<?php
// src/Config/ReportStatus.php
namespace App\Config;

enum ReportStatus: string
{
    case Treated = 'Treated';
    case Untreated = 'Untreated';
    case InProgress = 'InProgress';
    case Closed = 'Closed';
}