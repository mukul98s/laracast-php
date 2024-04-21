<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

// validate inputs
if (! Validator::email($email)) {
	$errors['email'] = 'Provide a valid email address';
}

if (! Validator::string($password, 8, 255)) {
	$errors['password'] = 'Password should be between 8 to 255 characters range';
}

if (!empty($errors)) {
	return view("registration/create.view.php", [
		'errors' => $errors,
	]);	
}

$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM users WHERE email = :email', [
	'email' => $email
])->find();

if ($user) {
	header('location: /');
	exit();	
}

$db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
	'email' => $email,
	'password' => password_hash($password, PASSWORD_BCRYPT)
]);

$_SESSION['user'] = [
	'email' => $email
];

header('location: /');
exit();	
