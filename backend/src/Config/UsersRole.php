<?php
// src/Config/UsersRole.php
namespace App\Config;

enum UsersRole: string
{
    case Member = 'ROLE_MEMBER';
    case Merchant = 'ROLE_MERCHANT';
    case Admin = 'ROLE_ADMIN';
    case SuperAdmin = 'ROLE_SUPER_ADMIN';
}