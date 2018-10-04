<?php
require '../require.php';
$errors = array();

if(!Authentication::user()){
  $formFields = [
    'company-name',
    'company-no',
    'full-name',
    'telephone-number',
    'email-address',
    'password',
    'password-confirmation',
    'notes'
  ];
} else {
  $formFields = [
  'notes'
  ];
}


/*
 * Handles rfp form when posted.
 *
 */
if (Arrays::areset($_POST, $formFields) && isset($_FILES['rfp'])) {
    $filtered = inputFilter($_POST['password'],$_POST['password-confirmation'], $_FILES['rfp'], $_POST['company-no'],$_POST['telephone-number'] , $_POST['full-name'],$_POST['company-name'],$_POST['notes']);
    if ($filtered === true) {
        if (!Authentication::user()) {
            $userid = Database::getInstance()->addUser($_POST['email-address'], $_POST['full-name'], $_POST['company-name'], $_POST['company-no'], password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 12]), "unconfirmed_customer");
        } else {
            $userid = Authentication::user()->id;
        }

        if ($userid === false) {
            $errors[] = "You are already registerd as a user. Please log in to post an RFP";
        } else {
            $rfpid = Database::getInstance()->storeRFP($userid, $_POST['notes']);
            $stored = storeFile($rfpid,$_FILES['rfp']);
            if($stored==false)
                $error[]=$stored;
        }

    }
    else
        $errors[] = $filtered;
}

/*
 * Allows admin to confirm user if it is currently unconfirmed.
 */
if(isset($_POST['userId'])){
  Database::getInstance()->confirmUser($_POST['userId']);
}


/*
 * Fetches all rfp's and pedning users if logged in as admin
 */
$rfps = null;
$pendingUsers = null;
if(Authentication::admin()){
  $rfps = array_chunk(Database::getInstance()->getAllRFPs(), 2);
  $pendingUsers = Database::getInstance()->getPendingUsers();
}

/*
 * Renders contact page layout
 */
Template::render('contact.tpl', [
  'highlightedMenuItem' => 'contact',
  'errors' => $errors,
  'RFPs' => $rfps,
  'pendingUsers' => $pendingUsers
]);


/**
 * Input filter checks if all values are entered correctly, if not, an error message is returned describing what went wrong.
 *
 * @param $pass - password
 * @param $confPass - confirmed password
 * @param $file - attached file
 * @param $companyNo - 10 digit company number
 * @param $phone - phone number
 * @param $name - full name
 * @param $companyName - name of company
 * @param $notes - description of rfp
 * @return bool|string - Returns true if filtered without occurence of error, returns string of error if filter fails.
 *
 */
function inputFilter($pass,$confPass,$file,$companyNo,$phone,$name,$companyName,$notes){
     if(confirmPassword($pass,$confPass))
         return "Incorrect password.";
     elseif(approveFile($file)!==true)
         return approveFile($file);
     elseif(checkCompanyNo($companyNo))
         return "Invalid company number";
     else if(checkNumber($phone))
         return "Invalid phone number.";
     else if (checkEmpty($name) && checkEmpty($companyName) && checkEmpty($notes))
         return "Fill in all forms.";
    return true;

}

/**
 * Checks if wanted password matches with the confirmed password. Also checks that password is not empty.
 * @param $pass - wnted password
 * @param $confPass - confirm wanted password
 * @return bool - true or false depending if password was correct
 */
function confirmPassword($pass,$confPass){
   return $pass === $confPass && checkEmpty($pass);

}

/**
 * Checks if the company number is a digit, that it is exactly 10 digits and that it is not empty
 * @param $no - company number
 * @return bool - returns true or false depending on if the check failed or passed
 */
function checkCompanyNo($no){
    return ctype_digit($no) && strlen($no) ==10 && checkEmpty($no);
}

/**
 * Checks if number is a digit and that it is not empty.
 * @param $no - phone number of contact person
 * @return bool - true or false depending on if the check passed or failed.
 */
function checkNumber($no){
    return ctype_digit($no) && checkEmpty($no);
}

/**
 * Checks if a string is empty.
 * @param $name - a string
 * @return bool - true or false depending on if string is empty or not.
 */
function checkEmpty($name){
    return $name !=='';
}



/**
 * Checks the file is of correct size and format
 * Returns true if it is approved, false if it is not.

 * @param $file - The file that is to be uploaded
 * @return bool - True if success, false if error
 */
function approveFile($file){
    try {
        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (
            !isset($file['error']) ||
            is_array($file['error'])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }

        // Check $_FILES['upfile']['error'] value.
        switch ($file['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }

        // You should also check filesize here.
        if ($file['size'] > 100000000) {
            throw new RuntimeException('Exceeded filesize limit.');
        }

        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
                $finfo->file($file['tmp_name']),
                array(
                    'pdf' =>  'application/pdf',
                ),
                true
            )
        ) {
            throw new RuntimeException('Invalid file format, only PDF allowed');
        }





    } catch (RuntimeException $e) {
       return $e->getMessage();
    }
    return true;
}


/**
 * Stores attached pdf of rfp in the rfp storage.
 * @param $rfpId - id of rfp, also used as file name in storage folder
 * @param $file - attached file of rfp
 * @return bool|string returns true if store succeeded, returns error message if it failed.
 */
function storeFile ($rfpId, $file){
    try {
        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
                $finfo->file($file['tmp_name']),
                array(
                    'pdf' =>  'application/pdf',
                ),
                true
            )
        ) {
            throw new RuntimeException('Invalid file format, only PDF allowed');
        }


        if (!move_uploaded_file(
            $file['tmp_name'], sprintf('../storage/rfp/%s.%s' , $rfpId, $ext))) {
            throw new RuntimeException('Failed to move uploaded file.');
        }
        return true;
    }

    catch (RuntimeException $e) {
        return $e->getMessage();
    }
}
