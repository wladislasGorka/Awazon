<?php
// src/Config/UsersStatus.php
namespace App\Config;

enum UsersStatus: string
{
    case enabled = 'enabled';
    case disabled = 'disabled';
    case banned = 'banned';
}