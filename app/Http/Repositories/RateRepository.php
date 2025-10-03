<?php
namespace App\Http\Repositories;

use App\Models\Rate;

class RateRepository
{
    public function getAll()
    {
        return Rate::all();
    }

    public function findByAsset($type, $asset)
    {
        return Rate::where('type', $type)->where('asset', $asset)->first();
    }

    public function create($data)
    {
        return Rate::create($data);
    }
}
