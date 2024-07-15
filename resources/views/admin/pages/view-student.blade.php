@extends('admin.layouts.sidebar')
        @section('content')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Students /</span> Profile</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Student Profile</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex justify-content-center">
                        <img
                          src="{{$student->avatar !== null ? asset('storage/student/'.$student->avatar) : url('../assets/img/avatars/1.png')}}"
                          alt="staff-avatar"
                          class="d-block rounded-circle loader sm-4"
                          height="150"
                          width="150"
                          id="uploadedAvatar"
                          title="{{Str::title($student->student_name)}}"
                          data-toggle="tooltip"
                          ondragstart="return false;"
                        />
                    </div>
                    Standerd / Div : <strong data-toggle="tooltip" title="{{Str::upper($student->student_standerd.'/'.$student->student_div)}}">{{Str::upper($student->student_standerd.'/'.$student->student_div)}}</strong>
                </div>
                {{-- <h5></h5> --}}
                    <hr class="my-0" />
                     <div class="card-body">
                        <div class="row">
                          <div class="mb-3 col-md-6" data-toggle="tooltip" title="Student Name">
                            <label for="firstName"  class="form-label">Student Name</label>
                            <input
                              class="form-control"
                              type="text"
                              id="staff-name"
                              name="staff-name"
                              value="{{Str::title($student->student_name)}}"
                              autofocus
                              disabled
                            />
                          </div>
                          <div class="mb-3 col-md-6" data-toggle="tooltip" title="Student Email">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="{{$student->student_email}}"
                              disabled
                            />
                          </div>
                          <div class="mb-3 col-md-6" data-toggle="tooltip" title="Student Phone">
                            <label for="staff-phone" class="form-label">Phone No.</label>
                            <input
                              class="form-control"
                              type="text"
                              id="staff-phone"
                              name="staff-phone"
                              value="{{$student->student_phone}}"
                              disabled
                            />
                          </div>
                          <div class="mb-3 col-md-6" data-toggle="tooltip" title="Student Address">
                            <label for="staff-phone" class="form-label">Address</label>
                            <input
                              class="form-control"
                              type="text"
                              id="staff-phone"
                              name="staff-phone"
                              value="{{$student->student_address}}"
                              disabled
                            />
                          </div>
                    </div>
                    <!-- /Account -->
                    <hr>
                  @if (isset($payments)  && $payments->count() > 0)
                    <div class="accordion loading" id="according_student">
                      <div class="accordion-item active">
                        <h2 class="accordion-header" id="studentPayments">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayments" aria-expanded="true" aria-controls="collapsePayments">
                            Payments By &nbsp;<strong>{{Str::title($student->student_name)}}</strong>
                          </button>
                        </h2>
                        <div class="d-flex justify-content-center">
                          Total Amount Paid: &nbsp;<strong class="content-show">&#8377;{{$ttl}}</strong>
                          <div class="spinner-border text-secondary spinner-border-sm content-spin"
                            role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>
                        </div>
                          <div id="collapsePayments" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" data-toggle="tooltip" title="Payments">
                            <div class="accordion-body">
                              <div class="table-responsive mt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Payment Amount</th>
                                            <th scope="col">Paymen Date</th>
                                            <th scope="col">Payment Intent</th>
                                            <th scope="col">Payment Method</th>
                                        </tr>
                                    </thead>
                                    <tbody class="loading">
                                        @foreach ($payments as $payment)
                                        <tr>
                                          <td scope="row">
                                            <div class="content"></div>
                                              <div class="content-main">
                                              {{$payment->id}}
                                            </div>
                                          </td>
                                            <td scope="row">
                                              <div class="content col-3"></div>
                                              <div class="content-main">
                                                &#8377;{{number_format($payment->payment_amount, 2)}}
                                              </div>
                                            </td>
                                            <td scope="row">
                                              <div class="content col-5"></div>
                                                <div class="content-main">
                                                  {{Carbon\Carbon::parse($payment->created_at)->format('Y-M-d')}}
                                                </div>
                                            </td>
                                            <td scope="row">
                                              <div class="content"></div>
                                              <div class="content-main">
                                                @if ($payment->payment_intent === '' || $payment->payment_intent === null)
                                                    <a class="page-link bg-light" title="This Transaction Was Faild" data-toggle="tooltip">Failed</a>
                                                @else
                                                    <a href="{{route('view.payment', ['payment_intent' => $payment->payment_intent])}}" class="page-link" title="View This Payment" data-toggle="tooltip">{{$payment->payment_intent}}</a>
                                                @endif
                                              </div>
                                            </td>
        
                                          {{-- For Brandings --}}
                                            <td scope="row">
                                                <div class="content col-4"></div>
                                                <div class="content-main">
                                                  @if ($payment->last_4 === '' || $payment->last_4 === null)
                                                    <a class="page-link bg-light">Failed</a>
                                                  @else
                                                  @if ($payment->brand ===  'm')
                                                        <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--20-svg" height="20"
                                                        width="20" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                        <g fill="none" fill-rule="evenodd">
                                                            <path d="M0 0h32v32H0z" fill="#000"></path>
                                                            <g fill-rule="nonzero">
                                                                <path d="M13.02 10.505h5.923v10.857H13.02z" fill="#ff5f00"></path>
                                                                <path
                                                                    d="M13.396 15.935a6.944 6.944 0 0 1 2.585-5.43c-2.775-2.224-6.76-1.9-9.156.745s-2.395 6.723 0 9.368 6.38 2.969 9.156.744a6.944 6.944 0 0 1-2.585-5.427z"
                                                                    fill="#eb001b"></path>
                                                                <path
                                                                    d="M26.934 15.935c0 2.643-1.48 5.054-3.81 6.21s-5.105.851-7.143-.783a6.955 6.955 0 0 0 2.587-5.428c0-2.118-.954-4.12-2.587-5.429 2.038-1.633 4.81-1.937 7.142-.782s3.811 3.566 3.811 6.21z"
                                                                    fill="#f79e1b"></path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                  @else
                                                    <svg class="SVGInline-svg SVGInline--cleaned-svg SVG-svg BrandIcon-svg BrandIcon--size--20-svg" height="20"
                                                        width="20" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                                        <g fill="none" fill-rule="evenodd">
                                                            <path d="M0 0h32v32H0z" fill="#00579f"></path>
                                                            <g fill="#fff" fill-rule="nonzero">
                                                                <path
                                                                    d="M13.823 19.876H11.8l1.265-7.736h2.023zm7.334-7.546a5.036 5.036 0 0 0-1.814-.33c-1.998 0-3.405 1.053-3.414 2.56-.016 1.11 1.007 1.728 1.773 2.098.783.379 1.05.626 1.05.963-.009.518-.633.757-1.216.757-.808 0-1.24-.123-1.898-.411l-.267-.124-.283 1.737c.475.213 1.349.403 2.257.411 2.123 0 3.505-1.037 3.521-2.641.008-.881-.532-1.556-1.698-2.107-.708-.354-1.141-.593-1.141-.955.008-.33.366-.667 1.165-.667a3.471 3.471 0 0 1 1.507.297l.183.082zm2.69 4.806.807-2.165c-.008.017.167-.452.266-.74l.142.666s.383 1.852.466 2.239h-1.682zm2.497-4.996h-1.565c-.483 0-.85.14-1.058.642l-3.005 7.094h2.123l.425-1.16h2.597c.059.271.242 1.16.242 1.16h1.873zm-16.234 0-1.982 5.275-.216-1.07c-.366-1.234-1.515-2.575-2.797-3.242l1.815 6.765h2.14l3.18-7.728z">
                                                                </path>
                                                                <path
                                                                    d="M6.289 12.14H3.033L3 12.297c2.54.641 4.221 2.189 4.912 4.049l-.708-3.556c-.116-.494-.474-.633-.915-.65z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>                    
                                                    @endif
                                              ••••  {{$payment->last_4}}
                                                  @endif
                                                </div>
                                            </td>
                                            {{-- /For Brandings --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>     
                            <a href="{{url('admin/payment/invoice?payment_intent='.$payment->payment_intent.'&date='.\Carbon\Carbon::parse($payment->created_at)->format('Y-M-d'))}}" class="btn btn-light mt-3" title="Print Invoice" data-toggle="tooltip"><i class="fa-solid fa-receipt"></i> Print Invoice</a>
                            </div>
                          </div>
                        </div>
                        {{-- For Attendance --}}
                      </div>
                      {{-- Attendance --}}
                      <hr>
                      @endif
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
    <script>
        const sk = $('.content');
        const content = $('.content-main').hide();
          setTimeout(() => {
              sk.removeClass('content');
              content.show();
          }, 1400);
    </script>
    @endsection
