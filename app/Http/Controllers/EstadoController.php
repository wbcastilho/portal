<?php

namespace App\Http\Controllers;

use App\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function getCidades($id)
    {      
        $cidades = Estado::find($id)->cidades;      
        return response()->json($cidades);
    }

    public function getCidades2($equipamento_id, $id)
    {      
        $cidades = Estado::find($id)->cidades;      
        return response()->json($cidades);
    }
}
