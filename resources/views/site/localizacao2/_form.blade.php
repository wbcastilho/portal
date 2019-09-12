<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('localizacao1_id') ? 'has-error' : ''}}">
        <label for="localizacao1_id">Localização 1</label>        
        <select id="localizacao1_id" name="localizacao1_id" class="form-control">
            @foreach($localizacoes1 as $localizacao1)
            <option {{ (isset($localizacao2->localizacao1_id) && $localizacao2->localizacao1_id ==  $localizacao1->id) || old('localizacao1_id') ==  $localizacao1->id ? 'selected' : '' }} value="{{$localizacao1->id}}">{{$localizacao1->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('nome') ? 'has-error' : ''}}">
        <label for="nome">Nome</label>
        <input id="nome" type="text" name="nome" class="form-control" value="{{ isset($localizacao2->nome) ? $localizacao2->nome : '' }}{{old('nome')}}">
    </div>
</div>

