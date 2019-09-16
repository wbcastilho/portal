<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('estado_id') ? 'has-error' : ''}}">
        <label for="estado_id">Estado</label>        
        <select id="estado_id" name="estado_id" class="form-control">
            @foreach($estados as $estado)
            <option {{ (isset($localizacao1->estado_id) && $localizacao1->estado_id ==  $estado->id) || old('estado_id') ==  $estado->id ? 'selected' : '' }} value="{{$estado->id}}">{{$estado->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('cidade_id') ? 'has-error' : ''}}">
        <label for="cidade_id">Cidade</label>        
        <select id="cidade_id" name="cidade_id" class="form-control">
            @foreach($cidades as $cidade)
            <option {{ (isset($localizacao1->cidade_id) && $localizacao1->cidade_id ==  $cidade->id) || old('cidade_id') ==  $cidade->id ? 'selected' : '' }} value="{{$cidade->id}}">{{$cidade->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('nome') ? 'has-error' : ''}}">
        <label for="nome">Nome</label>
        <input id="nome" type="text" name="nome" class="form-control" value="{{ isset($localizacao1->nome) ? $localizacao1->nome : '' }}{{old('nome')}}">
    </div>
</div>
