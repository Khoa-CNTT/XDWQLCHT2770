export default [
    {
      path: '/user',
      component: () => import('../layouts/LayoutAdmin/index.vue'), // Layout chính của Admin
      children: [
        {
        },
      ],
    },
  ];