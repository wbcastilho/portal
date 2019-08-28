<template>    
   <section class="content">                                  
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"> {{ subtitulo }} </h3>    
                <div class="box-tools pull-right">
                {{ voltar }}
                </div>
            </div>
            <div class="box-body">                    
               <slot></slot>
            </div>                
            <!--<div class="box-footer">
                Footer
            </div>-->
        </div>
    </section>
</template>

<script>
    export default {
         props:['subtitulo', 'voltar']
    }
</script>
