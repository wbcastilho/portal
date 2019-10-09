<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Localizacao1;
use App\Estado;
use App\Cidade;
use App\Praca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

        $localizacoes = Localizacao1::where('praca_id', '=', auth()->user()->praca->id)
        ->where(function ($query) use ($searchText)  { 
            $query->orWhere('nome', 'LIKE', '%' . $searchText . '%');
            $query->orWhereHas('cidade', function ($query1) use ($searchText) {
                $query1->where('nome', 'LIKE', '%' . $searchText . '%')
                ->orWhereHas('estado', function ($query) use ($searchText) {
                    $query->where('uf', 'like', '%' . $searchText . '%');                       
                });
            });
        })->paginate(10);       
       
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
        $cidades = Cidade::where("id", "=", 0)->get();       

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao1.index'),'titulo'=>'Localização 1'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao1.adicionar', compact('caminhos', 'estados', 'cidades'));
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
            'nome'=> 'required'     
        ]);      

        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);
  
        //Insere no banco de dados       
        $localizacao = Localizacao1::create([
            'nome' => $request['nome'],
            'estado_id' => $request['estado_id'],
            'cidade_id' => $request['cidade_id'],
            'praca_id' => auth()->user()->praca->id          
        ]);
  
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
        $localizacao1 = Localizacao1::find($id);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao1.index'),'titulo'=>'Localização 1'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao1.editar', compact('caminhos', 'estados', 'cidades', 'localizacao1'));  
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
            'nome'=> 'required'     
        ]);      

        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ]);

        //Altera as informações de acordo com o id passado       
        $localizacao = Localizacao1::find($id)->update([
            'nome' => $request['nome'],
            'estado_id' => $request['estado_id'],
            'cidade_id' => $request['cidade_id'],
            'praca_id' => auth()->user()->praca->id          
        ]);

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
        if(Localizacao1::has('localizacao_equipamentos')->find($id) == null)
        {
            $localizacao = Localizacao1::find($id);

            $localizacao->delete();
        }
        else
        {
            return response()->json([
                'fail' => true                
            ]);
        }                        
    }

    public function getLocalizacao2($id)
    {      
        $localizacoes2 = Localizacao1::find($id)->localizacao2->where('praca_id', '=', auth()->user()->praca->id);      
        return response()->json($localizacoes2);
    }

    public function getLocalizacao2_2($equipamento_id, $id)
    {      
        $localizacoes2 = Localizacao1::find($id)->localizacao2->where('praca_id', '=', auth()->user()->praca->id);      
        return response()->json($localizacoes2);
    }
}
