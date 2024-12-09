<?php
namespace App\Enums;

class BookTransactionType {
    const IMPORT = 1; // Nhập sách
    const EXPORT = 2; // Xuất sách

    static public function getLabel($value) {
        switch ($value) {
            case self::IMPORT:
                return 'Nhập sách';
            case self::EXPORT:
                return 'Xuất sách';
            default:
                return '';
        }
    }

    static public function getValues() {
        return [
            self::IMPORT,
            self::EXPORT,
        ];
    }
}
