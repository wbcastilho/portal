<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Localizacao1;
use App\Localizacao2;
use App\Estado;
use App\Cidade;
use App\Praca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Localizacao2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchText=trim($request->get('searchText'));
       
        //Faz a consulta no banco com paginação
        $localizacoes = DB::table('localizacoes2')
        ->join('localizacoes1', 'localizacoes1.id', '=', 'localizacoes2.localizacao1_id')
        ->join('estados', 'estados.id', '=', 'localizacoes1.estado_id')
        ->join('cidades', 'cidades.id', '=', 'localizacoes1.cidade_id')
        ->join('pracas', 'pracas.id', '=', 'localizacoes2.praca_id')
        ->select('localizacoes2.id', 'estados.uf AS Estado', 'cidades.nome AS Cidade', 'pracas.nome AS Praca', 'localizacoes1.nome AS Localizacao1', 'localizacoes2.nome AS Localizacao2')
        ->where('localizacoes2.id', '>', 0)
        ->where('localizacoes2.praca_id', '=', auth()->user()->praca->id)        
        ->when($searchText, function ($query, $searchText) {
            return $query->where('estados.nome', 'like', $searchText . '%')
            ->orWhere('cidades.nome', 'like', $searchText . '%')
            ->orWhere('pracas.nome', 'like', $searchText . '%')
            ->orWhere('localizacoes1.nome', 'like', $searchText . '%')
            ->orWhere('localizacoes2.nome', 'like', $searchText . '%');
        })             
        ->orderBy("estados.nome","ASC")
        ->paginate(10);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>'','titulo'=>'Localizações'],
          ['url'=>'','titulo'=>'Localização 2']
        ];

        //Chamada da view passando as variaveis $registros
        return view('site.localizacao2.index', compact('localizacoes', 'caminhos', 'searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $localizacoes1 = Localizacao1::orderBy("nome","ASC")->get();              

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao2.index'),'titulo'=>'Localização 2'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao2.adicionar', compact('caminhos', 'localizacoes1'));
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
            'localizacao1_id'=> 'required',   
            'nome'=> 'required'                   
        ];
  
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);
  
        //Insere no banco de dados       
        $localizacao = Localizacao2::create([
            'nome' => $request['nome'],
            'localizacao1_id' => $request['localizacao1_id'],            
            'praca_id' => auth()->user()->praca->id          
        ]);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('localizacao2')
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
        $localizacoes1 = Localizacao1::orderBy("nome","ASC")->get();       
        $localizacao2 = Localizacao2::find($id);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao2.index'),'titulo'=>'Localização 1'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao2.editar', compact('caminhos', 'localizacoes1', 'localizacao2'));
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
            'localizacao1_id'=> 'required',   
            'nome'=> 'required'                   
        ];
  
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);
  
        //Insere no banco de dados       
        $localizacao = Localizacao2::find($id)->update([
            'nome' => $request['nome'],
            'localizacao1_id' => $request['localizacao1_id'],            
            'praca_id' => auth()->user()->praca->id          
        ]);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('localizacao2')
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
        $localizacao = Localizacao2::find($id);

        $localizacao->delete();
    }
}
