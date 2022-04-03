<template>
  <div class="container">
      <div class="row">
        <div class="col-12">
          <CategoryLinks />
        </div>
      </div>
      <div class="row bg-white mb-5 shadow-sm">        
          <div class="col-3">
              <img class="w-100" :src="restaurant.image" :alt="restaurant.name + ' logo'">
          </div>
          <div class="col-9">
            <h2>{{restaurant.name}}</h2>
            <p>{{restaurant.address}}</p>
          </div>
      </div>
      <div class="row mt-5">
        <div class="col-8">
          <div v-for="(dish, index) in dishes" :key="'dish-' + index" class="row p-0 mb-4 bg-white shadow-sm">
            <div  class="col-6 mb-3">
                  <div :id="'carousel-top4-' + index" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                        <div v-for="(image, index) in dish.image" :key="'image-' + index" class="carousel-item" :class="(index == 0) ? 'active' : ''" data-bs-interval="5000">
                          <div class="higlights-image-container">
                          <img  :src="image" class="d-block w-100" :alt="dish.name + ' photo'">
                          </div>
                        </div>
                        <button class="carousel-control-prev d-none d-none" type="button" :data-bs-target="'#carousel-top4-' + index" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next d-none " type="button" :data-bs-target="'#carousel-top4-' + index" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                    </div>
                  
  
            </div>
                  <div class="col-6">
                    <h5>{{dish.name}}</h5>
                    <p class="fst-italic">"{{dish.description}}"</p>
                    <a href="#" class="btn btn-primary text-success" @click="addCart(dish)" >Aggiungi al carrello</a>
                  </div>
          </div>
        </div>

        <div class="col-4">
          CARRELLO
        </div>
      </div>
  </div>
</template>

<script>
import Axios from "axios";
import CategoryLinks from "../components/CategoryLinks.vue";

export default {
name:"Menu",
data() {
  return {
    restaurant: [],
    dishes: [],
  }
},
components: {
  CategoryLinks,
},
created() {
    let routeParam = "";
    if (this.$route.params.restaurant) {
      routeParam = this.$route.params.restaurant;
    }
    Axios.get(localHost + '/api/menu?restaurant=' + routeParam)
      .then((results) =>{
        this.restaurant = results.data.results.restaurant;
        this.dishes = results.data.results.dishes;
        console.log(this.dishes);
        // this.restaurants = results.data.results;
      }).catch( (error) => {console.log(error)});


    // this.$watch(
    //   () => this.$route.params.category,
    //   () => {
    //     let routeParam = "";
    //     if (this.$route.params.category) {
    //       routeParam = this.$route.params.category;
    //     }

    //     Axios.get(localHost + '/api/category?category=' + routeParam)
    //       .then((results) =>{
    //         console.log(results.data.results);
    //         this.restaurants = results.data.results;
    //       }).catch( (error) => {console.log(error)});

    //       console.log(this.$route.params.category);
    //   }
    // )
  },
}
</script>

<style>

</style>