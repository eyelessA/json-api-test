<?php

namespace App\Services\Advert;

use App\Models\Advert;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

readonly class IndexService
{
    public function __construct(
        private SortingService $sortingService
    ) {
    }

    public function index($data): LengthAwarePaginator
    {
        $builder = Advert::query();

        $builder = $this->sortingService->orderByApply($builder, $data);

        return $builder->paginate(10);
    }

}
