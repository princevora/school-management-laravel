@extends('admin.layouts.sidebar')
      @section('content')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Students Data</h4>
              <hr class="my-5" />
              <div class="card row">
                <h5 class="card-header">Students</h5>
                <div class="navbar-nav align-items-center">
                 <form action="{{url('search')}}" method="POST" onsubmit="return false;">
                  @csrf
                  <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                      type="text"
                      class="form-control border-0 shadow-none"
                      placeholder="Search By Id,Name etc.."
                      aria-label="Search By Id,Name etc.."
                      id="searchStudent"
                    />
                  </div>
                 </form>
                </div>
                <div class="col-sm-4">
                  <button type="button" class="btn btn-secondary" id="selectAll">Select All</button>
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="form-data">
                  </div>
                  <form action="{{url('action/delete')}}" method="POST" id="studentData" onsubmit="return false;">
                    @csrf
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Select</th>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Roll No</th>
                        <th>Phone no</th>
                        <th>Address</th>
                        <th>Standerd</th>
                        <th>Div</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($studentDATA as $students)  
                    <tr>
                        <td>
                          <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="student[{{$students->id}}]">
                        </div>
                      </td>
                        <td>{{$students->id}}</td>                        
                        <td>
                          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            {{Str::title($students->student_name)}}
                            <li
                              data-bs-toggle="tooltip"
                              data-popup="tooltip-custom"
                              data-bs-placement="top"
                              class="avatar avatar-xs pull-up"
                              title="{{Str::title($students->student_name)}}"
                            >
                            <img src="{{$students->avatar !== null || $students->avatar === '' ? asset('storage/student/'.$students->avatar.'') : 'https://xsgames.co/randomusers/avatar.php?g=male'}}" alt="Avatar" class="rounded-circle" />
                          </li>
                        </ul>
                      </td>
                      <td>
                          @if ($students->roll_no == 0)
                            <span class="badge bg-warning">Unverified</span>
                          @else                              
                            {{$students->roll_no}}
                          @endif
                      </td>
                      <td>
                        @if ($students->student_phone == 0)
                            <span class="badge bg-dark">Unverified</span>
                        @else                              
                            {{$students->student_phone}}
                        @endif
                      </td>
                      <td>
                        @if ($students->student_address == 0)
                          <span class="badge bg-dark">Unverified</span>
                        @else                              
                            {{$students->student_address}}
                        @endif
                      </td>
                      <td>
                        @if ($students->student_standerd == 0)
                          <span class="badge bg-primary">Unverified</span>
                        @else                              
                            {{$students->student_standerd}}
                        @endif
                      </td>
                      <td>
                        @if ($students->student_div == 0)
                          <span class="badge bg-secondary">Unverified</span>
                        @else                              
                            {{$students->student_div}}
                        @endif
                      </td>
                      <td>
                        <a href="{{url('admin/students/view/'.$students->id.'')}}" data-toggle="tooltip" title="View : {{Str::title($students->student_name)}}">
                          <i class="fa-regular fa-eye" style="color: red"></i>
                        </a>
                      </td>
                      <td>
                        @if ($students->student_div == 0)

                        @else                              
                          <a href="{{url('update/'.$students->id)}}"><i class="bx bx-pencil"></i> Edit</a>
                        @endif
                      </td>
                      <td>
                          <a class="dropdown-item" href="{{url('action/delete/'.$students->id)}}"
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
                {{$studentDATA ->links('pagination::bootstrap-5')}}
              </div>
            </div>
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
          
          $('#selectAll').on('click', function(){
            let checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
              checkbox.checked =! checkbox.checked;
            });     
          });
          $('#searchStudent').on('keyup', function(){
            let search = $(this).val();
            $.ajax({
              url: 'data-table/search',
              method: 'GET',
              data: {
                search: search,
              },
              success: function(response){
                $('#studentData').hide();
                $('#paginate-data').hide();
                $('.form-data').html(response.html);
              }
            });
            const urlBase = "data-table?search=" + search; 
            history.pushState(null,null,urlBase);
          });
      });
    </script>
    @endsection
