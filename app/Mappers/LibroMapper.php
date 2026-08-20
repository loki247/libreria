<?php

namespace App\Mappers;

use App\Models\Libro;
use stdClass;
use Illuminate\Support\Facades\DB;

class LibroMapper{
    public static function getAll(stdClass $filtros): stdClass {
        $libros = Libro::select(
            "id",
            "nombre",
            "nombre_alternativo AS nombreAlternativo",
            "portada",
            "descripcion",
            "id_estado_libro AS estadoLibro",
            "id_tipo_libro AS tipoLibro",
            "fecha_publicacion AS fechaPublicacion",
            "created_at",
            "updated_at");

        if (!empty($filtros->search)) {
            $libros = $libros->where(DB::raw("LOWER(nombre)"), "LIKE", "%" . strtolower($filtros->search) . "%");
        }

        $librosCount = $libros->count();

        $libros = $libros->limit($filtros->size)->offset($filtros->offset)->get();

        $results = new stdClass;
        $results->total = $librosCount;
        $results->data = $libros;

        return $results;
    }

    public static function getLibros(stdClass $filtros): stdClass {
        $libros = Libro::select(
            "id",
            "nombre",
            "nombre_alternativo AS nombreAlternativo",
            "portada",
            "descripcion",
            "id_estado_libro AS estadoLibro",
            "id_tipo_libro AS tipoLibro",
            "fecha_publicacion AS fechaPublicacion",
            "created_at",
            "updated_at")
            ->where([
                ['id_tipo_libro', 1]
            ]);

        if (!empty($filtros->search)) {
            $libros = $libros->where(DB::raw("LOWER(nombre)"), "LIKE", "%" . strtolower($filtros->search) . "%");
        }

        $librosCount = $libros->count();

        $libros = $libros->limit($filtros->size)->offset($filtros->offset)->get();

        $results = new stdClass;
        $results->total = $librosCount;
        $results->data = $libros;

        return $results;
    }

    public static function getMangas(stdClass $filtros): stdClass {
        $libros = Libro::select(
            "id",
            "nombre",
            "nombre_alternativo AS nombreAlternativo",
            "portada",
            "descripcion",
            "id_estado_libro AS estadoLibro",
            "id_tipo_libro AS tipoLibro",
            "fecha_publicacion AS fechaPublicacion",
            "created_at",
            "updated_at")
            ->where([
                ['id_tipo_libro', 2]
            ]);

        if (!empty($filtros->search)) {
            $libros = $libros->where(DB::raw("LOWER(nombre)"), "LIKE", "%" . strtolower($filtros->search) . "%");
        }

        $librosCount = $libros->count();

        $libros = $libros->limit($filtros->size)->offset($filtros->offset)->get();

        $results = new stdClass;
        $results->total = $librosCount;
        $results->data = $libros;

        return $results;
    }

    public static function getById($id): Libro {
        return Libro::select(
            "id",
            "nombre",
            "nombre_alternativo AS nombreAlternativo",
            "portada",
            "descripcion",
            "id_estado_libro AS estadoLibro",
            "id_tipo_libro AS tipoLibro",
            "fecha_publicacion AS fechaPublicacion",
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
