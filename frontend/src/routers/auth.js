import { useAdminStore } from '../stores/useAdminStore';
import { createToaster } from '@meforma/vue-toaster';

const toaster = createToaster({ position: 'top-right' });

export default async function (to, from, next) {
  const adminStore = useAdminStore();

  // Khởi tạo trạng thái đăng nhập từ token trong localStorage
  await adminStore.initializeAuth();

  // Nếu không có token hoặc chưa đăng nhập, chuyển hướng đến trang đăng nhập
  if (!adminStore.isLoggedIn) {
    toaster.warning('Vui lòng đăng nhập để tiếp tục.');
    next('/admin/login');
    return;
  }

  try {
    // Kiểm tra token hợp lệ thông qua API
    await adminStore.checkToken();
    // Nếu token hợp lệ, tiếp tục điều hướng
    next();
  } catch (error) {
    // Nếu token không hợp lệ, đăng xuất và chuyển hướng đến trang đăng nhập
    await adminStore.logout();
    toaster.error('Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
    next('/admin/login');
  }
}