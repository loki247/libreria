<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LibroTomo;
use App\Services\LibroTomoService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LibroTomoController extends Controller
{
    public function getById($id): LibroTomo{
        $tomos = LibroTomoService::getById($id);
        return $tomos;
    }
}
