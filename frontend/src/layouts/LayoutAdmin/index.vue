<template >
<div>
<Top></Top>
    <router-view></router-view>
</div>
 

</template>
<script>
import Top from "../../components/Admin/Top.vue"
export default {
    components:{
        Top
    }
}
</script>
<style >
     @import "../../assets/plugins/simplebar/css/simplebar.css";
    @import "../../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css";
    @import "../../assets/css/bootstrap.min.css";
    @import "../../assets/css/bootstrap-extended.css";
    @import "../../assets/css/app.css";
    @import "../../assets/css/icons.css";
   
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");
    @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css");
</style>