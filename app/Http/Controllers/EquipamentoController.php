<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fabricante;
use App\Tipo;
use App\Modelo;
use App\Setor;
use App\Situacao;
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
               
        
            $equipamentos = DB::table('localizacao_equipamentos')
            ->join(DB::raw('(SELECT MAX(localizacao_equipamentos.data) AS data, localizacao_equipamentos.equipamento_id FROM localizacao_equipamentos GROUP BY localizacao_equipamentos.equipamento_id) AS b'), 
            function($join)
            {
                $join->on('localizacao_equipamentos.equipamento_id', '=', 'b.equipamento_id');
                $join->on('localizacao_equipamentos.data', '=', 'b.data');
            })           
            ->join('users', 'localizacao_equipamentos.user_id', '=', 'users.id') 
            ->join('equipamentos', 'localizacao_equipamentos.equipamento_id', '=', 'equipamentos.id') 
            ->join('estados', 'localizacao_equipamentos.estado_id', '=', 'estados.id') 
            ->join('cidades', 'localizacao_equipamentos.cidade_id', '=', 'cidades.id') 
            ->join('localizacoes1', 'localizacao_equipamentos.localizacao1_id', '=', 'localizacoes1.id') 
            ->join('localizacoes2', 'localizacao_equipamentos.localizacao2_id', '=', 'localizacoes2.id') 
            ->join('localizacoes3', 'localizacao_equipamentos.localizacao3_id', '=', 'localizacoes3.id') 
            ->join('localizacoes4', 'localizacao_equipamentos.localizacao4_id', '=', 'localizacoes4.id') 
            ->join('setores', 'equipamentos.setor_id', '=', 'setores.id')           
            ->join('modelos', 'equipamentos.modelo_id', '=', 'modelos.id')           
            ->join('tipos', 'modelos.tipo_id', '=', 'tipos.id')           
            ->join('fabricantes', 'modelos.fabricante_id', '=', 'fabricantes.id')                                
            ->selectRaw('localizacao_equipamentos.id, localizacao_equipamentos.equipamento_id, equipamentos.apelido, setores.nome AS setor, equipamentos.numeroserie, equipamentos.patrimonio, localizacao_equipamentos.data, estados.uf, cidades.nome AS cidade, localizacoes1.nome AS localizacao1, localizacoes2.nome AS localizacao2, localizacoes3.nome AS localizacao3, localizacoes4.nome AS localizacao4, modelos.nome AS modelo, tipos.nome AS tipo, fabricantes.nome AS fabricante, modelos.imagem, equipamentos.apelido, localizacao_equipamentos.situacao_id, localizacao_equipamentos.observacao, localizacao_equipamentos.localizacao1_id, localizacao_equipamentos.localizacao2_id, localizacao_equipamentos.localizacao3_id, localizacao_equipamentos.localizacao4_id')
            ->groupBy('localizacao_equipamentos.equipamento_id')
            ->where('equipamentos.praca_id', '=', auth()->user()->praca->id)
            ->where(function ($query) use ($searchText)  {                
                $query->orWhere(function ($query) use ($searchText)  { 
                    $query->orWhere('equipamentos.apelido', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('equipamentos.numeroserie', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('equipamentos.patrimonio', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('equipamentos.id', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('fabricantes.nome', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('tipos.nome', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('modelos.nome', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('users.name', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('setores.nome', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('estados.uf', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('cidades.nome', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('localizacoes1.nome', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('localizacoes2.nome', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('localizacoes3.nome', 'like', '%' . $searchText . '%');                   
                    $query->orWhere('localizacoes4.nome', 'like', '%' . $searchText . '%');                   
                });
            })
            ->orderBy('fabricantes.nome', 'asc')
            ->orderBy('tipos.nome', 'asc')
            ->orderBy('modelos.nome', 'asc')
            ->orderBy('equipamentos.apelido', 'asc')
            ->orderBy('equipamentos.numeroserie', 'asc')
            ->orderBy('equipamentos.patrimonio', 'asc')
            ->orderBy('estados.uf', 'asc')
            ->orderBy('cidades.nome', 'asc')
            ->orderBy('localizacoes1.nome', 'asc')
            ->orderBy('localizacoes2.nome', 'asc')
            ->orderBy('localizacoes3.nome', 'asc')
            ->orderBy('localizacoes4.nome', 'asc')
            ->paginate(10);          

        /*$equipamentos = Equipamento::where('praca_id', '=', auth()->user()->praca->id)
        ->where(function ($query) use ($searchText)  { 
            $query->orWhere('apelido', 'like', '%' . $searchText . '%');
            $query->orWhere('numeroserie', 'like', '%' . $searchText . '%');
            $query->orWhere('patrimonio', 'like', '%' . $searchText . '%');
            $query->orWhereHas('setor', function ($query) use ($searchText) {
                $query->where('nome', 'LIKE', '%' . $searchText . '%');               
            });
            $query->orWhereHas('modelo', function ($query) use ($searchText) {
                $query->where('nome', 'like', '%' . $searchText . '%')
                ->orWhereHas('fabricante', function ($query) use ($searchText) {                                     
                    $query->where('nome', 'like', '%' . $searchText . '%');                       
                })                          
                ->orWhereHas('tipo', function ($query) use ($searchText) {
                    $query->where('nome', 'like', '%' . $searchText . '%');                       
                });
            }); 
            $query->orWhereHas('localizacao_equipamentos', function ($query) use ($searchText) {                                                                               
                $query->where(function ($query) use ($searchText) {                                                                         
                    $query->orWhereHas('estado', function ($query) use ($searchText) {
                        $query->where('uf', 'like', '%' . $searchText . '%');                                          
                    })
                    ->orWhereHas('cidade', function ($query) use ($searchText) {
                        $query->where('nome', 'like', '%' . $searchText . '%');                       
                    })
                    ->orWhereHas('localizacao1', function ($query) use ($searchText) {
                        $query->where('nome', 'like', '%' . $searchText . '%');                       
                    })
                    ->orWhereHas('localizacao2', function ($query) use ($searchText) {
                        $query->where('nome', 'like', '%' . $searchText . '%');                       
                    })
                    ->orWhereHas('localizacao2', function ($query) use ($searchText) {
                        $query->where('nome', 'like', '%' . $searchText . '%');                       
                    })
                    ->orWhereHas('localizacao3', function ($query) use ($searchText) {
                        $query->where('nome', 'like', '%' . $searchText . '%');                       
                    })
                    ->orWhereHas('localizacao4', function ($query) use ($searchText) {
                        $query->where('nome', 'like', '%' . $searchText . '%');                       
                    });
                });
            });              
        })->paginate(10);*/ 
        
        //dd($equipamentos);

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

            $now = date("Y-m-d H:i:s"); 
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
         $situacoes = Situacao::where('id','=',3)->orWhere('id','=',7)->orWhere('id','=',8)->orWhere('id','=',9)->get();

         //Monta o breadcrumb
         $caminhos = [
          ['url'=>'','titulo'=>'Equipamentos'],
          ['url'=>route('equipamentos.index'),'titulo'=>'Equipamentos'],
          ['url'=>'','titulo'=>'Detalhes']
        ];

        return view('site.equipamentos.show', compact('equipamento', 'situacoes', 'caminhos'));
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
    }

    public function excluir(Request $request, $id)
    {                                    
        DB::beginTransaction();

        $equipamento = Equipamento::find($id);
      
        try {                      
            $now = date("Y-m-d H:i:s"); 
            $localizacao = LocalizacaoEquipamentos::create([
                'data' => $now, 
                'observacao' => $request['observacao'], 
                'user_id' => auth()->user()->id ,            
                'equipamento_id' => $equipamento->id,            
                'situacao_id' => $request['situacao_id'],
                'estado_id' => 0,
                'cidade_id' => 0,
                'localizacao1_id' => 0,                       
                'localizacao2_id' => 0,                       
                'localizacao3_id' => 0,                       
                'localizacao4_id' => 0                         
            ]);
           
            $equipamento->delete();
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
        }

        DB::commit();
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('equipamentos')
        ]);



      
    }

    public function movimentar($id)
    {             
        $fabricantes = Fabricante::orderBy("nome","ASC")->get();
        $tipos = Tipo::orderBy("nome","ASC")->get();
        $modelos = Modelo::orderBy("nome","ASC")->get();
        $setores = Setor::orderBy("nome","ASC")->get();  
        $situacoes = Situacao::where('id','=',2)->orWhere('id','=',5)->get();                           

        $estados = Estado::orderBy("nome","ASC")->get();  
        $equipamento = Equipamento::find($id);            

        //Monta o breadcrumb
        $caminhos = [          
          ['url'=>route('equipamentos.index'),'titulo'=>'Equipamentos'],
          ['url'=>'','titulo'=>'Movimentar']
        ];
    
        return view('site.equipamentos.movimentar', compact('caminhos', 'fabricantes', 'tipos', 'modelos', 'setores', 'situacoes', 'equipamento', 'estados'));
    }

    public function movimentacao(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [                      
            'observacao' => 'required_if:situacao_id,5'                                    
        ]);

        //Caso o campo situacao_id == 2 checa se o estado_id == 0, se sim dá o erro
        $validator->sometimes('estado_id', Rule::notIn('0'), function ($input) {
            return $input->situacao_id == 2;
        });

        //Caso o campo situacao_id == 2 checa se o cidade_id == 0, se sim dá o erro
        $validator->sometimes('cidade_id', Rule::notIn('0'), function ($input) {
            return $input->situacao_id == 2;
        });

        //Caso o campo situacao_id == 2 checa se o localizacao1_id == 0, se sim dá o erro
        $validator->sometimes('localizacao1_id', Rule::notIn('0'), function ($input) {
            return $input->situacao_id == 2;
        });

        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);         

        $now = date("Y-m-d H:i:s"); 
        $localizacao = LocalizacaoEquipamentos::create([
            'data' => $now, 
            'observacao' => $request['observacao'], 
            'user_id' => auth()->user()->id ,            
            'equipamento_id' => $id,            
            'situacao_id' => $request['situacao_id'], 
            'estado_id' => $request['estado_id'],
            'cidade_id' => $request['cidade_id'],
            'localizacao1_id' => $request['localizacao1_id'],                       
            'localizacao2_id' => $request['localizacao2_id'],                       
            'localizacao3_id' => $request['localizacao3_id'],                       
            'localizacao4_id' => $request['localizacao4_id']                         
        ]);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url()->previous()
        ]);
    }
}
