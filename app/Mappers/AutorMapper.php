<?php

namespace App\Mappers;

use App\Models\Autor;
use Illuminate\Support\Collection;

class AutorMapper{
    public static function getAll(): Collection {
        return Autor::all();
    }

    public static function getById($id): Autor {
        return Autor::where([
            ['id', $id]
        ])->first();
    }
}
