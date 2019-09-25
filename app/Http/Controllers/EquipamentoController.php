<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fabricante;
use App\Tipo;
use App\Modelo;
use App\Setor;
use App\Equipamento;
use App\LocalizacaoEquipamentos;
use App\Estado;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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
       
        /*$equipamentos = Equipamento::where('apelido', 'like', '%' . $searchText . '%')
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
        })->paginate(10);*/

        //$equipamentos = LocalizacaoEquipamentos::paginate(10);
        $equipamentos = Equipamento::paginate(10);

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
        $estados = Estado::orderBy("nome","ASC")->get();              

        //Monta o breadcrumb
        $caminhos = [          
          ['url'=>route('equipamentos.index'),'titulo'=>'Equipamentos'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.equipamentos.adicionar', compact('caminhos', 'fabricantes', 'tipos', 'modelos', 'setores', 'estados'));
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
            ],
            'estado_id'=> [                
                Rule::notIn('0'),
            ],  
            'cidade_id'=> [                
                Rule::notIn('0'),
            ],  
            'localizacao1_id'=> [                
                Rule::notIn('0'),
            ]                               
        ]);

        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);
  
        //Insere no banco de dados       
        /*$equipamento = Equipamento::create([
            'fabricante_id' => $request['fabricante_id'], 
            'tipo_id' => $request['tipo_id'], 
            'modelo_id' => $request['modelo_id'],            
            'setor_id' => $request['setor_id'],            
            'apelido' => $request['apelido'],
            'numeroserie' => $request['numeroserie'],
            'patrimonio' => $request['patrimonio'],
            'descricao' => $request['descricao'],                       
            'praca_id' => auth()->user()->praca->id          
        ]);*/

        DB::beginTransaction();

        try {           
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

            $now = date("Y-m-d"); 
            $localizacao = LocalizacaoEquipamentos::create([
                'data' => $now, 
                'observacao' => $request['observacao'], 
                'user_id' => auth()->user()->id ,            
                'equipamento_id' => $equipamento->id,            
                'situacao_id' => 1,
                'estado_id' => $request['estado_id'],
                'cidade_id' => $request['cidade_id'],
                'localizacao1_id' => $request['localizacao1_id'],                       
                'localizacao2_id' => $request['localizacao2_id'],                       
                'localizacao3_id' => $request['localizacao3_id'],                       
                'localizacao4_id' => $request['localizacao4_id']                         
            ]);
        } catch(ValidationException $e)
        {
            DB::rollback();

            /*return Redirect::to('/form')
                ->withErrors( $e->getErrors() )
                ->withInput();*/
            
            return response()->json([
                'fail' => true,
                'redirect_url' => url('equipamentos')
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw $e;
        }

        /*try {
           
        } catch(ValidationException $e)
        {
            DB::rollback();

            return response()->json([
                'fail' => true,
                'redirect_url' => url('equipamentos')
            ]);
        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw $e;
        }*/

        DB::commit();
  
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
         //Faz a consulta pesquisando pelo id
         $equipamento = Equipamento::find($id);

         //Monta o breadcrumb
         $caminhos = [
          ['url'=>'','titulo'=>'Equipamentos'],
          ['url'=>route('equipamentos.index'),'titulo'=>'Equipamentos'],
          ['url'=>'','titulo'=>'Detalhes']
        ];

        return view('site.equipamentos.show', compact('equipamento', 'caminhos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fabricantes = Fabricante::orderBy("nome","ASC")->get();
        $tipos = Tipo::orderBy("nome","ASC")->get();
        
        $setores = Setor::orderBy("nome","ASC")->get();              
        $estados = Estado::orderBy("nome","ASC")->get();    
        $equipamento = Equipamento::find($id);
        $modelos = Modelo::where('fabricante_id', '=', $equipamento->modelo->fabricante->id)
            ->where('tipo_id', '=', $equipamento->modelo->tipo->id)->get();

         //Monta o breadcrumb
         $caminhos = [
          ['url'=>'','titulo'=>'Equipamentos'],
          ['url'=>route('equipamentos.index'),'titulo'=>'Equipamentos'],
          ['url'=>'','titulo'=>'Formulário']
        ];

        return view('site.equipamentos.editar', compact('caminhos', 'fabricantes', 'tipos', 'modelos', 'setores', 'estados', 'equipamento'));
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
            'fabricante_id' => [               
                Rule::notIn('0'),
            ],
            'tipo_id'=> [                
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

        $equipamento = Equipamento::find($id)->update([
            'fabricante_id' => $request['fabricante_id'], 
            'tipo_id' => $request['tipo_id'], 
            'modelo_id' => $request['modelo_id'],            
            'setor_id' => $request['setor_id'],            
            'apelido' => $request['apelido'],
            'numeroserie' => $request['numeroserie'],
            'patrimonio' => $request['patrimonio'],
            'descricao' => $request['descricao']                   
        ]);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url()->previous()
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
        $equipamento = Equipamento::find($id);

        $equipamento->delete();

        return redirect()->route('equipamentos');
    }
}
