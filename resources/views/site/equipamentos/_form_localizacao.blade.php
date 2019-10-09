<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('estado_id') ? 'has-error' : ''}}">
        <label for="estado_id">Estado</label>        
        <select id="estado_id" name="estado_id" class="form-control">
            @foreach($estados as $estado)
                <option {{ old('estado_id') ==  $estado->id ? 'selected' : '' }} value="{{$estado->id}}">{{$estado->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('cidade_id') ? 'has-error' : ''}}">
        <label for="cidade_id">Cidade</label>        
        <select id="cidade_id" name="cidade_id" class="form-control">           
            <option value="0"></option>           
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('localizacao1_id') ? 'has-error' : ''}}">
        <label for="localizacao1_id">Localização 1</label>        
        <select id="localizacao1_id" name="localizacao1_id" class="form-control">
            <option value="0"></option>  
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('localizacao2_id') ? 'has-error' : ''}}">
        <label for="localizacao2_id">Localização 2</label>        
        <select id="localizacao2_id" name="localizacao2_id" class="form-control">
            <option value="0"></option>  
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('localizacao3_id') ? 'has-error' : ''}}">
        <label for="localizacao3_id">Localização 3</label>        
        <select id="localizacao3_id" name="localizacao3_id" class="form-control">
            <option value="0"></option>  
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('localizacao4_id') ? 'has-error' : ''}}">
        <label for="localizacao4_id">Localização 4</label>        
        <select id="localizacao4_id" name="localizacao4_id" class="form-control">
            <option value="0"></option>  
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('observacao') ? 'has-error' : ''}}">
        <label>Observação</label>
        <textarea name="observacao" class="form-control" rows="3">{{old('observacao')}}</textarea>
    </div>
</div>