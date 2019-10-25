<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class TipoController extends Controller
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
      if(Gate::denies('tipo-view')){
        abort(403,"Não autorizado!");
      }

      $searchText=trim($request->get('searchText'));

      //Faz a consulta no banco com paginação
      $tipos = Tipo::where('nome', 'LIKE', $searchText . '%')->where('id', '>', 0)->orderBy("nome","ASC")->paginate(10);

      //Monta o breadcrumb
      $caminhos = [
        ['url'=>'','titulo'=>'Cadastros'],
        ['url'=>'','titulo'=>'Tipos']
      ];

      //Chamada da view passando as variaveis $registros
      return view('site.tipos.index', compact('tipos', 'caminhos', 'searchText'));
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
      if(Gate::denies('tipo-create')){
        abort(403,"Não autorizado!");
      }

      //Monta o breadcrumb
      $caminhos = [
        ['url'=>'','titulo'=>'Cadastros'],
        ['url'=>route('tipos.index'),'titulo'=>'Tipos'],
        ['url'=>'','titulo'=>'Formulário']
      ];

      return view('site.tipos.adicionar', compact('caminhos'));
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
      if(Gate::denies('tipo-create')){
        abort(403,"Não autorizado!");
      }

      try
      {
        $rules=[
          'nome'=> 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
          return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
          ], 200);

          //Insere no banco de dados
          $tipo = Tipo::create($request->all());

          return response()->json([
            'fail' => false,
            'redirect_url' => url('tipos')
          ]);
      } catch (\Exception $e) {
        return response(['error' => $e->getMessage()],500);
      }
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
      if(Gate::denies('tipo-edit')){
        abort(403,"Não autorizado!");
      }

      //Faz a consulta pesquisando pelo id
      $tipo = Tipo::find($id);

      //Monta o breadcrumb
      $caminhos = [
        ['url'=>'','titulo'=>'Cadastro'],
        ['url'=>route('tipos.index'),'titulo'=>'Tipos'],
        ['url'=>'','titulo'=>'Formulário']
      ];

      return view('site.tipos.editar', compact('tipo', 'caminhos'));
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
      if(Gate::denies('tipo-edit')){
        abort(403,"Não autorizado!");
      }

      try
      {
        $rules=[
          'nome'=> 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
          return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
          ]);

          //Altera as informações de acordo com o id passado
          Tipo::find($id)->update($request->all());

          return response()->json([
            'fail' => false,
            'redirect_url' => url('tipos')
          ], 200);
      } catch (\Exception $e) {
        return response(['error' => $e->getMessage()],500);
      }
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
      if(Gate::denies('tipo-delete')){
        abort(403,"Não autorizado!");
      }

      $tipo = Tipo::find($id);
      $tipo->delete();    
    }
}
