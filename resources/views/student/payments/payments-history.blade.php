@extends('student.layouts.sidebar')
      @section('content')
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            @if ($payments->count() > 0)
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Payments</h4>
              <hr class="my-5" />
              <div class="card row">
                <h5 class="card-header">Payments</h5>
                <div class="col-sm-4">
                </div>
                <div class="navbar-nav align-items-center data-table">
                </div>
                <div class="col-sm-4 d-inline-block me-2">
                  <div class=" select-all d-inline-block me-2">

                  </div>
                </div>

                <div class="table-responsive text-nowrap">
                  <div class="form-data">
                  </div>
                  <table class="table ">
                    {{-- {{-- <thead> --}}
                      <tr>
                        <th>#</th>
                        <th>Payment Amount</th>
                        <th>Billing Email</th>
                        <th>Payment Intent</th>
                        <th>Payment Status</th>
                        <th>Payment Date</th>
                      </tr>
                    </thead>
                  <tbody class="table-border-bottom-0 loading">
                    @foreach ($payments as $payment)
                    <tr>
                        <td>{{$payment->id}}</td>
                      <td>
                        <div class="content col-4"></div>
                        <div class="content-main">
                          {{$payment->payment_amount}}
                        </div>
                      </td>
                      <td>
                        <div class="content"></div>
                        <div class="content-main">
                          -
                          <!-- {{$payment->billing_email}} -->
                        </div>
                      </td>
                      @if ($payment->payment_intent === null)
                          <td title="Payment Not Completed" data-toggle="tooltip">
                      @else
                        <td>
                      @endif
                        <div class="content"></div>
                        <div class="content-main">
                          {{$payment->payment_intent}}
                        </div>
                      </td>
                      @if ($payment->status === 0)
                          <td title="Payment Not Completed" data-toggle="tooltip">
                      @else
                        <td title="Payment Completed" data-toggle="tooltip">
                      @endif
                      <div class="content"></div>
                      <div class="content-main">
                        @if ($payment->status === 1)
                            <a href="{{url('student/payments?payment_intent='.$payment->payment_intent)}}"><span class="badge bg-success">Succeeded <i class="fa-solid fa-check"></i></span></a>
                        @endif
                      </div>
                      </td>
                      <td>
                        <div class="content">
                          <div class="content-main">
                            {{ \Carbon\Carbon::parse($payment->created_at)->format('Y M d')}}
                          </div>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
              <!--/ Striped Rows -->
            </div>
            <div class="content-backdrop fade"></div>
            </div>
            </div>
            @endif
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
      // $(window).on('load', function () {
      //   $('.content-wrapper').html('<div class="d-flex justify-content-center align-items-center mt-5 px-2 text-center"> <div class="spinner-border text-secondary spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
      // });

          @if ($payments->count() === 0)
          $('.content-wrapper').html('<div class="d-flex justify-content-center align-items-center mt-5 px-2 text-center"> <div class="spinner-border text-secondary spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            setTimeout(() => {
              $('.content-wrapper').load('{{route('error.data')}}');
            }, 2000);
          @endif

      const sk = $('.content');
        const content = $('.content-main').hide();
          setTimeout(() => {
              sk.removeClass('content');
              content.show();
          }, 1400);
    </script>
    @endsection
