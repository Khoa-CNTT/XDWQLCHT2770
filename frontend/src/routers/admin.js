// src/routers/admin.js
export default [
    {
      path: '/admin',
      component: () => import('../layouts/LayoutAdmin/index.vue'), // Layout chính của Admin
      children:[
        {
          path: 'home',
          name: 'AdminHome',
          component: () => import('../pages/pageAdmin/Home.vue'),
        },
        {
          path: '',
          redirect: { name: 'AdminHome' },
        },
      ],
    },
  ];