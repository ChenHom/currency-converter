<?php

namespace App;

use App\CurrencyEnum;

class Converter
{
    /**
     * 匯率表
     *
     * @var array
     */
    protected $currencies;

    public function __construct()
    {
        $this->initRate();
    }

    /**
     * 匯率轉換
     *
     * @param CurrencyEnum $from
     * @param CurrencyEnum $to
     * @param float $amount
     * @return float
     */
    public function convert(CurrencyEnum $from, CurrencyEnum $to, float $amount): float
    {
        $rate = data_get($this->currencies, "{$from->name}.{$to->name}", 1);

        return $amount * $rate;
    }

    protected function initRate()
    {
        $this->currencies = [
            CurrencyEnum::TWD->name => [
                CurrencyEnum::TWD->name => 1,
                CurrencyEnum::JPY->name => 3.669,
                CurrencyEnum::USD->name => 0.03281
            ],
            CurrencyEnum::JPY->name => [
                CurrencyEnum::TWD->name => 0.26956,
                CurrencyEnum::JPY->name => 1,
                CurrencyEnum::USD->name => 0.00885
            ],
            CurrencyEnum::USD->name => [
                CurrencyEnum::TWD->name => 30.444,
                CurrencyEnum::JPY->name => 111.801,
                CurrencyEnum::USD->name => 1
            ],
        ];
    }
}
