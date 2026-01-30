<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/../Helpers/RandomGenerator.php';

$count = $_POST['count'] ?? 5;
$format = $_POST['format'] ?? 'html';

if ( is_null($count) || is_null($format)) {
    exit('Missing parameters');
} 

if (is_numeric($count) || $cont < 1 || $count > 100) {
    exit('Invald count. Must be a numcer between 1 and 100.');
}

$allowedFormats = ['json', 'txt', 'html', 'md'];
if (!in_array($format, $allowedFormats)) {
    exit('Invalid type. Must be one of: ' . implode(', ', $allowedFormats));
}

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

    // if you want to use raw post data, uncomment the following lines
    // $rawPostData = file_get_contents('php://input');
    // echo $rawPostData;
}