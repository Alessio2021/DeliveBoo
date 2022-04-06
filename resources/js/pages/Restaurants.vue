<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-info fw-bold my-4">Categorie Disponibili</h2>
        <CategoryLinks :setActiveCategories="activeCategories" @activeCategories="setActiveCategories" />
      </div>
    </div>
    <div v-if="searchResult == true" class="row mt-5">
      <div class="col-12 fw-bold">
        <h3 class="mb-3">Categoria: <span class="text-danger text-capitalize">{{$route.params.category}}</span></h3>
      </div>
      <router-link :to="{name: 'restaurant', params:{restaurant: restaurant.slug}}" class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 text-info text-decoration-none" v-for="(restaurant, index) in restaurants" :key="'restaurant-' + index">
        <div class="card border-0 h-100 shadow">
          <div class="higlights-image-container">
            <img v-if="restaurant.image" :src="restaurant.image" class="card-img-top" :alt="restaurant.name + 'logo'">
            <img v-else :src="uri + '/img/placeholder/restaurant-placeholder.svg'" class="card-img-top" :alt="restaurant.name + 'logo'">
          </div>
          <div class="card-body">
            <h5 class="card-title text-center text-info">{{restaurant.name}}</h5>
          </div>
        </div>
      </router-link>
    </div>
    <div v-else class="row mt-5">
      <h4 class="font-italic">Nessun Ristorante Trovato</h4>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
import CategoryLinks from "../components/CategoryLinks.vue";

export default {
  name:'Restaurants',
  components: {
    CategoryLinks,
  },
  data() {
    return {
      activeCategories: [],
      searchResult: false,
      restaurants: [],
      uri: '',
    }
  },
  created() {
    this.uri = localHost;
    if (this.$route.params.categories) {
      this.activeCategories = this.$route.params.categories;
    }
    let categoriesParam = '';
    if (this.activeCategories.length !== 0) {
      categoriesParam = this.activeCategories.toString();
    }
    Axios.get(localHost + '/api/category', {
      params: {
        categories: categoriesParam,
      }})
      .then((results) =>{
        this.searchResult = results.data.response;
        this.restaurants = results.data.results;
      }).catch( (error) => {console.log(error)});
  },
  watch: {
    activeCategories(){
      let categoriesParam = '';
    if (this.activeCategories.length !== 0) {
      categoriesParam = this.activeCategories.toString();
    }
    Axios.get(localHost + '/api/category', {
      params: {
        categories: categoriesParam,
      },
      // paramsSerializer: params => {
      //   return qs.stringify(params)
      // }
      })
      .then((results) =>{
        this.searchResult = results.data.response;
        this.restaurants = results.data.results;
        console.log(results);
      }).catch( (error) => {console.log(error)});
    }
  },
  methods: {
    setActiveCategories(value) {
      this.activeCategories = value;
      console.log(this.activeCategories);
    }
  }
  
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