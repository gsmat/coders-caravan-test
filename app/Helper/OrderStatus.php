<?php

namespace App\Helper;

class OrderStatus
{
    const PENDING = 1;
    const CONFIRMED = 2;
    const SHIPPED = 3;
    const DELIVERED = 4;
    const CANCELLED = 5;
    const RETURNED = 6;
    const FAILED = 7;


    public static function order_status_converter(int $status)
    {
        switch ($status) {
            case 1:
                return '<span class="badge bg-warning">PENDING</span>';
                break;
            case 2:
                return '<span class="badge bg-info">CONFIRMED</span>';
                break;
            case 3:
                return '<span class="badge bg-primary">SHIPPED</span>';
                break;
            case 4:
                return '<span class="badge bg-success">DELIVERED</span>';
                break;
            case 5:
                return '<span class="badge bg-danger">CANCELLED</span>';
                break;
            case 6:
                return '<span class="badge bg-secondary">RETURNED</span>';
                break;
            case 7:
                return '<span class="badge bg-danger">FAILED</span>';
                break;
            default:
                return '<span class="badge bg-danger">UNKNOWN</span>';
                break;
        }
    }
}