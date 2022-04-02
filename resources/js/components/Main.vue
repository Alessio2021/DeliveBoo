<template>
<div>
  <div>
  <h2>carrello</h2>
  <h4>Nel Carrello [{{cartCounter}}]</h4>
    
  <button @click="resetCart()">svuota carrello</button>
  <div v-for="(item, index) in cart2" :key="index" class="cart"> 
    {{item.name}}
  </div>
  </div>
  <div class="container">
    <h2 class="text-info fw-bold my-4">Cerchi qualcosa di preciso? </h2>
    <CategoryLinks />
  </div>
  <div class="container bg-main">
    <div class="row mt-5 ">
      <div class="col-12 fw-bold">
        <h3 class="text-info fw-bold my-4">I pi&ugrave; venduti:</h3>
      </div>
      <div v-for="(dish, index) in topDishes" :key="index" class="col-6 col-lg-3 mb-3">
          <div class="card h-100 border-primary rounded-0">
            <div :id="'carousel-top4-' + index" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div v-for="(image, index) in dish.image_array" :key="'image-' + index" class="carousel-item" :class="(index == 0) ? 'active' : ''" data-bs-interval="5000">
                    <div class="higlights-image-container">
                    <img  :src="image" class="d-block w-100" :alt="dish.name">
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
            <!-- <img :src="dish.image_array[0]" class="card-img-top w-100" alt=""> -->
            <div class="card-body">
              <h5 class="card-title">{{dish.name}}</h5>
              <h6>{{dish.restaurant_name}}</h6>
              <a href="#" class="btn btn-primary" @click="addCart(dish)" >aggiungi al carrello</a>
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
      <div class="col-4 mb-3" v-for="(restaurant, index) in lastRestaurants" :key="'lastrestaurant-' + index">
        <div class="card border-info h-100 rounded-0">
          <div class="higlights-image-container-restaurant">
            <img :src="restaurant.img" class="card-img-top" :alt="restaurant.name + 'logo'">
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">{{restaurant.name}}</h5>
          </div>
        </div>
      </div>
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
        cart: [],
        cartCounter: 0,
        topDishes: [],
        lastRestaurants: [],
        storage: [],
        cart2: [],
        try: null
      }
    },
    created() {
    Axios.get(localHost + '/api/top-sales')
      .then((results) =>{
        this.topDishes = results.data.results;
      }).catch( (error) => {console.log(error)});
    
    Axios.get(localHost + '/api/last-users')
      .then((results) =>{
        this.lastRestaurants = results.data.results;
      }).catch( (error) => {console.log(error)});
    
    this.try = localStorage.getItem('key');
    this.cart2 = JSON.parse(this.try)

    if (this.cart2 == null) {
      this.cart2 = []
    }else {
        this.try = localStorage.getItem('key');
        this.cart2 = JSON.parse(this.try)
        
        // for (let index = 0; index < this.cart2.length; index++) {
        //   const element = this.cart2[index];
        //   console.log(element);
        //   if (element === element) {
        //     console.log('ciao');
        //   }
          
        // }
      }
    this.cartCounter = this.cart2.length;

    },
    methods: {
      addCart(dish) {
        console.log(dish);
        this.cart2.push(dish);
        this.cartCounter = this.cart2.length;
        localStorage.getItem(JSON.stringify(this.cart2))

        localStorage.setItem('key', JSON.stringify(this.cart2));

        this.cart2 = localStorage.getItem('key');
        console.log(this.cart2);
        console.log(JSON.parse(this.cart2));
        this.cart2 = JSON.parse(this.cart2)
      },

      resetCart() {
        localStorage.removeItem('key');
        this.cart2 = [];
        this.cartCounter = 0;
      }

    }

}
</script>

<style lang="scss" scoped>
.higlights-image-container {
  max-height:150px;
   height:10vw; 
   overflow:hidden;
   position: relative;
   & img{
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
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
  background-image: url('../../img/bg-main.svg');
  background-size: 100%;
  background-repeat: no-repeat;
}

@media screen and(max-width: 991px) {
  .higlights-image-container {
   height:20vw; 
  
}
}
</style>