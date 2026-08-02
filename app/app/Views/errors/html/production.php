<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="robots" content="noindex">
    <title>Ошибка сервера</title>
    <?= view('errors/html/_styles') ?>
</head>
<body>
<div class="error-page">
    <div class="error-code">500</div>
    <h1 class="error-title">Что-то пошло не так</h1>
    <p class="error-text">
        Произошла внутренняя ошибка.<br>
        Пожалуйста, попробуйте позже.
    </p>
    <div class="error-actions">
        <a href="/" class="btn-primary">На главную</a>
        <a href="javascript:history.back()" class="btn-secondary">Назад</a>
    </div>
</div>
</body>
</html>
