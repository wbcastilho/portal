@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Cadastros
@endsection

@section('subtitulo')
    Teste
@endsection

@section('voltar')
   
@endsection 

@section('breadcrumb')         
  <ol class="breadcrumb">
    @if(isset($caminhos))
        @foreach($caminhos as $caminho)
            @if($caminho['url'])
                <li><a href="{{$caminho['url']}}"> {{$caminho['titulo']}}</a></li>     
            @else
                <li class="active"> {{$caminho['titulo']}}</li>
            @endif
        @endforeach
    @else

    @endif   
  </ol>
@endsection

@section('content') 
    <button  type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Adicionar</button>
    <div class="input-group col-xs-3 pull-right">
        <input type="text" class="form-control">
        <span class="input-group-btn">
            <button type="button" class="btn btn-default btn-flat"><i class="fa fa-fw fa-search"></i> Buscar</button>
        </span>
    </div>
    <table style="margin-top: 10px;" class="table table-bordered">
        <tbody><tr>
          <th style="width: 10px">Cód.</th>
          <th>Fabricantes</th>         
          <th style="width: 90px">Ação</th>
        </tr>
        <tr>
          <td>1</td>
          <td>Update software</td>
          <td>
            <a href="#" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
            <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                   
                                                               
          </td>         
        </tr>
        
      </tbody>
    </table>  
@endsection

@section('js')
    
    
@endsection
