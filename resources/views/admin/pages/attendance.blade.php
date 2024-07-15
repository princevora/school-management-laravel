@extends('admin.layouts.sidebar')
      @section('content')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Attendance /</span> {{isset($title)? $title : 'Students' }}</h4>
              <hr class="my-5" />
              <div class="card row">
                <h5 class="card-header">{{isset($title)? $title : 'Students' }}</h5>
                <h6 class="text-center">Total Students <strong>{{$total}}</strong></h6>
                <h6 class="text-center"><strong>{{isset($heading)? $heading : 'Select the Status For Submit The Students'}}</strong></h6>
                <div class="col-sm-4">
                </div>
                <div class="navbar-nav align-items-center data-table">
                </div>
                <div class="table-responsive text-nowrap">
                  <div class="form-data">
                  </div>
                  <form action="{{isset($submitURL)? $submitURL : url('action/take-atd')}}" method="POST" id="atdData">
                    @csrf
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Absent</th>
                        <th>Present</th>
                        {{-- <th>Delete</th> --}}
                      </tr>
                    </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($stdDATA as $standerd)  
                    <tr>
                        <td>{{$standerd->id}}</td>  
                      <td>
                          {{$standerd->student_name}}
                      </td>
                      <td>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="student[{{$standerd->id}}]" value="absent" {{(isset($standerd->attendance_status) && $standerd->attendance_status == 0)? 'checked' : ''}}>
                        </div>
                      </td>
                      <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="student[{{$standerd->id}}]" value="present" {{(isset($standerd->attendance_status) && $standerd->attendance_status == 1)? 'checked' : ''}}>
                          </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="d-flex justify-content-center submit-atd mt-2 mb-3">
                </div>
              </div>
            </div>
          </form>
              <!--/ Striped Rows -->
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
        //show Submit Button
        function submitData(){
            let students = $('input:radio:checked');
            if(students.length === {{$total}}){
                $('.submit-atd').html('<button type="submit" id="submitATD" class="btn btn-danger col-sm-4">Submit</button>');
            }
        }

        $('input:radio').on('change', function(){
            submitData();
        });
        
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
        });
    </script>
    @endsection
