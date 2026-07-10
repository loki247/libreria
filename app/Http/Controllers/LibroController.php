<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use App\Models\LibroAutor;
use App\Services\LibroService;
use App\Services\LibroAutorService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller{
    public function getAll(): Collection {
        return LibroService::getAll();
    }

    public function getById($id): Libro{
        return LibroService::getById($id);
    }

    public function save(Request $request) {
        DB::beginTransaction();
        try {
            $libro = new Libro();
            $libro->nombre = $request->nombre;
            $libro->nombre_alternativo = $request->nombre_alternativo;
            $libro->portada = $request->portada;
            $libro->id_tipo_libro = $request->id_tipo_libro;
            $libro->fecha_publicacion = $request->fecha_publicacion;

            LibroService::save($libro);

            $libroAutor = new LibroAutor();
            $libroAutor->id_libro = $libro->id;
            $libroAutor->id_autor = $request->autor['id'];

            LibroAutorService::save($libroAutor);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(Request $request) {
        DB::beginTransaction();
        try {
            $libro = new Libro();
            $libro->id = $request->id;
            $libro->nombre = $request->nombre;
            $libro->nombre_alternativo = $request->nombre_alternativo;
            $libro->portada = $request->portada;
            $libro->id_tipo_libro = $request->id_tipo_libro;
            $libro->fecha_publicacion = $request->fecha_publicacion;

            LibroService::update($libro);

            $libroAutor = new LibroAutor();
            $libroAutor->id_libro = $request->id;
            $libroAutor->id_autor = $request->autor['id'];

            LibroAutorService::update($libroAutor);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
