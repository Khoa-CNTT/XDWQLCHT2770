
<template >
  <div class="wrapper " :class="{ toggled: isToggled }">
  <header>
    <div class="topbar d-flex align-items-center" style="">
      <nav class="navbar navbar-expand d-flex justify-content-between">
        <div class="topbar-logo-header">
          <div class="">
            <img
              src="/logodark.png"
              style="height: 40px; width: auto"
              class="logo-icon"
              alt="logo icon"
            />
          </div>
        </div>
        <div class="mobile-toggle-menu" @click="toggleDiv"><i class="bx bx-menu"></i></div>

        <div class="user-box dropdown">
          <a
            class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <img
              src="../../../public/image.png"
              class="user-img"
              alt="user avatar"
            />
            <div class="user-info ps-3">
              <p class="user-name mb-0">Admin</p>
              <p class="designattion mb-0">Manager</p>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="javascript:;"
                ><i class="bx bx-user"></i><span>Profile</span></a
              >
            </li>
            <li>
              <a class="dropdown-item" href="javascript:;"
                ><i class="bx bx-cog"></i><span>Settings</span></a
              >
            </li>
            <li>
              <a class="dropdown-item" href="javascript:;"
                ><i class="bx bx-home-circle"></i><span>Dashboard</span></a
              >
            </li>
            <li>
              <a class="dropdown-item" href="javascript:;"
                ><i class="bx bx-dollar-circle"></i><span>Earnings</span></a
              >
            </li>
            <li>
              <a class="dropdown-item" href="javascript:;"
                ><i class="bx bx-download"></i><span>Downloads</span></a
              >
            </li>
            <li>
              <div class="dropdown-divider mb-0"></div>
            </li>
            <li>
              <router-link to="/admin/login"
                ><a class="dropdown-item" href="javascript:;"
                  ><i class="bx bx-log-out-circle"></i><span>Logout</span></a
                ></router-link
              >
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
    <div class="nav-container primary-menu">
      <div class="mobile-topbar-header">
        <div>
          <img src="/logodark.png" class="logo-icon" alt="logo icon" />
        </div>
        <div>
          <h4 class="logo-text">HomeS</h4>
        </div>
        <div class="toggle-icon ms-auto" @click="toggleDiv">
          <i class="bx bx-arrow-to-left"></i>
        </div>
      </div>
      <nav class="navbar navbar-expand-xl w-100">
        <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
          <li class="nav-item">
            <router-link to="/admin/dashboard">
              <a class="nav-link">
                <div class="parent-icon"><i class="bx bx-cookie"></i></div>
                <div class="menu-title">Dashboard</div>
              </a></router-link
            >
          </li>
          <li class="nav-item">
            <router-link to="/admin/booking"><a class="nav-link">
              <div class="parent-icon"><i class="bx bx-cookie"></i></div>
              <div class="menu-title">Bookings</div>
            </a></router-link>
          </li>
          <li class="nav-item">
           <router-link to="/admin/homestay"><a class="nav-link">
              <div class="parent-icon"><i class="bx bx-cookie"></i></div>
              <div class="menu-title">Homestay</div>
            </a></router-link>
          </li>
          <li class="nav-item">
           <router-link to="/admin/rooms"> <a class="nav-link">
              <div class="parent-icon"><i class="bx bx-cookie"></i></div>
              <div class="menu-title">Rooms</div>
            </a></router-link>
          </li>
        </ul>
      </nav>
    </div>
   
  
    <div class="page-wrapper"></div>
    <div class="overlay toggle-icon" @click="toggleDiv"></div>
  </div>
  
</template>
<script>
export default {
  data() {
    return {
      isToggled: false,
    };
  },
  methods: {
    toggleDiv() {
      this.isToggled = !this.isToggled;
    },
  },
};
</script>

<style >

</style>