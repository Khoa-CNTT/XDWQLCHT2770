// src/routers/admin.js
export default [
  {
    path: "/admin",
    component: () => import("../layouts/LayoutAdmin/index.vue"), // Layout chính của Admin
    children: [
      {
        path: "dashboard",
        name: "AdminDashBoard",
        component: () => import("../pages/pageAdmin/DashBoard.vue"),
      },
      {
        path: "",
        redirect: { name: "AdminLogin" },
      },
      {
        path: "login",
        name: "AdminLogin",
        component: () => import("../pages/pageAdmin/Login.vue"),
      },
      {
        path: "forgotpassword",
        name: "Forgotpassword",
        component: () => import("../pages/pageAdmin/ForgotPassword.vue"),
      },
      {
        path: "rooms",
        name: "Rooms",
        component: () => import("../pages/pageAdmin/RoomManagement.vue"),
      },
      {
        path: "homestay",
        name: "homestay",
        component: () => import("../pages/pageAdmin/Homestays.vue"),
      },
      {
        path: "booking",
        name: "Booking",
        component: () => import("../pages/pageAdmin/Bookings.vue"),
      },
      {
        path: "baiviet",
        name: "Baiviet",
        component: () => import("../pages/pageAdmin/Posts.vue"),
      },
      {
        path: "quanlyloaiphong",
        name: "QuanLyLoaiPhong",
        component: () => import("../pages/pageAdmin/QLLoaiPhong.vue"),
      },
      {
        path: "qlnguoidung",
        name: "QuanLyNguoiDung",
        component: () => import("../pages/pageAdmin/QLTKnguoidung.vue"),
      },
      {
        path: "qlnhanvien",
        name: "QLNhanVien",
        component: () => import("../pages/pageAdmin/QLTKnhanvien.vue"),
      },
      {
        path: "qldanhgia",
        name: "QLDanhGia",
        component: () => import("../pages/pageAdmin/QLdanhgia.vue"),
      },
      {
        path: "qldichvu",
        name: "QLDichVu",
        component: () => import("../pages/pageAdmin/QLdichvu.vue"),
      },
      
    ],
  },
];
