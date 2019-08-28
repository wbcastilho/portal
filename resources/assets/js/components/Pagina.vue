<template>    
    <div class="content-wrapper">        
        <section class="content-header">
            <h1>{{titulo}}</h1>
            <migalhas v-bind:lista="migalhas"></migalhas>                                            
        </section>
       
        <slot></slot>
    </div>
</template>

<script>
    export default {
         props:['titulo','migalhas']
    }
</script>
