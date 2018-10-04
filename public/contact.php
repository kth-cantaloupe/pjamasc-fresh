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

if (Arrays::areset($_POST, $formFields) && isset($_FILES['rfp'])) {

    if (inputFilter($_POST['password'],$_POST['password-confirmation'], $_FILES['rfp'])) {
        if (!Authentication::user()) {
            $userid = Database::getInstance()->addUser($_POST['email-address'], $_POST['full-name'], $_POST['company-name'], $_POST['company-no'], password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 12]), "unconfirmed_customer");
        } else {
            $userid = Authentication::user()->id;
        }

        if ($userid === false) {
            $errors[] = "You are already registerd as a user. Please log in to post an RFP";
        } else {
            $rfpid = Database::getInstance()->storeRFP($userid, $_POST['notes']);
            storeFile($rfpid,$_FILES['rfp']);
        }

    }
}

$rfps = null;
if(Authentication::admin()){
  $rfps = Database::getInstance()->getAllRFPs();
}

Template::render('contact.tpl', [
  'highlightedMenuItem' => 'contact',
  'errors' => $errors,
  'RFPs' => $rfps
]);

function inputFilter($pass,$confPass,$file){
    return confirmPassword($pass,$confPass);
}

function confirmPassword($pass,$confPass){
    if($pass === $confPass AND $pass !== '' AND $confPass!=='')
        return true;

    $errors[] = "Passwords does not match.";
    return false;
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
        $errors[]  = $e->getMessage();
        return false;
    }
    return true;
}



/*
 *
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
        $errors[]  = $e->getMessage();
        return false;
    }
}
