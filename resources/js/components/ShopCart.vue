<template>
<div>
    <div class="d-none d-lg-block">
        <div v-if="data.dishes.length != 0" class="container bg-white border rounded shadow p-2">
                <div class=" d-flex px-1">
                    <h4 class="text-green col-6 m-0 d-flex align-items-center"><b>Carrello </b></h4>
                    <div class="col-6 text-end m-0">
                        <button class="btn btn-danger fw-bold" @click="resetCart()">
                            <b-icon class="mb-1" icon="TrashFill"></b-icon>
                            svuota
                        </button>
                    </div>
                </div>

            <span class="text-danger">({{numberOfDishes()}} elementi)</span>
            <h5 class="mt-2 ">Ristorante <router-link :to="{name: 'restaurant', params:{restaurant: data.restaurant.slug}}">{{data.restaurant.name}}</router-link></h5>
            

            <div class="bg-green text-light d-flex px-1 mb-3">
                <div class="col-5">
                    Piatto
                </div>
                <div class="col-4 text-end ">
                    Quantit&agrave;
                </div>
                <div class="col-3 text-end ">
                    Prezzo
                </div>
            </div>
            
            <div v-for="(item, index) in data.dishes" :key="'cart-bg-' + index" class="row mb-2 px-1">
                <div class="col-5 text-green">
                    {{item.name}}
                </div>
                <div class="col-4 text-end text-green">
                    <NumberIncrement :dishSlug="item.slug" :startValue="item.amount" @amount="setDishAmount" :minValue="0"/>
                </div>
                <div class="col-3 text-end text-green">
                    {{item.price}} &euro;
                </div>       
            </div>
            <div class="mb-4 text-end pe-1 pt-1 border-top">
                <h5 class="text-green m-0 ">Totale: {{totalOrder()}} &euro;</h5>    
            </div>
            <div class="text-center">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary text-light fw-bold d-inline-flex align-items-center py-0" data-bs-toggle="modal" data-bs-target="#staticBackdropPayment-1">
                    <span class="d-inline-block h-100">Procedi con l'ordine</span>
                    <span class="fs-2 h-100"><b-icon class="mb-1" icon="ArrowRightShort"></b-icon></span>
                </button>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="staticBackdropPayment-1" tabindex="-1" aria-labelledby="backdropPayment-1Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="backdropPayment-1Label">Procedere con l'ordine?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button id="closeHerePlz" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Torna al Menù</button>
                            <a :href="$router.resolve({name: 'checkout'}).href" type="button" class="btn btn-primary">Vai</a>
                        </div>
                    </div>
                </div>
            </div>
       </div>

        <div v-else class="bg-white py-5 shadow-lg">
            <div class="text-center text-uppercase text-danger fw-bold fs-4">
                Carrello vuoto
            </div>
            <div class="text-center">
                <h1 class="cart-icon-sm text-info">
                    <b-icon class="mb-1" icon="Cart"></b-icon>
                </h1>
            </div>
            <div class="text-center fst-italic">
                aggiungi piatti al tuo ordine dal men&ugrave;
            </div>
        </div>

    </div>

    <div class="d-lg-none d-block">     
        <button class="btn btn-info w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Carrello {{totalOrder()}} &euro; ({{numberOfDishes()}} elementi )
        </button>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <div v-if="data.restaurant.slug" class="container bg-white border rounded shadow p-2">
                    <h5 class="mt-2 ">Ristorante <router-link :to="{name: 'restaurant', params:{restaurant: data.restaurant.slug}}">{{data.restaurant.name}}</router-link></h5>
                    <div class="bg-green text-light d-flex px-1 mb-3">
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
                    

                    <div v-for="(item, index) in data.dishes" :key="index" class="row mb-2 px-1">
                        <div class="col-6 text-green">
                            {{item.name}}
                        </div>
                        <div class="col-3 text-end text-green">
                            <NumberIncrement :minValue="0" :dishSlug="item.slug" :startValue="item.amount" @amount="setDishAmount"/>
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
                    <div class="text-center">
                        Carrello vuoto
                    </div>
                    <div class="text-center">
                        <h1 class="cart-icon-sm text-info">
                            <b-icon class="mb-1" icon="Cart"></b-icon>
                        </h1>
                    </div>
                    <div class="text-center fst-italic">
                        aggiungi piatti al tuo ordine dal men&ugrave;
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import NumberIncrement from './NumberIncrement.vue';
import { BIcon, BIconCart, BIconArrowRightShort, BIconTrashFill } from 'bootstrap-vue';

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
            },
        }
    },
    components: {
        NumberIncrement,
        BIcon,
        BIconCart,
        BIconArrowRightShort,
        BIconTrashFill,
    },
    watch: {
        choosenDish() {
            this.addOnCart();
            this.synchCartOnRequest();
        },
    },
    created() {
        const tryRead = localStorage.getItem('key');

        if ( tryRead ) {
            this.data = JSON.parse(tryRead); 
        } else {
            localStorage.setItem('key', JSON.stringify(this.data));
        }

        this.synchCartOnRequest();

        this.$emit('restaurantOnCart', this.data.restaurant.slug);
    },
    methods: {
        synchCartOnRequest() {
            document.getElementById('JSONOrder').value = JSON.stringify(this.data);
        },
        // cart methods
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
            return totalValue.toFixed(2);
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
            if (emitted.value != 0) {
                const dish = this.data.dishes.filter(dish => dish.slug == emitted.dishSlug);
                dish[0].amount = emitted.value;
                localStorage.setItem('key', JSON.stringify(this.data));
                this.synchCartOnRequest();
            } else {
                let badIndex;
                this.data.dishes.forEach((dish,index) => {
                    if(dish.slug == emitted.dishSlug) {
                        badIndex = index;
                    }
                });
                this.data.dishes.splice(badIndex, 1);
                localStorage.setItem('key', JSON.stringify(this.data));
            }
            if(this.data.dishes.length == 0) {
                this.resetCart();
            }
        },
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

  .cart-icon-sm {
      font-size: 40px;
      display: inline-block;
      margin: 10px 0;
  }
</style>