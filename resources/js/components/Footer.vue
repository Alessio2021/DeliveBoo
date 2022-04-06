<template>
    <footer class="">
        <div class="container-fluid orange-footer py-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-4 text-center ">
                    <a class="navbar-brand" href="/">
                        <img class="logo w-75" :src="logo" alt="">
                    </a>
                </div>
                <div class="col-4 text-center">
                    <ul class="navbar-nav d-flex flex-row flex-wrap">
                        <li v-for="(category, index) in categories" :key="index" class="col-4 text-start" >
                            <router-link class=" my-2 text-capitalize text-success text-decoration-none" :to="{name: 'restaurants', params: {categories: [category.name]}}" >
                                {{category.name}}
                            </router-link>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>
    </footer>
</template>


<script>
import Axios from "axios";

export default {
    name: "Footer",
    data() {
        return {
            logo: require('../../img/logo-deliveboo.svg'),  
            categories: [],          
        }
    },
    created() {
    
    Axios.get(localHost + '/api/categories').then(
    (results) =>{
        this.categories = results.data.results;
    });
    this.activeCategories = this.setActiveCategories;
  },
}
</script>

<style>
.orange-footer{
    background-color: #CC561E ;
    height: 200px;
    background-image: url('../../img/bg-footer.svg');
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: 100%;
}
</style>