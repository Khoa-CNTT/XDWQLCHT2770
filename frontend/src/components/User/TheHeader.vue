<template>
 <div  style="background-color: #062d62;" >
  <div class="container d-flex  ">
    <nav class="navbar navbar-expand-lg navbar-dark " style="flex: 1 ;background-color: #062d62;">
    <div class="container-fluid">
      <!-- Logo -->
      <router-link to="/" class="navbar-brand d-flex align-items-center">
        <img src="/logolight.png" alt="Logo" style="height: 40px;" />
        
      </router-link>

      <!-- Toggle btn -->
      <button
        class=" btn text-white rounded-0 border-0 focus:outline-none active:outline-none d-lg-none"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarContent"
        aria-controls="navbarContent"
        aria-expanded="false"
        
      >
      <i class="fa-solid fa-bars"></i>
      </button>

      <!-- Navbar content -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
        <ul class="navbar-nav mb-2 mb-lg-0 w-100 justify-content-center">
          <li class="nav-item">
            <router-link to="/home" class="nav-link">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/post" class="nav-link">Post</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/postdetail" class="nav-link">Chi tiết phòng</router-link>
          </li>
          
        </ul>
        
      </div>
    </div>
  </nav>
  <div class="dropdown  mt-3">
        <a
          href="#"
          class="d-flex align-items-center text-white text-decoration-none "
          id="userDropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="https://scontent.fhan14-5.fna.fbcdn.net/v/t39.30808-6/480825499_1137689028097039_5666489940447021542_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeEGHw3tHcqLnRxNr_CqwIIMt9yoS-GOX8G33KhL4Y5fwUH1FpC9PyKBUtEibVrHyqCYuvY4-lbakQdEUoEJrrrn&_nc_ohc=38c9bEG0NUAQ7kNvwFJ0u62&_nc_oc=AdnmIgrh9sP8jMAQ5rEl-Pjpo-QMdqZcBso0QgC2MO0UJ3N3RyXzOYPlaGZPabujyLU&_nc_zt=23&_nc_ht=scontent.fhan14-5.fna&_nc_gid=hjQTYuzaIqo77NFHYAcgfA&oh=00_AfGW5nDIh--x_eNJQryySnHZtHDfL1DWc5FLFcLkKLdOcw&oe=6800820A"
            alt="User"
            width="40"
            height="40"
            class="rounded-circle"
          />
          <div class="ms-2 d-none d-lg-block text-start">
            <div class="fw-bold">User</div>
            <div class="small">Khách hàng mới</div>
          </div>
        </a>
        <ul class="dropdown-menu w-100  mt-2" aria-labelledby="userDropdown">
          <li><router-link class="dropdown-item" to="/login">🔐 Đăng nhập</router-link></li>
          <li><router-link class="dropdown-item" to="/register">📝 Đăng ký</router-link></li>
          <li><router-link class="dropdown-item" to="/profile">👤 Tài khoản</router-link></li>
          <li><router-link class="dropdown-item text-danger" to="/logout">🚪 Đăng xuất</router-link></li>
        </ul>
      </div>
  </div>
 </div>
</template>

<script>
export default {
  name: "Navbar",
};
</script>

<style scoped>
/* Optional: Hover effect on nav links */
.nav-link:hover {
  color: #ffc107 !important;
}
</style>
