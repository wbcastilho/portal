<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Localizacao1;
use App\Localizacao2;
use App\Localizacao3;
use App\Localizacao4;
use App\Estado;
use App\Cidade;
use App\Praca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Localizacao4Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchText=trim($request->get('searchText'));
       
        $localizacoes = Localizacao4::where('nome', 'like', '%' . $searchText . '%')->where('praca_id', '=', auth()->user()->praca->id)
        ->orWhereHas('localizacao3', function ($query) use ($searchText) {
            $query->where('nome', 'like', '%' . $searchText . '%')->where('praca_id', '=', auth()->user()->praca->id)
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
                        });                              
        })->paginate(10);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>'','titulo'=>'Localizações'],
          ['url'=>'','titulo'=>'Localização 4']
        ];

        //Chamada da view passando as variaveis $registros
        return view('site.localizacao4.index', compact('localizacoes', 'caminhos', 'searchText'));
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
        $localizacoes2 = Localizacao2::where('id', '=', 0)->get();              
        $localizacoes3 = Localizacao3::where('id', '=', 0)->get();              

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao4.index'),'titulo'=>'Localização 4'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao4.adicionar', compact('caminhos', 'estados', 'cidades', 'localizacoes1', 'localizacoes2', 'localizacoes3'));
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
            'localizacao2_id'=> [
                'required',
                Rule::notIn('0'),
            ],
            'localizacao3_id'=> [
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
        $localizacao = Localizacao4::create([
            'nome' => $request['nome'],
            'localizacao3_id' => $request['localizacao3_id'],            
            'praca_id' => auth()->user()->praca->id          
        ]);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('localizacao4')
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
        $localizacoes3 = Localizacao2::where('praca_id', '=', auth()->user()->praca->id)->orderBy("nome","ASC")->get(); 
        $localizacao4 = Localizacao4::find($id);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('localizacao4.index'),'titulo'=>'Localização 4'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.localizacao4.editar', compact('caminhos', 'estados', 'cidades', 'localizacoes1', 'localizacoes2', 'localizacoes3', 'localizacao4'));
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
            'localizacao2_id'=> [
                'required',
                Rule::notIn('0'),
            ],
            'localizacao3_id'=> [
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
        $localizacao = Localizacao4::find($id)->update([
            'nome' => $request['nome'],
            'localizacao3_id' => $request['localizacao3_id'],            
            'praca_id' => auth()->user()->praca->id          
        ]);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('localizacao4')
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
        $localizacao = Localizacao4::find($id);

        $localizacao->delete();
    }
}
