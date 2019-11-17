<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use App\Estado;
use App\Cidade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class FornecedorController extends Controller
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
        $fornecedores = Fornecedor::where('nome', 'LIKE', $searchText . '%')->where('id', '>', 0)->orderBy("nome","ASC")->paginate(10);
  
        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>'','titulo'=>'Fornecedores']
        ];
  
        //Chamada da view passando as variaveis $registros
        return view('site.fornecedores.index', compact('fornecedores', 'caminhos', 'searchText'));
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
          ['url'=>route('fornecedores.index'),'titulo'=>'Fornecedores'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.fornecedores.adicionar', compact('caminhos', 'estados', 'cidades'));
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
            'nome'=> 'required',
            'cnpj'=> 'required',
            'estado_id' => [
                'required',
                Rule::notIn('0'),
            ],
            'cidade_id'=> [
                'required',
                Rule::notIn('0'),
            ]              
        ]);

        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);

        //Insere no banco de dados
        $fornecedor = Fornecedor::create($request->all());

        return response()->json([
            'fail' => false,
            'redirect_url' => url('fornecedores')
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
        $fornecedor = Fornecedor::find($id);
      
        //Monta o breadcrumb
        $caminhos = [
         ['url'=>'','titulo'=>'Cadastros'],
         ['url'=>route('fornecedores.index'),'titulo'=>'Fornecedores'],
         ['url'=>'','titulo'=>'Detalhes']
       ];

       return view('site.fornecedores.show', compact('fornecedor', 'caminhos'));
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
        $fornecedor = Fornecedor::find($id);
       
         //Monta o breadcrumb
         $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('fornecedores.index'),'titulo'=>'Fornecedores'],
          ['url'=>'','titulo'=>'Formulário']
        ];

        return view('site.fornecedores.editar', compact('caminhos', 'estados', 'cidades', 'fornecedor'));
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
            'nome'=> 'required',
            'cnpj'=> 'required',
            'estado_id' => [
                'required',
                Rule::notIn('0'),
            ],
            'cidade_id'=> [
                'required',
                Rule::notIn('0'),
            ]              
        ]);
       
        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);
  
        Fornecedor::find($id)->update($request->all());
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('fornecedores')
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
        $fornecedor = Fornecedor::find($id);
        $fornecedor->delete();
    }
}
