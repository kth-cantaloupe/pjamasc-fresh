<?php
require '../require.php';

header('Content-Type: application/json');

if (isset($_POST['email']) && isset($_POST['password'])) {
	$user = Database::getInstance()->getUserByEmail($_POST['email']);

	if ($user !== null) {
		if ($user->verifyPassword($_POST['password'])) {
			$_SESSION['user'] = $user->id;
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid password.', 'code' => 2]);
		}
	} else {
		echo json_encode(['status' => 'error', 'message' => 'No user with such email.', 'code' => 1]);
	}
} else {
	echo json_encode(['status' => 'error', 'message' => 'Missing paramaters.', 'code' => 0]);
}
