<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('nome') ? 'has-error' : ''}}">
        <label for="nome">Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ isset($fabricante->nome) ? $fabricante->nome : '' }}{{old('nome')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12">
        <label for="site">Site</label>
        <input type="text" name="site" class="form-control" value="{{ isset($fabricante->site) ? $fabricante->site : '' }}{{old('site')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12">
        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" class="form-control" value="{{ isset($fabricante->telefone) ? $fabricante->telefone : '' }}{{old('telefone')}}">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" value="{{ isset($fabricante->email) ? $fabricante->email : '' }}{{old('email')}}">
    </div>
</div>