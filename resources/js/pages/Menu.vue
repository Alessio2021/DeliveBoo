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




      <div class="row mt-5">
        <div class="col-12">
          <CategoryLinks/>
        </div>
      </div>
      <div class="row my-5 shadow gradient rounded" >        
          <div class="col-lg-1 col-md-2 col-3 p-3">
              <img v-if="restaurant.image" class="w-100" :src="restaurant.image" :alt="restaurant.name + ' logo'">
              <img v-else :src="uri + '/img/placeholder/restaurant-placeholder.svg'" class="card-img-top" :alt="restaurant.name + 'logo'">
          </div>
          <div class="col-9 d-flex flex-column justify-content-center">
            <h2 class="text-green px-3"><b>{{restaurant.name}}</b></h2>
            <p class="text-green px-3">{{restaurant.address}}</p>
          </div>
      </div>
      <div class="row mt-5 justify-content-between">
        <div class="col-lg-7 col-12">
          <div v-for="(dish, index) in dishes" :key="'dish-' + index" class="row box mb-4 gradient rounded shadow-lg p-3">
            <div  class="col-lg-6 ">
                  <div :id="'carousel-top4-' + index" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner container-img ">
                        <div v-for="(image, index) in dish.image" :key="'image-' + index" class="  carousel-item" :class="(index == 0) ? 'active' : ''" data-bs-interval="5000">
                          <div class="higlights-image-container">
                          <img  :src="image" class="d-block w-100 obj-fit " :alt="dish.name + ' photo'">
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
            <div class="col-lg-6 position-relative d-flex flex-column justify-content-between">
              <div>
                <h5 class="mb-2 text-green fs-4"><b>{{dish.name}}</b></h5>
                <p class="fst-italic text-green fs-7">"{{dish.description}}"</p>

              </div>
              <p class="text-danger m-0 fs-4 fw-bold">{{dish.price}} &euro;</p>
            
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary text-success vertical-aling-middle position-button  shadow fw-bold" data-bs-toggle="modal" :data-bs-target="'#add-cart-' + index">
                <b-icon class="mb-1" icon="CartPlus"></b-icon> Aggiungi al carrello
              </button>

              <!-- Modal -->
              <div class="modal fade" :id="'add-cart-' + index" tabindex="-1" :aria-labelledby="'add-cart-' + index + 'Label'" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h5 class="modal-title text-info" :id="'add-cart-' + index + 'Label'"><b> {{dish.name}} </b></h5>
                      <button type="button" class="btn-close text-info" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h5 v-if="!(restaurant.slug == restaurantOnCart || restaurantOnCart == '')" class="text-secondary mb-3">Svuotare il cestino e procedere con il nuovo ordine?</h5>
                      <h5 class="text-info">Seleziona la quantità</h5>
                      <div class="text-green fs-4">
                      <NumberIncrement @amount="setAmount" />

                      </div>
                    </div>
                    <div class="modal-footer ">
                      <button type="button" class="btn btn-secondary text-success" data-bs-dismiss="modal">Annulla</button>
                      <button v-if="restaurant.slug == restaurantOnCart || restaurantOnCart == ''" type="button" class="btn btn-primary text-success" data-bs-dismiss="modal" @click="setChoosenDish(dish)">Aggiungi</button>
                      <button v-else type="button" class="btn btn-primary text-success" data-bs-dismiss="modal" @click="setChoosenDish(dish)">Svuota e Aggiungi</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 cart-responsive">
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
      uri: '',
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
    this.uri = localHost;
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

  .gradient{
    background-color: white;
  }
  .text-green{
    color: #064635;
  }
  .fs-7{
    font-size: 12px;
  }
  .position-button{
    position: absolute;
    bottom: 0;
    right: 0;
  }
  .obj-fit{
    object-fit: contain;
    height: 200px;
    width: 100%;
  }
  .container-img{
    height: 200px;
  }
  @media screen and (max-width: 992px) {
    .position-button{
    position: inherit;
    bottom: 0;
    right: 0
  }
  .box{
    display: flex;
    flex-direction: column;
  }
  .container-img{
    margin-bottom: 10px;
  }
  .cart-responsive{
    position: fixed;
    bottom: 5px;
    width: 100%;
    left: 50%;
    transform: translateX(-50%);
  }
}

</style>