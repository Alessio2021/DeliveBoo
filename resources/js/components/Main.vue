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
    <div class="row">
      <CategoryLinks />
    </div>
    <div class="row">
      <div v-for="(dish, index) in dishes" :key="index" class="col-6 col-lg-3">
          <div class="card">
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
        dishes: [],
        storage: [],
        cart2: [],
        try: null
      }
    },
    created() {
    Axios.get(localHost + '/api/top').then(
    (results) =>{
        this.dishes = results.data.results;
    }),
    
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


@media screen and(max-width: 991px) {
  .higlights-image-container {
   height:20vw; 
  
}
}
</style>