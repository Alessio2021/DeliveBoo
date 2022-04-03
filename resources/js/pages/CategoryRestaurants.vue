<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-info fw-bold my-4">Categorie Disponibili</h2>
        <CategoryLinks />
      </div>
    </div>
    <div v-if="searchResult == true" class="row mt-5">
      <div class="col-12 fw-bold">
        <h3 class="mb-3">Categoria: <span class="text-danger text-capitalize">{{$route.params.category}}</span></h3>
      </div>
      <router-link :to="{name: 'restaurant', params:{restaurant: restaurant.slug}}" class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 text-info text-decoration-none" v-for="(restaurant, index) in restaurants" :key="'restaurant-' + index">
        <div class="card border-0 h-100 shadow">
          <div class="higlights-image-container">
            <img :src="restaurant.image" class="card-img-top" :alt="restaurant.name + 'logo'">
          </div>
          <div class="card-body">
            <h5 class="card-title text-center text-info">{{restaurant.name}}</h5>
          </div>
        </div>
      </router-link>
    </div>
    <div v-else class="row mt-5">
      <h4 class="font-italic">Categoria non trovata</h4>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
import CategoryLinks from "../components/CategoryLinks.vue";

export default {
  name:'CategoryRestaurants',
  components: {
    CategoryLinks,
  },
  data() {
    return {
      searchResult: false,
      restaurants: [],
    }
  },
  created() {
    let routeParam = "";
    if (this.$route.params.category) {
      routeParam = this.$route.params.category;
    }

    Axios.get(localHost + '/api/category?category=' + routeParam)
      .then((results) =>{
        this.searchResult = results.data.response;
        this.restaurants = results.data.results;
      }).catch( (error) => {console.log(error)});

    this.$watch(
      () => this.$route.params.category,
      () => {
        let routeParam = "";
        if (this.$route.params.category) {
          routeParam = this.$route.params.category;
        }

        Axios.get(localHost + '/api/category?category=' + routeParam)
          .then((results) =>{
            this.searchResult = results.data.response;
            this.restaurants = results.data.results;
          }).catch( (error) => {console.log(error)});
      }
    )
  },
  
}
</script>

<style lang="scss" scoped>
@import '~@sass/_variables.scss';

.higlights-image-container {
  max-height:200px;
   height:15vw; 
   overflow:hidden;
   position: relative;
   & img{
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
   }
}


@media screen and(max-width: 991px) {
  .higlights-image-container {
   height:20vw; 
  
  }
}
</style>