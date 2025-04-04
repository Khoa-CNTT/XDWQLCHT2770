
import { createRouter, createWebHistory } from 'vue-router';
import adminRoutes from './admin.js';
import userRoutes from './user.js';

// Định nghĩa các route chính
const routes = [

  ...adminRoutes, // Routes của Admin
  ...userRoutes // Routes của User
 
];


const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;