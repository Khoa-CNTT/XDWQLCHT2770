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
        component: () => import("../pages/pageAdmin/Room.vue"),
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
    ],
  },
];
