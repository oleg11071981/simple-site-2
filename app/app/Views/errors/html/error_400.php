<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>400 — Некорректный запрос</title>
    <meta name="description" content="Некорректный URL адрес">
    <meta name="robots" content="noindex, nofollow">
    <?= view('errors/html/_styles') ?>
</head>
<body>
<div class="error-page">
    <div class="error-code">400</div>
    <h1 class="error-title">Некорректный запрос</h1>
    <p class="error-text">
        URL содержит недопустимые символы.<br>
        Проверьте правильность адреса.
    </p>
    <div class="error-actions">
        <a href="/" class="btn-primary">На главную</a>
        <a href="javascript:history.back()" class="btn-secondary">Назад</a>
    </div>
</div>
</body>
</html>
