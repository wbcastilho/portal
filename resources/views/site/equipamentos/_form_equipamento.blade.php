<div class="row">
    <div class="form-group col-md-5 col-sm-5 col-xs-12 {{ $errors->has('fabricante_id') ? 'has-error' : ''}}">
        <label for="fabricante_id">Fabricante</label>        
        <select {{ Request::segment(4) == 'edit' || Request::segment(3) == 'movimentar' ? "disabled" : "" }} id="fabricante_id" name="fabricante_id" class="form-control">
            @foreach($fabricantes as $fabricante)
            <option {{ (isset($equipamento->modelo->fabricante->id) && $equipamento->modelo->fabricante->id ==  $fabricante->id) || old('fabricante_id') ==  $fabricante->id ? 'selected' : '' }} value="{{$fabricante->id}}">{{$fabricante->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-5 col-sm-5 col-xs-12 {{ $errors->has('tipo_id') ? 'has-error' : ''}}">
        <label for="tipo_id">Tipo</label>        
        <select {{ Request::segment(4) == 'edit' || Request::segment(3) == 'movimentar' ? "disabled" : "" }} id="tipo_id" name="tipo_id" class="form-control">
            @foreach($tipos as $tipo)
            <option {{ (isset($equipamento->modelo->tipo->id) && $equipamento->modelo->tipo->id ==  $tipo->id) || old('tipo_id') ==  $tipo->id ? 'selected' : '' }} value="{{$tipo->id}}">{{$tipo->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-5 col-sm-5 col-xs-12 {{ $errors->has('modelo_id') ? 'has-error' : ''}}">
        <label for="modelo_id">Modelo</label>        
        <select {{ Request::segment(4) == 'edit' || Request::segment(3) == 'movimentar' ? "disabled" : "" }} id="modelo_id" name="modelo_id" class="form-control">            
            @if (Request::segment(2) == 'create')
                <option value="0"></option>
            @else
                @foreach($modelos as $modelo)                                             
                    <option {{ (isset($equipamento->modelo->id) && $equipamento->modelo->id ==  $modelo->id) || old('modelo_id') ==  $modelo->id ? 'selected' : '' }} value="{{$modelo->id}}">{{$modelo->nome}}</option>
                @endforeach
            @endif           
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-5 col-sm-5 col-xs-12 {{ $errors->has('setor_id') ? 'has-error' : ''}}">
        <label for="setor_id">Setor</label>        
        <select {{ Request::segment(3) == 'movimentar' ? "disabled" : "" }} id="setor_id" name="setor_id" class="form-control">
            @foreach($setores as $setor)
                <option {{ (isset($equipamento->setor->id) && $equipamento->setor->id ==  $setor->id) || old('setor_id') ==  $setor->id ? 'selected' : '' }} value="{{$setor->id}}">{{$setor->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 col-sm-6 col-xs-12 {{ $errors->has('apelido') ? 'has-error' : ''}}">
        <label for="apelido">Apelido</label>
        <input {{ Request::segment(3) == 'movimentar' ? "disabled" : "" }} type="text" name="apelido" class="form-control" value="{{ isset($equipamento->apelido) ? $equipamento->apelido : '' }}{{old('apelido')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('numeroserie') ? 'has-error' : ''}}">
        <label for="numeroserie">Número de Série</label>
        <input {{ Request::segment(3) == 'movimentar' ? "disabled" : "" }} type="text" name="numeroserie" class="form-control" value="{{ isset($equipamento->numeroserie) ? $equipamento->numeroserie : '' }}{{old('numeroserie')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12">
        <label for="patrimonio">Patrimônio</label>
        <input {{ Request::segment(3) == 'movimentar' ? "disabled" : "" }} type="text" name="patrimonio" class="form-control" value="{{ isset($equipamento->patrimonio) ? $equipamento->patrimonio : '' }}{{old('patrimonio')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12">
        <label>Descrição</label>
        <textarea {{ Request::segment(3) == 'movimentar' ? "disabled" : "" }} name="descricao" class="form-control" rows="3">{{ isset($equipamento->descricao) ? $equipamento->descricao : '' }}{{old('descricao')}}</textarea>
    </div>
</div>