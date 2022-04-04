<template>
  <div class="container">
<!--     
     <div v-if="data.restaurant.slug">
  <h2>carrello</h2>
  <h4>Nel Carrello {{numberOfDishes()}}</h4>
  <h5>Totale: {{totalOrder()}}</h5>    
  <button @click="resetCart()">svuota carrello</button>

  <div v-for="(item, index) in data.dishes" :key="index" class="cart"> 
    {{item.name}} {{item.price}} {{item.amount}}
  </div>

  </div> -->




      <div class="row">
        <div class="col-12">
          <CategoryLinks/>
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
        <div class="col-7">
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
              <p class="text-danger">{{dish.price}} &euro;</p>
            
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary text-success vertical-aling-middle" data-bs-toggle="modal" :data-bs-target="'#add-cart-' + index">
                <b-icon icon="CartPlus"></b-icon> Aggiungi al carrello
              </button>

              <!-- Modal -->
              <div class="modal fade" :id="'add-cart-' + index" tabindex="-1" :aria-labelledby="'add-cart-' + index + 'Label'" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" :id="'add-cart-' + index + 'Label'">{{dish.name}}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h3 v-if="!(restaurant.slug == restaurantOnCart || restaurantOnCart == '')" class="text-danger">Svuotare il cestino e procedere con il nuovo ordine?</h3>
                      <h6>Seleziona la quantità</h6>
                      <NumberIncrement @amount="setAmount" />
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                      <button v-if="restaurant.slug == restaurantOnCart || restaurantOnCart == ''" type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="setChoosenDish(dish)">Aggiungi</button>
                      <button v-else type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="setChoosenDish(dish)">Svuota e Aggiungi</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-5">
          <ShopCart :choosenDish="choosenDish" @restaurantOnCart="setRestaurantOnCart"/>
        </div>
      </div>
  </div>
</template>

<script>
import Axios from "axios";

import CategoryLinks from "../components/CategoryLinks.vue";
import ShopCart from "../components/ShopCart.vue";
import NumberIncrement from "../components/NumberIncrement.vue";

import { BIcon, BIconCartPlus } from 'bootstrap-vue';

export default {
  name:"Menu",
  data() {
    return {
      restaurant: {
        slug: '',
      },
      restaurantOnCart: '',
      dishes: [],
      choosenDish: {
        restaurant: {
          slug: '',
          name: '',
        },
        dish: {
          name: '',
        }
      },
      amount: 1,
    }
  },
  components: {
    CategoryLinks,
    ShopCart,
    NumberIncrement,
    BIcon,
    BIconCartPlus,
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
      }).catch( (error) => {console.log(error)});

    this.$watch(
      () => this.$route.params.restaurant,
      () => {
        let routeParam = "";
        if (this.$route.params.restaurant) {
          routeParam = this.$route.params.restaurant;
        }

        Axios.get(localHost + '/api/menu?restaurant=' + routeParam)
          .then((results) =>{
            this.restaurant = results.data.results.restaurant;
            this.dishes = results.data.results.dishes;
          }).catch( (error) => {console.log(error)});
      }
    );
  },
  methods: {
    setAmount(value) {
      this.amount = value.value;
    },
    setChoosenDish(dish) {
      this.choosenDish = {
        restaurant: {
          slug: this.restaurant.slug,
          name: this.restaurant.name,
        },
        dish: {
          name: dish.name,
          slug: dish.slug,
          price: dish.price,
          amount: this.amount,
        }
      }
      this.amount = 1;
      console.log(this.choosenDish);
    },
    setRestaurantOnCart(value) {
      this.restaurantOnCart = value;
      console.log(this.restaurantOnCart);
    }
  }
}
</script>

<style lang="scss" scoped>
  
</style>