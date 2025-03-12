<?php
namespace App\Config;

enum OrderShopStatus: string
{
    case Pending = 'En attente';
    case Ready = 'Prête';
    case PickUp = 'Retirée';
    case Canceled = 'Annulée';

    
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::names(), self::values());
    }
}