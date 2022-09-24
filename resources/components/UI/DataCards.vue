<template>
    <div class="p-3 customCards d-flex justify-content-center">
        <slot name="body">
        </slot>
    </div>
</template>

<style scoped>
    .customCards{
        background: #673AB7;
        color: white;
        font-size: 2rem;
        border-radius: 16px;
    }
</style>