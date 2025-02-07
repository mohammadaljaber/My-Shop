<?php

namespace App\Custom;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginator extends LengthAwarePaginator
{

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    // public function toArray()
    // {
    //     return [
    //         'items' => $this->items(),
    //         'pagination'    => [
    //             'current_page' => $this->currentPage(),
    //             'last_page' => $this->lastPage(),
    //             'from' => $this->firstItem(),
    //             'to' => $this->lastItem(),
    //             'per_page' => $this->perPage(),
    //             'total' => $this->total(),
    //         ],
    //     ];
    // }

    public function getPagination(){
        return[
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
            'from' => $this->firstItem(),
            'to' => $this->lastItem(),
            'per_page' => $this->perPage(),
            'total' => $this->total(),
        ];
    }

    public function itemsOnly(){
        return $this->items();
    }
}
