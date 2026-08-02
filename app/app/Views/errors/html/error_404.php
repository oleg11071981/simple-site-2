<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>404 — Страница не найдена</title>
    <meta name="description" content="Запрашиваемая страница не существует или была перемещена">
    <meta name="robots" content="noindex, nofollow">
    <?= view('errors/html/_styles') ?>
</head>
<body>
<div class="error-page">
    <div class="error-code">404</div>
    <h1 class="error-title">Страница не найдена</h1>
    <p class="error-text">
        К сожалению, страница, которую вы ищете, не существует,<br>
        была перемещена или временно недоступна.
    </p>
    <div class="error-actions">
        <a href="/" class="btn-primary">На главную</a>
        <a href="javascript:history.back()" class="btn-secondary">Назад</a>
    </div>
</div>
</body>
</html>
