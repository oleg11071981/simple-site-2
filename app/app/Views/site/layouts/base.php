<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title><?= esc($title ?? 'Сайт') ?></title>
    <?php if (!empty($description)): ?>
        <meta name="description" content="<?= esc($description) ?>">
    <?php endif; ?>
    <?php if (!empty($keywords)): ?>
        <meta name="keywords" content="<?= esc($keywords) ?>">
    <?php endif; ?>

    <?php
    $cssVersion = filemtime(FCPATH . 'css/site.css');
    $jsVersion = filemtime(FCPATH . 'js/site.js');
    ?>

    <link rel="stylesheet" href="/css/site.css?v=<?= $cssVersion ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
</head>
<body>

<?= view('site/partials/header', [
    'menuPages'  => $menuPages ?? [],
    'activePage' => $activePage ?? '',
    'siteName'   => $siteName ?? null,
]) ?>

<main>
    <?= $this->renderSection('content') ?>
</main>

<?= view('site/partials/footer', [
    'menuPages' => $menuPages ?? [],
    'siteName'  => $siteName ?? null,
]) ?>

<script src="/js/site.js?v=<?= $jsVersion ?>"></script>
<?php if (!empty($enableSearch)): ?>
    <?php $searchVersion = filemtime(FCPATH . 'js/search.js'); ?>
    <script src="/js/search.js?v=<?= $searchVersion ?>"></script>
<?php endif; ?>
</body>
</html>
