<?php
// src/Config/TicketService.php
namespace App\Config;

enum TicketService: string
{
    case Question = 'Member';
    case Support = 'Merchant';
    case Report = 'Admin';
    case other = 'other';
}