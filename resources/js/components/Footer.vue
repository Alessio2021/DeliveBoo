<template>
    <footer>
        <div class="container-fluid orange-footer py-5">
            <div class="row ">
                <div class="col-5 ">
                    <a class="navbar-brand" href="/">
                        <img class="logo w-75" :src="logo" alt="">
                    </a>
                </div>
                <div class="col-5">
                    <ul class="navbar-nav">
                        <li v-for="(item) in menuFooter" :key="item.id">
                            <router-link class="nav-link text-yellow" :to="{ name: item.routeName }">{{ item.label }}</router-link>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </footer>
</template>


<script>
export default {
    name: "Footer",
    data() {
        return {
            logo: require('../../img/logo-deliveboo.svg'),
            menuFooter: [
                {
                    label: 'Chi Siamo',
                    routeName: 'about',
                },
                {
                    label: 'Ristoranti',
                    routeName: 'restaurant',
                },
            ],
            
        }
    }
}
</script>

<style>
.orange-footer{
    background-color: #CC561E ;
    height: 250px;
    background-image: url('../../img/bg-footer.svg');
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: 100%;
}
</style>