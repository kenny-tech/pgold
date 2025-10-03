<?php

namespace App\Http\Services;

use App\Http\Repositories\RateRepository;

class RateService
{
    private $rateRepository;

    public function __construct(RateRepository $rateRepository)
    {
        $this->rateRepository = $rateRepository;
    }

    public function calculateAmount($type, $asset, $amount)
    {
        $rate = $this->rateRepository->findByAsset($type, $asset);

        if (!$rate) {
            return ['error' => true, 'message' => 'Rate not found'];
        }

        $converted = $amount * $rate->rate;

        return [
            'error'   => false,
            'data'    => [
                'asset'        => $asset,
                'type'         => $type,
                'rate'         => $rate->rate,
                'amount_given' => $amount,
                'converted'    => $converted
            ],
            'message' => 'Calculation successful'
        ];
    }

    public function getAllRates()
    {
        $rates = $this->rateRepository->getAll();

        if ($rates->isEmpty()) {
            return ['error' => true, 'message' => 'No rates found'];
        }

        return [
            'error' => false,
            'data' => $rates,
            'message' => 'Rates fetched successfully'
        ];
    }
}
