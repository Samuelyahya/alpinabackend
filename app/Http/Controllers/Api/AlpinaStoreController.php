<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AlpinaStoreApiResource;
use App\Models\AlpinaStore;

class AlpinaStoreController extends Controller
{
    public function index()
    {
        $alpinaStores = AlpinaStore::latest()->get();
        return AlpinaStoreApiResource::collection($alpinaStores);
    }
}
