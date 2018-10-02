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

if (Arrays::isset($_POST, $formFields) && isset($_FILES['rfp'])) {
  die('TODO: Handle user registration and RFP upload');
}

Template::render('contact.tpl', [
  'highlightedMenuItem' => 'contact'
]);
