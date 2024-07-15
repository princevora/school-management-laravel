@extends('student.layouts.sidebar')
    @section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Payments/</span> Pay Fee</h4>
            <div class="col-xl d-flex justify-content-center">
              <div class="card mb-4 col-md-6">
                <div class="card-header d-flex align-items-center">
                  <h5 class="mb">Pay fee</h5>
                </div>
                <hr>
                <form action="" onsubmit="return false;">
                    <div class="card-body">
                        <p>Fill Out This Form To Get to Your Checkout</p>
                        <label for="" class="form-label">Billing Email</label>
                        <input type="email" class="form-control" name="billing_email" id="email_billing" aria-describedby="emailHelpId" placeholder="abc@mail.com">
                        <div class="mt-3">
                            <button type="submit" name="billing_submit" id="submit" class="btn btn-dark col-12">Proccede To Checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            @if(session()->has('success'))
                    toastr.success('{{session('success')}}', 'Success', 6000);
            @endif

            $('#submit').on('click',function () {
                //email
                const email =  $('input[name="billing_email"]').val();

                //Ajax
                $.ajax({
                    url: 'processed',
                    data: {
                        _token: '{{csrf_token()}}',
                        student_email: '{{session()->get('student')}}',
                        billing_email: email
                    },
                    method: 'POST',
                    beforeSend: function () {
                        $('#submit').html('<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div> Loading.. ');
                        $('#submit').prop('disabled', true);
                    },

                    success: function (response) {
                        const Checkout = response.checkout;
                        window.location.href = Checkout;
                    },
                    
                    error: function (xhr, response) {
                        const e = xhr.responseJSON;
                        toastr.error(e.error);
                        $('#submit').html('Proccede To Checkout');
                        $('#submit').prop('disabled', false);
                    }
                });
            });
        });
        // billing_email
    </script>
    @endsection