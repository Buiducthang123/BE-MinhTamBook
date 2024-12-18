<?php
namespace App\Enums;

class OrderStatus
{
   //chờ duyệt
    const PENDING = 1;

    //đã được duyệt

    const APPROVED = 2;

    //đang chuẩn bị hàng

    const PREPARING = 3;

    //đơn hàng đang được vận chuyển

    const SHIPPING = 4;

    //đã giao hàng

    const DELIVERED = 5;

    //đã hủy

    const CANCELLED = 6;

    public static function getStatuses()
    {
        return [
            self::PENDING => 'Chờ duyệt',
            self::APPROVED => 'Đã duyệt',
            self::PREPARING => 'Đang chuẩn bị hàng',
            self::SHIPPING => 'Đang vận chuyển',
            self::DELIVERED => 'Đã giao hàng',
            self::CANCELLED => 'Đã hủy',
        ];
    }

    public static function getAllStatuses()
    {
        return [
            self::PENDING,
            self::APPROVED,
            self::PREPARING,
            self::SHIPPING,
            self::DELIVERED,
            self::CANCELLED,
        ];
    }

}
