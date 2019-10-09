<?php

namespace App\Http\Controllers;

use App\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function getLocalizacao1($id)
    {      
        $localizacoes1 = Cidade::find($id)->localizacao1->where('praca_id', '=', auth()->user()->praca->id);      
        return response()->json($localizacoes1);
    }

    public function getLocalizacao1_2($equipamento_id, $id)
    {      
        $localizacoes1 = Cidade::find($id)->localizacao1->where('praca_id', '=', auth()->user()->praca->id);      
        return response()->json($localizacoes1);
    }
}
