<template>
    <header>
        <div class="container-fluid orange relative">
            <div class="row ">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    <div class="container">
                        <a class="navbar-brand" href="/">
                            <img class="logo w-75" :src="logo" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-grow-0" id="navbarNavAltMarkup">
                            <ul class="navbar-nav pe-5">
                                <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
                                <li v-for="(item) in menuItems" :key="item.id">
                                    <router-link class="nav-link text-yellow" :to="{ name: item.routeName }">{{ item.label }}</router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>


<script>
export default {
    name: "Header",
    data() {
        return {
            logo: require('../../img/logo-deliveboo.svg'),
            menuItems: [
                {
                    label: 'Home',
                    routeName: 'home',
                },
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

<style lang="scss">
.orange{
    background-color: #CC561E ;
    height: 450px;
    background-image: url('../../img/bg-bike.svg');
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: contain;
}
.relative{
    position: relative;
}
.absolute{
    position: absolute;
    width: 75%;
    top: calc(1vw/10vw) ;
    left: 10px;
}
.absolute-bike{
    position: absolute;
    width: 15%;
    top: 20px;
    right: 150px;
    transform: rotate(10deg);
}
.text-yellow{
    color: #FFF2BD !important;
}
</style>