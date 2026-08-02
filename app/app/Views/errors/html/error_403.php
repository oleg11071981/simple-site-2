<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>403 — Доступ запрещён</title>
    <meta name="description" content="У вас нет доступа к этой странице">
    <meta name="robots" content="noindex, nofollow">
    <?= view('errors/html/_styles') ?>
</head>
<body>
<div class="error-page">
    <div class="error-code">403</div>
    <h1 class="error-title">Доступ запрещён</h1>
    <p class="error-text">
        У вас нет прав для доступа к этой странице.<br>
        Войдите в систему или вернитесь на главную.
    </p>
    <div class="error-actions">
        <a href="/" class="btn-primary">На главную</a>
        <a href="javascript:history.back()" class="btn-secondary">Назад</a>
    </div>
</div>
</body>
</html>
