<?php
// src/Config/MerchantType.php
namespace App\Config;

enum MerchantType: string
{
    case Restaurateur = 'restaurateur';
    case Vendor = 'Vendor';
    case Farmer = 'Farmer';
    case Artisan = 'Artisan';
    case Other = 'Other';
}