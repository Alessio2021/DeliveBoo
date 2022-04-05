<template>
    <div>
        <div v-if="data.restaurant.slug" class="container bg-white border rounded shadow p-2">
            <h4 class="text-green"><b>Carrello </b></h4><span class="text-danger">({{numberOfDishes()}} elementi)</span>
            <h5 class="mt-2 ">Ristorante <router-link :to="{name: 'restaurant', params:{restaurant: data.restaurant.slug}}">{{data.restaurant.name}}</router-link></h5>
            

            <div class="bg-green text-light d-flex px-1">
                <div class="col-6">
                    Piatto
                </div>
                <div class="col-3 text-end ">
                    Quantit&agrave;
                </div>
                <div class="col-3 text-end ">
                    Prezzo
                </div>
            </div>
            

            <div v-for="(item, index) in data.dishes" :key="index" class="row mb-3 px-1">
                <div class="col-6 text-green">
                    {{item.name}}
                </div>
                <div class="col-3 text-end text-green">
                    <NumberIncrement :dishSlug="item.slug" :startValue="item.amount" @amount="setDishAmount"/>
                </div>
                <div class="col-3 text-end text-green">
                    {{item.price}} &euro;
                </div>       
            </div>
            <div class="mb-4 text-end pe-1 pt-1 border-top">
                <h5 class="text-green m-0 ">Totale: {{totalOrder()}} &euro;</h5>    
            </div>
            <div class="text-center">
                <button class="btn btn-danger" @click="resetCart()">Svuota carrello</button>
            </div>
            
        </div>
        <div v-else>
            Carrello vuoto
        </div>
    </div>
</template>

<script>
import NumberIncrement from './NumberIncrement.vue';

export default {
    name: 'ShopCart',
    props: {
        choosenDish: {
            type: Object,
        }
    },
    data() {
        return {
            data: {
                restaurant: {
                    slug: '',
                    name: '',
                },
                dishes: [],
            }
        }
    },
    components: {
        NumberIncrement,
    },
    watch: {
        choosenDish() {
            this.addOnCart();
        },
    },
    created() {
        const tryRead = localStorage.getItem('key');

        if ( tryRead ) {
            this.data = JSON.parse(tryRead); 
        } else {
            localStorage.setItem('key', JSON.stringify(this.data));
        }

        this.$emit('restaurantOnCart', this.data.restaurant.slug);
    },
    methods: {
        addOnCart() {
            if ( this.choosenDish.restaurant.slug == this.data.restaurant.slug || this.data.restaurant.slug == '') {
                this.data.restaurant.slug = this.choosenDish.restaurant.slug;
                this.data.restaurant.name = this.choosenDish.restaurant.name;
                this.setDishOnCart(this.choosenDish.dish);
                this.data = JSON.parse(localStorage.getItem('key'));
                this.$emit('restaurantOnCart', this.data.restaurant.slug);
            } else {
                this.resetCart();
                this.data.restaurant.slug = this.choosenDish.restaurant.slug;
                this.data.restaurant.name = this.choosenDish.restaurant.name;
                this.setDishOnCart(this.choosenDish.dish);
                this.data = JSON.parse(localStorage.getItem('key'));
                this.$emit('restaurantOnCart', this.data.restaurant.slug);
            }
        },

        setDishOnCart(dish) {
            let canIPush = true;
            this.data.dishes.forEach(cartDish => {
                if (cartDish.slug == dish.slug) {
                    cartDish.amount = cartDish.amount + dish.amount;
                    canIPush = false;
                }
            });

            if (canIPush) {
                this.data.dishes.push(
                    {
                        name: dish.name,
                        slug: dish.slug,
                        price: dish.price,
                        amount: dish.amount,
                    });
            }
            localStorage.setItem('key', JSON.stringify(this.data));
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
                restaurant: {
                    slug: '',
                    name: '',
                },
                dishes: [],
            }
        },

        setDishAmount(emitted) {
            const dish = this.data.dishes.filter(dish => dish.slug == emitted.dishSlug);
            dish[0].amount = emitted.value;
            localStorage.setItem('key', JSON.stringify(this.data));
            console.log(dish);
        }
    }
}
</script>

<style lang="scss" scoped>
.text-green{
    color: #064635;
  }
  .bg-green{
      background-color: #064635;
  }
</style>