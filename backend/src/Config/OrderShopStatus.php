<?php
namespace App\Config;

enum OrderShopStatus: string
{
    case Pending = 'En attente';
    case Ready = 'Prête';
    case PickUp = 'Retirée';
    case Canceled = 'Annulée';
}