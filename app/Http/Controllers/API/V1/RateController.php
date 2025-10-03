<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateRateRequest;
use App\Http\Services\RateService;
use App\Traits\ApiResponse;

class RateController extends Controller
{
    use ApiResponse;

    private $rateService;

    public function __construct(RateService $rateService)
    {
        $this->rateService = $rateService;
    }

    public function calculate(CalculateRateRequest $request)
    {
        $result = $this->rateService->calculateAmount(
            $request->type,
            $request->asset,
            $request->amount
        );

        if ($result['error']) {
            return $this->sendError($result['message']);
        }

        return $this->sendResponse($result['data'], $result['message']);
    }

    public function getAllRates()
    {
        $result = $this->rateService->getAllRates();

        if ($result['error']) {
            return $this->sendError($result['message']);
        }

        return $this->sendResponse($result['data'], $result['message']);
    }
}
