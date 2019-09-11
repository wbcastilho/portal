<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Localizacao1;
use App\Estado;
use App\Cidade;
use App\Praca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Localizacao1Controller extends Controller
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
        //$modelos = Modelo::where('nome', 'LIKE', $searchText . '%')->where('id', '>', 0)->orderBy("nome","ASC")->paginate(10);
        //$localizacoes = Localizacao1::with(['estado', 'cidade', 'praca'])->where('nome', 'LIKE', $searchText . '%')->where('id', '>', 0)->orderBy("nome","ASC")->paginate(10);             

        //Faz a consulta no banco com paginação
        $localizacoes = DB::table('localizacoes1')
        ->join('estados', 'estados.id', '=', 'localizacoes1.estado_id')
        ->join('cidades', 'cidades.id', '=', 'localizacoes1.cidade_id')
        ->join('pracas', 'pracas.id', '=', 'localizacoes1.praca_id')
        ->select('localizacoes1.id', 'estados.nome AS Estado', 'cidades.nome AS Cidade', 'pracas.nome AS Praca', 'localizacoes1.nome AS Localizacao')
        ->where('localizacoes1.id', '>', 0)
        ->where('estados.nome', 'like', $searchText . '%')
        ->orWhere('cidades.nome', 'like', $searchText . '%')
        ->orWhere('pracas.nome', 'like', $searchText . '%')
        ->orWhere('localizacoes1.nome', 'like', $searchText . '%')
        ->orderBy("estados.nome","ASC")
        ->paginate(10);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>'','titulo'=>'Localizações'],
          ['url'=>'','titulo'=>'Localização 1']
        ];

        //Chamada da view passando as variaveis $registros
        return view('site.localizacao1.index', compact('localizacoes', 'caminhos', 'searchText'));
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
        $pracas = Praca::orderBy("nome","ASC")->get();

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao1.index'),'titulo'=>'Localização 1'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao1.adicionar', compact('caminhos', 'estados', 'cidades', 'pracas'));
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
            'nome'=> 'required',
            'estado_id'=> 'required',
            'cidade_id'=> 'required',
            'praca_id'=> 'required'
        ];
  
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);
  
        //Insere no banco de dados
        $localizacao = Localizacao1::create($request->all());
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('localizacao1')
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
        $pracas = Praca::orderBy("nome","ASC")->get();
        $localizacao1 = Localizacao1::find($id);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao1.index'),'titulo'=>'Localização 1'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao1.editar', compact('caminhos', 'estados', 'cidades', 'pracas', 'localizacao1'));  
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
            'nome'=> 'required',
            'estado_id'=> 'required',
            'cidade_id'=> 'required',
            'praca_id'=> 'required'
        ];
  
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ]);

        //Altera as informações de acordo com o id passado
        Localizacao1::find($id)->update($request->all());

        return response()->json([
            'fail' => false,
            'redirect_url' => url('localizacao1')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $localizacao = Localizacao1::find($id);

        $localizacao->delete();
    }
}
