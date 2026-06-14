<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

    <div class="form-container">
        <div class="page-header">
            <h1>Настройки сайта</h1>
            <p>Управление параметрами конфигурации сайта</p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success" id="successAlert">
                <span class="alert-icon">✓</span>
                <span class="alert-message"><?= esc(session()->getFlashdata('success')) ?></span>
                <button class="alert-close" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error" id="errorAlert">
                <span class="alert-icon">⚠</span>
                <span class="alert-message"><?= esc(session()->getFlashdata('error')) ?></span>
                <button class="alert-close" onclick="this.parentElement.style.display='none'">×</button>
            </div>
        <?php endif; ?>

        <form action="/admin-panel/settings/save" method="post" class="settings-form">
            <?= csrf_field() ?>

            <div class="settings-section">
                <h2>Основные настройки</h2>

                <div class="form-group">
                    <label for="SiteName">Название сайта</label>
                    <input type="text" id="SiteName" name="SiteName"
                           value="<?= esc($settings['SiteName'] ?? '') ?>"
                           class="form-control"
                           placeholder="Введите название сайта">
                </div>

                <div class="form-group">
                    <label for="Slogan">Слоган</label>
                    <input type="text" id="Slogan" name="Slogan"
                           value="<?= esc($settings['Slogan'] ?? '') ?>"
                           class="form-control"
                           placeholder="Слоган сайта">
                </div>

                <div class="form-group">
                    <label for="MainText">Главный текст</label>
                    <textarea id="MainText" name="MainText" rows="15"
                              class="form-control"
                              placeholder="Введите основной текст сайта"><?= htmlspecialchars($settings['MainText'] ?? '') ?></textarea>
                    <small>Поддерживается HTML разметка. Используйте визуальный редактор.</small>
                </div>
            </div>

            <div class="settings-section">
                <h2>Контактная информация</h2>

                <div class="form-group">
                    <label for="Email">Email (публичный)</label>
                    <input type="email" id="Email" name="Email"
                           value="<?= esc($settings['Email'] ?? '') ?>"
                           class="form-control"
                           placeholder="example@mail.ru">
                </div>

                <div class="form-group">
                    <label for="AdminEmail">Email администратора</label>
                    <input type="email" id="AdminEmail" name="AdminEmail"
                           value="<?= esc($settings['AdminEmail'] ?? '') ?>"
                           class="form-control"
                           placeholder="admin@example.com">
                </div>

                <div class="form-group">
                    <label for="Phone">Телефон</label>
                    <input type="text" id="Phone" name="Phone"
                           value="<?= esc($settings['Phone'] ?? '') ?>"
                           class="form-control"
                           placeholder="+7 (999) 123-45-67">
                </div>

                <div class="form-group">
                    <label for="Adress">Адрес</label>
                    <input type="text" id="Adress" name="Adress"
                           value="<?= esc($settings['Adress'] ?? '') ?>"
                           class="form-control"
                           placeholder="г. Москва, ул. Примерная, д. 1">
                </div>

                <div class="form-group">
                    <label for="WorkSchedule">График работы</label>
                    <input type="text" id="WorkSchedule" name="WorkSchedule"
                           value="<?= esc($settings['WorkSchedule'] ?? '') ?>"
                           class="form-control"
                           placeholder="Пн-Пт 9:00 - 18:00">
                </div>
            </div>

            <div class="settings-section">
                <h2>SEO</h2>

                <div class="form-group">
                    <label for="Keywords">Ключевые слова</label>
                    <textarea id="Keywords" name="Keywords" rows="3"
                              class="form-control"
                              placeholder="Ключевые слова через запятую"><?= esc($settings['Keywords'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="Description">Описание</label>
                    <textarea id="Description" name="Description" rows="3"
                              class="form-control"
                              placeholder="SEO описание сайта"><?= esc($settings['Description'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="settings-section">
                <h2>Счетчики и аналитика</h2>

                <div class="form-group">
                    <label for="Counters">Код счетчиков</label>
                    <textarea id="Counters" name="Counters" rows="10"
                              class="form-control"
                              placeholder="Код Яндекс.Метрики, Google Analytics и др."><?= esc($settings['Counters'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="settings-section">
                <h2>Дополнительные поля</h2>

                <div class="form-group">
                    <label for="additional_field1">Схема проезда (HTML-код карты)</label>
                    <textarea id="additional_field1" name="additional_field1" rows="8"
                              class="form-control"
                              placeholder="Код карты Яндекс или Google Maps"><?= esc($settings['additional_field1'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="additional_field2">Дополнительное поле 2</label>
                    <input type="text" id="additional_field2" name="additional_field2"
                           value="<?= esc($settings['additional_field2'] ?? '') ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">💾 Сохранить настройки</button>
            </div>
        </form>
    </div>

    <script>
        if (typeof CKEDITOR !== 'undefined' && document.getElementById('MainText') && !CKEDITOR.instances.MainText) {
            CKEDITOR.replace('MainText', {
                language: 'ru',
                height: 400,
                filebrowserBrowseUrl: '/admin-panel/editor/ckeditor-browse',
                filebrowserUploadUrl: '/admin-panel/editor/upload-image'
            });
        }
    </script>

<?= $this->endSection() ?>
