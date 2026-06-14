<?= $this->extend('site/layouts/base') ?>

<?= $this->section('content') ?>

<section class="section appeal-section">
    <div class="container">
        <div class="breadcrumbs">
            <a href="/">Главная</a>
            <span class="separator">/</span>
            <span class="current">Контакты</span>
        </div>

        <h1 class="page-title">Контакты</h1>

        <div class="appeal-card">
            <h2 class="appeal-title">Контактная информация</h2>
            <ul class="appeal-list">
                <?php if (!empty($address)): ?>
                    <li><strong>Адрес:</strong> <?= esc($address) ?></li>
                <?php endif; ?>
                <?php if (!empty($phone)): ?>
                    <li><strong>Телефон:</strong> <a href="tel:<?= esc($phone) ?>" class="gos-link"><?= esc($phone) ?></a></li>
                <?php endif; ?>
                <?php if (!empty($email)): ?>
                    <li><strong>Email:</strong> <a href="mailto:<?= esc($email) ?>" class="gos-link"><?= esc($email) ?></a></li>
                <?php endif; ?>
                <?php if (!empty($adminEmail)): ?>
                    <li><strong>Email администратора:</strong> <a href="mailto:<?= esc($adminEmail) ?>" class="gos-link"><?= esc($adminEmail) ?></a></li>
                <?php endif; ?>
                <?php if (!empty($workSchedule)): ?>
                    <li><strong>График работы:</strong> <?= esc($workSchedule) ?></li>
                <?php endif; ?>
            </ul>

            <?php if (!empty($additional_field1)): ?>
                <div class="appeal-notice">
                    <?= $additional_field1 ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
