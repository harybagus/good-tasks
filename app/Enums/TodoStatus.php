<?php

namespace App\Enums;

enum TodoStatus: string
{
    case FINISHED = 'finished';
    case UNFINISHED = 'unfinished';
}
