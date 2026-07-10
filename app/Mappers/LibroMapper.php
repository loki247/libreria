<?php

namespace App\Mappers;

use App\Models\Libro;
use Illuminate\Support\Collection;

class LibroMapper{
    public static function getAll(): Collection {
        return Libro::select(
            "id",
            "nombre",
            "nombre_alternativo",
            "portada",
            "id_tipo_libro AS tipo_libro",
            "fecha_publicacion",
            "created_at",
            "updated_at")->get();
    }

    public static function getById($id): Libro {
        return Libro::select(
            "id",
            "nombre",
            "nombre_alternativo",
            "portada",
            "id_tipo_libro AS tipo_libro",
            "fecha_publicacion",
            "created_at",
            "updated_at")->where([
            ['id', $id]
        ])->first();
    }

    public static function save(Libro $libro){
        $libro->save();
    }

    public static function update(Libro $libro){
        Libro::where([
            ['id', $libro->id]
        ])->update([
            'nombre' => $libro->nombre,
            'nombre_alternativo' => $libro->nombre_alternativo,
            'portada' => $libro->portada,
            'id_tipo_libro' => $libro->id_tipo_libro,
            'fecha_publicacion' => $libro->fecha_publicacion != null ? date("Y-m-d H:i:s", strtotime($libro->fecha_publicacion)): null
        ]);
    }
}
