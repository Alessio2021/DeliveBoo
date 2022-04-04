<template>
  <div class="row mb-3">
      <router-link class="col-3 col-md-2 col-lg-1 mb-3" :class="activeCategories.includes(category.name)? 'border border-info' : ''" :to="{name: 'restaurants', params: {categories: [category.name]}}" v-for="(category, index) in categories" :key="index">
        <img @click="setActiveCategory(category.name)" :src="category.img" :alt="category.name">
      </router-link>
  </div>
</template>

<script>
import Axios from "axios";

export default {
name:'CategoryLinks',
data: function() {
  return {
    categories: [],
    activeCategories: [],
  }
},
props: { 
  setActiveCategories: {
    type: Array,
    default(){
      return [];
    }
  } 

},
  created() {
    
    Axios.get(localHost + '/api/categories').then(
    (results) =>{
        this.categories = results.data.results;
    });
    this.activeCategories = this.setActiveCategories;
  },
  methods: {
    setActiveCategory(category){
      if (!this.activeCategories.includes(category)) {
        this.activeCategories.push(category);
      }else {
        this.activeCategories.splice(this.activeCategories.indexOf(category), 1);
      }
      this.$emit('activeCategories', this.activeCategories);
    }
  }
  
}
</script>

<style lang="scss" scoped>

</style>