<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Routing\Controller as BaseController;

class KryptoController extends BaseController
{
    public function getAlerts()
    {
        return Alert::get();
    }

    public function postAlerts()
    {
        // todo validate request data

        $newAlert = Alert::updateOrCreate(
            [
                'currency_id' => request()->get('currency_id')
            ],
            [
                'min'=> request()->get('min'),
                'max' => request()->get('max'),
            ]
        );
        return response()->json([
            'result' => $newAlert ? 1 : 0
        ], 200);
    }
}
