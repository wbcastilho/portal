@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Cadastros
@endsection

@section('subtitulo')
    Localização 3
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
   
    <form action="localizacao3" method="GET">
        <a href="{{ route('localizacao3.create') }}" type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Adicionar</a>                
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
              <th>Estado</th>         
              <th>Cidade</th>         
              <th>Localização 1</th>         
              <th>Localização 2</th>         
              <th>Localização 3</th>         
              <th style="width: 90px">Ação</th>                                        
          </tr>
      </thead>
      <tbody>
          @if (count($localizacoes) > 0)
            @foreach ($localizacoes as $localizacao)               
                <tr>                             
                    <td class="text-center" style="vertical-align:middle;">{{ $localizacao->id }}</td>
                    <td style="vertical-align:middle;">{{ $localizacao->localizacao2->localizacao1->estado->uf }}</td>
                    <td style="vertical-align:middle;">{{ $localizacao->localizacao2->localizacao1->cidade->nome }}</td>
                    <td style="vertical-align:middle;">{{ $localizacao->localizacao2->localizacao1->nome }}</td>
                    <td style="vertical-align:middle;">{{ $localizacao->localizacao2->nome }}</td>
                    <td style="vertical-align:middle;">{{ $localizacao->nome }}</td>
                    <td>                         
                    <a href="{{ route('localizacao3.edit',$localizacao->id) }}" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                    <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="{{ $localizacao->id }}" class="hidDeleteId"></button>                                   
                    </td>
                </tr>
            @endforeach
          @else
            <tr style="height:45px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
          @endif                
      </tbody>
    </table>  
    {{$localizacoes->links()}}  
    
    <input type="hidden" name="hidPagina" id="hidPagina" value="{{ URL::full() }}" class="hidPagina">
    
     <!-- Janela Modal -->
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <p>Confirma a exclusão da localização 3?</p>
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
                url: "{{ route('localizacao3.index') }}" + "/" + id, // url
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
