<?php

namespace App;

enum CurrencyEnum: string
{
    /**
     * 台幣
     */
    case TWD = 'TWD';

    /**
     * 日元
     */
    case JPY = 'JPY';

    /**
     * 美元
     */
    case USD = 'USD';
}
