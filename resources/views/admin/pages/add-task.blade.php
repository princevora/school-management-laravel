@extends('admin.layouts.sidebar')
      @section('content')      
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Students/</span> Task</h4>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Add Task</h5>
                      <div class="row">
                        <div class="col">
                          <button onclick="ViewTask()" type="button" class="btn btn-light" id="OpenTasks" title="View Tasks" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#ViewTasks">
                            <i class="fa-solid fa-eye"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  <form id="formAddStudent">
                    <div class="card-body">
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-student-name">Task Name</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              name="task_name"
                              class="form-control"
                              id="basic-icon-default-student-name"
                              placeholder="John Doe"
                              aria-label="John Doe"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-student-roll">Task Description</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-roll" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              name="task"
                              class="form-control"
                              id="basic-icon-default-student-roll"
                              placeholder="123"
                              aria-label="123"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        <div class="row standerd-selection">
                          <div class="col-12">
                            <label for="selectStanderd" class="form-label">Select Standerd</label>
                            <select class="form-select" id="selectStanderd" aria-label="Default select example" name="student_standerd" required onchange="FindStd(this.value)">
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
                          </div>
                          <div class="division-selection">
                          </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center button-submit">
                          <button class="btn btn-dark col-12 btn-sub" id="submit_task" type="button">
                            Submit Task
                              </div>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
                  {{-- Modal View Tasks --}}
                <div class="modal fade" id="ViewTasks" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body students-content text-center">
                            {{-- Content --}}
                          </div>
                      </div>
                  </div>
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
      function DeleteTask(id) {
        $.ajax({
          url: "{{url('admin/task/delete')}}",
          data: {
            taskId: id,
          },
          method: 'GET',
          beforeSend: function () {
            $('#'+id).html('<div class="spinner-border text-secondary spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>');
            $('button[name="deleteTask"').prop('disabled', 1);
          },
          success: function (response) {
            $('button[name="deleteTask"').prop('disabled', 0);
            $('#ViewTask').html('<div class="spinner-border text-secondary spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>');
            setTimeout(() => {
              $('#ViewTasks').modal('hide');
            }, 2000);
          }
        });
      }

      function ViewTask(){
        $.ajax({
          url: "{{url('admin/tasks/view-tasks')}}",
          methd:  'GET',
          beforeSend: function () {
            $('.students-content').html('<div class="spinner-border text-secondary" role="status"><span class="visually-hidden">Loading...</span></div>');
          },
          
          success: function (response) {
            $('.students-content').html(response.html);
          },
          error: function () {
            $('.students-content').html('<h4 class="text-secondary">Something Went Wrong</h4>');
          }
        });
      }

      function FindStd(std) {     
          $.ajax({
              url: "{{url('find/standerd')}}",
              data: {
                  standerd: std,
              },
              beforeSend: function () {
                  $('#submit_task').html('Proccesing <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>');
                  $('#submit_task').prop('disabled',true);  
              },

              success: function (response) {
                  $('.division-selection').html(response.divisions);
                  $('#submit_task').html('Submit Task');
                  $('#submit_task').prop('disabled',false);
              },
              error: function (xhr, response) {
                  const e = xhr.responseJSON;
                  $('.division-selection').html(' ');
                  toastr.error(e.error,'Error', 4000);
                  $('#submit_task').html('Submit Task');
                  $('#submit_task').prop('disabled',false);
              }
          });
      }
      $(document).ready(function (){
        $('#submit_task').click(function (){
            $(this).removeClass('btn-dark');
            //Task
            const task = $('input[name=task_name]').val();
            //Description
            const task_desc = $('input[name=task]').val();
            // Standerd
            const standerd = $('#selectStanderd option:selected').val();
            //Division
            const div = $('#selectDiv option:selected').val();

            $.ajax({
            url: '{{url('task/add-task')}}',
            method: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                task_name: task,
                task: task_desc,
                standerd: standerd,
                div:div,
            },

            beforeSend: function () {
                    $('#submit_task').html('Proccesing <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>');
                    $('#submit_task').prop('disabled',true);  
            },

            success: function(message){
                $('#submit_task').removeClass('btn-primary');
                setTimeout(() => {
                    $('#submit_task').html('<span class="material-symbols-outlined check">check_circle</span>');
                    $('.button-submit').addClass(' animate-left-to-right');
                    $('#submit_task').css('background-color','#00FA9A');
                    toastr.options = {
                    'closeButton' :  true,
                    }
                    toastr.success('The Task Was Submited', 'Success!', {timeout: 6600});
                }, 3000);
                setTimeout(() => {
                    $('#submit_task').prop('disabled',false);
                    $('#submit_task').addClass('btn-dark');
                    $('#submit_task').html('Save Changes');
                    $('#submit_task').removeAttr('style');
                }, 5000);
            },

            error: function (xhr, response) {
                const e = xhr.responseJSON;
                toastr.error(e.error,'Error', 4000);
                $('#submit_task').html('Submit Task');
                $('#submit_task').prop('disabled',false);
                $('#submit_task').addClass('btn-dark');
            }
            });
        });
    });
    </script>
  @endsection