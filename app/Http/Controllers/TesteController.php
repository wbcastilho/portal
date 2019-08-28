<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo"=>"Cadastros", "url"=>""],
            ["titulo"=>"Clientes", "url"=>""]                 
        ]);
        
        return view('teste', compact('listaMigalhas'));        
    }
}
