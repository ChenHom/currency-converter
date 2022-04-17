<?php

namespace Tests\Unit;

use App\Converter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConverterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     *
     * @return void
     */
    public function 可取得轉換器()
    {
        $this->assertInstanceOf(Converter::class, app(Converter::class));
    }
}
