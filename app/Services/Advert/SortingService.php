<?php

namespace App\Services\Advert;

use Illuminate\Database\Eloquent\Builder;

class SortingService
{
    public function orderByApply(Builder $builder, array $data): Builder
    {
        switch ($data) {
            case $data && $data['order_by'] == 'price_desc':
                $builder->orderBy('price', 'desc');
                break;
            case $data && $data['order_by'] == 'price_asc':
                $builder->orderBy('price', 'asc');
                break;
            case $data && $data['order_by'] == 'created_at_desc':
                $builder->orderBy('created_at', 'desc');
                break;
            case $data && $data['order_by'] == 'created_at_asc':
                $builder->orderBy('created_at', 'asc');
                break;
        }

        return $builder;
    }
}
