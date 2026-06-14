<header class="header">
    <div class="container navbar">
        <a href="/" class="logo">
            <?php
            $settingsModel = new \App\Models\NSiteconfigModel();
            echo esc($settingsModel->get('SiteName') ?? 'n-cms');
            ?>
        </a>

        <?= view('site/partials/menu', ['menuPages' => $menuPages, 'activePage' => $activePage, 'type' => 'desktop']) ?>

        <button class="burger" id="burgerBtn" aria-label="Меню">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <?= view('site/partials/menu', ['menuPages' => $menuPages, 'activePage' => $activePage, 'type' => 'mobile']) ?>
</header>
