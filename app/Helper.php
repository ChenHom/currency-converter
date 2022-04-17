<?php

if (!function_exists('currency_amount_format')) {
    /**
     * 格式化金額格式
     *
     * @param float|integer $amount
     * @return string
     */
    function currency_amount_format(float|int $amount): string
    {
        return number_format($amount, 2);
    }
}
