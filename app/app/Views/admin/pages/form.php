<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

    <div class="form-container">
        <div class="page-header">
            <h1><?= isset($page) ? 'Редактирование страницы' : 'Создание страницы' ?></h1>
            <p><?= isset($page) ? 'Редактирование «' . esc($page['name']) . '»' : 'Добавление новой страницы на сайт' ?></p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" id="successAlert">
                <span class="alert-icon">✓</span>
                <span class="alert-message"><?= esc(session()->getFlashdata('success')) ?></span>
                <button class="alert-close" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-error">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <div>⚠ <?= esc($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <span class="alert-icon">⚠</span>
                <span class="alert-message"><?= esc(session()->getFlashdata('error')) ?></span>
                <button class="alert-close" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        <?php endif; ?>

        <form action="<?= isset($page) ? '/admin-panel/pages/update/' . $page['id'] : '/admin-panel/pages/store' ?>" method="post" class="settings-form">
            <?= csrf_field() ?>

            <?php if (isset($page)): ?>
                <input type="hidden" name="id" value="<?= $page['id'] ?>">
            <?php endif; ?>

            <?php if (isset($parent_id) && $parent_id > 0 && !isset($page)): ?>
                <input type="hidden" name="parent" value="<?= $parent_id ?>">
            <?php endif; ?>

            <div class="settings-section">
                <h2>Расположение</h2>

                <?php if (isset($parent_id) && $parent_id > 0 && !isset($page)): ?>
                    <div class="form-group">
                        <label>Родительская страница</label>
                        <div class="form-control-static">
                            <?php
                            $parentName = 'Корневая страница';
                            if (!empty($parents)) {
                                foreach ($parents as $p) {
                                    if ($p['id'] == $parent_id) {
                                        $parentName = $p['name'];
                                        break;
                                    }
                                }
                            }
                            ?>
                            📁 <?= esc($parentName) ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <label for="parent">Родительская страница</label>
                        <select id="parent" name="parent" class="form-control">
                            <option value="0">— Корневая страница —</option>
                            <?php if (!empty($parents)): ?>
                                <?php foreach ($parents as $parent): ?>
                                    <?php if (isset($page) && $page['id'] == $parent['id']) continue; ?>
                                    <option value="<?= $parent['id'] ?>"
                                        <?= (isset($page) && ($page['parent'] ?? 0) == $parent['id']) ? 'selected' : '' ?>>
                                        <?= str_repeat('—', $parent['level'] ?? 0) ?> <?= esc($parent['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                <?php endif; ?>
            </div>

            <div class="settings-section">
                <h2>Основная информация</h2>

                <?php if (isset($page)): ?>
                    <div class="form-group">
                        <label>ID страницы</label>
                        <div class="form-control-static"><?= $page['id'] ?></div>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="name">Название страницы <span class="required">*</span></label>
                    <input type="text" id="name" name="name"
                           value="<?= esc($page['name'] ?? '') ?>"
                           class="form-control"
                           placeholder="Введите название страницы"
                           required>
                </div>

                <div class="form-group">
                    <label for="path">URL-путь</label>
                    <input type="text" id="path" name="path"
                           value="<?= esc($page['path'] ?? '') ?>"
                           class="form-control"
                           placeholder="o-kompanii">
                    <small>
                        <a href="#" onclick="rusToTranslit('path', document.getElementById('name')); return false;">Сформировать из названия</a>
                    </small>
                </div>
            </div>

            <div class="settings-section">
                <h2>Содержимое</h2>
                <div class="form-group">
                    <label for="more_info">Подробная информация</label>
                    <textarea id="more_info" name="more_info" rows="15"
                              class="form-control"
                              placeholder="Введите содержимое страницы"><?= htmlspecialchars($page['more_info'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="settings-section">
                <h2>SEO</h2>
                <div class="form-group">
                    <label for="keywords">Ключевые слова</label>
                    <textarea id="keywords" name="keywords" rows="3"
                              class="form-control"
                              placeholder="Ключевые слова через запятую"><?= esc($page['keywords'] ?? '') ?></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Мета-описание</label>
                    <textarea id="description" name="description" rows="4"
                              class="form-control"
                              placeholder="Краткое описание для поисковых систем"><?= esc($page['description'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="settings-section">
                <h2>Анонс</h2>
                <div class="form-group">
                    <label for="anons_text">Краткое описание</label>
                    <textarea id="anons_text" name="anons_text" rows="4"
                              class="form-control"
                              placeholder="Краткое описание страницы"><?= esc($page['anons_text'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="settings-section">
                <h2>Настройки отображения</h2>
                <div class="form-group">
                    <label for="show_in_menu">Показывать в меню</label>
                    <select id="show_in_menu" name="show_in_menu" class="form-control">
                        <option value="1" <?= (isset($page) && $page['show_in_menu'] == 1) ? 'selected' : '' ?>>Да</option>
                        <option value="0" <?= (isset($page) && $page['show_in_menu'] == 0) ? 'selected' : '' ?>>Нет</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="priority">Приоритет</label>
                    <input type="number" id="priority" name="priority"
                           value="<?= esc($page['priority'] ?? 0) ?>"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="publish">Публикация</label>
                    <select id="publish" name="publish" class="form-control">
                        <option value="0" <?= (isset($page) && $page['publish'] == 0) ? 'selected' : '' ?>>Черновик</option>
                        <option value="1" <?= (isset($page) && $page['publish'] == 1) ? 'selected' : '' ?>>Опубликовано</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="new_on_site">Пометить как новинку</label>
                    <select id="new_on_site" name="new_on_site" class="form-control">
                        <option value="0" <?= (isset($page) && $page['new_on_site'] == 0) ? 'selected' : '' ?>>Нет</option>
                        <option value="1" <?= (isset($page) && $page['new_on_site'] == 1) ? 'selected' : '' ?>>Да</option>
                    </select>
                </div>
            </div>

            <div class="settings-section">
                <h2>Галерея</h2>
                <div class="form-group">
                    <label for="media">Привязать галерею</label>
                    <div class="media-select-wrapper">
                        <input type="text"
                               id="mediaSearch"
                               class="form-control"
                               placeholder="Поиск галереи..."
                               autocomplete="off">
                        <select id="media" name="media" class="form-control" size="8" style="margin-top: 8px;">
                            <option value="0">— Без галереи —</option>
                            <?php if (!empty($mediaCategories)): ?>
                                <?php foreach ($mediaCategories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"
                                            data-name="<?= esc(strtolower($cat['name'])) ?>"
                                        <?= (isset($page) && $page['media'] == $cat['id']) ? 'selected' : '' ?>>
                                        <?= str_repeat('—', $cat['level'] ?? 0) ?> 📁 <?= esc($cat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <?php if (isset($page)): ?>
                <div class="settings-section">
                    <div class="form-group">
                        <label>Создано</label>
                        <div class="form-control-static"><?= date('d.m.Y H:i:s', strtotime($page['create'])) ?></div>
                    </div>
                    <div class="form-group">
                        <label>Изменено</label>
                        <div class="form-control-static"><?= date('d.m.Y H:i:s', strtotime($page['modify'])) ?></div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-actions">
                <a href="/admin-panel/pages<?= (isset($parent_id) && $parent_id > 0) ? '?parent=' . $parent_id : '' ?>" class="btn-cancel">Отмена</a>
                <button type="submit" class="btn-save">💾 Сохранить</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('mediaSearch');
            const selectEl = document.getElementById('media');

            if (searchInput && selectEl) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = searchInput.value.toLowerCase().trim();
                    selectEl.querySelectorAll('option').forEach(option => {
                        const text = option.textContent.toLowerCase();
                        const categoryName = option.getAttribute('data-name') || text;
                        option.style.display = (searchTerm === '' || categoryName.includes(searchTerm) || text.includes(searchTerm)) ? '' : 'none';
                    });
                });
            }
        });

        if (typeof CKEDITOR !== 'undefined' && document.getElementById('more_info') && !CKEDITOR.instances.more_info) {
            CKEDITOR.replace('more_info', {
                language: 'ru',
                height: 400,
                filebrowserBrowseUrl: '/admin-panel/editor/ckeditor-browse',
                filebrowserUploadUrl: '/admin-panel/editor/upload-image'
            });
        }
    </script>

<?= $this->endSection() ?>
