<template>
    <header class="orange">
        <div class="container-fluid  pt-3">
            <div class="row ">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    
                        <a class="navbar-brand" href="/">
                            <img class="logo " :src="logo" alt="">
                        </a>
                        <div id="absolute-button">
                            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" >
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <ul class="navbar-nav bg-hamburger rounded p-2">
                                    <li v-for="(item) in menuItems" :key="item.id">
                                        <router-link class="nav-link text-yellow fs-4" :to="{ name: item.routeName }">{{ item.label }}</router-link>
                                    </li>
                                </ul>
                        </div>
                        </div>
                    
                </nav>
            </div>
            <div class="row d-none d-lg-flex align-items-end">
                <div class="col-5 offset-2 text-light">
                    <h1 style="font-size: 80px; font-weight: 600; color: #FFF2BD; margin-bottom: 20px"><span style="font-size: 40px; font-weight: 300">Ordina con</span> <br> DeliveBoo</h1>
                    
                </div>
                <div class="col-5 ">
                   <img class="w-50" :src="localHost + '/img/img-header-deliveboo.png'" alt="">
                </div>
            </div>
        </div>
    </header>
</template>


<script>
export default {
    name: "Header",
    data() {
        return {
            localHost: '',
            logo: require('../../img/logo-deliveboo.svg'),
            menuItems: [
                {
                    label: 'Home',
                    routeName: 'home',
                },
                {
                    label: 'Ristoranti',
                    routeName: 'restaurants',
                },
                {
                    label: 'Chi Siamo',
                    routeName: 'about',
                },
            ],
            
        }
    },
    created() {
    this.localHost = localHost;
    }
}
</script>

<style lang="scss">
.orange{
    // background-color: #CC561E ;
    // height: 400px;
    background-image: url('../../img/bg-header.svg');
    // background-position: bottom;
    background-repeat: no-repeat;
    background-size: cover;
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
.logo{
       width: 100%;
    }
#absolute-button{
    position: relative;
}

@media screen and (max-width: 992px) {
    .bg-hamburger{
    position: absolute;
    right: 0;
    top: 40px;
    width: 110px;
    background-color: #AA2B1D ; 
    font-size: 12px;
    
            &a{
                padding: 5px 10px;
            }
        }
}
@media screen and (max-width: 600px) {
    .logo{
       width: 75%;
    }
}
@media screen and (max-width: 450px) {
    .logo{
       width: 50%;
    }
}
@media screen and (max-width: 392px) {
    .bg-hamburger{
    right: inherit;
    left: 0;
    top: 40px;
    width: 110px;
}
}
</style>