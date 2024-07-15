<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta name="google-signin-client_id" content="794289032052-mm5b3smd9gs1t27o8grquhm5eeptjas5.apps.googleusercontent.com">
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Student Verification</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- material icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>

    </head>

  <style>
     #submit_student i {
      display: inline-block;
      opacity: 0;
      animation: fade-in 0.5s forwards;
    }

    @keyframes fade-in {
      0% {
        opacity: 0;
        transform: translateX(-100%);
      }
      50{
        opacity: 0.50;
        transform: translateX(-50%);
      }
      100% {
        opacity: 1;
        transform: translateX(0%);
      }
    }
  </style>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                  <span class="app-brand-logo demo">
                    <svg
                      width="25"
                      viewBox="0 0 25 42"
                      version="1.1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                    >
                      <defs>
                        <path
                          d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                          id="path-1"
                        ></path>
                        <path
                          d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                          id="path-3"
                        ></path>
                        <path
                          d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                          id="path-4"
                        ></path>
                        <path
                          d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                          id="path-5"
                        ></path>
                      </defs>
                      <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                          <g id="Icon" transform="translate(27.000000, 15.000000)">
                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                              <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"></use>
                              </mask>
                              <use fill="#121261" xlink:href="#path-1"></use>
                              <g id="Path-3" mask="url(#mask-2)">
                                <use fill="#121261" xlink:href="#path-3"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                              </g>
                              <g id="Path-4" mask="url(#mask-2)">
                                <use fill="#121261" xlink:href="#path-4"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                              </g>
                            </g>
                            <g
                              id="Triangle"
                              transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                            >
                              <use fill="#121261" xlink:href="#path-5"></use>
                              <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">School</span>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Hello {{$student->student_name}} 👋 </h4>
              <p class="mb-4">Please Complete This Verification To Get Into Your Shcool.</p>
              <hr>
              <form onsubmit="return false">
                <div class="mb-3 form-user-verificaton">
                  @if ($student->verification_status === 0 ||$student->verification_status === null)
                    <label for="" class="form-label">Select The Standerd And Division To Validate The Standerd</label>
                    <div class="mb-3">
                      <select class="form-select form-select" name="verification_std" id="student_select_standerd" onchange="ValidateStanderd(this.value)">
                        <option selected disabled>Select one</option>
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
                  @elseif ($student->verification_status === 1)
                  <div class="mb-3">
                    <p>Here Is the list Available Divisons For Your Standerd..</p>
                    <label for="" class="form-label">Select Division</label>
                    <select class="form-select form-select" name="select_div" id="verification_division">
                        <option selected disabled>Select Division</option>
                          @foreach ($divs as $div)
                              <option value="{{$div->divs}}">{{$div->divs}}</option>
                            @endforeach
                          </select>
                      </div>                      
                  @elseif($student->verification_status === 2)
                    <div class="mb-3">
                      <label class="form-label" for="basic-icon-default-student-roll">Student Roll No.</label>
                      <div class="input-group input-group-merge">
                          <span id="basic-icon-default-roll" class="input-group-text"><i class="bx bx-user"></i></span>
                          <input type="number" name="student_roll" class="form-control" id="basic-icon-default-student-roll"
                              placeholder="123" aria-label="123" aria-describedby="basic-icon-default-fullname2" />
                      </div>
                  </div>

                  <!-- Address-->

                  <div class="mb-3">
                      <label class="form-label" for="basic-icon-default-address">Address</label>
                      <div class="input-group input-group-merge">
                          <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-buildings"></i></span>
                          <input type="text" name="student_address" id="basic-icon-default-address" class="form-control"
                              placeholder="Street 123." aria-label="Street 123." aria-describedby="basic-icon-default-company2"/>
                      </div>
                  </div>

                  <!-- Phone No -->

                  <div class="mb-3">
                      <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                      <div class="input-group input-group-merge">
                          <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                          <input type="text" size="10" maxlength="10" name="student_phone" id="basic-icon-default-phone"
                              class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941"
                              aria-describedby="basic-icon-default-phone2" />
                      </div>
                  </div>
                  @endif

                </div>         
                <div class="error-handling">

                </div>
                <div class="mb-3 mt-2 button-submit ">
                  <button class="btn btn-dark w-100" id="submit_verification" name="submit_student" type="submit">{{$student->verification_status === 2 ? 'Submit' : 'Next'}}</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>


    {{-- login_email --}}
    
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->
    
    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>
    <!-- Toastr CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      //Get Statu
      function getStatus() {
        let status = null;
        $.ajax({
          url: "/student/verifications/status",
          async: false,
          data: {
            email: '{{session()->get('student')}}',
          },
          method: 'GET',
          success: function (response) {
            status = response.status;
          }
        });

        return status;
      }

      //Validate std
      function ValidateStanderd(std) {
        const status = getStatus();
        if(status === 0 || status === null){
          $.ajax({
            url: "/student/find/standerd",
            method: 'POST',
            data: {
              _token: '{{csrf_token()}}',
              standerd: std,
            },
            beforeSend: function(){
              $('#submit_verification').html('<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>');
              $('select[name="{{isset($divs) && $student->verification_status === 1 ? 'select_div' : 'verification_std'}}"] option').prop('disabled', true);
            },

            success: function (response) {
              $('#submit_verification').html('Next');
              $('select[name="{{isset($divs) && $student->verification_status === 1 ? 'select_div' : 'verification_std'}}"] option').prop('disabled', false);
            },

            error: function(response){
              $('#submit_verification').html('Next');
              $('select[name="{{isset($divs) && $student->verification_status === 1 ? 'select_div' : 'verification_std'}}"] option').prop('disabled', false);
              $('.error-handling').html('<a class="link" href="{{url('student/available-standerds')}}" class="error-view-standerds">See The Available Standerds Here..</a>');
              $('.error-handling').delay(10000).fadeOut(500);
              toastr.option = {
                closeButton: true,
              }

              toastr.error(response.responseText, 'Error', 6000);
            }
          }); 
        }
      }
      //Main Function
      function studentVerification(std) {
        const status = getStatus();
        if(status === 0 || status === null){

        //For Update Standderd
        let v = $('select[name="verification_std"').val();
          $.ajax({
            url: "/student/verifications/update-standerd",
            data: {
              _token: '{{csrf_token()}}',
              email: '{{session()->get('student')}}',
              standerd: v,
              action: '{{'stage-std'}}',
            },
            method: "POST",
            beforeSend: function () {
              $('#submit_verification').html('<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>');
              $('select[name="verification_std"] option').prop('disabled', true);
            },

            success: function (response) {
              let action = response.stage;
              $('.form-user-verificaton').html(response.form);
              $('#submit_verification').html('Next');
            },
            error: function(xhr, response){
              let e = xhr.responseJSON;
              toastr.error(e.error, 'Error', 6000);
              $('#submit_verification').html('Next');
              $('select[name="verification_std"] option').prop('disabled', false);
            }
          });
        }
          //For Update Division

        if(status === 1){
          let v = $('select[name="select_div"').val();
          $.ajax({
            url: "/student/verifications/update-division",
            data: {
              _token: '{{csrf_token()}}',
              email: '{{session()->get('student')}}',
              division: v,
              action: 'stage-div',
            },
            method: "POST",
            beforeSend: function () {
              $('#submit_verification').html('<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>');
              $('select[name="select_div"] option').prop('disabled', true);
            },

            success: function (response) {
              $('.form-user-verificaton').html(response.form);
              const data = $('.form-user-verificaton').load("{{'auth/verification-details'}}");
              if(data){
                $('#submit_verification').html('Submit');
              }
            },
            error: function(xhr, response){
              let e = xhr.responseJSON;
              toastr.error(e.error, 'Error', 6000);
              $('#submit_verification').html('Next');
              $('select[name="select_div"] option').prop('disabled', false);
            }
          });
        }
        //Main Details
        if(status === 2){
          //Phone
          const phone = $('input[name="student_phone"]').val();
          //Address
          const address = $('input[name="student_address"]').val();
          //Roll
          const roll = $('input[name="student_roll"]').val();

          //Ajax
          $.ajax({
            url: "/student/verifications/update-details",
            data: {
              _token: '{{csrf_token()}}',
              email: '{{session()->get('student')}}',
              student_phone: phone,
              student_address: address,
              student_roll: roll,
              action: 'stage-last',
            },
            method: 'POST',

            beforeSend: function () {
              $('#submit_verification').html('<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div>');
              $('select[name="select_div"] option').prop('disabled', true);
            },

            success: function (response) {
              window.location.href = '?validation=complete';
            },

            error: function (xhr, error) {
              let e = xhr.responseJSON;
              toastr.error(e.error, 'Error', 6000);
              $('#submit_verification').html('Next');
              $('select[name="select_div"] option').prop('disabled', false);
            }
          });
        }
      }

      $('#submit_verification').on('click', function(){
        studentVerification();
      });
    </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
