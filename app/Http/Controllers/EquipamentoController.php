<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fabricante;
use App\Tipo;
use App\Modelo;
use App\Setor;
use App\Equipamento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchText=trim($request->get('searchText'));
       
        $equipamentos = Equipamento::where('apelido', 'like', '%' . $searchText . '%')
        ->where('numeroserie', 'like', '%' . $searchText . '%')
        ->where('patrimonio', 'like', '%' . $searchText . '%')
        ->where('praca_id', '=', auth()->user()->praca->id)
        ->orWhereHas('setor', function ($query) use ($searchText) {
            $query->where('nome', 'like', '%' . $searchText . '%');
        })
        ->orWhereHas('modelo', function ($query) use ($searchText) {
            $query->where('nome', 'like', '%' . $searchText . '%')
                ->orWhereHas('fabricante', function ($query) use ($searchText) {
                    $query->where('nome', 'like', '%' . $searchText . '%');                       
                })                              
                ->orWhereHas('tipo', function ($query) use ($searchText) {
                    $query->where('nome', 'like', '%' . $searchText . '%');                       
                });                              
        })->paginate(10);

        //Monta o breadcrumb
        $caminhos = [         
          ['url'=>'','titulo'=>'Equipamentos']         
        ];

        //Chamada da view passando as variaveis $registros
        return view('site.equipamentos.index', compact('equipamentos', 'caminhos', 'searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fabricantes = Fabricante::orderBy("nome","ASC")->get();
        $tipos = Tipo::orderBy("nome","ASC")->get();
        $modelos = Modelo::where('id', '=', 0)->get();
        $setores = Setor::orderBy("nome","ASC")->get();              

        //Monta o breadcrumb
        $caminhos = [          
          ['url'=>route('equipamentos.index'),'titulo'=>'Equipamentos'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.equipamentos.adicionar', compact('caminhos', 'fabricantes', 'tipos', 'modelos', 'setores'));
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
            'fabricante_id' => [
                'required',
                Rule::notIn('0'),
            ],
            'tipo_id'=> [
                'required',
                Rule::notIn('0'),
            ],
            'modelo_id'=> [                
                Rule::notIn('0'),
            ],
            'setor_id'=> [                
                Rule::notIn('0'),
            ]                                 
        ]);

        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);
  
        //Insere no banco de dados       
        $equipamento = Equipamento::create([
            'fabricante_id' => $request['fabricante_id'], 
            'tipo_id' => $request['tipo_id'], 
            'modelo_id' => $request['modelo_id'],            
            'setor_id' => $request['setor_id'],            
            'apelido' => $request['apelido'],
            'numeroserie' => $request['numeroserie'],
            'patrimonio' => $request['patrimonio'],
            'descricao' => $request['descricao'],                       
            'praca_id' => auth()->user()->praca->id          
        ]);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('equipamentos')
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
