@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Equipamentos
@endsection

@section('subtitulo')
    Equipamentos <small>(Formulário)</small> 
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
   
    @if(!empty($errors->first()))
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <div id="erros" class="alert alert-danger alert-dismissible fade in" style="display:none;" role="alert">
        <span id="erro">

        </span>
    </div>
    
    <form id="meuForm" class="form" role="form" action="{{ route('equipamentos.store') }}" enctype="multipart/form-data" method="post">
        {{csrf_field()}} 

        <div class="box-body">
            @include('site.equipamentos._form')                   
        </div>                       

        <div class="box-footer">
            <button id="btnSalvar" class="btn btn-success">Salvar</button>
            <a style="margin-left:5px;" href="{{ URL::previous() }}" id="btnCancelar" class="btn btn-default">Voltar</a>
        </div>
    </form>   
    
      <!-- Janela Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Mensagem</h4>
                </div>
                <div class="modal-body">
                    <p>Equipamento cadastrado com sucesso!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnModalOk" class="btn btn-primary btnModalConfirm">Ok</button>
                    <input type="hidden" name="hidModal" id="hidModal" value="{{ URL::previous() }}" class="hidModal">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    
    <script>
        //Função que preenche o select modelos
        function getModelos(fabricante_id, tipo_id) {
            if(fabricante_id != 0 && tipo_id != 0)
            {
                axios.get('getmodelos/' + fabricante_id + '/' + tipo_id)
                .then(function (modelos) {
                    console.log(modelos);
                    $('select[name=modelo_id]').empty();
                    $('select[name=modelo_id]').append('<option value="0"></option>');
                    $.each(modelos.data, function (key, value) {
                        $('select[name=modelo_id]').append('<option value="' + value.id + '">' + value.nome + '</option>');
                    });
                })
                .catch(function (error) {               
                    console.log(error);
                });            
            }
        }

        //Evento executado ao se digitar qualquer tecla nos inputs do formulário 
        $('input', '.form').keypress(function (e) {
            $('input').parent().removeClass('has-error');
            $('select').parent().removeClass('has-error');
            $('#erros').fadeOut();
        });

        //Evento ao selecionar alguma opção no select
        $('select', '.form').change(function () {
            $('input').parent().removeClass('has-error');
            $('select').parent().removeClass('has-error');
            $('#erros').fadeOut();                        
        });

        //Ajax para preencher o select modelos
		$('select[name=fabricante_id]').change(function () {           
            var fabricante_id = $(this).val();
            var tipo_id = $('select[name=tipo_id]').val();

            getModelos(fabricante_id, tipo_id);
        });

        //Ajax para preencher o select modelos
		$('select[name=tipo_id]').change(function () {           
            var fabricante_id = $('select[name=fabricante_id]').val();
            var tipo_id = $(this).val();
           
            getModelos(fabricante_id, tipo_id);
        });

        //Evento ao clicar no botão Ok do modal
        $('#btnModalOk').click(function (e) {
            e.preventDefault();

            var hid = $(".hidModal").val();
            window.location = hid;
        });

         //Evento ao clicar no botão salvar
         $('#btnSalvar').click(function (e) {
            e.preventDefault();

            axios({
                method: "post", // verbo http
                url: "{{ route('equipamentos.store') }}", // url
                data: {  
                    _token: $("input[type=hidden][name=_token]").val(),
                    fabricante_id: $("select[name=fabricante_id]").val(),  
                    tipo_id: $("select[name=tipo_id]").val(),  
                    modelo_id: $("select[name=modelo_id]").val(),                     
                    setor_id: $("select[name=setor_id]").val(),                     
                    apelido: $("input[type=text][name=apelido]").val(),
                    numeroserie: $("input[type=text][name=numeroserie]").val(),
                    patrimonio: $("input[type=text][name=patrimonio]").val(),
                    descricao: $("textarea[name=descricao]").val()                    
                }                
            })
            .then(response => {
                console.log(response)
                if(response.data.fail){
                    $('#erro').empty();
                    for(control in response.data.errors){                       
                        $('#' + control).parent().addClass('has-error');
                        $('#erro').append('<li>' + response.data.errors[control] + '</li>');
                    }
                    $('#erros').fadeIn();
                    $('html, body').animate( { scrollTop: 0 }, 1000);
                }
                else {
                    $('#myModal').modal('show');
                }
            })
            .catch(error => {
                console.log(error)
            })
         });

    </script>
    
@endsection
