<?php

namespace App\Http\Controllers;

use App\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function getLocalizacao1($id)
    {      
        $localizacoes1 = Cidade::find($id)->localizacao1;      
        return response()->json($localizacoes1);
    }
}
