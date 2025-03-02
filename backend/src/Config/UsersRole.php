<?php
// src/Config/UsersRole.php
namespace App\Config;

enum UsersRole: string
{
    case Member = 'member';
    case Merchant = 'merchant';
    case Admin = 'admin';
    case SuperAdmin = 'super_admin';
}