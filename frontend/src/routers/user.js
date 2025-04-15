export default [
  {
    //admin
    path: "/",
    component: () => import("../layouts/LayoutUser/index.vue"), // Layout chính của User
    children: [
      {
        path: "home",
        name: "Home",
        component: () => import("../pages/PageUser/Home.vue"),
      },
      {
        path: "",
        redirect: { name: "Home" },
      },
      {
        path: "post",
        name: "Post",
        component: () => import("../pages/PageUser/Post.vue"),
      },

      {
        path: "roomdetail",
        name: "RoomDetail",
        component: () => import("../pages/PageUser/RoomDetails.vue"),
      },
      {
        path: "login",
        name: "Login",
        component: () => import("../pages/pageUser/Login.vue"),
      },
      {
        path: "register",
        name: "Register",
        component: () => import("../pages/pageUser/Register.vue"),
      },
      {
        path: "postdetail",
        name: "PostDetail",
        component: () => import("../pages/pageUser/PostDetails.vue"), 
      },
      {
        path: "login",
        name: "Login",
        component: () => import("../pages/pageUser/Login.vue"),
      },
      {
        path: "register",
        name: "Register",
        component: () => import("../pages/pageUser/Register.vue"),
      },
      {
        path: "postdetail",
        name: "PostDetail",
        component: () => import("../pages/pageUser/PostDetails.vue"), 
      },
    ],
  },
];
