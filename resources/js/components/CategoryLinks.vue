<template>
  <div>
      <button class="btn btn-primary" v-for="(category, index) in categories" :key="index">
        {{category.name}}
      </button>
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