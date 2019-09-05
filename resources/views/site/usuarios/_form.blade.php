<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name">Nome</label>
        <input id="name" type="text" name="name" class="form-control" value="{{ isset($usuario->name) ? $usuario->name : '' }}{{old('name')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('email') ? 'has-error' : ''}}">
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" class="form-control" value="{{ isset($usuario->email) ? $usuario->email : '' }}{{old('email')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('nivel_id') ? 'has-error' : ''}}">
        <label for="nivel_id">Nível</label>        
        <select id="nivel_id" name="nivel_id" class="form-control">
            @foreach($niveis as $nivel)
            <option {{ (isset($usuario->nivel_id) && $usuario->nivel_id ==  $nivel->id) || old('nivel_id') ==  $nivel->id ? 'selected' : '' }} value="{{$nivel->id}}">{{$nivel->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-3 col-sm-3 col-xs-12 {{ $errors->has('password') ? 'has-error' : ''}}">
        <label for="password">Senha</label>
        <input id="password" type="password" name="password" class="form-control" value="">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-3 col-sm-3 col-xs-12 {{ $errors->has('password-confirm') ? 'has-error' : ''}}">
        <label for="password-confirm">Confirma Senha</label>
        <input id="password-confirm" type="password" name="password_confirmation" class="form-control" value="">
    </div>
</div>