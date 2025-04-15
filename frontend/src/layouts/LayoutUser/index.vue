<template >
    <div >
      <TheHeader></TheHeader>
    <ChatBot></ChatBot>
    <router-view ></router-view>

    <TheFooter></TheFooter>
    </div>
  </template>
  <script>

import TheHeader from "../../components/User/TheHeader.vue";
import TheFooter from "../../components/User/TheFooter.vue";
import ChatBot from "../../components/User/ChatBot.vue";

  export default {
      components:{
          TheHeader,
          TheFooter,
          ChatBot
      }
  }
  </script>
  <style >
      
  </style>