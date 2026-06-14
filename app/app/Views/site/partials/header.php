<?php
$pagesModel = new \App\Models\NSiteModel();
$configModel = new \App\Models\NSiteconfigModel();
$logoName = $siteName ?? $configModel->get('SiteName', 'n-cms');
$navPages = $menuPages ?? $pagesModel->getMenuPages();
?>
<header class="header">
    <div class="container navbar">
        <a href="/" class="logo"><?= esc($logoName) ?></a>

        <div class="nav-menu">
            <a href="/" class="nav-link <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Главная</a>
            <?php foreach ($navPages as $menuPage): ?>
                <a href="/<?= esc($pagesModel->getFullPath($menuPage['id'])) ?>"
                   class="nav-link <?= ($activePage ?? '') === 'page_' . $menuPage['id'] ? 'active' : '' ?>">
                    <?= esc($menuPage['name']) ?>
                </a>
            <?php endforeach; ?>
            <a href="/contacts" class="nav-link <?= ($activePage ?? '') === 'contacts' ? 'active' : '' ?>">Контакты</a>
        </div>

        <button class="burger" id="burgerBtn" aria-label="Меню">
            <span></span><span></span><span></span>
        </button>
    </div>

    <div class="mobile-nav" id="mobileMenu">
        <a href="/" class="nav-link <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Главная</a>
        <?php foreach ($navPages as $menuPage): ?>
            <a href="/<?= esc($pagesModel->getFullPath($menuPage['id'])) ?>"
               class="nav-link <?= ($activePage ?? '') === 'page_' . $menuPage['id'] ? 'active' : '' ?>">
                <?= esc($menuPage['name']) ?>
            </a>
        <?php endforeach; ?>
        <a href="/contacts" class="nav-link <?= ($activePage ?? '') === 'contacts' ? 'active' : '' ?>">Контакты</a>
    </div>
</header>
