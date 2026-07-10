<?php

namespace App\Mappers;

use App\Models\TipoLibro;
use Illuminate\Support\Collection;

class TipoLibroMapper{
    public static function getAll(): Collection {
        return TipoLibro::all();
    }

    public static function getById($id): TipoLibro {
        return TipoLibro::where([
            ['id', $id]
        ])->first();
    }
}
