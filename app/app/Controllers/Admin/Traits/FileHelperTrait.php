<?php

/**
 * Трейт с вспомогательными методами для работы с файлами
 *
 * @package App\Controllers\Admin\Traits
 */

namespace App\Controllers\Admin\Traits;

use CodeIgniter\HTTP\Files\UploadedFile;

trait FileHelperTrait
{
    /**
     * @var array<string, list<string>>
     */
    private array $mimeMap = [
        'jpg'  => ['image/jpeg', 'image/pjpeg'],
        'jpeg' => ['image/jpeg', 'image/pjpeg'],
        'png'  => ['image/png'],
        'gif'  => ['image/gif'],
        'webp' => ['image/webp'],
        'pdf'  => ['application/pdf'],
        'doc'  => ['application/msword'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
        'xls'  => ['application/vnd.ms-excel'],
        'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        'zip'  => ['application/zip', 'application/x-zip-compressed'],
        'rar'  => ['application/vnd.rar', 'application/x-rar-compressed'],
        'txt'  => ['text/plain'],
    ];

    /**
     * Проверить загружаемый файл по расширению и MIME.
     * Возвращает текст ошибки или null, если файл допустим.
     */
    protected function validateUploadedFile(UploadedFile $file, array $allowedExtensions): ?string
    {
        if (!$file->isValid()) {
            return 'Файл повреждён или не был загружен';
        }

        $extension = strtolower($file->getExtension());
        if (!in_array($extension, $allowedExtensions, true)) {
            return 'Тип файла не поддерживается';
        }

        $mimeType = strtolower((string) $file->getMimeType());
        $allowedMimes = $this->mimeMap[$extension] ?? [];

        if ($allowedMimes !== [] && !in_array($mimeType, $allowedMimes, true)) {
            return 'Содержимое файла не соответствует заявленному типу';
        }

        if ($this->isImage($extension)) {
            $imageInfo = @getimagesize($file->getTempName());
            if ($imageInfo === false) {
                return 'Файл не является корректным изображением';
            }
        }

        return null;
    }

    protected function formatFileSize(int $bytes): string
    {
        if ($bytes < 1024) {
            return $bytes . ' Б';
        }
        if ($bytes < 1048576) {
            return round($bytes / 1024, 1) . ' КБ';
        }
        if ($bytes < 1073741824) {
            return round($bytes / 1048576, 1) . ' МБ';
        }
        return round($bytes / 1073741824, 1) . ' ГБ';
    }

    protected function getFileIcon(string $fileType): string
    {
        $icons = [
            'jpg' => '🖼️', 'jpeg' => '🖼️', 'png' => '🖼️', 'gif' => '🖼️',
            'pdf' => '📄', 'doc' => '📝', 'docx' => '📝', 'xls' => '📊',
            'xlsx' => '📊', 'zip' => '📦', 'rar' => '📦', 'txt' => '📃',
            'mp3' => '🎵', 'mp4' => '🎬', 'avi' => '🎬',
        ];
        return $icons[strtolower($fileType)] ?? '📁';
    }

    protected function isImage(string $fileType): bool
    {
        return in_array(strtolower($fileType), ['jpg', 'jpeg', 'png', 'gif', 'webp'], true);
    }
}
