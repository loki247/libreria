<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LecturaLibro;
use App\Services\LecturaLibroService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LecturaLibroController extends Controller
{
    public function getByIdTomoUsuario(int $idTomo, int $idUsuario) {
        $lectura = LecturaLibroService::getByIdTomoUsuario($idTomo, $idUsuario);

        if ($lectura === null) {
            return response()->json([
                'message' => 'No existe una lectura para este tomo y usuario'
            ], 404);
        }

        return response()->json($lectura);
    }

    public function saveLectura(Request $request) {
        DB::beginTransaction();
        try {
            $lectura = new LecturaLibro();
            $lectura->id_tomo = $request->idTomo;
            $lectura->id_usuario = $request->idUsuario;
            $lectura->pagina = $request->pagina;

            LecturaLibroService::saveLectura($lectura);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function updateLectura(Request $request) {
        DB::beginTransaction();
        try {
            $lectura = new LecturaLibro();
            $lectura->id = $request->id;
            $lectura->pagina = $request->pagina;

            LecturaLibroService::updateLectura($lectura, $request->totalPaginas);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
