<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelo;
use App\Fabricante;
use App\Tipo;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchText=trim($request->get('searchText'));

        $modelos = Modelo::where('nome', 'like', '%' . $searchText . '%')
        ->orWhereHas('fabricante', function ($query) use ($searchText) {
            $query->where('nome', 'like', '%' . $searchText . '%');                                           
        })
        ->orWhereHas('tipo', function ($query) use ($searchText) {
            $query->where('nome', 'like', '%' . $searchText . '%');                        
        })->paginate(10);       

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>'','titulo'=>'Modelos']
        ];

        //Chamada da view passando as variaveis $registros
        return view('site.modelos.index', compact('modelos', 'caminhos', 'searchText'));
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

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('modelos.index'),'titulo'=>'Modelos'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.modelos.adicionar', compact('caminhos', 'fabricantes', 'tipos'));
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
            'fabricante_id' => 'required',
            'tipo_id' => 'required',
            'nome'=> 'required'
        ];
  
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ], 200);

        $dataForm = $request->all();        
        
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){                      
            $extension = $request->imagem->extension();

            $name = uniqid(date('His'));

            $nameFile = "{$name}.{$extension}";

            //$upload = Image::make($dataForm['imagem'])->resize(177, 236)->save(storage_path("app/public/modelos/$nameFile", 70));
            $upload = Image::make($dataForm['imagem'])->fit(400,400)->save(storage_path("app/public/modelos/$nameFile", 70));
            
            if(!$upload){
                return response()->json([
                    'fail' => true,
                    'errors' => 'Falha ao fazer upload'
                ], 500);
            }else{
                $dataForm['imagem'] = $nameFile;
            }
        }

        //Insere no banco de dados
        $modelo = Modelo::create($dataForm);

        return response()->json([
            'fail' => false,
            'redirect_url' => url('modelos')
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
        $fabricantes = Fabricante::orderBy("nome","ASC")->get();
        $tipos = Tipo::orderBy("nome","ASC")->get();
        $modelo = Modelo::find($id);

        //Monta o breadcrumb
        $caminhos = [
          ['url'=>'','titulo'=>'Cadastros'],
          ['url'=>route('modelos.index'),'titulo'=>'Modelos'],
          ['url'=>'','titulo'=>'Formulário']
        ];
    
        return view('site.modelos.editar', compact('caminhos', 'modelo', 'fabricantes', 'tipos'));       
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
            'fabricante_id' => 'required',
            'tipo_id' => 'required',
            'nome'=> 'required'
        ];
  
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        return response()->json([
            'fail' => true,
            'errors' => $validator->errors()
        ]);

        $dataForm = $request->all();        
        
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){ 
            $img = Modelo::find($id)->imagem;

            if( $img != null && $img != '')
            {
                $upload = Image::make($dataForm['imagem'])->fit(400,400)->save(storage_path("app/public/modelos/$img", 70));                
                $nameFile = $img;
            }   
            else
            {                  
                $extension = $request->imagem->extension();

                $name = uniqid(date('His'));

                $nameFile = "{$name}.{$extension}";

                //$upload = Image::make($dataForm['imagem'])->resize(177, 236)->save(storage_path("app/public/modelos/$nameFile", 70));
                $upload = Image::make($dataForm['imagem'])->fit(400,400)->save(storage_path("app/public/modelos/$nameFile", 70));                               
            }

            if(!$upload){
                return response()->json([
                    'fail' => true,
                    'errors' => 'Falha ao fazer upload'
                ], 500);
            }else{
                $dataForm['imagem'] = $nameFile;
            }
        }
  
        //Altera as informações de acordo com o id passado
        Modelo::find($id)->update($dataForm);
  
        return response()->json([
            'fail' => false,
            'redirect_url' => url('modelos')
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
        $modelo = Modelo::find($id);

        $modelo->delete();
    }

    public function getModelos($id, $fabricante_id, $tipo_id)
    {      
        $modelos = Modelo::where('fabricante_id', '=', $fabricante_id)
            ->where('tipo_id', '=', $tipo_id)->get();      
        return response()->json($modelos);
    }
}
