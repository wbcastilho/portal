@extends('layouts.app')

@section('css')
    <style>
        .timeline > li > .timeline-item { 
            background:#eee;
        }
    </style>
@endsection

@section('titulo')
    Equipamentos
@endsection

@section('subtitulo')
    Equipamentos <small>(Detalhes)</small> 
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
        @can('equipamento-edit')
            <a href="{{ route('equipamentos.edit',$equipamento->id) }}" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Editar</a>        
        @endcan
        @can('equipamento-delete')
            <button title="Deletar" class="btn btn-danger btnExcluir btn-sm"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="{{ $equipamento->id }}" class="hidDeleteId"> Excluir</button>
        @endcan
        @can('equipamento-movimentar')
            <a href="{{ route('equipamentos.movimentar',$equipamento->id) }}" class="btn btn-success btn-sm" type="button" title="Movimentar"><i class="fa fa-fw fa-map-marker"></i> Movimentar</a>
        @endcan
    </div>
    
    <div class="col-sm-3 col-md-3 col-lg-3"> 
    <img style="margin:auto;" class="img-responsive" src="{{asset('storage/modelos')}}/{{ $equipamento->modelo->imagem != '' ? $equipamento->modelo->imagem : 'picture.jpg' }}" alt="Avatar" title="Imagem equipamento"/>				          
        <h6 style="margin-top:15px;" class="page-header">
            <i class="fa fa-info-circle"></i>
            Informações
        </h6>
        <ul style="font-size:14px; line-height:25px;" class="list-unstyled user_data">
            <li><strong>Cód.:</strong> {{ $equipamento->id }}</li>
            <li><strong>Fabricante:</strong> {{ $equipamento->modelo->fabricante->nome }}</li>
            <li><strong>Tipo:</strong> {{ $equipamento->modelo->tipo->nome }}</li>
            <li><strong>Modelo:</strong> {{ $equipamento->modelo->nome }}</li>
            <li><strong>Apelido:</strong> {{ $equipamento->apelido }}</li>
            <li><strong>Setor:</strong> {{ $equipamento->setor->nome }}</li>
            <li><strong>N/S:</strong> {{ $equipamento->numeroserie }}</li>
            <li><strong>Patrimônio:</strong> {{ $equipamento->patrimonio }}</li>
            <li><strong>Descrição:</strong> {{ $equipamento->descricao }}</li>               
        </ul>
        <br>
        <h6 style="" class="page-header">
            <i class="fa fa-map-marker"></i>
            Localização
        </h6>
        <ul style="font-size:14px; line-height:25px;" class="list-unstyled">                
            <li><strong>Estado:</strong> {{ $equipamento->localizacao_equipamentos->last()->estado->nome }}</li>
            <li><strong>Cidade:</strong> {{ $equipamento->localizacao_equipamentos->last()->cidade->nome }}</li>
            <li><strong>Localizacao 1:</strong> {{ $equipamento->localizacao_equipamentos->last()->localizacao1->nome }}</li>
            <li><strong>Localizacao 2:</strong> {{  $equipamento->localizacao_equipamentos->last()->localizacao2->nome }}</li>
            <li><strong>Localizacao 3:</strong> {{  $equipamento->localizacao_equipamentos->last()->localizacao3->nome }}</li>
            <li><strong>Localizacao 4:</strong> {{  $equipamento->localizacao_equipamentos->last()->localizacao4->nome }}</li>
            <li><strong>Observação:</strong> {{ $equipamento->localizacao_equipamentos->last()->observacao }}</li>
        </ul>
        <br>
        <h6 style="" class="page-header">
            <i class="fa fa-industry"></i>
            Fabricante
        </h6>
        <ul style="font-size:14px; line-height:25px;" class="list-unstyled">                
            <li><strong>Nome:</strong> {{ $equipamento->modelo->fabricante->nome }}</li>
            <li><strong>Telefone:</strong> {{ $equipamento->modelo->fabricante->telefone }}</li>
            <li><strong>Email:</strong> {{ $equipamento->modelo->fabricante->email }}</li>
            <li><strong>Site:</strong> {{ $equipamento->modelo->fabricante->site }}</li>                       
        </ul>
    </div>

    <div class="col-sm-9 col-md-9 col-lg-9"><!-- Container Direita-->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 style="text-align:center; text-decoration: underline;">{{ $equipamento->modelo->fabricante->nome }} {{ $equipamento->modelo->tipo->nome }} {{ $equipamento->modelo->nome }}</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <h6 class="page-header">
                            <i class="fa fa-history"></i>
                            Histórico de Movimentações
                        </h6>
                        <ul class="timeline"> 
                            <?php $aux=""; ?>                          
                            @foreach ($equipamento->localizacao_equipamentos->sortByDesc("data") as $localizacao)
                                @if($localizacao->getFormattedDataAttribute() != $aux)                                 
                                    <li class="time-label">
                                        <span class="{{ $aux == "" ? "bg-red" : "bg-green" }}">                                           
                                            {{ $localizacao->getFormattedDataAttribute() }}
                                        </span>
                                        <?php $aux = $localizacao->getFormattedDataAttribute();  ?>
                                    </li>
                                @endif                                                             

                                @foreach ($equipamento->localizacao_equipamentos->sortByDesc("data") as $local)
                                    @if ($localizacao->data === $local->data)
                                        <li>
                                        <i @if($local->situacao->id == 1) class="fa fa-save bg-green" @elseif($local->situacao->id == 2) class="fa fa-exchange bg-blue" @elseif($local->situacao->id == 3) class="fa fa-trash bg-red" @elseif($local->situacao->id == 4) class="fa fa-retweet bg-aqua" @elseif($local->situacao->id == 5) class="fa fa-wrench bg-maroon" @elseif($local->situacao->id == 6) class="fa fa-hand-o-right bg-orange" @elseif($local->situacao->id == 7) class="fa fa-gift bg-purple" @elseif($local->situacao->id == 8) class="fa fa-trash-o bg-red" @elseif($local->situacao->id == 9) class="fa fa-question bg-red" @endif></i>                  
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> {{ $local->getFormattedHourDataAttribute() }}</span>                  
                                            <h3 class="timeline-header"><strong>{{ $local->situacao->nome }}</strong></h3>                  
                                                <div class="timeline-body">
                                                    <p>
                                                        <i style="margin-right:2px;" class="fa fa-user"></i> {{ studly_case($local->user->name) }}
                                                    </p>
                                                    
                                                    @if($local->situacao->id == 1 || $local->situacao->id == 2 || $local->situacao->id == 4)
                                                    <p>
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <i class="fa fa-map-marker"></i>
                                                                
                                                            <code>{{ $local->estado->uf }} 
                                                                {{ '/ ' . $local->cidade->nome }} 
                                                                {{ '/ '. $local->localizacao1->nome }} 
                                                                {{ $local->localizacao2->id !=  0 ? '/ ' . $local->localizacao2->nome  : '' }} 
                                                                {{ $local->localizacao3->id !=  0 ? '/ ' . $local->localizacao3->nome  : '' }}
                                                                {{ $local->localizacao4->id !=  0 ? '/ ' . $local->localizacao4->nome  : '' }}
                                                            </code>
                                                            </li>
                                                        </ul>
                                                    </p>
                                                    @endif

                                                    <p>
                                                        <strong>Observação:</strong> {{ $local->observacao }}
                                                    </p>                                           
                                                </div>                                 
                                            </div>
                                        </li> 
                                    @endif
                                @endforeach
                            @endforeach

                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>  
                        </ul>
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
                    <h4 class="modal-title">Excluir equipamento</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-5 col-sm-5 col-xs-12 {{ $errors->has('situacao_id') ? 'has-error' : ''}}">
                            <label for="situacao_id">Situação</label>        
                            <select id="situacao_id" name="situacao_id" class="form-control">
                                @foreach($situacoes as $situacao)
                                    <option {{ old('situacao_id') ==  $situacao->id ? 'selected' : '' }} value="{{$situacao->id}}">{{$situacao->nome}}</option>
                                @endforeach
                            </select>       
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label>Observação</label>
                            <textarea name="observacao" class="form-control" rows="3">{{old('observacao')}}</textarea>
                        </div>
                    </div>
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
                method: "post", // verbo http
                url: "{{ route('equipamentos.index') }}" + "/" + id + "/excluir", // url
                data: {                     
                    situacao_id: $("select[name=situacao_id]").val(),                                         
                    observacao: $("textarea[name=observacao]").val()                                       
                }        
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
