<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/../Helpers/RandomGenerator.php';

$count = $_POST['count'] ?? 5;
$format = $_POST['format'] ?? 'html';

// if you want to use raw post data, uncomment the following lines
// $rawPostData = file_get_contents('php://input');
// echo $rawPostData;

$count = (int) $count;

$users =[];
for ($i = 0; $i < $count; $i++) {
    $users[] = new User();
}

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="users.md');
    foreach ($users as $user) {
        echo $user->toMarkdown();
    }
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="users.json"');
    $userArray = array_map(fn($user) => $user->toArray(), $users);
    echo json_encode($userArray);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="users.txt"');
    foreach ($users as $user) {
        echo $user->toString();
    }
} else {
    header('Content-Type: text/html');
    foreach ($users as $user) {
        echo $user->toHTML();
    }
}