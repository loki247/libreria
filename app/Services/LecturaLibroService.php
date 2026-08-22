<?php

namespace App\Services;

use App\Mappers\LecturaLibroMapper;
use App\Mappers\LibroMapper;
use App\Mappers\LibroTomoMapper;
use App\Models\LecturaLibro;
use Illuminate\Support\Collection;

class LecturaLibroService{
    public static function getByIdTomoUsuario(int $idTomo, int $idUsuario) {
        return LecturaLibroMapper::getByIdTomoUsuario($idTomo, $idUsuario);
    }

    public static function getByUsuario(int $idUsuario) {
        $lecturas = LecturaLibroMapper::getByUsuario($idUsuario);

        foreach($lecturas as $lectura){
            $lectura->tomo = LibroTomoMapper::getById($lectura->id_tomo);

            $lectura->tomo->portada = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $lectura->tomo->portada);
            $lectura->tomo->ruta = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $lectura->tomo->ruta);

            $lectura->tomo->libro = LibroMapper::getById($lectura->tomo->id_libro);
        }

        return $lecturas;
    }

    public static function saveLectura(LecturaLibro $lectura){
        LecturaLibroMapper::saveLectura($lectura);
    }

    public static function updateLectura(LecturaLibro $lectura, int $totalPaginas){
        LecturaLibroMapper::updateLectura($lectura, $totalPaginas);
    }
}
