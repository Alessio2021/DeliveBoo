<template>
  <div class="container">
     <div v-if="data.restaurant.slug">
  <h2>carrello</h2>
  <h4>Nel Carrello {{numberOfDishes()}}</h4>
  <h5>Totale: {{totalOrder()}}</h5>    
  <button @click="resetCart()">svuota carrello</button>

  <div v-for="(item, index) in data.dishes" :key="index" class="cart"> 
    {{item.name}} {{item.price}} {{item.amount}}
  </div>

  </div>




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
          <ShopCart />
        </div>
      </div>
  </div>
</template>

<script>
import Axios from "axios";
import CategoryLinks from "../components/CategoryLinks.vue";
import ShopCart from "../components/ShopCart.vue";

export default {
  name:"Menu",
  data() {
    return {
      restaurant: {
        slug: '',
      },
      dishes: [],
      storage: [],
      data: {
        restaurant: {
          slug: '',
        },
        dishes: [],
      },
    }
  },
  components: {
    CategoryLinks,
    ShopCart,
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
    const tryRead = localStorage.getItem('key');
    console.log('lettura locale');
    if ( tryRead ) {
      this.data = JSON.parse(tryRead);
      console.log('lettura effettuata');
    } else {
      localStorage.setItem('key', JSON.stringify(this.data));
      console.log('settare il file in locale non letto');
    }
  },
  methods: {
    addCart(dish) {
      if ( this.restaurant.slug == this.data.restaurant.slug) {
        this.setDishOnCart(dish);
        this.data = JSON.parse(localStorage.getItem('key'));
      }else {
        this.data.restaurant.slug = this.restaurant.slug;
        this.setDishOnCart(dish);
      //     console.log('non arriverò');
      //     console.log(dish);
      //     this.data.dishes.push(dish);
      //     localStorage.getItem(JSON.stringify(this.data))
      //     localStorage.setItem('key', JSON.stringify(this.data));
      this.data = JSON.parse(localStorage.getItem('key'));
      // console.log(this.data);
      // console.log(JSON.parse(this.data));
      // this.data = JSON.parse(this.data)
      }
      


    },

    setDishOnCart(dish) {
      console.log(this.numberOfDishes());
      let amount = 1;
      let canIPush = true;
      this.data.dishes.forEach(cartDish => {
        if (cartDish.slug == dish.slug) {
          amount = cartDish.amount + amount;
          cartDish.amount = amount;
          canIPush = false;
        }
      });

      if (canIPush) {
        this.data.dishes.push(
              {
                name: dish.name,
                slug: dish.slug,
                price: dish.price,
                amount: amount,
              });
      }
      localStorage.setItem('key', JSON.stringify(this.data));
      console.log(this.data); 

      },

      numberOfDishes() {
        let numberOfDishes = 0;
        this.data.dishes.forEach((dish) => {numberOfDishes += dish.amount});
        return numberOfDishes;
      },
      totalOrder() {
        let totalValue = 0;
        this.data.dishes.forEach((dish) => {totalValue += dish.amount*dish.price});
        return totalValue;
      },

    resetCart() {
      localStorage.removeItem('key');
      this.data = {
        restaurant: {},
        dishes: [],
      };
    }
  }
}
</script>

<style>

</style>