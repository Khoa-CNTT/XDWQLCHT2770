<template>
    <div class="wrapper">
         <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
             <div class="container-fluid">
                 <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                     <div class="col mx-auto">
                         <div class="mb-4 text-center">
                             <img src="../../../public/logodark.png" width="180" alt="">
                         </div>
                         <div class="card">
                             <div class="card-body">
                                 <div class="border p-4 rounded">
                                     <div class="text-center">
                                         <h3 class="">Đăng nhập</h3>
                                         <p>Don't have an account yet? <a href="authentication-signup.html">Sign up here</a>
                                         </p>
                                     </div>
                                     
                                     <div class="login-separater text-center mb-4"> 
                                         <hr>
                                     </div>
                                     <div class="form-body">
                                         <form class="row g-3">
                                             <div class="col-12">
                                                 <label for="inputEmailAddress" class="form-label">Tên đăng nhập</label>
                                                 <input type="email" class="form-control" id="inputEmailAddress" placeholder="Tên đăng nhập">
                                             </div>
                                             <div class="col-12">
                                                 <label for="inputChoosePassword" class="form-label">Mật khẩu</label>
                                                 <div class="input-group" id="show_hide_password">
                                                     <input type="password" class="form-control border-end-0" id="inputChoosePassword"  placeholder="Nhập mật khẩu"> <a href="javascript:;" class="input-group-text bg-transparent"><i class="bx bx-hide"></i></a>
                                                 </div>
                                             </div>
                                             <div class="col-md-6">
                                                 <div class="form-check form-switch">
                                                     <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                                                     <label class="form-check-label" for="flexSwitchCheckChecked">Lưu mật khẩu</label>
                                                 </div>
                                             </div>
                                             <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Quên mật khẩu ?</a>
                                             </div>
                                             <div class="col-12">
                                                 <div class="d-grid">
                                                     <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Đăng nhập</button>
                                                 </div>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!--end row-->
             </div>
         </div>
     </div>
 </template>
 <script>
 export default {
 
 }
 </script>
 <style></style>