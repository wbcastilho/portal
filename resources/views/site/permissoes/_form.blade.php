<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('nivel_id') ? 'has-error' : ''}}">
        <label for="nivel_id">Nível de Usuário</label>        
        <select id="nivel_id" name="nivel_id" class="form-control">
            <option value="0"></option>
            @foreach($niveis as $nivel)                
                <option value="{{$nivel->id}}">{{$nivel->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>

<div class="row">
    <div class="form-group col-md-4 col-sm-4 col-xs-12 {{ $errors->has('permissao_id') ? 'has-error' : ''}}">
        <label for="permissao_id">Permissão</label>        
        <select id="permissao_id" name="permissao_id" class="form-control">
            <option value="0"></option>
            @foreach($permissoes as $permissao)               
                <option value="{{$permissao->id}}">{{$permissao->nome}}</option>
            @endforeach
        </select>       
    </div>
</div>