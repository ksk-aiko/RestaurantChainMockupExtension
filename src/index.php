<?php

spl_autoload_extensions('.php');
spl_autoload_register(function($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) include $file;
});

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/classes/RestaurantChain.php';

$chains = [];
$chainCount = rand(2, 4);
for ($i = 0; $i < $chainCount; $i++) {
    $chains[] = new RestaurantChain();
}

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Chains Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <header class="mb-4">
            <h1 class="display-4 fw-bold mb-2">Restaurant Chains</h1>
            <p class="text-muted mb-0">レストランチェーン管理ページ</p>
        </header>

        <?php foreach ($chains as $chainIndex => $chain):
            $locations = $chain->restaurantLocations;
            $accordionId = "locationsAccordion{$chainIndex}";
        ?>
            <section class="mb-5">
                <div class="d-flex align-items-baseline justify-content-between mb-2">
                    <h2 class="h3 fw-bold mb-0"><?= e($chain->name) ?></h2>
                    <span class="text-muted small">Number of stores: <?= e(count($locations)) ?></span>
                </div>

                <div class="accordion" id="<?= e($accordionId) ?>">
                    <?php foreach ($locations as $index => $location):
                        $collapseId = "locationCollapse{$chainIndex}_{$index}";
                        $headingId = "locationHeading{$chainIndex}_{$index}";
                    ?>
                        <div class="accordion-item mb-2">
                            <h2 class="accordion-header" id="<?= e($headingId) ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= e($collapseId) ?>" aria-expanded="false" aria-controls="<?= e($collapseId) ?>">
                                    <?= e($location->name) ?>
                                </button>
                            </h2>
                            <div id="<?= e($collapseId) ?>" class="accordion-collapse collapse" aria-labelledby="<?= e($headingId) ?>" data-bs-parent="#<?= e($accordionId) ?>">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <h3 class="h5 mb-1"><?= e($location->name) ?></h3>
                                            <div class="text-muted small"><?= e($chain->name) ?></div>
                                            <div class="text-muted small"><?= e($location->getFullAddress()) ?></div>
                                        </div>
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-striped align-middle mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Job Title</th>
                                                            <th>name</th>
                                                            <th>Start Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($location->employees as $employee): ?>
                                                            <tr>
                                                                <td><?= e($employee->id) ?></td>
                                                                <td><?= e($employee->jobTitle) ?></td>
                                                                <td><?= e($employee->getFullName()) ?></td>
                                                                <td><?= e($employee->getStartDateFormatted()) ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
