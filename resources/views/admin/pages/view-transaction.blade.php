@extends('admin.layouts.sidebar')
    @section('content')
    <div class="content-wrapper page-load">
        <div class="container-xxl flex-grow-1 container-p-y loading">
            <svg aria-hidden="true" height="18" width="18" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 4h14c.552 0 1 .407 1 .91v8.18c0 .503-.448.91-1 .91H1c-.552 0-1-.407-1-.91V4.91C0 4.406.448 4 1 4zm1-3h12a1 1 0 0 1 1 1v1H1V2a1 1 0 0 1 1-1zm6 10.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"></path>
            </svg>
            &nbsp;<strong class="text-secondary">Payment</strong>
            <h4 class="col-2 content">
                <strong class="content-main" id="amount">
                    &#8377;{{number_format($payment->payment_amount,2)}}
                </strong>
            </h4>
            <hr>
            <div class="row mt-3">
                <!-- Payments Department -->
                <div class="col-4 d-flex align-items-center">
                    <!-- Display the payment method icon here -->
                    <!-- Display the last 4 digits -->
                    <div class="ml-2">
                        <h6 class="font-weight-bold">Payment Method </h6>
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
                        {{-- Lock SVG--}}

                        {{-- @if ($payment->brand === 'v')
                            <h3 class="d-flex"><i class="fa-brands fa-cc-visa"></i></h3>
                        @else
                            <h3 class="d-flex"><i class="fa-brands fa-cc-mastercard"></i></h3>
                        @endif --}}
                    </div>
                </div>
                
            
                <!-- Vertical Ruler -->
                <div class="col-1">
                    <div class="vr" style="height: 45px"></div>
                </div>
            
                <!-- Method Department -->
                <div class="col-4">
                    <h6 class="font-weight-bold">Status</h6>
                    @if ($payment->status === 1)
                    <svg  aria-hidden="true" height="12" width="12" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16zm3.083-11.005L7 9.085 5.207 7.294a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4.79-4.798a1 1 0 1 0-1.414-1.414z"
                            fill="green"
                            fill-rule="evenodd"></path>
                    </svg>                    
                    Succeeded
                    @else
                        <span class="badge bg-danger">failed</span>
                    @endif
                </div>
            </div>

            <div class="col mt-5">
                <strong>
                    <h5>
                        Checkout Summary
                    </h5>
                </strong>
            </div>
            <hr>
            <div class="table-responsive col-md-12">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Item Name</th>
                            <th scope="col">QNT</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td scope="row">School Fee</td>
                            <td>1</td>
                            <td>
                                <div class="content col-6"></div>
                                <div class="content-main">
                                    &#8377;{{number_format($payment->payment_amount,2)}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td>
                                <div class="content col-6"></div>
                                <div class="content-main">
                                    <strong>
                                        &#8377;{{number_format($payment->payment_amount,2)}}
                                    </strong>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col d-flex">
                <a href="{{url('admin/payment/invoice?payment_intent='.$payment->payment_intent.'&date='.\Carbon\Carbon::parse($payment->created_at)->format('Y-M-d'))}}" class="btn btn-dark" data-toggle="tooltip" title="Download Invoice" id="download_invoice">
                    <i class="fa-solid fa-arrow-down"></i>
                </a>
            </div>
        </div>
    </div>
<script>
    const sk = $('.content');
    const content = $('.content-main').hide();
    setTimeout(() => {
        sk.removeClass('content');
        content.fadeIn('show');
    }, 1200);
</script>
    @endsection
