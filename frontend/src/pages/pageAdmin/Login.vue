<template >
  <div style="">
    <div class="wrapper">
      <div
        class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0"
      >
        <div class="container-fluid">
          <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col mx-auto">
              <div class="mb-4 text-center">
                <img src="./assets/images/logo-img.png" width="180" alt="" />
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="border p-4 rounded">
                    <div class="text-center">
                      <h3 class="">Sign in</h3>
                    </div>

                    <hr />
                    <div class="form-body">
                      <form class="row g-3">
                        <div class="col-12">
                          <label for="inputEmailAddress" class="form-label"
                            >User Name</label
                          >
                          <input
                            type="text"
                            class="form-control"
                            id="inputEmailAddress"
                            placeholder="User name"
                          />
                        </div>
                        <div class="col-12">
                          <label for="inputChoosePassword" class="form-label"
                            >Enter Password</label
                          >
                          <div class="input-group" id="show_hide_password">
                            <input
                              type="password"
                              class="form-control border-end-0"
                              id="inputChoosePassword"
                              value=""
                              placeholder="Enter Password"
                            />
                            <a
                              href="javascript:;"
                              class="input-group-text bg-transparent"
                              ><i class="bx bx-hide"></i
                            ></a>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-check form-switch">
                            <input
                              class="form-check-input"
                              type="checkbox"
                              id="flexSwitchCheckChecked"
                              checked=""
                            />
                            <label
                              class="form-check-label"
                              for="flexSwitchCheckChecked"
                              >Remember Me</label
                            >
                          </div>
                        </div>
                        <div class="col-md-6 text-end">
                        <router-link to="/admin/forgotpassword" >  <a href="authentication-forgot-password.html"
                            >Forgot Password ?</a
                          ></router-link>
                        </div>
                        <div class="col-12">
                          <div class="d-grid">
                           <router-link to="/admin/dashboard"> <button type="submit" class="btn btn-primary w-100">
                              <i class="bx bxs-lock-open"></i>Sign in
                            </button></router-link>
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
  </div>
</template>
<script>
$(document).ready(function () {
  $("#show_hide_password a").on("click", function (event) {
    event.preventDefault();
    if ($("#show_hide_password input").attr("type") == "text") {
      $("#show_hide_password input").attr("type", "password");
      $("#show_hide_password i").addClass("bx-hide");
      $("#show_hide_password i").removeClass("bx-show");
    } else if ($("#show_hide_password input").attr("type") == "password") {
      $("#show_hide_password input").attr("type", "text");
      $("#show_hide_password i").removeClass("bx-hide");
      $("#show_hide_password i").addClass("bx-show");
    }
  });
});

export default {};
</script>
<style >
</style>