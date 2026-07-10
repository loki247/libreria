<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LibroTomo;
use App\Services\LibroTomoService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class LibroTomoController extends Controller
{
    public function getById($id): LibroTomo{
        $tomos = LibroTomoService::getById($id);
        return $tomos;
    }

    public function getByIdLibro($idLibro): Collection {
        return LibroTomoService::getByIdLibro($idLibro);
    }
}
