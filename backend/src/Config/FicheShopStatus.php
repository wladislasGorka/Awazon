<?php
namespace App\Config;

enum FicheShopStatus: string
{
    case Pending = 'En attente';
    case Valide = 'Validée';
    case Invalide = 'Refusée';
}