    @extends('admin.layouts.sidebar')
        @section('content')            
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Account Settings /</span> Notifications
              </h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('/admin/account/profile')}}"
                        ><i class="bx bx-user me-1"></i> Account</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"
                        ><i class="bx bx-bell me-1"></i> Notifications</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('/admin/account/connections')}}"
                        ><i class="bx bx-link-alt me-1"></i> Connections</a
                      >
                    </li>
                  </ul>
                  <div class="card">
                    <!-- Notifications -->
                    <h5 class="card-header">Recent Devices</h5>
                    <div class="card-body">
                      <span
                        >We need permission to send you the notifications..
                        <span class="notificationRequest"><strong>Request Permission</strong></span></span
                      >
                      <div class="error"></div>
                    </div>
                  <form action="javascript:void(0);" id="activiy-permisions-form">
                    <div class="table-responsive">
                      <table class="table table-striped table-borderless border-bottom">
                        <thead>
                          <tr>
                            <th class="text-nowrap">Type</th>
                            <th class="text-nowrap text-center">✉️ Email</th>
                            {{-- <th class="text-nowrap text-center">📬 Messages</th> --}}
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-nowrap">Account activity</td>
                            <td>
                              <div class="form-check d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" id="message-account-activity" {{isset($staffdata) && $staffdata->permission_activity == 1 ? 'checked' : ''}} />
                              </div>
                            </td>
                            {{-- <td>
                              <div class="form-check d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" id="defaultCheck5" checked disabled/>
                              </div>
                            </td> --}}
                          </tr>
                          <tr>
                            <td class="text-nowrap">A Device Used to Login</td>
                            <td>
                              <div class="form-check d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" id="message-account-login" {{isset($staffdata) && $staffdata->permission_login == 1 ? 'checked' : ''}} />
                              </div>
                            </td>
                            {{-- <td>
                              <div class="form-check d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" id="defaultCheck8" checked disabled/>
                              </div>
                            </td> --}}
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <button type="submit" id="save-changes" class="btn btn-primary me-2 btn-sub">Save changes</button>
                      </div>
                      </div>
                    </form>
                    <!-- /Notifications -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
          </footer>
            <!-- / Footer -->

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
        //Prevent form to submit..
        $("#activiy-permisions-form").on("submit", function (e) {
            e.preventDefault();
        });

        //Ajax Request.
        $('.btn-sub').click(function (){
          // $('#proccess-data').show();
          $(this).html('Proccesing <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>');
          $(this).prop('disabled',true);

          //Activiti
          const account = $('#message-account-activity').is(':checked') ? 1 : 0;
          //Login Device
          const login = $('#message-account-login').is(':checked')? 1 : 0;

          $.ajax({
            url: '{{'changes'}}',
            method: 'POST',
            data: {
              _token: '{{csrf_token()}}',
              message_account:account,
              message_login:login,
            },
            success: function(message){
              $('#save-changes').removeClass('btn-primary');
              setTimeout(() => {
                $('#save-changes').html('<span class="material-symbols-outlined check">check_circle</span>');
                $('.button-submit').addClass(' animate-left-to-right');
                $('#save-changes').css('background-color','#00FA9A');
                toastr.options = {
                  'closeButton' :  true,
                }
                toastr.success('The Changes Have Saved', 'Success!', {timeout: 6600});
              }, 3000);
              setTimeout(() => {
                $('#save-changes').prop('disabled',false);
                $('#save-changes').addClass('btn-primary');
                $('#save-changes').html('Save Changes');
                $('#save-changes').removeAttr('style');
              }, 8000);
            },
            error: function(xhr){
              let getErr = xhr.responseJSON.error;
              toastr.options = {
                    'closeButton' :  true,
                  }
              toastr.error(getErr, 'Error Occured', {timeout: 6600});
              $('#save-changes').prop('disabled',false);
              $('#save-changes').addClass('btn-primary');
              $('#save-changes').html('Save Changes');
              $('#save-changes').removeAttr('style');
            }
          });
        });
      });
    </script>
    @endsection
