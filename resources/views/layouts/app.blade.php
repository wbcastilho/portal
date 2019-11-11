<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">  
        @yield('css')     
    </head>
    <body class="hold-transition skin-blue fixed">       
        <div class="wrapper">
        
          <!-- TOPO Navegação -->
          @include('layouts._nave')  
      
          <!-- MENU lateral -->
          @include('layouts._sidebar') 
          
          <div class="content-wrapper">        
            <section class="content-header">
                <h1>@Yield('titulo')</h1>
                @yield('breadcrumb')                                          
            </section>
           
            <section class="content">                                  
              <div class="box">
                  <div class="box-header with-border">
                      <h3 class="box-title">  @Yield('subtitulo')  </h3>    
                      <div class="box-tools pull-right">
                        @yield('voltar') 
                      </div>
                  </div>
                  <div class="box-body">                    
                    @Yield('content') 
                  </div>                
                  <!--<div class="box-footer">
                      Footer
                  </div>-->
              </div>
          </section>
        </div>      
      </div>            
    
      <script src="{{asset('js/app.js')}}"></script>  
       
      <script>
        $(document).ready(function () {
          $('.sidebar-menu').tree()
        })
      </script>
     
      @yield('js')   

    </body>
</html>
