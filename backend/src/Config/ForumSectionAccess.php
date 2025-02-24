<?php
// src/Config/ForumSectionAccess.php
namespace App\Config;

enum ForumSectionAccess: string
{
    case Member = 'Member';
    case Merchant = 'Merchant';
    case Admin = 'Admin';
}