<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
	$errors['body'] = 'A body of no more than 1000 characters is required';
}

if (!empty($errors)) {
	return view("notes/create.view.php", [
		'errors' => $errors,
		'heading' => "Create Note"
	]);
}

$db->query('INSERT INTO notes(note, user_id) VALUES (:body, :user_id)', [
	'body' => $_POST['body'],
	'user_id' => $currentUserId
]);

header('location: /notes');
exit();