<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card p-4 shadow-sm">
            <h3 class="mb-4">来所予定の追加</h3>
            <form action="<?= route('store') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label font-weight-bold">日付</label>
                    <input type="text" name="target_date" class="form-control" value="<?= e($date) ?>" readonly>
                </div>
                <div class="mb-4">
                    <label class="form-label font-weght-bold">予定内容</label>
                    <select name="plan" class="form-select" required>
                        <option value="">選択してください</option>
                        <option value="A">A（ご飯あり１日）</option>
                        <option value="B">B（ご飯あり午前）</option>
                        <option value="C">C（ご飯あり午後）</option>
                        <option value="D">D（ご飯なし午前）</option>
                        <option value="E">E（ご飯なし午後）</option>
                    </select>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" name="save" class="btn btn-primary">登録する</button>
                    <a href="<?= route('index', ['ym' => substr($date, 0, 7)]) ?>" class="btn btn-secondary mt-2">戻る</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>