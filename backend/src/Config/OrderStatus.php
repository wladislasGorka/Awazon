<?php
namespace App\Config;

enum OrderStatus: string
{
    case Pending = 'En attente';
    case Partial = 'Partielle';
    case Complete = 'Complète';
    case Canceled = 'Annulée';
}