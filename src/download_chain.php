<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/classes/RestaurantChain.php';

// Processes other than POST requests, such as redirects, are required, but are handled simply here.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Invalid Request');
}

// Get parameters and typecast
$numberOfLocations = (int)($_POST['numberOfLocations'] ?? 5);

$zipCodeMin = (int)($_POST['zipCodeMin'] ?? 10000);
$zipCodeMax = (int)($_POST['zipCodeMax'] ?? 99999);
$employeeCount = (int)($_POST['employeeCount'] ?? 3);
$salaryMin = (int)($_POST['salaryMin'] ?? 30000);
$salaryMax = (int)($_POST['salaryMax'] ?? 80000);
$format = $_POST['format'] ?? 'html';

// Validation (simplified)
if ($numberOfLocations < 1 || $numberOfLocations > 50) exit('Invalid number of locations');
if ($employeeCount < 1 || $employeeCount > 20) exit('Invalid employee count');

// Generate restaurant chain
// pass values according to the order of the class constructor arguments
// RestaurantChain(numOfLocs, minSal, maxSal, minZip, maxZip, empCount)
$chain = new RestaurantChain(
    $numberOfLocations,
    $salaryMin,
    $salaryMax,
    $zipCodeMin,
    $zipCodeMax,
    $employeeCount
);

// Output according to format
if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="chain_data.md"');
    echo $chain->toMarkdown();
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="chain_data.json"');
    // convert the result of toArray() to JSON
    echo json_encode($chain->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="chain_data.txt"');
    echo $chain->toString();
} else {
    // HTML output
    // uncomment out if you want the file to be downloaded
    // header('Content-Disposition: attachment; filename="chain_data.html"');
    ?>
    <!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>Restaurant Chain Data</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="mb-3">
                <a href="generate_chain.php" class="btn btn-secondary">&laquo; 戻る</a>
            </div>
            <?= $chain->toHTML() ?>
        </div>
    </body>
    </html>
    <?php
}