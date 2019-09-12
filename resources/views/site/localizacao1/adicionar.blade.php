@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Cadastros
@endsection

@section('subtitulo')
    Localização 1 <small>(Formulário)</small> 
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
    
    <form id="meuForm" class="form" role="form" action="{{ route('localizacao1.store') }}" enctype="multipart/form-data" method="post">
        {{csrf_field()}} 

        <div class="box-body">
            @include('site.localizacao1._form')                   
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
                    <p>Localização 1 cadastrada com sucesso!</p>
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
        /* Evento executado ao se digitar qualquer tecla nos inputs do formulário */
        $('input', '.form').keypress(function (e) {
            $(this).parent().removeClass('has-error');
            $('#erros').fadeOut();
        });

        //Ajax para preencher cidades de acordo com o estado selecionado
		$('select[name=estado_id]').change(function () {
            var estado_id = $(this).val();

            axios.get('cidades/' + estado_id)
            .then(function (cidades) {
                console.log(cidades);
                $('select[name=cidade_id]').empty();
                $('select[name=cidade_id]').append('<option value="0"></option>');
                $.each(cidades.data, function (key, value) {
                    $('select[name=cidade_id]').append('<option value="' + value.id + '">' + value.nome + '</option>');
                });
            })
            .catch(function (error) {               
                console.log(error);
            });            
            
        });

        //Evento ao clicar no botão Ok do modal
        $('#btnModalOk').click(function (e) {
            e.preventDefault();

            var hid = $(".hidModal").val();
            window.location = hid;
        });

        $('#myModal').on('hide.bs.modal', function (e) {
            var hid = $(".hidModal").val();
            window.location = hid;
        });

         //Evento ao clicar no botão salvar
         $('#btnSalvar').click(function (e) {
            e.preventDefault();

            axios({
                method: "post", // verbo http
                url: "{{ route('localizacao1.store') }}", // url
                data: {  
                    _token: $("input[type=hidden][name=_token]").val(),
                    nome: $("input[type=text][name=nome]").val(),                                       
                    estado_id: $("select[name=estado_id]").val(),                    
                    cidade_id: $("select[name=cidade_id]").val()                                                                                                          
                }                
            })
            .then(response => {
                console.log(response)
                if(response.data.fail){
                    for(control in response.data.errors){
                        $('#erro').empty();
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
