<?php

namespace App\Services;

use App\Mappers\LibroTomoMapper;
use App\Models\LibroTomo;
use Illuminate\Support\Collection;

class LibroTomoService{
    public static function getById($id): LibroTomo {
        $tomo = LibroTomoMapper::getById($id);

        $tomo->portada = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $tomo->portada);
        $tomo->ruta = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $tomo->ruta);

        return $tomo;
    }
}
