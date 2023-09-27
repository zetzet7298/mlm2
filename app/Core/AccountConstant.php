<?php
namespace App\Core;

class AccountConstant
{
    const USER_STATE_NEW = 0;
    const USER_STATE_PAID = 1;
    const USER_STATE_PROCESSING = 2;

    const TYPE_USER_FREE = 'free';
    const TYPE_USER_MEMBER = 'member';
    const TYPE_USER_SAPHIRE = 'saphire';
    const TYPE_USER_RUBY = 'ruby';
    const TYPE_USER_DIAMOND = 'diamond';

    const TRANSFER_STATE_NEW = 0;
    const TRANSFER_STATE_PAID = 1;

    const DIRECT_COMISSION = 10;
    const INDIRECT_COMISSION = 1;
    const PERCENTAGE_COMISSION_SAPHIRE = 3;
    const PERCENTAGE_COMISSION_RUBY = 2;
    const PERCENTAGE_COMISSION_DIAMOND = 2;

    const GOLD_COMISSION = 40;
    const ADMIN_TRANSFER = 40;
    const COIN_NEED_UPGRADE = 40;
}