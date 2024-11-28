<?php
namespace App\Enums\Book;

class Format{

    const HARDCOVER = 1; //Bìa cứng

    const PAPERBACK = 2; //Bìa mềm

    public static function getFormat($format){
        switch ($format){
            case self::HARDCOVER:
                return 'Bìa cứng';
            case self::PAPERBACK:
                return 'Bìa mềm';
            default:
                return 'Không xác định';
        }
    }

    public static function getValues(){
        return [
            self::HARDCOVER,
            self::PAPERBACK
        ];
    }
}
