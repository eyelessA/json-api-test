<?php

namespace App\Http\Controllers;

use App\Http\Requests\Advert\IndexRequest;
use App\Http\Requests\Advert\ShowRequest;
use App\Http\Requests\Advert\StoreRequest;
use App\Http\Resources\AdvertCollection;
use App\Http\Resources\AdvertResource;
use App\Models\Advert;
use App\Services\Advert\IndexService;
use App\Services\Advert\ShowService;
use App\Services\Advert\StoreService;
use Illuminate\Http\JsonResponse;

class AdvertController extends Controller
{
    public function index(IndexRequest $indexRequest, IndexService $indexService): AdvertCollection
    {
        $data = $indexRequest->validated();
        $adverts = $indexService->index($data);
        return AdvertCollection::make($adverts);
    }

    public function show(ShowRequest $showRequest, ShowService $showService): AdvertResource
    {
        $data = $showRequest->validated();
        $advert = $showService->show($data['id']);

        return AdvertResource::make($advert);
    }

    public function store(StoreRequest $storeRequest, StoreService $storeService): JsonResponse
    {
        try {
            $data = $storeRequest->validated();
            $advertId = $storeService->store($data);

            return response()->json([
                'response' => $advertId,
                'status_code' => 201
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'status_code' => 500,
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
