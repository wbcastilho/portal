@extends('layouts.app')

@section('css')
    
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
        <a href="{{ route('equipamentos.edit',$equipamento->id) }}" title="Editar" type="button" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Editar</a>        
        <button title="Deletar" class="btn btn-danger btnExcluir btn-sm"><i class="fa fa-trash"></i><input type="hidden" name="hidDeleteId" value="{{ $equipamento->id }}" class="hidDeleteId"> Excluir</button>
        <a href="#" class="btn btn-success btn-sm" type="button" title="Alterar localização"><i class="fa fa-fw fa-map-marker"></i> Movimentar</a>
    </div>
    
    <div class="col-sm-3 col-md-3 col-lg-3"> 
    <img style="margin:auto;" class="img-responsive" src="{{asset('storage/modelos')}}/{{ $equipamento->modelo->imagem }}" alt="Avatar" title="Imagem equipamento"/>				          
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
            <li><strong>Localizacao 2:</strong> {{ $equipamento->localizacao_equipamentos->last()->localizacao2->nome }}</li>
            <li><strong>Localizacao 3:</strong> {{ $equipamento->localizacao_equipamentos->last()->localizacao3->nome }}</li>
            <li><strong>Localizacao 4:</strong> {{ $equipamento->localizacao_equipamentos->last()->localizacao4->nome }}</li>
            <li><strong>Observação:</strong> {{ $equipamento->localizacao_equipamentos->last()->observacao }}</li>
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
            </div>
        </div>
    </div>

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
