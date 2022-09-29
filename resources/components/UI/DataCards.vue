<template>

    <div class="customCards">
        <div class="customCardsTitle">
            <slot name="title">

            </slot>
        </div>
        <div class="customCardsBody d-flex justify-content-center">
            <slot name="body">
            </slot>
        </div>
    </div>
    
</template>

<style scoped>
    .customCards{
        background: #673AB7;
        border-radius: 9px;
        color: white;
    }
    .customCardsBody{
        font-size: 2rem;
        padding-bottom: 20px;
        font-weight: 800;
    }

    .customCardsTitle{
       padding: 10px 10px 10px 20px;
       margin: 0;
    }
</style>