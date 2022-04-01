<template>
<div>
    <Header/>
    <router-view></router-view>
    <Footer/>
</div>
</template>

<script>
import Header from '../components/Header.vue';
import Main from '../components/Main.vue';
import Footer from '../components/Footer.vue';



export default {
    name: "App",
    components: {
        Header,
        Main,
        Footer,
        
    }
}
</script>

<style lang="scss">
    @import '~@sass/_variables.scss';
    @import '~bootstrap';
</style>