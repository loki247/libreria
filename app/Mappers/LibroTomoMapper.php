<?php

namespace App\Mappers;

use App\Models\LibroTomo;
use Illuminate\Support\Collection;

class LibroTomoMapper{
    public static function getById($id): LibroTomo {
        return LibroTomo::select(
            "id",
            "id_libro",
            "tomo",
            "titulo",
            "ruta",
            "portada")
        ->where([
            ['id', $id]
        ])->first();
    }

    public static function getByIdLibro($idLibro): Collection {
        return LibroTomo::select(
            "id",
            "id_libro",
            "tomo",
            "titulo",
            "ruta",
            "portada")
        ->where([
            ['id_libro', $idLibro]
        ])->orderBy('tomo', 'asc')->get();
    }
}
