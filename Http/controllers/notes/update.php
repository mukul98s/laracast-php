<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 1;

$errors = [];

$note = $db->query("SELECT * FROM notes WHERE id = :id", ['id' => $_POST['id']])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
	$errors['body'] = 'A body of no more than 1000 characters is required';
}

if (!empty($errors)) {
	return view("notes/edit.view.php", [
		'heading' => "Edit Note",
		'errors' => $errors,
		'note' => $note
	]);
}

$db->query('UPDATE notes SET note = :body WHERE user_id = :user_id', [
	'body' => $_POST['body'],
	'user_id' => $currentUserId
]);

header('location: /notes');
exit();