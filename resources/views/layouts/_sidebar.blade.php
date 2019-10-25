<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height:auto;">  
        <div style="height: 40px;" class="user-panel">         
            <div class="pull-left info">
              <p>{{ auth()->user()->praca->nome }}</p>
             
            </div>
        </div>                
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
         
        <li class="header">MENU PRINCIPAL</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        
        @can('cadastro-view')
          <li class="treeview {{ Request::segment(1) == 'usuarios' || Request::segment(2) == 'usuarios' || Request::segment(1) == 'setores' || Request::segment(2) == 'setores' || Request::segment(1) == 'fabricantes' || Request::segment(2) == 'fabricantes' || Request::segment(1) == 'tipos' || Request::segment(2) == 'tipos' || Request::segment(1) == 'modelos' || Request::segment(2) == 'modelos' || Request::segment(1) == 'permissoes' || Request::segment(2) == 'permissoes' || Request::segment(1) == 'localizacao1' || Request::segment(2) == 'localizacao1' || Request::segment(1) == 'localizacao2' || Request::segment(2) == 'localizacao2' || Request::segment(1) == 'localizacao3' || Request::segment(2) == 'localizacao3' || Request::segment(1) == 'localizacao4' || Request::segment(2) == 'localizacao4' ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-pencil-square-o"></i> <span>Cadastros</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              @can('usuario-view')          
                <li class="{{ Request::segment(1) == 'usuarios' || Request::segment(2) == 'usuarios' ? 'active' : ''}}"><a href="{{route('usuarios.index')}}"><i class="fa fa-circle-o"></i> Usuários</a></li>
              @endcan
              @can('permissao-view')
                <li class="{{ Request::segment(1) == 'permissoes' || Request::segment(2) == 'permissoes' ? 'active' : ''}}"><a href="{{route('permissoes.index')}}"><i class="fa fa-circle-o"></i> Permissões</a></li>                                  
              @endcan
              @can('setor-view')
                <li class="{{ Request::segment(1) == 'setores' || Request::segment(2) == 'setores' ? 'active' : ''}}"><a href="{{route('setores.index')}}"><i class="fa fa-circle-o"></i> Setores</a></li>           
              @endcan
              @can('fabricante-view')
                <li class="{{ Request::segment(1) == 'fabricantes' || Request::segment(2) == 'fabricantes' ? 'active' : ''}}"><a href="{{route('fabricantes.index')}}"><i class="fa fa-circle-o"></i> Fabricantes</a></li>
              @endcan
              @can('tipo-view')
                <li class="{{ Request::segment(1) == 'tipos' || Request::segment(2) == 'tipos' ? 'active' : ''}}"><a href="{{route('tipos.index')}}"><i class="fa fa-circle-o"></i> Tipos</a></li>
              @endcan
              @can('modelo-view')
                <li class="{{ Request::segment(1) == 'modelos' || Request::segment(2) == 'modelos' ? 'active' : ''}}"><a href="{{route('modelos.index')}}"><i class="fa fa-circle-o"></i> Modelos</a></li>
              @endcan
              @can('localizacao-view')
                <li class="treeview {{ Request::segment(1) == 'localizacao1' || Request::segment(2) == 'localizacao1' || Request::segment(1) == 'localizacao2' || Request::segment(2) == 'localizacao2' || Request::segment(1) == 'localizacao3' || Request::segment(2) == 'localizacao3' || Request::segment(1) == 'localizacao4' || Request::segment(2) == 'localizacao4' ? 'active' : ''}}" style="height: auto;">
                  <a href="#"><i class="fa fa-circle-o"></i> Localizações
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">                 
                    <li class="{{ Request::segment(1) == 'localizacao1' || Request::segment(2) == 'localizacao1' ? 'active' : ''}}"><a href="{{route('localizacao1.index')}}"><i class="fa fa-circle-o"></i> Localização 1</a></li>                              
                    <li class="{{ Request::segment(1) == 'localizacao2' || Request::segment(2) == 'localizacao2' ? 'active' : ''}}"><a href="{{route('localizacao2.index')}}"><i class="fa fa-circle-o"></i> Localização 2</a></li>                              
                    <li class="{{ Request::segment(1) == 'localizacao3' || Request::segment(2) == 'localizacao3' ? 'active' : ''}}"><a href="{{route('localizacao3.index')}}"><i class="fa fa-circle-o"></i> Localização 3</a></li>                                
                    <li class="{{ Request::segment(1) == 'localizacao4' || Request::segment(2) == 'localizacao4' ? 'active' : ''}}"><a href="{{route('localizacao4.index')}}"><i class="fa fa-circle-o"></i> Localização 4</a></li>                                 
                  </ul>
                </li>
              @endcan
            </ul>
          </li>
        @endcan

        <li>
          <a href="#">
            <i class="fa fa-phone"></i>
            <span>Contatos</span>            
          </a>         
        </li> 
        <li class="{{ Request::segment(1) == 'equipamentos' || Request::segment(2) == 'equipamentos' ? 'active' : '' }}">
          <a href="{{route('equipamentos.index')}}">
            <i class="fa fa-laptop"></i>
            <span>Equipamentos</span>            
          </a>         
        </li>  
        <li>
          <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span>Relatórios</span>            
          </a>         
        </li> 
        <li>
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Logs</span>            
          </a>         
        </li>                                              
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>