<template>
    <header>
        <div class="container-fluid orange-low relative pt-3">
            <div class="row ">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    <div class="container position-relative">
                        <a class="navbar-brand" href="/">
                            <img class="logo " :src="logo" alt="">
                        </a>
                        <div id="absolute-button">
                            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" >
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <ul class="navbar-nav bg-red">
                                    <li v-for="(item) in menuItems" :key="item.id">
                                        <router-link class="nav-link text-yellow fs-4" :to="{ name: item.routeName }">{{ item.label }}</router-link>
                                    </li>
                                    <li><i class="pt-3 fs-4 fa-solid fa-cart-shopping text-yellow"></i></li>
                                </ul>
                        </div>
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
                // {
                //     label: 'Ristoranti',
                //     routeName: 'restaurant',
                // },
            ],
            
        }
    }
}
</script>

<style lang="scss">
.orange-low{
    // background-color: #CC561E ;
    height: 200px;
    background-image: url('../../img/header-low.svg');
    // background-position: bottom;
    background-repeat: no-repeat;
    background-size: 100%;
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
    // transform: translateX(-50%);
    position: absolute;
    left: 30%;
}
@media screen and (max-width: 1200px) {
    #absolute-button{
    left: 35%;
}
}
@media screen and (max-width: 992px) {
    #absolute-button    {
        top: 60px;
        left: inherit;
        right: 35px;
        & ul{
            background-color: #CC561E;
            font-size: 12px;
            & a{
                padding: 5px 10px;
            }
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
</style>