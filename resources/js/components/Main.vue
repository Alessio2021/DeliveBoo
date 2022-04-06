<template>
<div>
  <div class="container">
    <h2 class="text-info fw-bold my-4">Cerchi qualcosa di preciso? </h2>
    <CategoryLinks/>
  </div>
  <div class="bg-main">
    <div>
      <div class="container">
        <div class="row">
          <div class="col-12 fw-bold">
            <h3 class="text-info fw-bold my-4">I pi&ugrave; venduti:</h3>
          </div>

          <div v-for="(dish, index) in topDishes" :key="index" class="col-6 col-lg-3 mb-3">
              <div class="card h-100 border-0 rounded-0 shadow bg-white">
                <div :id="'carousel-top4-' + index" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div v-for="(image, index) in dish.image_array" :key="'image-' + index" class="carousel-item" :class="(index == 0) ? 'active' : ''" data-bs-interval="5000">
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
                
                <div class="card-body">
                  <h5 class="card-title">{{dish.name}}</h5>
                  <router-link class="d-block text-end text-decoration-none text-info" :to="{name: 'restaurant', params:{restaurant: dish.restaurant_slug}}">{{dish.restaurant_name}}</router-link>
                  
                  
                  
                  
                  
                </div>
              </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="container mt-5">
    <div class="row ">
      <div class="col-12 fw-bold">
        <h3 class="text-info fw-bold my-4">Novità su DeliveBoo</h3>
      </div>
      <router-link :to="{name: 'restaurant', params:{restaurant: restaurant.slug}}" class="col-4 mb-3" v-for="(restaurant, index) in lastRestaurants" :key="'lastrestaurant-' + index">
        <div class="card border-0 h-100 shadow">
          <div class="higlights-image-container-restaurant">
            <img v-if="restaurant.img" :src="restaurant.img" class="card-img-top" :alt="restaurant.name + 'logo'">
            <img v-else :src="uri + '/img/placeholder/restaurant-placeholder.svg'" class="card-img-top" :alt="restaurant.name + 'logo'">
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">{{restaurant.name}}</h5>
          </div>
        </div>
      </router-link>
    </div>
  </div>
</div>
</template>


<script>
import Axios from "axios";
import CategoryLinks from "./CategoryLinks.vue";

export default {
    name: "Main",
    components: {
      CategoryLinks,
    },
    data() {
      return {
        uri: '',
        topDishes: [],
        lastRestaurants: [],
      }
    },
    created() {
      this.uri = localHost;
    Axios.get(localHost + '/api/top-sales')
      .then((results) =>{
        this.topDishes = results.data.results;
      }).catch( (error) => {console.log(error)});
    
    Axios.get(localHost + '/api/last-users')
      .then((results) =>{
        this.lastRestaurants = results.data.results;
      }).catch( (error) => {console.log(error)});
    },
}
</script>

<style lang="scss" scoped>
@import '~@sass/_variables.scss';

.higlights-image-container {
  max-height:180px;
   height:10vw; 
   overflow:hidden;
   position: relative;
   background-color: black;
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

.higlights-image-container-restaurant {
  max-height:200px;
   height:22vw; 
   overflow:hidden;
   position: relative;
   & img{
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
   }
}

.bg-main{
  &>div:first-child {
    background-color: $success;
  }
  &::before {
    content:'';
    width: 100%;
    height: 10vh;
    background-image: url('../../img/bg-main.svg');
    background-size: 100%;
    background-repeat: no-repeat;
    display: block;
    margin: 0;
  }
  &::after {
    content:'';
    width: 100%;
    height: 10vh;
    background-image: url('../../img/bg-main.svg');
    background-size: 100%;
    background-repeat: no-repeat;
    transform: rotate(180deg);
    display: block;
    margin: 0;
  }
}
</style>