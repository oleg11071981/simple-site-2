<?= $this->extend('site/layouts/base') ?>

<?= $this->section('content') ?>

<?php if (!empty($mainText)): ?>
    <section class="section appeal-section">
        <div class="container">
            <div class="appeal-card">
                <?= $mainText ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($sections)): ?>
    <section class="section sections-section">
        <div class="container">
            <h2 class="section-title"><?= esc($slogan ?: 'Разделы') ?></h2>
            <div class="sections-grid">
                <?php foreach ($sections as $section): ?>
                    <div class="section-card" id="section-<?= (int) $section['id'] ?>">
                        <div class="card-header">
                            <a href="/<?= esc($section['full_path']) ?>" style="color: inherit; text-decoration: none;">
                                <?= esc($section['name']) ?>
                            </a>
                        </div>
                        <?php if (!empty($section['children'])): ?>
                            <div class="subsections">
                                <?php foreach ($section['children'] as $child): ?>
                                    <a href="/<?= esc($child['full_path']) ?>">→ <?= esc($child['name']) ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?= $this->endSection() ?>
