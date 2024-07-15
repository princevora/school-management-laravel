@extends('admin.layouts.sidebar')
      @section('content')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Standerds</h4>
              <hr class="my-5" />
              <div class="card row">
                <h5 class="card-header">Standerds</h5>
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
                  <div class=" select-all d-inline-block me-2">
                    
                  </div>
                  <button
                    type="button"
                    class="btn btn-dark"
                    data-bs-toggle="modal"
                    data-bs-target="#AddStanderd"
                  >Add Standerd</button>
                </div>
                
                <div class="table-responsive text-nowrap">
                  <div class="form-data">
                  </div>
                  <form action="{{url('standerds/delete')}}" method="POST" id="studentData">
                    @csrf
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th><input class="form-check-input select-all-standerd" type="checkbox" name="select-all"></th>
                        <th>#</th>
                        <th>Standerds</th>
                        <th>Divisions</th>
                        <th>Limit</th>
                        <th>View Students</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($stdDATA as $standerd)  
                    <tr>
                        <td>
                          <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="standerd[{{$standerd->id}}]">
                        </div>
                      </td>
                        <td>{{$standerd->id}}</td>                        
                      <td>
                          {{$standerd->standerd}}
                      </td>
                      <td>
                        {{$standerd->divs}}
                      </td>
                      <td>
                        {{$standerd->limit}}
                      </td>
                      <td>
                        <button name="inspect" class="btn btn-light" type="button" data-bs-target="#ViewStudent" data-bs-toggle="modal" value="{{$standerd->id}}">
                        <i class="fa-regular fa-eye"></i>
                          View
                        </button>
                      </td>
                      <td>
                          <a class="dropdown-item" name="DeleteStanderd" href="{{url('standerd/delete/'.$standerd->id)}}"
                            ><i style="color: red" class="bx bx-trash me-1"></i> Delete</a
                          >
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
              <button type="submit" class="btn btn-primary" id="delete-selected">Delete Selected</button>
            </div>
          </form>
              <!--/ Striped Rows -->
            </div>
            <div class="d-flex justify-content-center" >
              <div class="paginate-data" id="paginate-data">
                {{isset($stdDATA->links) ? $stdDATA->links('pagination::bootstrap-5') : ''}}
              </div>
            </div>
            <div class="content-backdrop fade"></div>

            {{-- Model View Students --}}
            <div class="modal fade" id="ViewStudent" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body students-content text-center">
                          <!-- Add your content here -->
                      </div>
                  </div>
              </div>
            </div>

            {{-- Model Add Standerd --}}
            
            <div class="modal fade" id="AddStanderd" tabindex="-1" aria-hidden="true">
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
                                <div class="col-6">
                                  <label for="selectStanderd" class="form-label">Select Standerd</label>
                                  <select class="form-select" id="selectStanderd" aria-label="Default select example" name="standerd" required>
                                    <option selected disabled>Select Standerd</option>
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
                                  <label for="selectDiv" class="form-label">Select Standerd Division</label>
                                  <select class="form-select" id="selectDiv" aria-label="Default select example" name="student_div">
                                    <option selected disabled>Select Division</option>
                                    <option value="a">DIV - A</option>
                                    <option value="b">DIV - B</option>
                                    <option value="c">DIV - C</option>
                                    <option value="d">DIV - D</option>
                                    <option value="e">DIV - E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label" for="students-limit">Students Limit</label>
                                <div class="input-group input-group-merge">
                                  <span id="students-limit-standerd" class="input-group-text"
                                    ><i class="bx bx-group"></i
                                  ></span>
                                  <input
                                    type="text"
                                    name="limit"
                                    id="students-limit"
                                    class="form-control phone-mask"
                                    placeholder="xxx"
                                    aria-label="xxx"
                                    aria-describedby="students-limit-standerd"
                                  />
                                </div>
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
        $('a[name="DeleteStanderd"]').on('click', function (e) {
          if(!confirm('Are You Sure')){
            e.preventDefault();
          }
        });
        // View Student
        $('button[name="inspect"]').on('click', function(){
          let id = $(this).val();
          $.ajax({
            url: "{{url('admin/standerd/get-students')}}",
            data: {
              standerd_id: id,
            },
            beforeSend: function () {
              $('.students-content').html('<div class="spinner-border text-secondary spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
            },
            success: function (response) {
              $('.students-content').html(response.students);
            },
            error: function(xhr, response){
              const e = xhr.responseJSON;
              if(e.message == 0){
                // console.log(e.message);
                $('.students-content').html('<h5>No Student Found<h5>');
              }
            }
          });
        });
        //show select all buttton if the data exists..
        // let td = $('td');
        // if(td.length > 0){
        //   $('.select-all').html('<button type="button" class="btn btn-secondary" id="selectAll">Select All</button>');
        // }
          
        $('.select-all-standerd').on('change', function() {
          let isChecked = this.checked;
          let checkboxes = document.querySelectorAll('input[type="checkbox"]');
          checkboxes.forEach(checkbox => {
              checkbox.checked = isChecked;
          });
        });


          //ajax For Add standerd
                  //Prevent form to submit..
        $("#add-standerd-form").on("submit", function (e) {
            e.preventDefault();
        });

        //Ajax Request.
        $('.btn-sub').click(function (){
          // $('#proccess-data').show();
          $(this).html('Proccesing <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>');
          $(this).prop('disabled',true);

          //Phone
          const limit = $('input[name=limit]').val();
          // Standerd
          const standerd = $('#selectStanderd option:selected').val();
          //Division
          const div = $('#selectDiv option:selected').val();

          $.ajax({
            url: '{{url('action/add-standerd')}}',
            method: 'POST',
            data: {
              _token: '{{csrf_token()}}',
              standerd:standerd,
              standerd_div:div,
              standerd_limit: limit,
            },
            success: function(message){
              $('#submit_student').removeClass('btn-primary');
              setTimeout(() => {
                $('#submit_student').html('<span class="material-symbols-outlined check">check_circle</span>');
                $('.button-submit').addClass(' animate-left-to-right');
                $('#submit_student').css('background-color','#00FA9A');
                toastr.options = {
                  'closeButton' :  true,
                }
                toastr.success('The Standerd Has Been Submited..', 'Success!', {timeout: 6600});
              }, 3000);
              setTimeout(() => {
                $('#submit_student').prop('disabled',false);
                $('#submit_student').addClass('btn-primary');
                $('#submit_student').html('Submit');
                $('#submit_student').removeAttr('style');
                @if(isset($student))
                  // PHP code
                @else
                    $('#formAddStudent :input').val('');
                @endif
              }, 8000);
            },
            error: function(xhr){
              let getErr = xhr.responseJSON.message;
              toastr.options = {
                    'closeButton' :  true,
                  }
              toastr.error(getErr, 'Error Occured', {timeout: 6600});
              $('#submit_student').prop('disabled',false);
              $('#submit_student').addClass('btn-primary');
              $('#submit_student').html('{{isset($student)? 'Update Student' : 'Submit'}}');
              $('#submit_student').removeAttr('style');
            }
          });
        });
      });
    </script>
    @endsection
