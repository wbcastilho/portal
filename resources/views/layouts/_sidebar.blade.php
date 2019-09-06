<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height:auto;">  
        <div style="height: 40px;" class="user-panel">         
            <div class="pull-left info">
              <p>EPTV Sul de Minas</p>
             
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
        <li class="treeview {{ Request::segment(1) == 'usuarios' || Request::segment(2) == 'usuarios' || Request::segment(1) == 'setores' || Request::segment(2) == 'setores' || Request::segment(1) == 'fabricantes' || Request::segment(2) == 'fabricantes' || Request::segment(1) == 'tipos' || Request::segment(2) == 'tipos' || Request::segment(1) == 'modelos' || Request::segment(2) == 'modelos' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-pencil-square-o"></i> <span>Cadastros</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::segment(1) == 'usuarios' || Request::segment(2) == 'usuarios' ? 'active' : ''}}"><a href="{{route('usuarios.index')}}"><i class="fa fa-circle-o"></i> Usuários</a></li>
            <li class="{{ Request::segment(1) == 'setores' || Request::segment(2) == 'setores' ? 'active' : ''}}"><a href="{{route('setores.index')}}"><i class="fa fa-circle-o"></i> Setores</a></li>
            <li class="{{ Request::segment(1) == 'fabricantes' || Request::segment(2) == 'fabricantes' ? 'active' : ''}}"><a href="{{route('fabricantes.index')}}"><i class="fa fa-circle-o"></i> Fabricantes</a></li>
            <li class="{{ Request::segment(1) == 'tipos' || Request::segment(2) == 'tipos' ? 'active' : ''}}"><a href="{{route('tipos.index')}}"><i class="fa fa-circle-o"></i> Tipos</a></li>
            <li class="{{ Request::segment(1) == 'modelos' || Request::segment(2) == 'modelos' ? 'active' : ''}}"><a href="{{route('modelos.index')}}"><i class="fa fa-circle-o"></i> Modelos</a></li>           
            <li class="treeview" style="height: auto;">
              <a href="#"><i class="fa fa-circle-o"></i> Localizações
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="#"><i class="fa fa-circle-o"></i> Localização 1</a></li>                
                <li><a href="#"><i class="fa fa-circle-o"></i> Localização 2</a></li>                
                <li><a href="#"><i class="fa fa-circle-o"></i> Localização 3</a></li>                
                <li><a href="#"><i class="fa fa-circle-o"></i> Localização 4</a></li>                
              </ul>
            </li>


          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Equipamentos</span>            
          </a>
          <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
        <li>
          <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Hot</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="../UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="../UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="../UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="../UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="../UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>
        </li>              
        <li>
          <a href="{{route('teste')}}">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="{{route('home')}}">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>            
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>