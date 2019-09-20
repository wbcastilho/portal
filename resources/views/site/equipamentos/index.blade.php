@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Equipamentos
@endsection

@section('subtitulo')
    Equipamentos
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
   
    <form action="equipamentos" method="GET">
        <a href="{{ route('equipamentos.create') }}" type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Adicionar</a>                
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
              <th>Equipamento</th>         
              <th>Apelido</th>         
              <th>N/S</th>         
              <th>Patrimônio</th>         
              <th style="width: 90px">Ação</th>                                        
          </tr>
      </thead>
      <tbody>
          @if (count($equipamentos) > 0)
            @foreach ($equipamentos as $equipamento)               
                <tr>                             
                    <td class="text-center" style="vertical-align:middle;">{{ $equipamento->id }}</td>
                    <td style="vertical-align:middle;">{{ $equipamento->modelo->fabricante->nome }} {{ $equipamento->modelo->tipo->nome }} {{ $equipamento->modelo->nome }}</td>
                    <td style="vertical-align:middle;">{{ $equipamento->apelido }}</td>
                    <td style="vertical-align:middle;">{{ $equipamento->numeroserie }}</td>
                    <td style="vertical-align:middle;">{{ $equipamento->patrimonio }}</td>
                    <td>                         
                        <a href="{{ route('equipamentos.edit',$equipamento->id) }}" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                        <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="{{ $equipamento->id }}" class="hidDeleteId"></button>                                   
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
    {{$equipamentos->links()}}  
    
    <input type="hidden" name="hidPagina" id="hidPagina" value="{{ URL::full() }}" class="hidPagina">
    
     <!-- Janela Modal -->
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <p>Confirma a exclusão do equipamento?</p>
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
                url: "{{ route('equipamentos.index') }}" + "/" + id, // url
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
