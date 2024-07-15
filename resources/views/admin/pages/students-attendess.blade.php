@extends('admin.layouts.sidebar')
      @section('content')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Students Data</h4>
              <hr class="my-5" />
              <div class="card row bg-light">
                <h5 class="card-header">Students</h5>
                <div class="navbar-nav align-items-center">
                 <form action="{{url('attendance/data-table')}}" method="GET">
                  <div class="nav-item d-flex align-items-center">
                      <select style="border: none" class="form-select form-select-lg bg-light" name="searchStat">
                        <option selected disabled>Select</option>
                        <option value="1">Present</option>
                        <option value="0">Absent</option>
                      </select>
                    <input style="border: none; background: none;" type='date' name="atdDate" class="form-control" id="atdDATEslt"/>
                    <input
                      type="text"
                      name="q"
                      class="form-control border-0 shadow-none"
                      placeholder="By Name,id, std-div"
                      aria-label="By Name,id, std-div"
                      id="searchATD"
                      value="{{isset($search)? $search : ''}}"
                    />
                    <div class="d-grid gap-2">
                      <button type="submit" name="" id="" class="btn btn-lite"><i class="bx bx-search fs-4 lh-0"></i></button>
                    </div>
                  </div>
                 </form>
                </div>
                <hr>
                <div class="table-responsive text-nowrap">
                  <div class="form-data">
                  </div>
                  <form action="{{url('action/delete')}}" method="POST" id="studentData">
                    @csrf
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Attendance Status</th>
                        <th>Attendance Date</th>
                        <th>Student Standerd</th>
                        <th>Student Div</th>
                        <th>Edit</th>
                      </tr>
                    </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($Atds as $atd)  
                    <tr>
                      <td>
                        {{$atd->id}}
                      </td>                        
                      <td>
                        {{$atd->student_name}}
                      </td>                        
                      <td>
                        <span class="badge bg-{{($atd->attendance_status == '0')? 'secondary' : 'primary'}}">{{($atd->attendance_status == '0')? 'Absent' : 'Present'}}</span>
                      </td>
                      <td>
                        <span class="badge bg-secondary">{{$atd->created_at}}</span>
                      </td>
                      <td>
                        {{$atd->student_standerd}}
                      </td>
                      <td>
                        {{$atd->student_div}}
                      </td>
                      <td>
                        <a class="dropdown-item" href="{{url('action/take-atd?action=edit&id='.$atd->id.'&std='.$atd->student_standerd.'&div='.$atd->student_div.'&atd_date='.$atd->created_at.'')}}"
                          ><i style="color: red" class="bx bx-pencil me-1"></i> Edit</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </form>
              <!--/ Striped Rows -->
            </div>
            <div class="d-flex justify-content-center" >
              <div class="paginate-data" id="paginate-data">
                {{$Atds ->links('pagination::bootstrap-5')}}
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
        const isOnline = navigator.onLine;
        console.log(isOnline);
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
          // Get the current date
          const today = new Date();

          // Format the date in "YYYY-MM-DD" format
          const formattedDate = today.toISOString().split('T')[0];
          $('#atdDATEslt').attr('max',formattedDate);
      });
    </script>
    @endsection
