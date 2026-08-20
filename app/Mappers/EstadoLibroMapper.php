<?php

namespace App\Mappers;

use App\Models\EstadoLibro;
use Illuminate\Support\Collection;

class EstadoLibroMapper{
    public static function getAll(): Collection {
        return EstadoLibro::all();
    }

    public static function getById($id): EstadoLibro {
        return EstadoLibro::where([
            ['id', $id]
        ])->first();
    }
}
