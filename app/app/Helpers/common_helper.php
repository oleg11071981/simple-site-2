<?php

if (!function_exists('declension')) {
    /**
     * Склонение существительных после числительных
     * @param int $number Число
     * @param string $one Единственное число (1)
     * @param string $two Два (2,3,4)
     * @param string $many Много (5+)
     * @return string
     */
    function declension(int $number, string $one, string $two, string $many): string
    {
        $mod10 = $number % 10;
        $mod100 = $number % 100;

        if ($mod100 >= 11 && $mod100 <= 19) {
            return $many;
        }

        if ($mod10 == 1) {
            return $one;
        }

        if ($mod10 >= 2 && $mod10 <= 4) {
            return $two;
        }

        return $many;
    }
}

if (!function_exists('format_file_size')) {
    function format_file_size(int $bytes): string
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
}

if (!function_exists('doc_file_icon')) {
    function doc_file_icon(string $fileType): string
    {
        $type = strtolower($fileType);
        if (in_array($type, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
            return '🖼️';
        }
        if (in_array($type, ['pdf'], true)) {
            return '📕';
        }
        if (in_array($type, ['doc', 'docx'], true)) {
            return '📝';
        }
        if (in_array($type, ['xls', 'xlsx'], true)) {
            return '📊';
        }
        return '📄';
    }
}