<template>
  <div class="container">
    <div class="row mt-5">
      <ul class="list-unstyled d-flex justify-content-center">
        <li v-for="(icon) in icons" :key="icon.id">
          <a href="">
            <img class="w-50" :src="icon.icon" alt="">
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>


<script>
export default {
    name: "Main",
    // data() {
    //     return {
    //         icons: [
    //             {
    //                 icon: require('../../img/icone/american-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/breakfast-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/chinese-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/fastfood-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/greek-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/indian-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/international-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/italian-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/japan-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/mexican-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/vegan-icon.svg'),
    //             },
    //             {
    //                 icon: require('../../img/icone/vegetarian-icon.svg'),
    //             },
    //         ],
    //     }
    //     },
        
}
</script>

<style>

</style>