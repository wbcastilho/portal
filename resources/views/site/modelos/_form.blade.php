<div class="row">
    <div class="form-group col-md-6 col-sm-6 col-xs-12 {{ $errors->has('fabricante_id') ? 'has-error' : ''}}">
        <label for="fabricante_id">Fabricante</label>        
        <select id="fabricante_id" name="fabricante_id" class="form-control">                      
            @foreach($fabricantes as $fabricante)
                <option {{ (isset($modelo->fabricante_id) && $modelo->fabricante_id ==  $fabricante->id) || old('fabricante_id') ==  $fabricante->id ? 'selected' : '' }} value="{{$fabricante->id}}">{{$fabricante->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 col-sm-6 col-xs-12 {{ $errors->has('tipo_id') ? 'has-error' : ''}}">
        <label for="tipo_id">Fabricante</label>        
        <select id="tipo_id" name="tipo_id" class="form-control">           
            @foreach($tipos as $tipo)
            <option {{ (isset($modelo->tipo_id) && $modelo->tipo_id ==  $tipo->id) || old('tipo_id') ==  $tipo->id ? 'selected' : '' }} value="{{$tipo->id}}">{{$tipo->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('nome') ? 'has-error' : ''}}">
        <label for="nome">Modelo</label>
        <input type="text" name="nome" class="form-control" value="{{ isset($modelo->nome) ? $modelo->nome : '' }}{{old('nome')}}">
    </div>
</div>

<!--<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12">
        <label for="imagem">Imagem</label>
        <input type="file" name="imagem" id="imagem">       
    </div>
</div>-->