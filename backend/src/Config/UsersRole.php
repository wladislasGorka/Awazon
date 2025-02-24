<?php
// src/Config/UsersRole.php
namespace App\Config;

enum UsersRole: string
{
    case Member = 'enabled';
    case Merchant = 'banned';
    case Admin = 'disabled';
    case SuperAdmin = 'superadmin';
}