<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nivel;
use App\Permissao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class PermissaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        } 
        if(Gate::denies('permissao-view')){
            abort(403,"Não autorizado!");
        }

        $niveis = Nivel::where('id', '>', 1)->orderBy("id","ASC")->get();
       
        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>'','titulo'=>'Permissões']
        ];

        //Chamada da view passando as variaveis $registros
        return view('site.permissoes.index', compact('caminhos', 'niveis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        } 
        if(Gate::denies('permissao-create')){
            abort(403,"Não autorizado!");
        }

        $niveis = Nivel::where('id', '>', 1)->orderBy("id","ASC")->get();
        $permissoes = Permissao::orderBy("id","ASC")->get();       

        //Monta o breadcrumb
        $caminhos = [
            ['url'=>'','titulo'=>'Cadastros'],
            ['url'=>route('setores.index'),'titulo'=>'Permissões'],
            ['url'=>'','titulo'=>'Formulário']
        ];

        return view('site.permissoes.adicionar', compact('niveis', 'permissoes', 'caminhos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        } 
        if(Gate::denies('permissao-create')){
            abort(403,"Não autorizado!");
        }

        $validator = Validator::make($request->all(), [
            'nivel_id' => [
                'required',
                Rule::notIn('0'),
            ],
            'permissao_id'=> [
                'required',
                Rule::notIn('0'),
            ]               
        ]);

        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);

        $nivel = Nivel::find($request['nivel_id']);
        $dados = $request->all();
        $permissao = Permissao::find($dados['permissao_id']);
        if($nivel->adicionaPermissao($permissao)){
            return response()->json([
                'fail' => false,
                'redirect_url' => url('permissoes')
            ]);
        }
        else{
            return response()->json([
                'fail' => true,
                'errors' => ['Permissão já cadastrada para este nível de usuário.'],
                'redirect_url' => url('permissoes')
            ]);
        }
        //return redirect()->back();

        //$nivel = Nivel::find($request['nivel_id'])->permissoes()->attach($request['permissao_id']);       
  
       
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

    public function excluir($id, $permissao_id)
    {
        if(Gate::denies('cadastro-view')){
            abort(403,"Não autorizado!");
        } 
        if(Gate::denies('permissao-delete')){
            abort(403,"Não autorizado!");
        }

       Nivel::find($id)->permissoes()->detach($permissao_id);
    }
}
