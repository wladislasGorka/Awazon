<?php
// src/Config/ForumMessageStatus.php
namespace App\Config;

enum ForumMessageStatus: string
{
    case edited = 'edited';
    case moderated = 'moderated';
    case active = 'active';
}