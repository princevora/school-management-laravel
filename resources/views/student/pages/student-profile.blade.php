@extends('student.layouts.sidebar')
        @section('content')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('admin/account/notifications')}}"
                        ><i class="bx bx-bell me-1"></i> Notifications</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('admin/account/connections')}}"
                        ><i class="bx bx-link-alt me-1"></i> Connections</a
                      >
                    </li>
                  </ul>
                <form id="formAccountSettings" enctype="multipart/form-data" method="POST">
                    @csrf
                  <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4 ">
                        <img
                          src="{{isset($student) && $student->avatar !== null ? asset('storage/student/'.$student->avatar) : url('../assets/img/avatars/1.png')}}"
                          alt="Student Profile"
                          class="d-block rounded loader sm-4"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              name="student_avatar"
                              accept="image/png, image/jpeg"
                            />
                          </label>
                          <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                          </button>

                          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                     <div class="card-body">
                        <div class="row">
                          @if ($student->verification_status !== 99)
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">E-mail</label>
                              <input
                                class="form-control"
                                type="text"
                                id="email"
                                name="email"
                                value="{{$student->student_email}}"
                                placeholder="john.doe@example.com"
                              />
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="staff-phone" class="form-label">Phone No.</label>
                              <input
                                class="form-control"
                                type="text"
                                id="student_phone"
                                name="student_phone"
                                value="{{$student->student_phone}}"
                                placeholder="121 234 4567"
                              />
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        </form>
                          @else
                            <div class="card">
                              <div class="card-body">
                                <div class="card-title">
                                  <h4>Account Disabled</h4>
                                </div>
                                <p>The Account details Cannot Be Changed When The Standerd Of the Student Was Deleted By Staff Ask The Staff To Readd the standerd To The Server</p>
                              </div>
                            </div>
                          @endif
                    </div>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <script>
      
        @if(session()->has('success'))
            toastr.option = {
                closeButton: true,
            }

            toastr.success('{{session('success')}}', 'Success', 7000);
        @elseif(session()->has('error'))
            toastr.option = {
                closeButton: true,
            }

            toastr.error('{{session('error')}}', 'Error', 7000);
        @endif
    </script>
    @endsection
