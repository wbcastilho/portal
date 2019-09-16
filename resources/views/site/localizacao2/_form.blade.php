<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('estado_id') ? 'has-error' : ''}}">
        <label for="estado_id">Estado</label>        
        <select {{ Request::segment(4) == 'edit' ? 'disabled' : '' }} id="estado_id" name="estado_id" class="form-control">
            @foreach($estados as $estado)
            <option {{ (isset($localizacao2->localizacao1->estado->id) && $localizacao2->localizacao1->estado->id ==  $estado->id) ? 'selected' : '' }} value="{{$estado->id}}">{{$estado->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('cidade_id') ? 'has-error' : ''}}">
        <label for="cidade_id">Cidade</label>        
        <select {{ Request::segment(4) == 'edit' ? 'disabled' : '' }} id="cidade_id" name="cidade_id" class="form-control">
            @foreach($cidades as $cidade)
            <option {{ (isset($localizacao2->localizacao1->cidade->id) && $localizacao2->localizacao1->cidade->id ==  $cidade->id) ? 'selected' : '' }} value="{{$cidade->id}}">{{$cidade->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('localizacao1_id') ? 'has-error' : ''}}">
        <label for="localizacao1_id">Localização 1</label>        
        <select {{ Request::segment(4) == 'edit' ? 'disabled' : '' }} id="localizacao1_id" name="localizacao1_id" class="form-control">
            @foreach($localizacoes1 as $localizacao1)
            <option {{ (isset($localizacao2->localizacao1_id) && $localizacao2->localizacao1_id ==  $localizacao1->id) ? 'selected' : '' }} value="{{$localizacao1->id}}">{{$localizacao1->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>
<div>{{auth()->user()->praca->id}}</div>
<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('nome') ? 'has-error' : ''}}">
        <label for="nome">Nome</label>
        <input id="nome" type="text" name="nome" class="form-control" value="{{ isset($localizacao2->nome) ? $localizacao2->nome : '' }}{{old('nome')}}">
    </div>
</div>

