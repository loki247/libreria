<?php

namespace App\Mappers;

use App\Models\LecturaLibro;
use Illuminate\Support\Collection;

class LecturaLibroMapper{
    public static function getByIdTomoUsuario(int $idTomo, int $idUsuario) {
        return LecturaLibro::where([
            ['id_tomo', $idTomo],
            ['id_usuario', $idUsuario],
        ])->first();
    }

    public static function getByUsuario(int $idUsuario) {
        return LecturaLibro::where([
            ['id_usuario', $idUsuario],
        ])->get();
    }

    public static function saveLectura(LecturaLibro $lectura){
        $lectura->save();
    }

    public static function updateLectura(LecturaLibro $lectura, int $totalPaginas){
        LecturaLibro::where([
            ['id', $lectura->id]
        ])->update([
            'pagina' => $lectura->pagina,
            'leido' => $lectura->pagina == $totalPaginas ? true : false
        ]);
    }
}
