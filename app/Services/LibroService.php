<?php

namespace App\Services;

use App\Mappers\AutorMapper;
use App\Mappers\LibroAutorMapper;
use App\Mappers\LibroMapper;
use App\Mappers\LibroTomoMapper;
use App\Mappers\TipoLibroMapper;
use App\Models\Libro;
use Illuminate\Support\Collection;

class LibroService{
    public static function getAll(): Collection {
        $libros = LibroMapper::getAll();

        foreach($libros as $libro){
            $libro->tipo_libro = TipoLibroMapper::getById($libro->tipo_libro);

            $libroAutores = LibroAutorMapper::getByIdLibro($libro->id);
            $autores = [];

            foreach($libroAutores as $libroAutor){
                array_push($autores, AutorMapper::getById($libroAutor->id_autor));
            }

            $libro->autores = $autores;
            $libro->tomos = LibroTomoMapper::getByIdLibro($libro->id);
        }

        return $libros;
    }

    public static function getById($id): Libro{
        $libro = LibroMapper::getById($id);

        $libro->tipo_libro = TipoLibroMapper::getById($libro->tipo_libro);

        $libroAutores = LibroAutorMapper::getByIdLibro($libro->id);
        $autores = [];

        foreach($libroAutores as $libroAutor){
            array_push($autores, AutorMapper::getById($libroAutor->id_autor));
        }

        $libro->autores = $autores;
        $libro->tomos = LibroTomoMapper::getByIdLibro($id);

        return $libro;
    }

    public static function save(Libro $libro){
        LibroMapper::save($libro);
    }

    public static function update(Libro $libro){
        LibroMapper::update($libro);
    }
}
