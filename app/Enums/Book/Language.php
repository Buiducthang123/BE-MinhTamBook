<?php
namespace App\Enums\Book;


class Language {
    const VIETNAMESE = 1; // Tiếng Việt

    const ENGLISH = 2; // Tiếng Anh

    const ORTHER = 3; // Khác

    public static function getValues()
    {
        return [
            self::VIETNAMESE,
            self::ENGLISH,
            self::ORTHER
        ];
    }

    public static function getLanguage($language)
    {
        switch ($language) {
            case self::VIETNAMESE:
                return 'Tiếng Việt';
            case self::ENGLISH:
                return 'Tiếng Anh';
            case self::ORTHER:
                return 'Khác';
            default:
                return 'Không xác định';
        }
    }
}
