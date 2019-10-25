<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fabricante;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class FabricanteController extends Controller
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
      if(Gate::denies('fabricante-view')){
          abort(403,"Não autorizado!");
      }

      $searchText=trim($request->get('searchText'));

      //Faz a consulta no banco com paginação
      $fabricantes = Fabricante::where('nome', 'LIKE', $searchText . '%')->where('id', '>', 0)->orderBy("nome","ASC")->paginate(10);

      //Monta o breadcrumb
      $caminhos = [
        ['url'=>'','titulo'=>'Cadastros'],
        ['url'=>'','titulo'=>'Fabricantes']
      ];

      //Chamada da view passando as variaveis $registros
      return view('site.fabricantes.index', compact('fabricantes', 'caminhos', 'searchText'));
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
      if(Gate::denies('fabricante-create')){
        abort(403,"Não autorizado!");
      }

      //Monta o breadcrumb
      $caminhos = [
        ['url'=>'','titulo'=>'Cadastros'],
        ['url'=>route('fabricantes.index'),'titulo'=>'Fabricantes'],
        ['url'=>'','titulo'=>'Formulário']
      ];

      return view('site.fabricantes.adicionar', compact('caminhos'));
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
      if(Gate::denies('fabricante-create')){
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
          $fabricante = Fabricante::create($request->all());

          return response()->json([
            'fail' => false,
            'redirect_url' => url('fabricantes')
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
      if(Gate::denies('fabricante-edit')){
        abort(403,"Não autorizado!");
      }

      //Faz a consulta pesquisando pelo id
      $fabricante = Fabricante::find($id);

      //Monta o breadcrumb
      $caminhos = [
        ['url'=>'','titulo'=>'Cadastro'],
        ['url'=>route('fabricantes.index'),'titulo'=>'Fabricantes'],
        ['url'=>'','titulo'=>'Formulário']
      ];

      return view('site.fabricantes.editar', compact('fabricante', 'caminhos'));
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
      if(Gate::denies('fabricante-edit')){
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
          Fabricante::find($id)->update($request->all());

          return response()->json([
            'fail' => false,
            'redirect_url' => url('fabricantes')
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
      if(Gate::denies('fabricante-delete')){
        abort(403,"Não autorizado!");
      }

      $fabricante = Fabricante::find($id);
      $fabricante->delete();  
    }
}
