<?php
// src/Config/ReportType.php
namespace App\Config;

enum ReportType: string
{
    case Shop = 'Shop';
    case Product = 'Product';
    case Message = 'Message';
    case Review = 'Review';
}