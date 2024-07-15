@extends('admin.layouts.sidebar')
      @section('content')      
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Students/</span> {{isset($title) ? $title : 'Add Student'}}</h4>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">{{isset($title) ? $title : 'Add Student'}}</h5>
                    </div>
                  <form id="formAddStudent">
                    <div class="card-body">
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-student-name">Full Name</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              name="student_name"
                              class="form-control"
                              id="basic-icon-default-student-name"
                              placeholder="John Doe"
                              aria-label="John Doe"
                              aria-describedby="basic-icon-default-fullname2"
                              value="{{isset($student)? $student->student_name : ''}}"
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-student-roll">Student Roll No.</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-roll" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="number"
                              name="student_roll"
                              class="form-control"
                              id="basic-icon-default-student-roll"
                              placeholder="123"
                              aria-label="123"
                              aria-describedby="basic-icon-default-fullname2"
                              value="{{isset($student)? $student->roll_no : ''}}"
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-address">Address</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"
                              ><i class="bx bx-buildings"></i
                            ></span>
                            <input
                              type="text"
                              name="student_address"
                              id="basic-icon-default-address"
                              class="form-control"
                              placeholder="Street 123."
                              aria-label="Street 123."
                              aria-describedby="basic-icon-default-company2"
                              value="{{isset($student)? $student->student_address : ''}}"
                            />
                          </div>
                        </div>
                      @if(!isset($student))
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                            <input
                              type="email"
                              name="student_email"
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
                              name="student_password"
                              class="form-control"
                              placeholder="password"
                              autocomplete="current-password"
                              id="basic-icon-default-password"
                            />
                          </div>
                        </div>
                      @endif
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
                              name="student_phone"
                              id="basic-icon-default-phone"
                              class="form-control phone-mask"
                              placeholder="658 799 8941"
                              aria-label="658 799 8941"
                              aria-describedby="basic-icon-default-phone2"
                              value="{{isset($student)? $student->student_phone : ''}}"
                            />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <label for="selectStanderd" class="form-label">Select Standerd</label>
                            <select class="form-select" id="selectStanderd" aria-label="Default select example" name="student_standerd" required>
                              <option selected disabled value="{{isset($student)? $student->student_standerd : 'Select Standerd'}}">{{isset($student)? $student->student_standerd : 'Select Standerd'}}</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                            </select>
                            <span class="text-danger">@error('student_standerd')
                            @enderror</span>
                          </div>
                          <div class="col-6">
                            <label for="selectDiv" class="form-label">Select Division</label>
                            <select class="form-select" id="selectDiv" aria-label="Default select example" name="student_div">
                              <option selected disabled value="{{isset($student)? $student->student_div : 'Select Division'}}">{{isset($student)? $student->student_div : 'Select Division'}}</option>
                              <option value="a">DIV - A</option>
                              <option value="b">DIV - B</option>
                              <option value="c">DIV - C</option>
                              <option value="d">DIV - D</option>
                              <option value="e">DIV - E</option>
                            </select>
                          </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center button-submit">
                          <button class="btn btn-primary col-12 btn-sub" id="submit_student" type="button">
                             {{isset($student)? 'Update Student' : 'Submit'}}
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
          const name = $('input[name=student_name]').val();
          //Address
          const address = $('input[name=student_address]').val();
          //email
          const email = $('input[name=student_email]').val();
          //Password
          const password = $('input[name=student_password]').val();
          //Roll
          const roll = $('input[name=student_roll]').val();
          //Phone
          const phone = $('input[name=student_phone]').val();
          // Standerd
          const standerd = $('#selectStanderd option:selected').val();
          //Division
          const div = $('#selectDiv option:selected').val();

          $.ajax({
            url: '{{isset($student)? url('action/update-student') : url('action/add-student')}}',
            method: 'POST',
            data: {
              _token: '{{csrf_token()}}',
              student_name:name,
              student_email:email,
              student_password:password,
              student_phone:phone,
              student_standerd:standerd,
              student_div:div,
              student_address: address,
              student_roll: roll,
              {{isset($student)? 'student_id: '.$student->id : '' }}
            },
            success: function(message){
              if(message.message == 'success'){
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
              }
              else if(message.error){
                toastr.options = {
                  closeButton : true
                }
                toastr.error(message.error + '..','Error!');
                $('#submit_student').html('Submit');
                $('#submit_student').prop('disabled',false);
              }
            },
          });
        });
      });
    </script>
  @endsection