<template >
<div class="wrapper">
		<div class="authentication-forgot d-flex align-items-center justify-content-center">
			<div class="card forgot-box">
				<div class="card-body">
					<div class="p-4 rounded  border">
						<div class="text-center">
							<img src="../../assets/images/icons/forgot-2.png" width="120" alt="" />
						</div>
						<h4 class="mt-5 font-weight-bold">Bạn quên mật khẩu ?</h4>
						<p class="text-muted">Nhập email để đặt lại mật khẩu</p>
						<div class="my-4">
							<label class="form-label">Địa chỉ email</label>
							<input type="text" class="form-control form-control" placeholder="Nhập email" />
						</div>
						<div class="text-center">
							<button type="button" class="btn btn-primary  w-100">Gửi</button> 
                            <router-link to="/admin/login" ><button  class="btn btn-outline-danger mt-1 radius-30 "><i class='bx bx-arrow-back me-1'></i>Back to Login</button></router-link>
                            
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
    
}
</script>
<style >
    
</style>