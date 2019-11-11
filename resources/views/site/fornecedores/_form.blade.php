<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('nome') ? 'has-error' : ''}}">
        <label for="nome">Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ isset($fornecedor->nome) ? $fornecedor->nome : '' }}{{old('nome')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12">
        <label for="ie">IE</label>
        <input type="text" name="ie" class="form-control" value="{{ isset($fornecedor->ie) ? $fornecedor->ie : '' }}{{old('ie')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('cnpj') ? 'has-error' : ''}}">
        <label for="ie">CNPJ</label>
        <input type="text" name="cnpj" class="form-control" value="{{ isset($fornecedor->cnpj) ? $fornecedor->cnpj : '' }}{{old('cnpj')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('estado_id') ? 'has-error' : ''}}">
        <label for="estado_id">Estado</label>        
        <select id="estado_id" name="estado_id" class="form-control">
            @foreach($estados as $estado)
            <option {{ (isset($fornecedor->estado_id) && $fornecedor->estado_id ==  $estado->id) || old('estado_id') ==  $estado->id ? 'selected' : '' }} value="{{$estado->id}}">{{$estado->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('cidade_id') ? 'has-error' : ''}}">
        <label for="cidade_id">Cidade</label>        
        <select id="cidade_id" name="cidade_id" class="form-control">
            @foreach($cidades as $cidade)
            <option {{ (isset($fornecedor->cidade_id) && $fornecedor->cidade_id ==  $cidade->id) || old('cidade_id') ==  $cidade->id ? 'selected' : '' }} value="{{$cidade->id}}">{{$cidade->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12">
        <label for="endereco">Endereço</label>
        <input type="text" name="endereco" class="form-control" value="{{ isset($fornecedor->endereco) ? $fornecedor->endereco : '' }}{{old('endereco')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-2 col-sm-2 col-xs-12">
        <label for="numero">Nº</label>
        <input type="text" name="numero" class="form-control" value="{{ isset($fornecedor->numero) ? $fornecedor->endereco : '' }}{{old('endereco')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6 col-sm-6 col-xs-12">
        <label for="bairro">Bairro</label>
        <input type="text" name="bairro" class="form-control" value="{{ isset($fornecedor->bairro) ? $fornecedor->bairro : '' }}{{old('bairro')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12">
        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" class="form-control" value="{{ isset($fornecedor->telefone) ? $fornecedor->telefone : '' }}{{old('telefone')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12">
        <label for="celular">Celular</label>
        <input type="text" name="celular" class="form-control" value="{{ isset($fornecedor->celular) ? $fornecedor->celular : '' }}{{old('celular')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" value="{{ isset($fornecedor->email) ? $fornecedor->email : '' }}{{old('email')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control" rows="3">{{ isset($fornecedor->descricao) ? $fornecedor->descricao : '' }}{{old('descricao')}}</textarea>
    </div>
</div>