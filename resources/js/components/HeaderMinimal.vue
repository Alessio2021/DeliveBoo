<template>
    <header class="orange-low">
        <div class="container-fluid pt-3">
            <div class="row ">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    
                        <a class="navbar-brand " href="/">
                            <img class="logo-low " :src="logo" alt="">
                        </a>
                        <div id="absolute-button-low">
                            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" >
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                                <ul class="navbar-nav bg-hamburger rounded p-2">
                                    <li v-for="(item) in menuItems" :key="item.id">
                                        <router-link class="nav-link text-yellow fs-4" :to="{ name: item.routeName }">{{ item.label }}</router-link>
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
                    label: 'Ristoranti',
                    routeName: 'restaurants',
                },
                {
                    label: 'Chi Siamo',
                    routeName: 'about',
                },
            ],
            
        }
    }
}
</script>

<style lang="scss">

.orange-low{
    height: 150px;
    background-image: url('../../img/header-low.svg');
    background-repeat: no-repeat;
    background-position: center right;
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
.text-yellow{
    color: #FFF2BD !important;
}
.logo-low{
       width: 100%;
       left: 5%;
    }
#absolute-button-low{
    position: relative;
    // left: 42%;
    // top: 18px;
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
    .logo-low{
       width: 75%;
    }
}
@media screen and (max-width: 450px) {
    .orange-low{
    height: 110px;
    
}
    .logo-low{
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