@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Cadastros
@endsection

@section('subtitulo')
    Tipos
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
   
    <form action="tipos" method="GET">
        <a href="{{ route('tipos.create') }}" type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Adicionar</a>                
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
              <th>Tipo</th>         
              <th style="width: 90px">Ação</th>                                        
          </tr>
      </thead>
      <tbody>
          @if (count($tipos) > 0)
            @foreach ($tipos as $tipo)               
                <tr>                             
                    <td class="text-center" style="vertical-align:middle;">{{ $tipo->id }}</td>
                    <td style="vertical-align:middle;">{{ $tipo->nome }}</td>
                    <td>                         
                    <a href="{{ route('tipos.edit',$tipo->id) }}" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                    <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="{{ $tipo->id }}" class="hidDeleteId"></button>                                   
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
    {{$tipos->links()}}  
    
    <input type="hidden" name="hidPagina" id="hidPagina" value="{{ URL::full() }}" class="hidPagina">
    
     <!-- Janela Modal -->
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <p>Confirma a exclusão do tipo?</p>
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
                url: "{{ route('tipos.index') }}" + "/" + id, // url
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
