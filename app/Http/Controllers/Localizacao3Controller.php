<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Localizacao1;
use App\Localizacao2;
use App\Localizacao3;
use App\Estado;
use App\Cidade;
use App\Praca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Localizacao3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchText=trim($request->get('searchText'));
       
        $localizacoes = Localizacao3::where('nome', 'like', '%' . $searchText . '%')->where('praca_id', '=', auth()->user()->praca->id)
        ->orWhereHas('localizacao2', function ($query) use ($searchText) {
            $query->where('nome', 'like', '%' . $searchText . '%')->where('praca_id', '=', auth()->user()->praca->id)
                ->orWhereHas('localizacao1', function ($query) use ($searchText) {
                    $query->where('nome', 'like', '%' . $searchText . '%')->where('praca_id', '=', auth()->user()->praca->id)
                        ->orWhereHas('cidade', function ($query) use ($searchText) {
                            $query->where('nome', 'like', '%' . $searchText . '%')
                                ->orWhereHas('estado', function ($query) use ($searchText) {
                                    $query->where('nome', 'like', '%' . $searchText . '%');
                                });
                        });
                });                               
        })->paginate(10);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>'','titulo'=>'Localizações'],
          ['url'=>'','titulo'=>'Localização 3']
        ];

        //Chamada da view passando as variaveis $registros
        return view('site.localizacao3.index', compact('localizacoes', 'caminhos', 'searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::orderBy("nome","ASC")->get();
        $cidades = Cidade::orderBy("nome","ASC")->get();
        $localizacoes1 = Localizacao1::where('praca_id', '=', auth()->user()->praca->id)->orderBy("nome","ASC")->get();
        $localizacoes2 = Localizacao2::where('praca_id', '=', auth()->user()->praca->id)->orderBy("nome","ASC")->get();              

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao3.index'),'titulo'=>'Localização 3'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao3.adicionar', compact('caminhos', 'estados', 'cidades', 'localizacoes1', 'localizacoes2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[            
            'estado_id'=> 'required',   
            'cidade_id'=> 'required',   
            'localizacao1_id'=> 'required',   
            'localizacao2_id'=> 'required',   
            'nome'=> 'required'                   
        ];
  
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);
  
        //Insere no banco de dados       
        $localizacao = Localizacao3::create([
            'nome' => $request['nome'],
            'localizacao2_id' => $request['localizacao2_id'],            
            'praca_id' => auth()->user()->praca->id          
        ]);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('localizacao3')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estados = Estado::orderBy("nome","ASC")->get();
        $cidades = Cidade::orderBy("nome","ASC")->get();
        $localizacoes1 = Localizacao1::where('praca_id', '=', auth()->user()->praca->id)->orderBy("nome","ASC")->get();       
        $localizacoes2 = Localizacao2::where('praca_id', '=', auth()->user()->praca->id)->orderBy("nome","ASC")->get(); 
        $localizacao3 = Localizacao3::find($id);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao3.index'),'titulo'=>'Localização 3'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao3.editar', compact('caminhos', 'estados', 'cidades', 'localizacoes1', 'localizacoes2', 'localizacao3'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[            
            'estado_id'=> 'required',   
            'cidade_id'=> 'required',   
            'localizacao1_id'=> 'required',   
            'localizacao2_id'=> 'required',   
            'nome'=> 'required'                   
        ];
  
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);
  
        //Insere no banco de dados       
        $localizacao = Localizacao3::find($id)->update([
            'nome' => $request['nome'],
            'localizacao2_id' => $request['localizacao2_id'],            
            'praca_id' => auth()->user()->praca->id          
        ]);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('localizacao3')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $localizacao = Localizacao3::find($id);

        $localizacao->delete();
    }
}
