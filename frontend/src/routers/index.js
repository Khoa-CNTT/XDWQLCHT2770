
import { createRouter, createWebHistory } from 'vue-router';
import adminRoutes from './admin.js';
import userRoutes from './user.js';


// Định nghĩa các route chính
const routes = [

  ...adminRoutes, // Routes của Admin
  ...userRoutes // Routes của User
 
];

import { useAdminStore } from '../stores/useAdminStore.js';
const router = createRouter({
  history: createWebHistory(),
  routes,
});


router.beforeEach((to, from, next) => {
  const adminStore = useAdminStore();
  if (to.meta.requiresAuth && !adminStore.isLoggedIn) {
    next({ name: 'AdminLogin' });
  } else {
    next();
  }
});

export default router;