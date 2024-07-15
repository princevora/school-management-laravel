@extends('admin.layouts.sidebar')

<!-- Layout container -->
<!-- Navbar -->
        @section('content')      
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Staff/</span> {{isset($title) ? $title : 'Add Staff'}}</h4>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">{{isset($title) ? $title : 'Add Staff'}}</h5>
                    </div>
                  <form id="formAddStudent">
                    <div class="card-body">
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-student-name">Staff Full Name</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              name="staff-name"
                              class="form-control"
                              id="basic-icon-default-student-name"
                              placeholder="John Doe"
                              aria-label="John Doe"
                              aria-describedby="basic-icon-default-fullname2"
                              {{-- value="{{isset($student)? $student->student_name : ''}}" --}}
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                            <input
                              type="email"
                              name="staff-email"
                              id="basic-icon-default-email"
                              class="form-control"
                              placeholder="example@email.com"
                              aria-describedby="basic-icon-default-email2"
                              autocomplete="username"
                            />
                          </div>
                          <div class="form-text">You can use letters, numbers & periods</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-password">Password</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class='bx bxs-low-vision'></i></span>
                            <input
                              type="password"
                              name="password"
                              class="form-control"
                              placeholder="password"
                              autocomplete="current-password"
                              id="basic-icon-default-password"
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-phone2" class="input-group-text"
                              ><i class="bx bx-phone"></i
                            ></span>
                            <input
                              type="text"
                              size="10"
                              maxlength="10"
                              name="staff-phone"
                              id="basic-icon-default-phone"
                              class="form-control phone-mask"
                              placeholder="658 799 8941"
                              aria-label="658 799 8941"
                              aria-describedby="basic-icon-default-phone2"
                              {{-- value="{{isset($student)? $student->student_phone : ''}}" --}}
                            />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <label for="selectStanderd" class="form-label">Select Gender</label>
                            <select class="form-select" id="select-staff-gender" aria-label="Default select example" name="staff-gender" required>
                              <option selected disabled>Select Gender</option>
                              {{-- <option selected disabled value="{{isset($student)? $student->student_standerd : 'Select Standerd'}}">{{isset($student)? $student->student_standerd : 'Select Standerd'}}</option> --}}
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                          </div>
                        <div class="mt-3 d-flex justify-content-center button-submit">
                          <button class="btn btn-primary col-12 btn-sub" id="submit_student" type="button">
                              Submit
                              <div class="success">
                                
                              </div>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
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
      $(document).ready(function (){
        $('.btn-sub').click(function (){

          // $('#proccess-data').show();
          $(this).html('Proccesing <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>');
          $(this).prop('disabled',true);

          //submit data
          const name = $('input[name=staff-name]').val();
          //Address
          const address = $('input[name=staff-address]').val();
          //email
          const email = $('input[name=staff-email]').val();
          //Password
          const password = $('input[name=password]').val();
          //Phone
          const phone = $('input[name=staff-phone]').val();
          // Staff Gender
          const gender = $('#select-staff-gender option:selected').val();

          $.ajax({
            url: '{{url('action/add-staff')}}',
            method: 'POST',
            data: {
              _token: '{{csrf_token()}}',
              staff_name:name,
              staff_gender:gender,
              staff_email:email,
              staff_password:password,
              staff_phone:phone,
              staff_address: address,
            },
            success: function(){
              $('#submit_student').removeClass('btn-primary');
              setTimeout(() => {
                $('#submit_student').html('<span class="material-symbols-outlined check">check_circle</span>');
                $('.button-submit').addClass(' animate-left-to-right');
                $('#submit_student').css('background-color','#00FA9A');
                toastr.options = {
                  'closeButton' :  true,
                }
                toastr.success('The Student Has Been {{isset($student)? 'Updated' : 'Submited'}}..', 'Success!', {timeout: 6600});
              }, 3000);
              setTimeout(() => {
                $('#submit_student').prop('disabled',false);
                $('#submit_student').addClass('btn-primary');
                $('#submit_student').html('{{isset($student)? 'Update Student' : 'Submit'}}');
                $('#submit_student').removeAttr('style');
                @if(isset($student))
                  // PHP code
                @else
                    $('#formAddStudent :input').val('');
                @endif
              }, 8000);
            },
            error: function(xhr, error){
              const response = xhr.responseJSON;
              toastr.options = {
                closeButton : true
              }
              toastr.error(response.error + '..','Error!');
              $('#submit_student').html('Submit');
              $('#submit_student').prop('disabled',false);
            }
          });
        });
      });
    </script>
  @endsection