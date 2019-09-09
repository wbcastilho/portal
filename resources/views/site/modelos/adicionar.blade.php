@extends('layouts.app')

@section('css')
    
@endsection

@section('titulo')
    Cadastros
@endsection

@section('subtitulo')
    Modelos <small>(Formulário)</small> 
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
    
    <form id="meuForm" class="form" role="form" action="{{ route('modelos.store') }}" enctype="multipart/form-data" method="post">
        {{csrf_field()}} 

        <div class="box-body">
            @include('site.modelos._form')                   
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
                    <p>Modelo cadastrado com sucesso!</p>
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

        //Evento ao clicar no botão Ok do modal
        $('#btnModalOk').click(function (e) {
            e.preventDefault();

            var hid = $(".hidModal").val();
            window.location = hid;
        });

         //Evento ao clicar no botão salvar
         $('#btnSalvar').click(function (e) {
            e.preventDefault();

            let nome = document.getElementById("nome").value;           
            let fabricante_id = document.getElementById("fabricante_id").value;
            let tipo_id = document.getElementById("tipo_id").value;
            let imagem = document.getElementById("imagem").files[0];
            let data = new FormData();
            let settings = { headers: { 'content-type': 'multipart/form-data' } }
           
            data.append('nome', nome);
            data.append('fabricante_id', fabricante_id);
            data.append('tipo_id', tipo_id);
            data.append('imagem', imagem, imagem.name);

            axios.post("{{ route('modelos.store') }}", data, settings)
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
            }).catch(error => {
                console.log(error)
            })


            /*axios({
                method: "post", // verbo http
                url: "{{ route('modelos.store') }}", // url
                headers: { 'content-type': 'multipart/form-data' },
                data: {  
                    _token: $("input[type=hidden][name=_token]").val(),
                    nome: $("input[type=text][name=nome]").val(),
                    fabricante_id: $("select[name=fabricante_id]").val(),      
                    tipo_id: $("select[name=tipo_id]").val(),                         
                    imagem: $("input[type=file][name=imagem]").prop('files')[0];                      
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
            })*/

         });

    </script>
    
@endsection
