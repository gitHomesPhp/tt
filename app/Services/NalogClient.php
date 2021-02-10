<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class NalogClient
{
    public const URL = 'https://statusnpd.nalog.ru/api/v1/tracker/taxpayer_status';

    public function checkIndividualTaxNumber(string $itn): array
    {
        if (Redis::exists($itn)) {
            return json_decode(Redis::get($itn), true);
        }

        $response = Http::post(self::URL, [
            'inn' => $itn,
            'requestDate' => Carbon::now()->format('Y-m-d')
        ]);

        Redis::set($itn, $response->body());
        Redis::expire($itn, Carbon::now()->secondsUntilEndOfDay());

        return json_decode(Redis::get($itn), true);
    }
}
