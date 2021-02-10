<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CheckITNRequest;
use App\Services\NalogClient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ITNController extends Controller
{
    public function index(): View
    {
        return view('itn.index');
    }

    public function check(CheckITNRequest $request, NalogClient $client): JsonResponse
    {
        return response()->json($client->checkIndividualTaxNumber($request->itn));
    }
}
