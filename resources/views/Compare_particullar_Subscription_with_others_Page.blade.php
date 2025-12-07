<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('cssfiles/single_subscription_page.css')}}">
    <title>{{ $subscription_to_compare->subscription_name }} | Comparision</title>
</head>
<body>

    <div class="Subscription_Comparision_heading">
        <p>Subscription Comparision</p>
    </div>
    <!-- ================================= Subscription Access  of particullar subscription (start) ================================================== -->
    <div class="subs_access_heading">
        <p>Access of &nbsp; " {{ $subscription_to_compare->subscription_name }} " &nbsp; Subscription &nbsp; | Duration : {{ $subscription_to_compare->full_subscription_duration }} &nbsp; | Price<span style = "font-size: 16px;">(With Discount)</span> : {{ $subscription_to_compare->subscription_price_with_discount }}/-</p>
    </div>

    <div class="subscrption_access_table">
        <table id = "subs_access_table">
            <tr id = "subs_access_table_headers">
                <th style = "border-right: 1px solid #18537a;">Subscription Access Parameter</th>
                <th style = "border-right: 1px solid #18537a;">Access [Yes/No]</th>
                <th style = "border-right: 1px solid #18537a;">Restriction [Limited/Unlimited]</th>
                <th>How Much [If Limited]</th>
            </tr>

            <tr>
                <td style = "border-right: 1px solid #18537a;">Videos & PDFs Access</td>
                <td style = "border-right: 1px solid #18537a;">
                    @if($subscription_to_compare->View_Videos_and_PDFs_access_boolean == 'true')
                            Yes
                    @elseif($subscription_to_compare->View_Videos_and_PDFs_access_boolean == 'false')
                            No
                    @endif
                </td>
                <td style = "border-right: 1px solid #18537a;">{{ $subscription_to_compare->View_Videos_and_PDFs_access_limitation ?? '-----------' }}</td>
                <td>{{ $subscription_to_compare->View_Videos_and_PDFs_access_limitation_number ?? '-----------'  }}</td>
            </tr>

            <tr>
                <td style = "border-right: 1px solid #18537a;">Download Videos & PDFs</td>
                <td style = "border-right: 1px solid #18537a;">
                    @if($subscription_to_compare->Download_Videos_and_PDFs_access_boolean == 'true')
                            Yes
                    @elseif($subscription_to_compare->Download_Videos_and_PDFs_access_boolean == 'false')
                            No
                    @endif
                </td>
                <td style = "border-right: 1px solid #18537a;">{{ $subscription_to_compare->Download_Videos_and_PDFs_access_limitation ?? '-----------' }}</td>
                <td>{{ $subscription_to_compare->Download_Videos_and_PDFs_access_limitation_number ?? '-----------' }}</td>
            </tr>

            <tr>
                <td style = "border-right: 1px solid #18537a;">Exams Attempts</td>
                <td style = "border-right: 1px solid #18537a;">
                    @if($subscription_to_compare->Exams_access_boolean == 'true')
                            Yes
                    @elseif($subscription_to_compare->Exams_access_boolean == 'false')
                            No
                    @endif
                </td>
                <td style = "border-right: 1px solid #18537a;">{{ $subscription_to_compare->Exams_access_limitation ?? '-----------' }}</td>
                <td>{{ $subscription_to_compare->Exams_access_limitation_number ?? '-----------' }}</td>
            </tr>
            
        </table>
    </div>
    <!-- ================================= Subscription Access  of particullar subscription (end) ================================================== -->


    <!-- ================================= Subscription Access  other subscirption (start) ================================================== -->
    <div class="subs_access_heading" style = "margin-top: 80px;">
        <p>Access of Others Subscription</p>
    </div>

    @if(count($other_subscriptions) > 0)
        @foreach($other_subscriptions as $each_subscription)
            <div class="subscrption_access_table" style = "margin-top: 40px;">
                <table id = "subs_access_table">
                    <tr>
                        <th colspan="4" style="text-align: center;"><a href="{{ route('Subscription', $each_subscription->id) }}" target = "_blank" id = "other_subscription_link">Subscription Name : &nbsp; "{{ $each_subscription->subscription_name }}"  &nbsp; | Duration : {{ $each_subscription->full_subscription_duration }} &nbsp; | Price<span style = "font-size: 14px;">(With Discount)</span> : {{ $each_subscription->subscription_price_with_discount }}/-</a></th>
                    </tr>
                    <tr id = "subs_access_table_headers">
                        <th style = "border-right: 1px solid #18537a;">Subscription Access Parameter</th>
                        <th style = "border-right: 1px solid #18537a;">Access [Yes/No]</th>
                        <th style = "border-right: 1px solid #18537a;">Restriction [Limited/Unlimited]</th>
                        <th>How Much [If Limited]</th>
                    </tr>

                    <tr>
                        <td style = "border-right: 1px solid #18537a;">Videos & PDFs Access</td>
                        <td style = "border-right: 1px solid #18537a;">
                            @if($each_subscription->View_Videos_and_PDFs_access_boolean == 'true')
                                    Yes
                            @elseif($each_subscription->View_Videos_and_PDFs_access_boolean == 'false')
                                    No
                            @endif
                        </td>
                        <td style = "border-right: 1px solid #18537a;">{{ $each_subscription->View_Videos_and_PDFs_access_limitation ?? '-----------' }}</td>
                        <td>{{ $each_subscription->View_Videos_and_PDFs_access_limitation_number ?? '-----------'  }}</td>
                    </tr>

                    <tr>
                        <td style = "border-right: 1px solid #18537a;">Download Videos & PDFs</td>
                        <td style = "border-right: 1px solid #18537a;">
                            @if($each_subscription->Download_Videos_and_PDFs_access_boolean == 'true')
                                    Yes
                            @elseif($each_subscription->Download_Videos_and_PDFs_access_boolean == 'false')
                                    No
                            @endif
                        </td>
                        <td style = "border-right: 1px solid #18537a;">{{ $each_subscription->Download_Videos_and_PDFs_access_limitation ?? '-----------' }}</td>
                        <td>{{ $each_subscription->Download_Videos_and_PDFs_access_limitation_number ?? '-----------' }}</td>
                    </tr>

                    <tr>
                        <td style = "border-right: 1px solid #18537a;">Exams Attempts</td>
                        <td style = "border-right: 1px solid #18537a;">
                            @if($each_subscription->Exams_access_boolean == 'true')
                                    Yes
                            @elseif($each_subscription->Exams_access_boolean == 'false')
                                    No
                            @endif
                        </td>
                        <td style = "border-right: 1px solid #18537a;">{{ $each_subscription->Exams_access_limitation ?? '-----------' }}</td>
                        <td>{{ $each_subscription->Exams_access_limitation_number ?? '-----------' }}</td>
                    </tr>
                    
                </table>
            </div>
            <br>
            <hr id = "ak_table_ke_bad_vali_line">
        @endforeach
    @endif

    <!-- ================================= Subscription Access  other subscirption (start) ================================================== -->


    <!-- ================================= contact us regarding to this Subscription (start) ================================================== -->
    <div class="contact_us_subs_heading">
        <p>"Contact Us" Regarding to any Subscription</p>
    </div>

    <div class="contact_us_and_logo_container">
        <div class="custom_contact_us_container">
            <h3 id = "contact_us_heading">CONTACT US</h3>
            <p id = "contact_us_description">How may we assist you..?<br>Here you can contact with us<br>in the context of this subscription's<br>'issue, suggesion or help'</p>
            <a href="{{ route('contact_us_page_for_subscription') }}" target = "_blank" id = "mail_us_link"><div class="contact_us_btn">Mail Us</div></a>
        </div>
        <div class="custom_scoreasy_logo_container">
            <img src="{{ asset('img/scoreasy_logo_contact_us.png') }}" id = "scoreasy_logo_contact_us" alt="">
        </div>
    </div>
    <!-- ================================= contact us regarding to this Subscription (End) ================================================== -->


    <!-- ================================= Other Subscriptions (Start) ================================================== -->
    <div class="other_subs_heading">
        <p>Other Subscriptions</p>
    </div>

    <div class="container" style = "margin-bottom: 20px;">
        @if(count($other_subscriptions) > 0)

            @foreach($other_subscriptions as $each_subscription)
                <div class="item-container">
                    <div class="img-container">
                        <div class="subscription_name">{{ $each_subscription->subscription_name }}</div>
                        <img src="{{ asset('storage/' . $each_subscription->subscription_thumnail_image) }}" alt="Subscription image">
                        <!-- <img src="{{ asset('img/subscription_image_test.jpg') }}" alt="Subscription image"> -->
                    </div>

                    <div class="body-container">
                        <div class="overlay"></div>

                        <div class="event-info">
                            <p class="title" style = "margin-top: 20px; white-space: nowrap; font-size: 20px;">{{ $each_subscription->subscription_title }}</p>
                            <div class="separator"></div>
                            <p class="info">DURATION: {{ $each_subscription->full_subscription_duration }}</p>
                            <p class="price"> <span><i class='bx bx-rupee'></i></span>{{ $each_subscription->subscription_price_with_discount }}/-</p>

                            <div class="additional-info" style = "margin-top: 18px;">
                                <p class="info" style = "white-space: nowrap;">
                                    <i class='bx bxs-purchase-tag'></i>
                                    <span>Price [Without Discount] : <span class = "desc_price">{{ $each_subscription->subscription_price_without_discount }}/-</span></span>
                                </p>
                                <p class="info">
                                    <i class='bx bxs-offer' ></i>
                                    <span>Price [With Discount] : <span class = "desc_price">{{ $each_subscription->subscription_price_with_discount }}/-</span></span>
                                </p>

                                <p class="info description">
                                    {{ $each_subscription->subscription_discription }}
                                    <br><br>
                                    <a href="{{ route('Subscription', $each_subscription->id) }}" class = "more_link"><span>Check Details</span></a>
                                    <br>
                                </p>
                            </div>
                        </div>
                        
                        @if(isset($student_session))

                            <form action="{{ route('subscription_payment_by_students') }}" method="POST" class="razorpay-container-try-try">
                                @csrf

                                <input type="hidden" id="student_id" name="student_id" value="{{ $student_session->id }}">
                                <input type="hidden" id="subscription_id" name="subscription_id" value="{{ $each_subscription->id }}">

                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ env('RAZORPAY_API_KEY') }}"
                                    data-amount="{{$each_subscription->subscription_price_with_discount * 100}}"
                                    data-buttontext="Buy Now"
                                    data-name="SCOREASY"
                                    data-description="An E-learning platform"
                                    data-image=""
                                    data-prefill.name="Anjali Patel"
                                    data-prefill.email="anjalipatel3074@gmail.com"
                                    data-theme.color="#8e44ad">
                                </script>
                            </form>
                        @else
                            <a href="{{ route('for_apply_middleware_on_payment_button') }}"><button class="action">Buy Now</button></a>
                        @endif
                        
                    </div>
                </div>
            @endforeach

        @endif
    </div>
    <!-- ================================= Other Subscriptions End ================================================== -->
</body>
</html>