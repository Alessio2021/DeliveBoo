<template>
  <div class="row mb-3">
      <router-link class="col-3 col-md-2 col-lg-1 mb-3 px-1" :to="{name: 'restaurants', params: {categories: [category.name]}}" v-for="(category, index) in categories" :key="index">
        <div :class="activeCategories.includes(category.name)? 'bg-active' : ''" class="px-2">
          <img class="py-2" @click="setActiveCategory(category.name)" :src="category.img" :alt="category.name">
        </div>
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
.bg-active{
  // border: solid 1px #AA2B1D;
  border-radius: 10px;
  background-color: rgba($color: #AA2B1D, $alpha: 0.5);
  }
</style>