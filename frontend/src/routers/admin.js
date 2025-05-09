// src/routers/admin.js
import kiemTraAdmin from "./auth.js"; // Import hàm kiểm tra token admin
export default [
  {
    path: "/admin",
    component: () => import("../layouts/LayoutAdmin/index.vue"), // Layout chính của Admin
    children: [
      {
        path: "dashboard",
        name: "AdminDashBoard",
        component: () => import("../pages/pageAdmin/DashBoard.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "",
        redirect: { name: "AdminDashBoard" },
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "login",
        name: "AdminLogin",
        component: () => import("../pages/pageAdmin/Login.vue")
       
      },
      {
        path: "forgotpassword",
        name: "Forgotpassword",
        component: () => import("../pages/pageAdmin/ForgotPassword.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "rooms",
        name: "Rooms",
        component: () => import("../pages/pageAdmin/RoomManagement.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "homestay",
        name: "homestay",
        component: () => import("../pages/pageAdmin/Homestays.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "booking",
        name: "Booking",
        component: () => import("../pages/pageAdmin/Bookings.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "baiviet",
        name: "Baiviet",
        component: () => import("../pages/pageAdmin/Posts.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "qlnguoidung",
        name: "QuanLyNguoiDung",
        component: () => import("../pages/pageAdmin/QLTKnguoidung.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "qlnhanvien",
        name: "QLNhanVien",
        component: () => import("../pages/pageAdmin/QLTKnhanvien.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "qldanhgia",
        name: "QLDanhGia",
        component: () => import("../pages/pageAdmin/QLdanhgia.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "qldichvu",
        name: "QLDichVu",
        component: () => import("../pages/pageAdmin/QLdichvu.vue"),
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "qltinhtrangphong",
        name: "QLTinhTrangPhong",
        component: () => import("../pages/pageAdmin/RoomStatus.vue"),   
        beforeEnter: kiemTraAdmin,
      },
      {
        path: "profile",
        name: "AdminProfile",
        component: () => import("../pages/pageAdmin/Profile.vue"), 
        beforeEnter: kiemTraAdmin,  
      },
      {
        path: 'profile',
      name: 'AdminProfile',
      component: () => import('../pages/pageAdmin/Profile.vue'), 
      beforeEnter: kiemTraAdmin,     
      },
      {
        path: 'phanquyen',
        name: 'PhanQuyen',
        component: () => import('../pages/pageAdmin/PhanQuyen.vue'), 
        beforeEnter: kiemTraAdmin,   
      }
      
    ],
  },
];

