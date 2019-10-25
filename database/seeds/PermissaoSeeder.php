<?php

use Illuminate\Database\Seeder;
use App\Permissao;

class PermissaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cadastro = Permissao::firstOrCreate([
            'nome' =>'cadastro-view',
            'descricao' =>'Acesso ao menu Cadastros'
        ]);

        $usuarios1 = Permissao::firstOrCreate([
            'nome' =>'usuario-view',
            'descricao' =>'Acesso a lista de Usuários'
        ]);
        $usuarios2 = Permissao::firstOrCreate([
            'nome' =>'usuario-create',
            'descricao' =>'Adicionar Usuários'
        ]);
        $usuarios2 = Permissao::firstOrCreate([
            'nome' =>'usuario-edit',
            'descricao' =>'Editar Usuários'
        ]);
        $usuarios3 = Permissao::firstOrCreate([
            'nome' =>'usuario-delete',
            'descricao' =>'Deletar Usuários'
        ]);

        $permissoes1 = Permissao::firstOrCreate([
            'nome' =>'permissao-view',
            'descricao' =>'Acesso a lista de Permissões'
        ]);
        $permissoes2 = Permissao::firstOrCreate([
            'nome' =>'permissao-create',
            'descricao' =>'Adicionar Permissão'
        ]);       
        $permissoes3 = Permissao::firstOrCreate([
            'nome' =>'permissao-delete',
            'descricao' =>'Deletar Permissão'
        ]);

        $setores1 = Permissao::firstOrCreate([
            'nome' =>'setor-view',
            'descricao' =>'Acesso a lista de Setores'
        ]);
        $setores2 = Permissao::firstOrCreate([
            'nome' =>'setor-create',
            'descricao' =>'Adicionar Setores'
        ]);
        $setores3 = Permissao::firstOrCreate([
            'nome' =>'setor-edit',
            'descricao' =>'Editar Setores'
        ]);
        $setores4 = Permissao::firstOrCreate([
            'nome' =>'setor-delete',
            'descricao' =>'Deletar Setores'
        ]);

        $fabricantes1 = Permissao::firstOrCreate([
            'nome' =>'fabricante-view',
            'descricao' =>'Acesso a lista de Fabricantes'
        ]);
        $fabricantes2 = Permissao::firstOrCreate([
            'nome' =>'fabricante-create',
            'descricao' =>'Adicionar Fabricantes'
        ]);
        $fabricantes3 = Permissao::firstOrCreate([
            'nome' =>'fabricante-edit',
            'descricao' =>'Editar Fabricantes'
        ]);
        $fabricantes4 = Permissao::firstOrCreate([
            'nome' =>'fabricante-delete',
            'descricao' =>'Deletar Fabricantes'
        ]);

        $tipos1 = Permissao::firstOrCreate([
            'nome' =>'tipo-view',
            'descricao' =>'Acesso a lista de Tipos'
        ]);
        $tipos2 = Permissao::firstOrCreate([
            'nome' =>'tipo-create',
            'descricao' =>'Adicionar Tipos'
        ]);
        $tipos3 = Permissao::firstOrCreate([
            'nome' =>'tipo-edit',
            'descricao' =>'Editar Tipos'
        ]);
        $tipos4 = Permissao::firstOrCreate([
            'nome' =>'tipo-delete',
            'descricao' =>'Deletar Tipos'
        ]);

        $modelos1 = Permissao::firstOrCreate([
            'nome' =>'modelo-view',
            'descricao' =>'Acesso a lista de Modelos'
        ]);
        $modelos2 = Permissao::firstOrCreate([
            'nome' =>'modelo-create',
            'descricao' =>'Adicionar Modelos'
        ]);
        $modelos3 = Permissao::firstOrCreate([
            'nome' =>'modelo-edit',
            'descricao' =>'Editar Modelos'
        ]);
        $modelos4 = Permissao::firstOrCreate([
            'nome' =>'modelo-delete',
            'descricao' =>'Deletar Modelos'
        ]);

        $localizacoes11 = Permissao::firstOrCreate([
            'nome' =>'localizacao1-view',
            'descricao' =>'Acesso a lista de Localizacoes1'
        ]);
        $localizacoes12 = Permissao::firstOrCreate([
            'nome' =>'localizacao1-create',
            'descricao' =>'Adicionar Localizacoes1'
        ]);
        $localizacoes13 = Permissao::firstOrCreate([
            'nome' =>'localizacao1-edit',
            'descricao' =>'Editar Localizacoes1'
        ]);
        $localizacoes14 = Permissao::firstOrCreate([
            'nome' =>'localizacao1-delete',
            'descricao' =>'Deletar Localizacoes1'
        ]);

        $localizacoes21 = Permissao::firstOrCreate([
            'nome' =>'localizacao2-view',
            'descricao' =>'Acesso a lista de Localizacoes2'
        ]);
        $localizacoes22 = Permissao::firstOrCreate([
            'nome' =>'localizacao2-create',
            'descricao' =>'Adicionar Localizacoes2'
        ]);
        $localizacoes23 = Permissao::firstOrCreate([
            'nome' =>'localizacao2-edit',
            'descricao' =>'Editar Localizacoes2'
        ]);
        $localizacoes24 = Permissao::firstOrCreate([
            'nome' =>'localizacao2-delete',
            'descricao' =>'Deletar Localizacoes2'
        ]);

        $localizacoes31 = Permissao::firstOrCreate([
            'nome' =>'localizacao3-view',
            'descricao' =>'Acesso a lista de Localizacoes3'
        ]);
        $localizacoes32 = Permissao::firstOrCreate([
            'nome' =>'localizacao3-create',
            'descricao' =>'Adicionar Localizacoes3'
        ]);
        $localizacoes33 = Permissao::firstOrCreate([
            'nome' =>'localizacao3-edit',
            'descricao' =>'Editar Localizacoes3'
        ]);
        $localizacoes34 = Permissao::firstOrCreate([
            'nome' =>'localizacao3-delete',
            'descricao' =>'Deletar Localizacoes3'
        ]);

        $localizacoes41 = Permissao::firstOrCreate([
            'nome' =>'localizacao4-view',
            'descricao' =>'Acesso a lista de Localizacoes4'
        ]);
        $localizacoes42 = Permissao::firstOrCreate([
            'nome' =>'localizacao4-create',
            'descricao' =>'Adicionar Localizacoes4'
        ]);
        $localizacoes43 = Permissao::firstOrCreate([
            'nome' =>'localizacao4-edit',
            'descricao' =>'Editar Localizacoes4'
        ]);
        $localizacoes44 = Permissao::firstOrCreate([
            'nome' =>'localizacao4-delete',
            'descricao' =>'Deletar Localizacoes4'
        ]);


        echo "Registros de Permissoes criados no sistema";
    }
}
