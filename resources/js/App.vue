<template>
    <div>
        <navbar :app="this"></navbar>
        <router-view :app="this"/>
        

    </div>
</template>
<script>
import Navbar from './components/Navbar.vue';

export default {
    name: 'app',
    components: {
        Navbar
    },
    data() {
        return {
            user: null,
            req: axios.create({
                baseUrl: BASE_URL
            })
        }
    },
    methods: {
        
    }
}
</script>
<style >
    
</style>