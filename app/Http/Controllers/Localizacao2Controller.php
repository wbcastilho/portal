<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Localizacao1;
use App\Localizacao2;
use App\Estado;
use App\Cidade;
use App\Praca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
       
        $localizacoes = Localizacao2::where('nome', 'like', '%' . $searchText . '%')->where('praca_id', '=', auth()->user()->praca->id)
        ->orWhereHas('localizacao1', function ($query) use ($searchText) {
            $query->where('nome', 'like', '%' . $searchText . '%')->where('praca_id', '=', auth()->user()->praca->id)
                ->orWhereHas('cidade', function ($query) use ($searchText) {
                    $query->where('nome', 'like', '%' . $searchText . '%')
                        ->orWhereHas('estado', function ($query) use ($searchText) {
                            $query->where('nome', 'like', '%' . $searchText . '%');                               
                        });
                });                               
        })->paginate(10);
       
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
        $estados = Estado::orderBy("nome","ASC")->get();
        $cidades = Cidade::where('id', '=', 0)->get();
        $localizacoes1 = Localizacao1::where('id', '=', 0)->get();              

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao2.index'),'titulo'=>'Localização 2'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao2.adicionar', compact('caminhos', 'estados', 'cidades', 'localizacoes1'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $validator = Validator::make($request->all(), [
            'estado_id' => [
                'required',
                Rule::notIn('0'),
            ],
            'cidade_id'=> [
                'required',
                Rule::notIn('0'),
            ],
            'localizacao1_id'=> [
                'required',
                Rule::notIn('0'),
            ],
            'nome'=> 'required'     
        ]);

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
        $estados = Estado::orderBy("nome","ASC")->get();
        $cidades = Cidade::orderBy("nome","ASC")->get();
        $localizacoes1 = Localizacao1::where('praca_id', '=', auth()->user()->praca->id)->orderBy("nome","ASC")->get();       
        $localizacao2 = Localizacao2::find($id);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao2.index'),'titulo'=>'Localização 1'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao2.editar', compact('caminhos', 'estados', 'cidades', 'localizacoes1', 'localizacao2'));
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
        $validator = Validator::make($request->all(), [
            'estado_id' => [
                'required',
                Rule::notIn('0'),
            ],
            'cidade_id'=> [
                'required',
                Rule::notIn('0'),
            ],
            'localizacao1_id'=> [
                'required',
                Rule::notIn('0'),
            ],
            'nome'=> 'required'     
        ]);

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

    public function getLocalizacao3($id)
    {      
        $localizacoes3 = Localizacao2::find($id)->localizacao3;      
        return response()->json($localizacoes3);
    }

    /*public function getLocalizacao($id)
    {      
        $localizacoes2 = Localizacao2::where('localizacao1_id', '=', $id)
            ->where('praca_id', '=', auth()->user()->praca->id)
            ->get();      
        return response()->json($localizacoes2); 
    }*/
}
