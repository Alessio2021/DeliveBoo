<template>
    <div>
        Carrello
    </div>
</template>

<script>
export default {
    name: 'ShopCart',
    props: {
        dishes: [],
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

</style>