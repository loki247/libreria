<?php

namespace App\Services;

use App\Mappers\AutorMapper;
use App\Mappers\EstadoLibroMapper;
use App\Mappers\LecturaLibroMapper;
use App\Mappers\LibroAutorMapper;
use App\Mappers\LibroMapper;
use App\Mappers\LibroTomoMapper;
use App\Mappers\TipoLibroMapper;
use App\Models\Libro;
use App\Pagination\Pagination;
use Illuminate\Support\Facades\Auth;
use stdClass;

class LibroService{
    public static function getAll(stdClass $filtros): stdClass {
        $libros = LibroMapper::getAll($filtros);
        $pagination = new Pagination();
        $page = $pagination->setPagination($filtros, $libros);

        foreach($page->data as $libro){
            $libro->portada = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $libro->portada);
            $libro->tipoLibro = TipoLibroMapper::getById($libro->tipoLibro);
            $libro->estadoLibro = EstadoLibroMapper::getById($libro->estadoLibro);

            $libroAutores = LibroAutorMapper::getByIdLibro($libro->id);
            $autores = [];

            foreach($libroAutores as $libroAutor){
                array_push($autores, AutorMapper::getById($libroAutor->id_autor));
            }

            $libro->autores = $autores;
            $libro->tomos = LibroTomoMapper::getByIdLibro($libro->id);
        }

        return $page;
    }

    public static function getLibros(stdClass $filtros): stdClass {
        $libros = LibroMapper::getLibros($filtros);
        $pagination = new Pagination();
        $page = $pagination->setPagination($filtros, $libros);

        foreach($page->data as $libro){
            $libro->portada = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $libro->portada);
            $libro->tipoLibro = TipoLibroMapper::getById($libro->tipoLibro);
            $libro->estadoLibro = EstadoLibroMapper::getById($libro->estadoLibro);

            $libroAutores = LibroAutorMapper::getByIdLibro($libro->id);
            $autores = [];

            foreach($libroAutores as $libroAutor){
                array_push($autores, AutorMapper::getById($libroAutor->id_autor));
            }

            $libro->autores = $autores;
            $libro->tomos = LibroTomoMapper::getByIdLibro($libro->id);
        }

        return $page;
    }

    public static function getMangas(stdClass $filtros): stdClass {
        $libros = LibroMapper::getMangas($filtros);
        $pagination = new Pagination();
        $page = $pagination->setPagination($filtros, $libros);

        foreach($page->data as $libro){
            $libro->portada = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $libro->portada);
            $libro->tipoLibro = TipoLibroMapper::getById($libro->tipoLibro);
            $libro->estadoLibro = EstadoLibroMapper::getById($libro->estadoLibro);

            $libroAutores = LibroAutorMapper::getByIdLibro($libro->id);
            $autores = [];

            foreach($libroAutores as $libroAutor){
                array_push($autores, AutorMapper::getById($libroAutor->id_autor));
            }

            $libro->autores = $autores;
            $libro->tomos = LibroTomoMapper::getByIdLibro($libro->id);
        }

        return $page;
    }

    public static function getById($id): Libro{
        $libro = LibroMapper::getById($id);

        $libro->portada = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $libro->portada);
        $libro->tipoLibro = TipoLibroMapper::getById($libro->tipoLibro);
        $libro->estadoLibro = EstadoLibroMapper::getById($libro->estadoLibro);

        $libroAutores = LibroAutorMapper::getByIdLibro($libro->id);
        $autores = [];

        foreach($libroAutores as $libroAutor){
            array_push($autores, AutorMapper::getById($libroAutor->id_autor));
        }

        $libro->autores = $autores;
        $libro->tomos = LibroTomoMapper::getByIdLibro($id);

        foreach($libro->tomos as $tomo){
            $tomo->lectura = LecturaLibroMapper::getByIdTomoUsuario($tomo->id, Auth::user()->id)  ;
        }
        foreach($libro->tomos as $tomo){
            $tomo->portada = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $tomo->portada);
            $tomo->ruta = env("URL_ARCHIVOS", "") . str_replace(" ", "%20", $tomo->ruta);
        }

        return $libro;
    }

    public static function save(Libro $libro){
        LibroMapper::save($libro);
    }

    public static function update(Libro $libro){
        LibroMapper::update($libro);
    }
}
