<?php

namespace App\Http\Controllers;

use App\Converter;
use App\CurrencyEnum;
use App\Http\Requests\ConvertRequest;
use App\Http\Resources\ConvertResource;

class ConvertController extends Controller
{
    public function converter(ConvertRequest $request, Converter $converter)
    {
        return new ConvertResource(
            $converter->convert(
                CurrencyEnum::tryFrom($request->from_currency),
                CurrencyEnum::tryFrom($request->to_currency),
                $request->amount,
            )
        );
    }
}
