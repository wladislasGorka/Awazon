<?php
// src/Config/GiftCodeTargetType
// .php
namespace App\Config;

enum GiftCodeTargetType : string
{
    case Product = "Product";
    case ProductCategory = "ProductCategory";
    case ProductSubCategory = "ProductSubCategory";
}