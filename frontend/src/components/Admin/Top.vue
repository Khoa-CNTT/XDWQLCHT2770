
<template >
  <div class="wrapper" :class="{ toggled: isToggled }" >
   
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
          <div class="mobile-toggle-menu" @click="toggleDiv">
            <i class="bx bx-menu"></i>
          </div>

          <div class="user-box dropdown">
            <a
              class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              <img
                :src="avatarUrl"
                class="user-img"
                alt="user avatar"
              />
              <div class="user-info ps-3">
                <p class="user-name mb-0">
                  {{ admin?.ho_ten }}
                </p>
                <p class="designattion mb-0">{{ admin?.chuc_vu.ten_chuc_vu}}</p>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="javascript:;"
                  ><i class="bx bx-user"></i><span>Profile</span></a
                >
              </li>
              <li>
               <router-link to="/admin/profile"> <a class="dropdown-item" href="javascript:;"
                  ><i class="bx bx-cog"></i><span>Settings</span></a
                ></router-link>
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
                <a class="dropdown-item" href="javascript:;" @click="logout"
                    ><i class="bx bx-log-out-circle"></i><span>Logout</span></a
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
                <div class="parent-icon">
                  <i class="fa-solid fa-gauge-high"></i>
                </div>
                <div class="menu-title">Dashboard</div>
              </a></router-link
            >
          </li>
          <li class="nav-item">
            <router-link to="/admin/booking"
              ><a class="nav-link">
                <div class="parent-icon">
                  <i class="fa-solid fa-cart-plus"></i>
                </div>
                <div class="menu-title">Bookings</div>
              </a></router-link
            >
          </li>
          <li class="nav-item dropdown">
            <a
              href="javascript:;"
              class="nav-link dropdown-toggle dropdown-toggle-nocaret"
              data-bs-toggle="dropdown"
            >
              <div class="parent-icon"><i class="fa-solid fa-house"></i></div>
              <div class="menu-title">QL Homestay</div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="/admin/homestay"
                  ><i class="bx bx-right-arrow-alt"></i>QL Homestay</a
                >
              </li>

              <li>
                <a class="dropdown-item" href="/admin/rooms"
                  ><i class="bx bx-right-arrow-alt"></i>QL phòng</a
                >
              </li>
             
            </ul>
          </li>

          <li class="nav-item">
            <router-link to="/admin/baiviet">
              <a class="nav-link">
                <div class="parent-icon"><i class="bx bx-file"></i></div>
                <div class="menu-title">Bài viết</div>
              </a>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/phanquyen">
              <a class="nav-link">
                <div class="parent-icon"><i class="bx bx-file"></i></div>
                <div class="menu-title">Phân Quyền</div>
              </a>
            </router-link>
          </li>
          <li class="nav-item dropdown">
            <a
              href="javascript:;"
              class="nav-link dropdown-toggle dropdown-toggle-nocaret"
              data-bs-toggle="dropdown"
            >
              <div class="parent-icon"><i class="bx bxs-group"></i></div>
              <div class="menu-title">Tài Khoản</div>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="/admin/qlnhanvien"
                  ><i class="bx bx-right-arrow-alt"></i>Nhân viên</a
                >
              </li>
              <li>
                <a class="dropdown-item" href="/admin/qlnguoidung"
                  ><i class="bx bx-right-arrow-alt"></i>Khách hàng</a
                >
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link to="/admin/qldanhgia"
              ><a class="nav-link">
                <div class="parent-icon">
                  <i class="fa-solid fa-cart-plus"></i>
                </div>
                <div class="menu-title">Đánh giá</div>
              </a></router-link
            >
          </li>
          <li class="nav-item">
            <router-link to="/admin/qldichvu"
              ><a class="nav-link">
                <div class="parent-icon">
                  <i class="fa-solid fa-cart-plus"></i>
                </div>
                <div class="menu-title">Dịch vụ</div>
              </a></router-link
            >
          </li>
        </ul>
      </nav>
    </div>

    <div class="page-wrapper"></div>
    <div class="overlay toggle-icon" @click="toggleDiv"></div>
  </div>
</template>
<script>
import { useAdminStore } from "../../stores/useAdminStore";
import { useRouter } from "vue-router";
export default {
  setup() {
    const adminStore = useAdminStore();
    const router = useRouter();
    return {
      adminStore,
      router,
    };
  },
  data() {
    return {
      isToggled: false,
      defaulAvatar:"../../../public/image.png",
      backendBaseUrl:"http://127.0.0.1:8000/storage/"
    };
  },
  computed: {
    admin() {
      return this.adminStore.getAdmin;
    },
    isLoggedIn() {
      return this.adminStore.isLoggedIn;
    },
    avatarUrl() {
      return this.admin?.avatar
        ? `${this.backendBaseUrl}${this.admin.avatar}`
        : this.defaulAvatar;
    },
  },
  mounted() {
    
    console.log(this.adminStore.getAdmin);
  },
  methods: {
    toggleDiv() {
      this.isToggled = !this.isToggled;
    },
    async logout() {
      try {
        await this.adminStore.logout();
        this.$router.push("/admin/login");
      } catch (error) {
        console.error("Logout failed:", error);
      }
    },
  },
};
</script>

<style >
</style>