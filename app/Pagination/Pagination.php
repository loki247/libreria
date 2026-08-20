<?php

namespace App\Pagination;

use stdClass;

class Pagination
{
    public function setPagination($filtros, $data): stdClass
    {
        $response = new stdClass;
        $response->size = (int) $filtros->size;
        $response->page = (int) $filtros->page;
        $response->total =  $data->total;
        $response->pages = (int) ceil($response->total / $filtros->size);

        $response->pages_list = [];
        $response->pages_show = [];
        $response->first_page = 1;
        $response->last_page = $response->pages;
        $response->first = false;
        $response->last = false;
        $response->from = $filtros->offset;
        $response->to = $response->total > 1 ? ($filtros->offset + $response->size - 1) : 0;

        for ($i = 1; $i <= $response->pages; $i++) {
            array_push($response->pages_list, $i);

            if ($response->page == 1) {
                $response->first = true;
            }

            if ($response->page == $response->pages) {
                $response->last = true;
            }
        }

        if ($response->first) {
            $response->prev = null;
            $response->next = $response->page + 1;
        } else if ($response->last) {
            $response->prev = $response->page - 1;
            $response->next = null;
        } else {
            $response->prev = $response->page - 1;
            $response->next = $response->page + 1;
        }

        $start = max($response->first_page, $response->page - 2); // Dos anteriores
        $end = min($response->last_page, $response->page + 2);    // Dos siguientes
        for ($i = $start; $i <= $end; $i++) {
            $response->pages_show[] = $i;
        }

        $response->data =  $data->data;

        return $response;
    }
}
