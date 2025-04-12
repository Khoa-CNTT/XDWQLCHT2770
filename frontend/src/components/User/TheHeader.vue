<template >
<div class="py-lg-2" style="background-color: #062d62;" >
    <nav class="container navbar navbar-expand-lg"
  style="background-color: #062d62;">
  <div class="container-fluid">
    <img
              src="/logolight.png"
              style="height: 40px; width: auto"
              class="logo-icon"
              alt="logo icon"
            />
    <button class="navbar-toggler text-white" style="outline: none; outline: none !important;
  box-shadow: none !important;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav w-100 justify-content-center me-auto me-2  mb-lg-0">
        <router-link to="/home"><li class="nav-item ">
          <a class="nav-link text-white link-hover " style="font-weight: 400;font-size:1rem;" aria-current="page" href="#">Home</a>
        </li></router-link>
        <router-link to="/Post"><li class="nav-item ">
          <a class="nav-link text-white link-hover " style="font-weight: 400;font-size:1rem;" aria-current="page" href="#">Post</a>
        </li></router-link>
        <router-link to="/postdetail"><li class="nav-item ">
          <a class="nav-link text-white link-hover " style="font-weight: 400;font-size:1rem;" aria-current="page" href="#">Chi tiết phòng</a>
        </li></router-link>
        
      </ul>
      <div class="d-flex">
        <router-link to="/login"><button class="btn btn-outline-light me-2" type="submit">Login</button></router-link>
        <router-link to="/register"><button class="btn btn-light" type="submit">Register</button></router-link>
      </div>
    </div>
  </div>
</nav>
</div>
</template>
<script>
export default {
    
}
</script>
<style >
    
</style>