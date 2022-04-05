<template>
<div class="body">
    <!-- <component :is="component"/> -->
    <Header v-if="$route.name == 'home'"/>
    <HeaderMinimal v-else/>
    <router-view></router-view>
    <Footer/>
</div>
</template>

<script>
import HeaderMinimal from '../components/HeaderMinimal.vue';
import Header from '../components/Header.vue';
import Main from '../components/Main.vue';
import Footer from '../components/Footer.vue';


export default {
    name: "App",
    components: {
        HeaderMinimal,
        Header,
        Main,
        Footer,
    },

}
</script>

<style lang="scss">
@import '~@sass/_variables.scss';
@import '~bootstrap';

.body {
    background-color: rgba($color: $success, $alpha: 0.4);
}
</style>