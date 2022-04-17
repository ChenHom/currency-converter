<?php

namespace Tests\Feature;

use Tests\TestCase;

class ConvertTest extends TestCase
{
    /** @test */
    public function 回傳的格式為data包裝著金額欄位 ()
    {
        $this->get('/api/currency-converter?from_currency=TWD&to_currency=USD&amount=10')
            ->assertJsonStructure([
                'data' => ['converted_amount']
            ]);
    }

    /** @test */
    public function 請求中來源與目標及金額欄位為必填()
    {
        $this->get('/api/currency-converter')
            ->assertJsonValidationErrors(['from_currency', 'to_currency', 'amount']);
    }

    /** @test */
    public function 轉換的金額有千分位及小數點二位()
    {
        $response = $this->get(
            '/api/currency-converter?from_currency=TWD&to_currency=USD&amount=1000'
        );

        $this->assertMatchesRegularExpression(
            '/^\d*(,\d{3})*.(\d+)$/',
            $response->json('data.converted_amount')
        );
    }

    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function 轉換的金額不可小於零()
    {
        $this->get('/api/currency-converter?from_currency=TWD&to_currency=USD&amount=-1')
            ->assertJsonValidationErrorFor('amount');
    }

    /** @test */
    public function 來源幣別與目標幣別不可超出規則()
    {
        $this->get('/api/currency-converter?from_currency=WD&to_currency=US&amount=100')
            ->assertJsonValidationErrors(['from_currency', 'to_currency']);
    }
}
