<?php
namespace App\Config;

enum ReservationStatus: string
{
    case Pending = 'En attente';
    case Present = 'Present';
    case Missing = 'Absent';
}