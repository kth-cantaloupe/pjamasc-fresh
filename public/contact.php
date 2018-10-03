<?php
require '../require.php';

$formFields = [
  'company-name',
  'company-no',
  'full-name',
  'telephone-number',
  'email-address',
  'password',
  'password-confirmation'
];

if (Arrays::areset($_POST, $formFields) && isset($_FILES['rfp'])) {
    $password = $_POST['password'];
    $name = $_POST['full-name'];
    $companyName = $_POST['company-name'];
    $email = $_POST['email-address'];
    $phoneNumber = $_POST['company-no'];
    $message = $_POST['notes'];
    $file = $_FILES['rfp'];
    if (approveFile($file)) {
        // On success
        if(handleRegistration( $password,$name, $companyName, $email, $phoneNumber, $message, $file)) {
            echo $_SESSION[success];
            //$_SESSION[success] = "";
        }
        else{
            echo $_SESSION[error];
            //$_SESSION[error] = "";
        }

    }
    // On failure
    else {
        echo $_SESSION[error];
        //$_SESSION[error] = "";
    }
}

Template::render('contact.tpl', [
  'highlightedMenuItem' => 'contact'
]);



function handleRegistration($password,$name,$companyName,$email,$phoneNumber,$message,$file){
    $exists=  false; //CHECK USER DBCALL

    $date = date("Y-m-d H:i:s");
    if(!$exists) {
        $userStored = true; //DB CALL TO STORE USER, RETURN TRUE/FALSE
        if ($userStored) {
            $userid = 5; //GET USER DBCALL
            $rfpAdded = true; // ADD RFP IN DB, RETURN TRUE/FALSE
            if ($rfpAdded) {
                $rfpID = 5;// GET RFP ID DB CALL
                if (storeFile($rfpID, $file)) {
                    $_SESSION[success] = "File was sent!";
                    return true;
                } else {
                    // Delete User DBCALL
                    // Delete RFP DBCALL
                    return false;
                }
            } else {
                $_SESSION[error] = "Could not send file";
                return false;
            }
        }
    }
    else{
        $_SESSION[error] =  "Username is taken.";
        return false;
    }
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
            !isset($file[error]) ||
            is_array($file[error])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }

        // Check $_FILES['upfile']['error'] value.
        switch ($file[error]) {
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
        if ($file['size'] > 1000000) {
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

        $_SESSION[error] = $e->getMessage();
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
        $_SESSION[error] = $e->getMessage();
        return false;
    }
}