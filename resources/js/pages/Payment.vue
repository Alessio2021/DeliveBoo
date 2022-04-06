<template>
  <div></div>
</template>

<script>
export default {
name: 'Payment',
created() {
    const data = this.data = JSON.parse(localStorage.getItem('key'));

    if(data.dishes.length != 0) {
        document.getElementById('payment-form-checkout').classList.remove('d-none');
        document.getElementById('JSONOrder').value = JSON.stringify(this.data);
    } else {
        this.$router.push({ name: 'home' });
    }
}

}
</script>

<style>

</style>