@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Cadastros
@endsection

@section('subtitulo')
    Permissões
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
      
    @can('permissao-create') 
        <a href="{{ route('permissoes.create') }}" type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Adicionar</a>                       
    @endcan
    <div style="margin-top:10px;" class="box-group" id="accordion">
        @foreach ($niveis as $nivel)
            <div class="panel box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $nivel->id }}" aria-expanded="true" class="">
                        {{ $nivel->nome }}
                    </a>
                    </h4>
                </div>
                <div id="collapse{{ $nivel->id }}" class="panel-collapse collapse" aria-expanded="true" style="">
                    <div class="box-body">              
                        <table class="table table-bordered">
                            <thead>
                                <tr>                     
                                <th>Permissão</th>                     
                                <th style="width: 40px">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nivel->permissoes as $permissao)
                                    <tr>                      
                                        <td>{{ $permissao->nome }}</td>                      
                                        <td>                                                            
                                            <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteNivelId" value="{{ $nivel->id }} " class="hidDeleteNivelId"><input type="hidden" name="hidDeletePermissaoId" value="{{ $permissao->id }} " class="hidDeletePermissaoId"></button>                                                                            
                                        </td>
                                    </tr>
                                @endforeach

                                {{--<tr>                      
                                    <td>cadastro-view</td>                      
                                    <td>                                                            
                                        <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                            
                                    </td>
                                </tr>
                                <tr>                      
                                    <td>cadastro-view</td>                      
                                    <td>                                                            
                                        <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                            
                                    </td>
                                </tr>
                                <tr>                      
                                    <td>cadastro-view</td>                      
                                    <td>                                                            
                                        <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                            
                                    </td>
                                </tr>--}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        @endforeach          
    </div>
       
       
    <input type="hidden" name="hidPagina" id="hidPagina" value="{{ URL::full() }}" class="hidPagina">
    
     <!-- Janela Modal -->
     <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <p>Confirma a exclusão da permissão?</p>
                </div>
                <div class="modal-footer">                       
                    <button title="Deletar" id="btnModalExcluir" class="btn btn-primary"><input type="hidden" name="hidModalNivelId" value="" class="hidModalNivelId"><input type="hidden" name="hidModalPermissaoId" value="" class="hidModalPermissaoId">OK</button>                                          
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
            var nivel_id = $('.hidDeleteNivelId', this).val();
            var permissao_id = $('.hidDeletePermissaoId', this).val();
            $('.hidModalNivelId').val(nivel_id);
            $('.hidModalPermissaoId').val(permissao_id);
            $('#myModal').modal('show');              
        });

        $('#btnModalCancel').click(function (e) {
            $('#myModal').modal('hide');              
        });

        $('#btnModal2Cancel').click(function (e) {
            $('#myModal2').modal('hide');              
        });

        $('#btnModalExcluir').click(function (e) {
            var nivel_id = $('.hidModalNivelId').val();
            var permissao_id = $('.hidModalPermissaoId').val();

            axios({
                method: "post", // verbo http
                url: "{{ route('permissoes.index') }}" + "/" + nivel_id + "/" + permissao_id + "/excluir", // url
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
