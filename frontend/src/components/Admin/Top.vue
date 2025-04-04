<template >
   <div class="topbar d-flex align-items-center">
					<nav class="navbar navbar-expand">
						<div class="topbar-logo-header">
							<div class="">
								<img src="../../../public/logodark.png" style=" height:40px; width:auto" class="logo-icon" alt="logo icon">
							</div>
							
						</div>
						<div class="mobile-toggle-menu"><i class="bx bx-menu"></i></div>
					
						
						<div class="user-box dropdown">
							<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<img src="../../../public/logodark.png" class="user-img" alt="user avatar">
								<div class="user-info ps-3">
									<p class="user-name mb-0">Admin</p>
									<p class="designattion mb-0">Manager</p>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-menu-end">
								<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>Profile</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-home-circle"></i><span>Dashboard</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-dollar-circle"></i><span>Earnings</span></a>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-download"></i><span>Downloads</span></a>
								</li>
								<li>
									<div class="dropdown-divider mb-0"></div>
								</li>
								<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-log-out-circle"></i><span>Logout</span></a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
</template>
<script>
export default {
    
}
</script>
<style >
    
</style>