<template>
    <div class="container-fluid">
        <app-nav-bar></app-nav-bar>
    </div>
</template>

<script>
    import AppNavBar from './AppNavBar.vue'

    export default {
    components: { AppNavBar },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
