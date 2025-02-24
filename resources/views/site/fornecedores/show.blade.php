@extends('layouts.app')

@section('css')
    <style>
        .timeline > li > .timeline-item { 
            background:#eee;
        }
    </style>
@endsection

@section('titulo')
    Cadastros
@endsection

@section('subtitulo')
    Fornecedores <small>(Detalhes)</small> 
@endsection

@section('voltar')
    <a href="{{ URL::previous() }}" class="btn btn-box-tool">
        <i class="fa fa-reply"></i> Voltar
    </a>  
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
    <div style="margin-bottom:10px;" class="col-sm-12 col-md-12 col-lg-12">       
        <a href="{{ route('fornecedores.edit',$fornecedor->id) }}" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Editar</a>               
        <button title="Deletar" class="btn btn-danger btnExcluir btn-sm"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="{{ $fornecedor->id }}" class="hidDeleteId"> Excluir</button>            
    </div>
    
    <div class="col-sm-3 col-md-3 col-lg-3"> 
        <h6 style="margin-top:15px;" class="page-header">
            <i class="fa fa-info-circle"></i>
            Informações
        </h6>
        <ul style="font-size:14px; line-height:25px;" class="list-unstyled user_data">
            <li><strong>Cód.:</strong> {{ $fornecedor->id }}</li>
            <li><strong>Fornecedor:</strong> {{ $fornecedor->nome }}</li>
            <li><strong>IE:</strong> {{ $fornecedor->ie }}</li>
            <li><strong>CNPJ:</strong> {{ $fornecedor->cnpj }}</li>
            <li><strong>Estado:</strong> {{ $fornecedor->estado->nome }}</li>
            <li><strong>Cidade:</strong> {{ $fornecedor->cidade->nome }}</li>
            <li><strong>Endereço:</strong> {{ $fornecedor->endereco }}</li>
            <li><strong>Número:</strong> {{ $fornecedor->numero }}</li>
            <li><strong>Bairro:</strong> {{ $fornecedor->bairro }}</li>
            <li><strong>Telefone:</strong> {{ $fornecedor->telefone }}</li>
            <li><strong>Celular:</strong> {{ $fornecedor->celular }}</li>
            <li><strong>Email:</strong> {{ $fornecedor->email }}</li>
            <li><strong>Descrição:</strong> {{ $fornecedor->descricao }}</li>               
        </ul>                
    </div>

    <div class="col-sm-9 col-md-9 col-lg-9"><!-- Container Direita-->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 style="text-align:center; text-decoration: underline;">{{ $fornecedor->nome }}</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Fabricantes</a></li>
                                <li><a href="#tab_2" data-toggle="tab">Representantes</a></li>                            
                            </ul>
                            <div class="tab-content" style="overflow-y: auto; max-height: 240px">
                            <div class="tab-pane active" id="tab_1">
                                <a href="#" type="button" class="btn btn-primary"><i class="fa fa-fw fa-chain"></i> Associar</a>                       
                                <table class="table table-bordered" style="margin-top:10px;">
                                    <thead>
                                        <tr>                
                                            <th style="width: 10px">Cód.</th>
                                            <th>Fabricante</th>         
                                            <th style="width: 40px">Ação</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Grass Valley</td>
                                            <td>
                                                <button title="Desassociar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-chain-broken"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                   
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Grass Valley</td>
                                            <td>
                                                <button title="Desassociar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-chain-broken"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                   
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Grass Valley</td>
                                            <td>
                                                <button title="Desassociar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-chain-broken"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                   
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Grass Valley</td>
                                            <td>
                                                <button title="Desassociar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-chain-broken"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                   
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Grass Valley</td>
                                            <td>
                                                <button title="Desassociar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-chain-broken"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                   
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Grass Valley</td>
                                            <td>
                                                <button title="Desassociar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-chain-broken"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                   
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Grass Valley</td>
                                            <td>
                                                <button title="Desassociar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-chain-broken"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                   
                                            </td>
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <a href="#" type="button" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Adicionar</a>                
                                <table class="table table-bordered" style="margin-top:10px;">
                                    <thead>
                                        <tr>                                                                    
                                            <th>Representantes</th>         
                                            <th>Telefone</th>         
                                            <th>Celular</th>         
                                            <th style="width: 90px">Ação</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>                                                                    
                                            <td>João</td>         
                                            <td>(35)3222-1508</td>         
                                            <td>(35)98855-4578)</td>         
                                            <td >                                                               
                                                <a href="#" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>                                              
                                                <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                                  
                                            </td>                                        
                                        </tr>
                                        <tr>                                                                    
                                            <td>João</td>         
                                            <td>(35)3222-1508</td>         
                                            <td>(35)98855-4578)</td>         
                                            <td >                                                               
                                                <a href="#" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>                                              
                                                <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                                  
                                            </td>                                       
                                        </tr>
                                        <tr>                                                                    
                                            <td>João</td>         
                                            <td>(35)3222-1508</td>         
                                            <td>(35)98855-4578)</td>         
                                            <td>                                                               
                                                <a href="#" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>                                              
                                                <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                                  
                                            </td>                                        
                                        </tr>
                                        <tr>                                                                    
                                            <td>João</td>         
                                            <td>(35)3222-1508</td>         
                                            <td>(35)98855-4578)</td>         
                                            <td>                                                               
                                                <a href="#" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>                                              
                                                <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                                  
                                            </td>                                        
                                        </tr>
                                        <tr>                                                                    
                                            <td>João</td>         
                                            <td>(35)3222-1508</td>         
                                            <td>(35)98855-4578)</td>         
                                            <td>                                                               
                                                <a href="#" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>                                              
                                                <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                                  
                                            </td>                                        
                                        </tr>
                                        <tr>                                                                    
                                            <td>João</td>         
                                            <td>(35)3222-1508</td>         
                                            <td>(35)98855-4578)</td>         
                                            <td>                                                               
                                                <a href="#" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>                                              
                                                <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                                  
                                            </td>                                        
                                        </tr>
                                        <tr>                                                                    
                                            <td>João</td>         
                                            <td>(35)3222-1508</td>         
                                            <td>(35)98855-4578)</td>         
                                            <td>                                                               
                                                <a href="#" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>                                              
                                                <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                                  
                                            </td>                                       
                                        </tr>
                                        <tr>                                                                    
                                            <td>João</td>         
                                            <td>(35)3222-1508</td>         
                                            <td>(35)98855-4578)</td>         
                                            <td>                                                               
                                                <a href="#" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>                                              
                                                <button title="Deletar" class="btn btn-danger btn-sm btnExcluir"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="" class="hidDeleteId"></button>                                                                                  
                                            </td>                                        
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                                like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <input type="hidden" name="hidVoltar" id="hidVoltar" value="{{ URL::previous() }}" class="hidVoltar">

    <!-- Janela Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <p>Confirma a exclusão do fornecedor?</p>
                </div>
                <div class="modal-footer">                       
                    <button title="Deletar" id="btnModalExcluir" class="btn btn-primary"><input type="hidden" name="hidModalId" value="" class="hidModalId">Excluir</button>                                          
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
                url: "{{ route('fornecedores.index') }}" + "/" + id, // url
                data: null        
            })
            .then(response => {               
                var current = $(".hidVoltar").val();
                window.location = current;                
            })
            .catch(error => {
                alert(data);
            })                          
        });
    </script>
    
@endsection
