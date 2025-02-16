<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    case MANAGE_USERS = 'manage_users';
    case MANAGE_DECKS = 'manage_decks';
}
