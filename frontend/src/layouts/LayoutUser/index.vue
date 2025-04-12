<template >
    <div >
      <TheHeader></TheHeader>
    
    <router-view ></router-view>
    <TheFooter></TheFooter>
    </div>
  </template>
  <script>

import TheHeader from "../../components/User/TheHeader.vue";
import TheFooter from "../../components/User/TheFooter.vue";

  export default {
      components:{
          TheHeader,
          TheFooter
      }
  }
  </script>
  <style >
      
  </style>