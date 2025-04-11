export default [
  {
    //admin
    path: "/",
    component: () => import("../layouts/LayoutUser/index.vue"), // Layout chính của User
    children: [
      {
        path: "home",
        name: "Home",
        component: () => import("../pages/pageUser/home.vue"),
      },
      {
        path: "",
        redirect: { name: "Home" },
      },
      {
        path: "post",
        name: "Post" ,
        component: () => import("../pages/pageUser/Post.vue"),
      },
      {
        path: "room",
        name: "Room" ,
        component: () => import("../pages/pageUser/Rooms.vue"),
      },
      {
        path: "roomdetail",
        name: "RoomDetail" ,
        component: () => import("../pages/pageUser/RoomDetails.vue"),
      },
      // user
    ],
  },
];
