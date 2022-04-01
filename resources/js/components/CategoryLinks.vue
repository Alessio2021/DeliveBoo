<template>
  <div class="row mb-3">
    <div class="col-3 col-md-2 col-lg-1 mb-3"  v-for="(category, index) in categories" :key="index">
      <img :src="category.img" :alt="category.name">
      </div>
  </div>
</template>

<script>
import Axios from "axios";

export default {
name:'CategoryLinks',
data: function() {
  return {
    categories: [],
  }
},
  created() {
    Axios.get(localHost + '/api/categories').then(
    (results) =>{
        this.categories = results.data.results;
    });
  }
  
}
</script>

<style lang="scss" scoped>

</style>