@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Cadastros
@endsection

@section('subtitulo')
    Setores
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
   
    <form action="setores" method="GET">
        @can('setor-create') 
            <a href="{{ route('setores.create') }}" type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Adicionar</a>                
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
              <th>Setor</th>         
              <th style="width: 90px">Ação</th>                                        
          </tr>
      </thead>
      <tbody>
          @if (count($setores) > 0)
            @foreach ($setores as $setor)               
                <tr>                             
                    <td class="text-center" style="vertical-align:middle;">{{ $setor->id }}</td>
                    <td style="vertical-align:middle;">{{ $setor->nome }}</td>
                    <td> 
                        @can('setor-edit')                                        
                            <a href="{{ route('setores.edit',$setor->id) }}" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                        @endcan
                        @can('setor-delete') 
                            <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="{{ $setor->id }}" class="hidDeleteId"></button>                                                        
                        @endcan
                    </td>
                </tr>
            @endforeach
          @else
            <tr style="height:45px;">
                <td></td>
                <td></td>
                <td></td>
            </tr>
          @endif                
      </tbody>
    </table>  
    {{$setores->links()}}  
    
    <input type="hidden" name="hidPagina" id="hidPagina" value="{{ URL::full() }}" class="hidPagina">
    
     <!-- Janela Modal -->
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <p>Confirma a exclusão do setor?</p>
                </div>
                <div class="modal-footer">                       
                    <button title="Deletar" id="btnModalExcluir" class="btn btn-primary"><input type="hidden" name="hidModalId" value="" class="hidModalId">OK</button>                                          
                    <button type="button" id="btnModalCancel" class="btn btn-default">Cancelar</button>                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Janela Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <p>O registro não pose ser excluído por estar relacionado a outra tabela.</p>
                </div>
                <div class="modal-footer">                                                                                    
                    <button type="button" id="btnModal2Cancel" class="btn btn-default">Ok</button>                    
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

        $('#btnModal2Cancel').click(function (e) {
            $('#myModal2').modal('hide');              
        });

        $('#btnModalExcluir').click(function (e) {
            var id = $('.hidModalId').val();

            axios({
                method: "delete", // verbo http
                url: "{{ route('setores.index') }}" + "/" + id, // url
                data: null        
            })
            .then(response => {
                if(response.data.fail){
                    $('#myModal').modal('hide');
                    $('#myModal2').modal('show'); 
                }
                else
                {
                    var current = $(".hidPagina").val();
                    window.location = current; 
                }      
            })
            .catch(error => {
                alert(data);
            })               
        });
    </script>
    
@endsection
