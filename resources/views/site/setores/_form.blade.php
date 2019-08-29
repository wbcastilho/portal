<div class="row">
    <div class="form-group col-md-8 col-sm-8 col-xs-12 {{ $errors->has('nome') ? 'has-error' : ''}}">
        <label for="nome">Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ isset($setor->nome) ? $setor->nome : '' }}{{old('nome')}}">
    </div>
</div>