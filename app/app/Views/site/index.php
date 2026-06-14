<?= $this->extend('site/layouts/base') ?>

<?= $this->section('content') ?>

<?php if (!empty($slogan)): ?>
    <div class="page-header">
        <h1 class="page-title"><?= esc($siteName) ?></h1>
        <?php if (!empty($slogan)): ?>
            <p class="page-subtitle"><?= esc($slogan) ?></p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if (!empty($mainText)): ?>
    <div class="page-card">
        <div class="page-text">
            <?= $mainText ?>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
