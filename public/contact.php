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
      if(!Authentication::user()){
        $userid = Database::getInstance()->addUser($_POST['email-address'], $_POST['full-name'], $_POST['company-name'], $_POST['company-no'], password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost"=>12]), "uncomfirmed_customer");
      } else {
        $userid = Authentication::user()->id;
      }

      if($userid === false) {
        $errors[] = "You are already registerd as a user. Please log in to post an RFP";
      } else {
          Database::getInstance()->storeRFP($userid, $_POST['notes']);
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
