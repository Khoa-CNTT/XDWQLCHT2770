// src/routers/admin.js
export default [
    {
      path: '/admin',
      component: () => import('../layouts/LayoutAdmin/index.vue'), // Layout chính của Admin
      children:[
        {
          path: '/dashboard',
          name: 'AdminDashBoard',
          component: () => import('../pages/pageAdmin/DashBoard.vue'),
        },
        {
          path: '',
          redirect: { name: 'AdminDashBoard' },
        },
      ],
    },
  ];