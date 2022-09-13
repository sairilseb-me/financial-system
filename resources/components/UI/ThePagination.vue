<template>
    <div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- <li v-for="link, index in pagination.data.links" :key="index" class="page-item"><button class="page-link" @click="paginatedClick(link.url)">{{ cleanNextPrevious(link.label) }}</button></li> -->
                <slot name="links"></slot>
            </ul>
        </nav>
    </div>
</template>

<script>
import { ref, computed } from 'vue';
export default {
   
}
</script>

<style scoped>
    
</style>