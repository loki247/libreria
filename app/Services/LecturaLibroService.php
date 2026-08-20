<?php

namespace App\Services;

use App\Mappers\LecturaLibroMapper;
use App\Models\LecturaLibro;
use Illuminate\Support\Collection;

class LecturaLibroService{
    public static function getByIdTomoUsuario(int $idTomo, int $idUsuario) {
        return LecturaLibroMapper::getByIdTomoUsuario($idTomo, $idUsuario);
    }

    public static function saveLectura(LecturaLibro $lectura){
        LecturaLibroMapper::saveLectura($lectura);
    }

    public static function updateLectura(LecturaLibro $lectura, int $totalPaginas){
        LecturaLibroMapper::updateLectura($lectura, $totalPaginas);
    }
}
