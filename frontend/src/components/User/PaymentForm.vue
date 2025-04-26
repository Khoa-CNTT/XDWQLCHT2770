<template>
    <div class="card shadow-sm">
      <div class="card-body">
        <h5>Xác nhận thanh toán</h5>
        
      <!-- QR thanh toán -->
      <div class="text-center mb-4">
        <h5>Quét mã QR để thanh toán bằng PayOS</h5>
        <img
          src="https://img.vietqr.io/image/970422-1234567890-compact2.png?amount=700000&addInfo=ThanhToanHomestay"
          alt="QR PayOS demo"
          class="img-fluid"
          style="max-width: 250px"
        />
        <p class="mt-2 text-muted">Mã QR demo — chưa kết nối API thật</p>
      </div>
  
      <div class="mt-3">
        <button class="btn btn-secondary me-2" @click="$emit('back')">Quay lại xác nhận</button>
        <button class="btn btn-success" disabled>Đã thanh toán</button>
      </div>
      </div>
  
    </div>
  </template>
  
  <script>
  export default {
   
  };
  </script>
  