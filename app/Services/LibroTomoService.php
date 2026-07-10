<?php

namespace App\Services;

use App\Mappers\LibroTomoMapper;
use App\Models\LibroTomo;
use Illuminate\Support\Collection;

class LibroTomoService{
    public static function getById($id): LibroTomo {
        return LibroTomoMapper::getById($id);
    }
}
