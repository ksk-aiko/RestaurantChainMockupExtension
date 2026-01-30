<?php
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Restaurant Chain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">レストランチェーン・モック生成</h1>
            </div>
            <div class="card-body">
                <form action="download_chain.php" method="post">
                    
                    <!-- 場所（店舗）の設定 -->
                    <h5 class="mb-3 border-bottom pb-2">店舗設定</h5>
                    <div class="mb-3">
                        <label for="numberOfLocations" class="form-label">店舗数 (Number of Locations):</label>
                        <input type="number" class="form-control" id="numberOfLocations" name="numberOfLocations" min="1" max="50" value="5" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="zipCodeMin" class="form-label">郵便番号（最小）:</label>
                            <input type="number" class="form-control" id="zipCodeMin" name="zipCodeMin" value="10000" required>
                        </div>
                        <div class="col-md-6">
                            <label for="zipCodeMax" class="form-label">郵便番号（最大）:</label>
                            <input type="number" class="form-control" id="zipCodeMax" name="zipCodeMax" value="99999" required>
                        </div>
                    </div>

                    <!-- 従業員の設定 -->
                    <h5 class="mb-3 border-bottom pb-2 mt-4">従業員設定 (1店舗あたり)</h5>
                    <div class="mb-3">
                        <label for="employeeCount" class="form-label">従業員数:</label>
                        <input type="number" class="form-control" id="employeeCount" name="employeeCount" min="1" max="20" value="3" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="salaryMin" class="form-label">給与範囲（最小）:</label>
                            <input type="number" class="form-control" id="salaryMin" name="salaryMin" value="30000" step="1000" required>
                        </div>
                        <div class="col-md-6">
                            <label for="salaryMax" class="form-label">給与範囲（最大）:</label>
                            <input type="number" class="form-control" id="salaryMax" name="salaryMax" value="80000" step="1000" required>
                        </div>
                    </div>

                    <!-- 出力形式 -->
                    <h5 class="mb-3 border-bottom pb-2 mt-4">出力設定</h5>
                    <div class="mb-3">
                        <label for="format" class="form-label">ファイル形式:</label>
                        <select class="form-select" name="format" id="format">
                            <option value="html">HTML</option>
                            <option value="json">JSON</option>
                            <option value="markdown">Markdown</option>
                            <option value="txt">Text</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">生成してダウンロード</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>