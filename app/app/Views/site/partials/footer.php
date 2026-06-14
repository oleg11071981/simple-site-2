<?php
$configModel = new \App\Models\NSiteconfigModel();
$siteTitle = $siteName ?? $configModel->get('SiteName', 'n-cms');
$footerPages = $menuPages ?? (new \App\Models\NSiteModel())->getMenuPages();
$pagesModel = new \App\Models\NSiteModel();
?>
<footer class="footer">
    <div class="container footer-inner">
        <div class="copyright">
            © <?= date('Y') ?> <?= esc($siteTitle) ?>. Все права защищены.
        </div>
        <?php if (!empty($footerPages)): ?>
            <div class="footer-links">
                <?php foreach ($footerPages as $menuPage): ?>
                    <a href="/<?= esc($pagesModel->getFullPath($menuPage['id'])) ?>"><?= esc($menuPage['name']) ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</footer>
