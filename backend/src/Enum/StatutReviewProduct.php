<?php namespace App\Enum;

enum StatutReviewProduct: string
{
    case OPTION_1 = 'pending';
    case OPTION_2 = 'approved';
    case OPTION_3 = 'rejected';
    case OPTION_4 = 'flagged';
}

?>