<template>
<div class="body">
    <Header/>
    <router-view></router-view>
    <Footer/>
</div>
</template>

<script>
import Axios from "axios";

import Header from '../components/Header.vue';
import Main from '../components/Main.vue';
import Footer from '../components/Footer.vue';

export default {
    name: "App",
    components: {
        Header,
        Main,
        Footer,
        
    },
created() {
    Axios.get(localHost + '/api/orders/generate')
        .then((results) =>{
            console.log(results)
        }).catch( (error) => {console.log(error)});
}
}
</script>

<style lang="scss">
@import '~@sass/_variables.scss';
@import '~bootstrap';

.body {
  background-color: rgba($color: $success, $alpha: 0.4);
}
</style>