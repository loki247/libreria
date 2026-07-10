<?php

namespace App\Services;

use App\Mappers\LibroAutorMapper;
use App\Models\LibroAutor;
use Illuminate\Support\Collection;

class LibroAutorService{
    public static function getByIdLibro(int $idLibro): Collection{
        return LibroAutorMapper::getByIdLibro($idLibro);
    }

    public static function save(LibroAutor $libroAutor){
        LibroAutorMapper::save($libroAutor);
    }

    public static function update(LibroAutor $libroAutor){
        LibroAutorMapper::update($libroAutor);
    }
}
