<?= $this->extend('site/layouts/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="breadcrumbs">
        <a href="/">Главная</a>
        <?php foreach ($breadcrumbs as $crumb): ?>
            <span class="separator">/</span>
            <a href="<?= esc($crumb['url']) ?>"><?= esc($crumb['name']) ?></a>
        <?php endforeach; ?>
        <span class="separator">/</span>
        <span class="current"><?= esc($page['name']) ?></span>
    </div>

    <h1 class="page-title"><?= esc($page['name']) ?></h1>

    <?php if (!empty($page['anons_text']) || !empty($page['more_info'])): ?>
        <div class="info-card page-text">
            <?php if (!empty($page['anons_text'])): ?>
                <p><?= esc($page['anons_text']) ?></p>
            <?php endif; ?>
            <?php if (!empty($page['more_info'])): ?>
                <?= $page['more_info'] ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($childrenTree)): ?>
        <div class="sections-grid" style="margin-bottom: 2rem;">
            <div class="section-card">
                <div class="card-header">Подразделы</div>
                <div class="subsections">
                    <?php foreach ($childrenTree as $child): ?>
                        <a href="/<?= esc($child['full_path']) ?>">→ <?= esc($child['name']) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($galleryFiles)): ?>
        <div class="search-section">
            <div class="search-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" id="searchInput" class="search-input" placeholder="Поиск по документам...">
                <button id="clearSearch" class="search-clear" style="display: none;" type="button">✕</button>
            </div>
            <div class="search-counter" id="searchCounter"></div>
        </div>

        <div class="docs-grid" id="docsGrid">
            <?php foreach ($galleryFiles as $file): ?>
                <?php
                $isImage = in_array(strtolower($file['file_type']), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true);
                $fileUrl = '/uploads/' . $file['file_name'];
                $displayName = $file['display_name'] ?? $file['name'];
                ?>
                <div class="doc-card" data-title="<?= esc($displayName, 'attr') ?>">
                    <div class="doc-card-icon"><?= doc_file_icon($file['file_type']) ?></div>
                    <div class="doc-card-content">
                        <?php if ($isImage): ?>
                            <a href="<?= esc($fileUrl) ?>" class="doc-card-link" target="_blank" rel="noopener">
                                <?= esc($displayName) ?>
                            </a>
                        <?php else: ?>
                            <a href="<?= esc($fileUrl) ?>" class="doc-card-link" download>
                                <?= esc($displayName) ?>
                            </a>
                        <?php endif; ?>
                        <div class="doc-card-meta">
                            <?= strtoupper(esc($file['file_type'])) ?>
                            <?php if (!empty($file['size_formatted'])): ?>
                                , <?= esc($file['size_formatted']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
