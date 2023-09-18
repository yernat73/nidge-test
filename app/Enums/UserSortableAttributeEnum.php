<?php

namespace App\Enums;

use ArchTech\Enums\From;
use ArchTech\Enums\Names;

enum UserSortableAttributeEnum: string
{
    use Names;
    use From;

    case DATE = 'created_at';
    case PHONE = 'phone';
    case NAME = 'name';
    case ID = 'id';
}