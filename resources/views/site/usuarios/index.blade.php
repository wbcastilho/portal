@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Cadastros
@endsection

@section('subtitulo')
    Usuários
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
   
    <form action="usuarios" method="GET">
        @can('usuario-create') 
            <a href="{{ route('usuarios.create') }}" type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Adicionar</a>                
        @endcan
        {{csrf_field()}}
        <div class="input-group col-xs-3 pull-right" >   
            <input type="text" class="form-control" name="searchText" placeholder="Pesquisa" value="{{$searchText}}">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-fw fa-search"></i> Buscar</button>
            </span>
        </div>
    </form> 
       
    <table class="table table-bordered" style="margin-top:10px;">
      <thead>
          <tr>                
              <th style="width: 10px">Cód.</th>
              <th>Nome</th>         
              <th style="width: 150px">Praça</th>         
              <th style="width: 150px">Nível</th>         
              <th style="width: 90px">Ação</th>                                        
          </tr>
      </thead>
      <tbody>
          @if (count($usuarios) > 0)
            @foreach ($usuarios as $usuario)               
                <tr>                             
                    <td class="text-center" style="vertical-align:middle;">{{ $usuario->id }}</td>
                    <td style="vertical-align:middle;">{{ $usuario->name }}</td>
                    <td style="vertical-align:middle;">{{ $usuario->praca->nome }}</td>
                    <td style="vertical-align:middle;">{{ $usuario->nivel->nome }}</td>
                    <td>     
                        @can('usuario-edit')                     
                            <a href="{{ route('usuarios.edit',$usuario->id) }}" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                        @endcan
                        @can('usuario-delete') 
                            <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="{{ $usuario->id }}" class="hidDeleteId"></button>                                   
                        @endcan
                    </td>
                </tr>
            @endforeach
          @else
            <tr style="height:45px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
          @endif                
      </tbody>
    </table>  
    {{$usuarios->links()}}  
    
    <input type="hidden" name="hidPagina" id="hidPagina" value="{{ URL::full() }}" class="hidPagina">
    
     <!-- Janela Modal -->
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <p>Confirma a exclusão do usuário?</p>
                </div>
                <div class="modal-footer">                       
                    <button title="Deletar" id="btnModalExcluir" class="btn btn-primary"><input type="hidden" name="hidModalId" value="" class="hidModalId">OK</button>                                          
                    <button type="button" id="btnModalCancel" class="btn btn-default">Cancelar</button>                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    <script>        

        //Evento ao clicar no botão Excluir
        $('.btnExcluir').click(function (e) {
            var id = $('.hidDeleteId', this).val();
            $('.hidModalId').val(id);
            $('#myModal').modal('show');              
        });

        $('#btnModalCancel').click(function (e) {
            $('#myModal').modal('hide');              
        });

        $('#btnModalExcluir').click(function (e) {
            var id = $('.hidModalId').val();

            axios({
                method: "delete", // verbo http
                url: "{{ route('usuarios.index') }}" + "/" + id, // url
                data: null        
            })
            .then(response => {
                var current = $(".hidPagina").val();
                window.location = current;  
            })
            .catch(error => {
                alert(data);
            })               
        });
    </script>
    
@endsection
