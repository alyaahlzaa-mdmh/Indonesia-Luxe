<?php

namespace App\Enums;

enum WalletTransactionType: string
{
    case Earning = 'earning';
    case Withdrawal = 'withdrawal';
}
