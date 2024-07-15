@extends('admin.layouts.sidebar')
      @section('content')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Staffs</h4>
              <hr class="my-5" />
              <div class="card row">
                <h5 class="card-header">Staff</h5>
                <div class="col-sm-4">
                </div>
                <div class="navbar-nav align-items-center data-table">

                 {{-- <form action="{{url('search')}}" method="POST">
                  @csrf
                  <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                      type="text"
                      class="form-control border-0 shadow-none"
                      placeholder="Search B"
                      aria-label="Search By Id,Name etc.."
                      id="searchStudent"
                    />
                  </div>
                 </form> --}}
                </div>
                <div class="col-sm-4 d-inline-block me-2">
                  <div class="d-inline-block me-2">

                  </div>
                  <button
                    type="button"
                    class="btn btn-dark"
                    data-bs-toggle="modal"
                    data-bs-target="#modalCenter"
                  >Add Staff</button>
                </div>

                <div class="table-responsive text-nowrap">
                  <div class="form-data">
                  </div>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Staff Mobile</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($staffDATA as $staff)
                    <tr>
                      <td>
                        {{$staff->id}}
                      </td>
                      <td>
                          {{$staff->staff_name}}
                      </td>
                      <td>
                        {{$staff->staff_phone}}
                      </td>
                      @if ($staff->staff_role !== 'principal')
                        <td>
                          <a class="dropdown-item" href="{{url('staff/delete/'.$staff->id)}}"
                            ><i style="color: red" class="bx bx-trash me-1"></i> Delete</a
                          >
                        </td>
                      @else
                        <td></td>
                      @endif
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
              <!--/ Striped Rows -->
            </div>
            <div class="d-flex justify-content-center" >
              <div class="paginate-data" id="paginate-data">
                {{$staffDATA ->links('pagination::bootstrap-5')}}
              </div>
            </div>
            <div class="content-backdrop fade"></div>
          </div>
          {{-- Model Add Staff --}}
          <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col mb-3">
                      <form id="add-standerd-form">
                        <div class="card-body">
                            <div class="row">
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
                      </form>
                    </div>
                  </div>
                </div>
              </div>
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
$(document).ready( function(){
  //errors And success toasts
    @if(session()->has('error')){
      toastr.option = {
        'closeButton': true,
      }
      toastr.error('{{session('error')}}','Error',7000);
    }

    @elseif(session()->has('success')){
      toastr.option = {
        'closeButton': true,
      }
      toastr.success('{{session('success')}}','! Success',7000);
    }
    @endif


    //Ajx req to add staff..
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
          toastr.success('The Staff Has Been Successfully Added', 'Success!', {timeout: 6600});
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
