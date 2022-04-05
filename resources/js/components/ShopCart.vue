<template>
    <div>
        <div v-if="data.restaurant.slug" class="container bg-white">
            <h2 class="row">Carrello <span class="text-danger">({{numberOfDishes()}} elementi)</span></h2>
            <h4>Ristorante <router-link :to="{name: 'restaurant', params:{restaurant: data.restaurant.slug}}">{{data.restaurant.name}}</router-link></h4>
            <h3 class="row">Totale: {{totalOrder()}}</h3>    
            <button class="btn btn-danger row" @click="resetCart()">svuota carrello</button>

            <div class="row bg-info text-light">
                <div class="col-2">
                    Quantit&agrave;
                </div>
                <div class="col-7">
                    Piatto
                </div>
                <div class="col-3">
                    Prezzo
                </div>
            </div>
            

            <div v-for="(item, index) in data.dishes" :key="index" class="row">
                <div class="col-2">
                    <NumberIncrement :dishSlug="item.slug" :startValue="item.amount" @amount="setDishAmount"/>
                </div>
                <div class="col-7">
                    {{item.name}}
                </div>
                <div class="col-3">
                    {{item.price}} &euro;
                </div>       
            </div>
            <button @click="ciao()">Paga</button>
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

        // JSON ALL'INIZIO

        document.getElementById('JSONOrder').value = JSON.stringify(this.data);

        this.$emit('restaurantOnCart', this.data.restaurant.slug);
    },
    methods: {
        ciao() {
            document.getElementById('payNow').click();
        },
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

</style>