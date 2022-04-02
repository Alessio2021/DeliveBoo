<template>
  <div class="container">
      <div class="row">
          <div class="col-3">
              
          </div>
      </div>
  </div>
</template>

<script>
import Axios from "axios";

export default {
name:"Menu",
created() {
    let routeParam = "";
    if (this.$route.params.restaurant) {
      routeParam = this.$route.params.restaurant;
    }
    Axios.get(localHost + '/api/menu?restaurant=' + routeParam)
      .then((results) =>{
        console.log(results.data.results);
        // this.restaurants = results.data.results;
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
  },
}
</script>

<style>

</style>