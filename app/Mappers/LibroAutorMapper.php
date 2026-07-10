<?php

namespace App\Mappers;

use App\Models\LibroAutor;
use Illuminate\Support\Collection;

class LibroAutorMapper{
    public static function getByIdLibro(int $idLibro): Collection{
        return LibroAutor::where([
            ['id_libro', $idLibro]
        ])->get();
    }

    public static function save(LibroAutor $libroAutor){
        $libroAutor->save();
    }

    public static  function update(LibroAutor $libroAutor){
        LibroAutor::where([
            ['id', $libroAutor->id]
        ])->update([
            'id_libro' => $libroAutor->id_libro,
            'id_autor' => $libroAutor->id_autor
        ]);
    }
}
