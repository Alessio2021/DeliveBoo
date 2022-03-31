<template>
    <header>
        <div class="container-fluid">
            <div class="row ">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/">
                            <img class="logo w-75" :src="logo" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <ul class="navbar-nav">
                                <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
                                <li v-for="(item) in menuItems" :key="item.id">
                                    <router-link class="nav-link" :to="{ name: item.routeName }">{{ item.label }}</router-link>
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

<style>
    /* .logo */
</style>