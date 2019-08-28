<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
         //Monta o breadcrumb
         $caminhos = [
            ['url'=>'','titulo'=>'Cadastro'],
            ['url'=>'','titulo'=>'Categorias']
          ];
        
        return view('home', compact('caminhos'));        
    }
}
