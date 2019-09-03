<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
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
        $usuarios = User::where('name', 'LIKE', $searchText . '%')->where('id', '>', 0)->orderBy("name","ASC")->paginate(10);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>'','titulo'=>'Usuários']
        ];

        //Chamada da view passando as variaveis $registros
        return view('site.usuarios.index', compact('usuarios', 'caminhos', 'searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          //Monta o breadcrumb
          $caminhos = [
            ['url'=>'','titulo'=>'Cadastros'],
            ['url'=>route('usuarios.index'),'titulo'=>'Usuários'],
            ['url'=>'','titulo'=>'Formulário']
          ];
  
          return view('site.usuarios.adicionar', compact('caminhos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
      $rules=[
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
      ];

      $validator = Validator::make($request->all(), $rules);
      if($validator->fails())
        return response()->json([
          'fail' => true,
          'errors' => $validator->errors()
        ], 200);

        $usuario = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json([
          'fail' => false,
          'redirect_url' => url('usuarios')
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
       //Faz a consulta pesquisando pelo id
        $usuario = User::find($id);

        //Monta o breadcrumb
         $caminhos = [
            ['url'=>'','titulo'=>'Cadastro'],
            ['url'=>route('usuarios.index'),'titulo'=>'Usuários'],
            ['url'=>'','titulo'=>'Formulário']
        ];

      return view('site.usuarios.editar', compact('usuario', 'caminhos'));
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
      $rules=[
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'email' => Rule::unique('users')->ignore($id),
          'password' => 'required|string|min:6|confirmed',
        ];

      $validator = Validator::make($request->all(), $rules);
      if($validator->fails())
          return response()->json([
          'fail' => true,
          'errors' => $validator->errors()
          ]);           

      $usuario = User::find($id);

      $usuario->name = $request['name'];
      $usuario->email = $request['email'];
      $usuario->password = Hash::make($request['password']);

      $usuario->save();           

      return response()->json([
      'fail' => false,
          'redirect_url' => url('usuarios')
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
        $usuario = User::find($id);

        $usuario->delete();
    }
}
