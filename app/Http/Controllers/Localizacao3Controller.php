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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class Localizacao3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Autenticação caso não tenha permissão para visualizar os cadastros  
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        }
        if(Gate::denies('localizacao-view')){
            abort(403,"Não autorizado!");
        }

        $searchText=trim($request->get('searchText'));
       
        $localizacoes = Localizacao3::where('praca_id', '=', auth()->user()->praca->id)
        ->where(function ($query) use ($searchText){
            $query->where('nome', 'like', '%' . $searchText . '%');
            $query->orWhereHas('localizacao2', function ($query1) use ($searchText) {
                $query1->where('nome', 'like', '%' . $searchText . '%')->where('praca_id', '=', auth()->user()->praca->id)
                ->orWhereHas('localizacao1', function ($query2) use ($searchText) {
                    $query2->where('nome', 'like', '%' . $searchText . '%')->where('praca_id', '=', auth()->user()->praca->id)
                    ->orWhereHas('cidade', function ($query3) use ($searchText) {
                        $query3->where('nome', 'like', '%' . $searchText . '%')
                        ->orWhereHas('estado', function ($query4) use ($searchText) {
                                $query4->where('nome', 'like', '%' . $searchText . '%');
                        });
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
        //Autenticação caso não tenha permissão para visualizar os cadastros  
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        }
        if(Gate::denies('localizacao-create')){
            abort(403,"Não autorizado!");
        }

        $estados = Estado::orderBy("nome","ASC")->get();
        $cidades = Cidade::where('id', '=', 0)->get();
        $localizacoes1 = Localizacao1::where('id', '=', 0)->get();
        $localizacoes2 = Localizacao2::where('id', '=', 0)->get();              

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
        //Autenticação caso não tenha permissão para visualizar os cadastros  
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        }
        if(Gate::denies('localizacao-create')){
            abort(403,"Não autorizado!");
        }

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
            'localizacao2_id'=> [
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
        //Autenticação caso não tenha permissão para visualizar os cadastros  
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        }
        if(Gate::denies('localizacao-edit')){
            abort(403,"Não autorizado!");
        }

        $estados = Estado::orderBy("nome","ASC")->get();
        $cidades = Cidade::orderBy("nome","ASC")->get();
        $localizacoes1 = Localizacao1::withTrashed()->where('praca_id', '=', auth()->user()->praca->id)->orderBy("nome","ASC")->get();       
        $localizacoes2 = Localizacao2::withTrashed()->where('praca_id', '=', auth()->user()->praca->id)->orderBy("nome","ASC")->get(); 
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
        //Autenticação caso não tenha permissão para visualizar os cadastros  
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        }
        if(Gate::denies('localizacao-edit')){
            abort(403,"Não autorizado!");
        }

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
            'localizacao2_id'=> [
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
        //Autenticação caso não tenha permissão para visualizar os cadastros  
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        }
        if(Gate::denies('localizacao-delete')){
            abort(403,"Não autorizado!");
        }

        $localizacao = Localizacao3::find($id);
        $localizacao->delete();               
    }

    public function getLocalizacao4($id)
    {      
        $localizacoes4 = Localizacao3::find($id)->localizacao4->where('praca_id', '=', auth()->user()->praca->id);      
        return response()->json($localizacoes4);
    }

    public function getLocalizacao4_2($equipamento_id, $id)
    {      
        $localizacoes4 = Localizacao3::find($id)->localizacao4->where('praca_id', '=', auth()->user()->praca->id);      
        return response()->json($localizacoes4);
    }
}
