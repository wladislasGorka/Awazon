<?php
// src/Config/MerchantStatus.php
namespace App\Config;

enum MerchantStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Hidden = 'hidden';
    case Suspended = 'suspended';
}
