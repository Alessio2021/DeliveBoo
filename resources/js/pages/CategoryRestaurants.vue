<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="text-info fw-bold my-4">Categorie Disponibili</h2>
        <CategoryLinks />
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-12 fw-bold">
        <h3 class="mb-3">Categoria: <span class="text-danger text-capitalize">{{$route.params.category}}</span></h3>
      </div>
      <div class="col-12 col-md-4 col-lg-3 mb-3" v-for="(restaurant, index) in restaurants" :key="'lastrestaurant-' + index">
        <div class="card border-info h-100 rounded-0">
          <div class="higlights-image-container-restaurant">
            <img :src="restaurant.image" class="card-img-top" :alt="restaurant.name + 'logo'">
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">{{restaurant.name}}</h5>
            <h6 class="card-title text-center">{{restaurant.email}}</h6>
          </div>
        </div>
      </div>
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
        console.log(results.data.results);
        this.restaurants = results.data.results;
      }).catch( (error) => {console.log(error)});

      console.log(this.$route.params.category);

    this.$watch(
      () => this.$route.params.category,
      () => {
        let routeParam = "";
        if (this.$route.params.category) {
          routeParam = this.$route.params.category;
        }

        Axios.get(localHost + '/api/category?category=' + routeParam)
          .then((results) =>{
            console.log(results.data.results);
            this.restaurants = results.data.results;
          }).catch( (error) => {console.log(error)});

          console.log(this.$route.params.category);
      }
    )
  },
  
}
</script>

<style>

</style>