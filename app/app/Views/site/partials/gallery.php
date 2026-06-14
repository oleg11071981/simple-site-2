<?php if (!empty($files)): ?>
    <section class="gallery-section">
        <h2 class="gallery-title">Галерея</h2>
        <div class="gallery-grid">
            <?php foreach ($files as $file): ?>
                <?php
                $isImage = in_array(strtolower($file['file_type']), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                $caption = !empty($file['title']) ? $file['title'] : $file['name'];
                ?>
                <div class="gallery-item">
                    <?php if ($isImage): ?>
                        <a href="/uploads/<?= esc($file['file_name']) ?>"
                           data-fancybox="gallery"
                           data-caption="<?= esc($caption) ?>">
                            <img src="/uploads/<?= esc($file['file_name']) ?>" alt="<?= esc($caption) ?>">
                        </a>
                        <?php if ($caption): ?>
                            <div class="gallery-caption"><?= esc($caption) ?></div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="gallery-file">
                            <span class="file-icon">📄</span>
                            <span class="file-name"><?= esc($file['name']) ?></span>
                            <a href="/uploads/<?= esc($file['file_name']) ?>"
                               class="file-download"
                               download
                               title="Скачать файл">
                                Скачать
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
