export default [
  {
    path: "/user",
    component: () => import("../layouts/LayoutUser/index.vue"), // Layout chính của Admin
    children: [
      {
        path: "/home",
        name: "Home",
        component: () => import("../pages/pageUser/home.vue"),
      },
      {
        path: "",
        redirect: { name: "Home" },
      },
    ],
  },
];
