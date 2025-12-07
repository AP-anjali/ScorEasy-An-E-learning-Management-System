<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('cssfiles/single_subscription_page.css')}}">
    <title>{{ $subscription_to_display->subscription_name }}</title>
</head>
<body>

    @if(Session()->has('payment_done'))
        <div class="payment_done_msg_container" id="msg1">
            <div class="payment_done_box_close_btn" onclick = "document.getElementById('msg1').style.display = 'none';">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <img src="{{ asset('img/404-tick.png') }}" class = "paymet_done_msg_image" alt="">
            <h3 class = "payment_done_main_msg">{{session()->get('payment_done')}}</h3>
            <h3 class = "payment_done_main_msg"><span style = "color: #454545;">&#10084; THANK YOU &#10084;</span></h3>
        </div>
    @endif

    <!-- ================================= Subscription Main image (start) ================================================== -->
    <div class="subs_first_heading">
        <p>{{ $subscription_to_display->subscription_name }} [ {{ $subscription_to_display->subscription_title }} ]</p>
    </div>

    <div class="main_container">
        <div class="image_container">
            <img src="{{ asset('storage/' . $subscription_to_display->subscription_bg_pic) }}" class = "subscription_bg" alt="Subscription image">
        </div>
    </div>
    <!-- ================================= Subscription Main image End ================================================== -->

    <!-- ================================= Subscription Information (start) ================================================== -->
    <div class="subs_info_heading">
        <p>Subscription Information</p>
    </div>

    <div class="container">
        <div class="item-container">
            <div class="img-container">
                <div class="subscription_name">{{ $subscription_to_display->subscription_name }}</div>
                <img src="{{ asset('storage/' . $subscription_to_display->subscription_thumnail_image) }}" alt="Subscription image">
                <!-- <img src="{{ asset('img/subscription_image_test.jpg') }}" alt="Subscription image"> -->
            </div>

            <div class="body-container">
                <div class="overlay"></div>

                <div class="event-info">
                    <p class="title" style = "margin-top: 20px; white-space: nowrap; font-size: 20px;">{{ $subscription_to_display->subscription_title }}</p>
                    <div class="separator"></div>
                    <p class="info">DURATION: {{ $subscription_to_display->full_subscription_duration }}</p>
                    <p class="price"> <span><i class='bx bx-rupee'></i></span>{{ $subscription_to_display->subscription_price_with_discount }}/-</p>

                    <div class="additional-info" style = "margin-top: 18px;">
                        <p class="info" style = "white-space: nowrap;">
                            <i class='bx bxs-purchase-tag'></i>
                            <span>Price [Without Discount] : <span class = "desc_price">{{ $subscription_to_display->subscription_price_without_discount }}/-</span></span>
                        </p>
                        <p class="info">
                            <i class='bx bxs-offer' ></i>
                            <span>Price [With Discount] : <span class = "desc_price">{{ $subscription_to_display->subscription_price_with_discount }}/-</span></span>
                        </p>

                        <p class="info description">
                            {{ $subscription_to_display->subscription_discription }}
                            <br><br>
                            <div id = "last_line"></div>
                        </p>
                    </div>
                </div>
                
                @if(isset($student_session))

                    <form action="{{ route('subscription_payment_by_students') }}" method="POST" class="razorpay-container-try-try">
                        @csrf

                        <input type="hidden" id="student_id" name="student_id" value="{{ $student_session->id }}">
                        <input type="hidden" id="subscription_id" name="subscription_id" value="{{ $subscription_to_display->id }}">

                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{ env('RAZORPAY_API_KEY') }}"
                            data-amount="{{$subscription_to_display->subscription_price_with_discount * 100}}"
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

        <div class="subs_info_container">
            <div class="subscription_name_for_info">{{ $subscription_to_display->subscription_name }}</div>
            <div class="subscription_title_for_info">{{ $subscription_to_display->subscription_title }}</div>
            <div class="subscription_duration_for_info">Subscription Duration : {{ $subscription_to_display->full_subscription_duration }}</div>

            <div class="subs_price_container">
                <div class="subscription_price1_for_info">Price [Without Discount] : <span class = "desc_price">{{ $subscription_to_display->subscription_price_without_discount }}/-</span></div>
                <div class="subscription_price2_for_info">Price [With Discount] : <span class = "desc_price">{{ $subscription_to_display->subscription_price_with_discount }}/-</span></div>
            </div>            

            <div class="subscription_description_for_info">"{{ $subscription_to_display->subscription_discription }}"</div>

            <div class="subs_btn_container">

                @if(isset($student_session))
                    <button class = "subscription_info_btn_try_hehe" onclick = "goToCompareSubscriptionPage(<?php echo $subscription_to_display->id; ?>)">Compare With Others</button>

                    <form action="{{ route('subscription_payment_by_students') }}" method="POST" class="razorpay-container">
                        @csrf

                        <input type="hidden" id="student_id" name="student_id" value="{{ $student_session->id }}">
                        <input type="hidden" id="subscription_id" name="subscription_id" value="{{ $subscription_to_display->id }}">

                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{ env('RAZORPAY_API_KEY') }}"
                            data-amount="{{$subscription_to_display->subscription_price_with_discount * 100}}"
                            data-buttontext="Buy Now"
                            data-name="SCOREASY"
                            data-description="An E-learning platform"
                            data-image=""
                            data-prefill.name="Anjali Patel"
                            data-prefill.email="anjalipatel3074@gmail.com"
                            data-theme.color="#8e44ad">
                        </script>
                    </form>
                            <!-- data-theme.color="{{$subscription_to_display->subscription_bg_color}}"> -->
                @else

                    <button class = "subscription_info_btn1" onclick = "goToCompareSubscriptionPage(<?php echo $subscription_to_display->id; ?>)">Compare With Others</button>

                    <a class = "subscription_info_btn2" href = "{{ route('for_apply_middleware_on_payment_button') }}">Buy Now</a>
                @endif
            </div> 

            <div class="bottom_fav_text">SCOREASY - "TRUSTED FOR SUCCESS"</div>

        </div>
    </div>
    <!-- ================================= Subscription Information End ================================================== -->

    <!-- ================================= Subscription Access  (What you will get !) (start) ================================================== -->
    <div class="subs_access_heading">
        <p>Subscription Access &nbsp;(What you will get !)</p>
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
                    @if($subscription_to_display->View_Videos_and_PDFs_access_boolean == 'true')
                            Yes
                    @elseif($subscription_to_display->View_Videos_and_PDFs_access_boolean == 'false')
                            No
                    @endif
                </td>
                <td style = "border-right: 1px solid #18537a;">{{ $subscription_to_display->View_Videos_and_PDFs_access_limitation ?? '-----------' }}</td>
                <td>{{ $subscription_to_display->View_Videos_and_PDFs_access_limitation_number ?? '-----------'  }}</td>
            </tr>

            <tr>
                <td style = "border-right: 1px solid #18537a;">Download Videos & PDFs</td>
                <td style = "border-right: 1px solid #18537a;">
                    @if($subscription_to_display->Download_Videos_and_PDFs_access_boolean == 'true')
                            Yes
                    @elseif($subscription_to_display->Download_Videos_and_PDFs_access_boolean == 'false')
                            No
                    @endif
                </td>
                <td style = "border-right: 1px solid #18537a;">{{ $subscription_to_display->Download_Videos_and_PDFs_access_limitation ?? '-----------' }}</td>
                <td>{{ $subscription_to_display->Download_Videos_and_PDFs_access_limitation_number ?? '-----------' }}</td>
            </tr>

            <tr>
                <td style = "border-right: 1px solid #18537a;">Exams Attempts</td>
                <td style = "border-right: 1px solid #18537a;">
                    @if($subscription_to_display->Exams_access_boolean == 'true')
                            Yes
                    @elseif($subscription_to_display->Exams_access_boolean == 'false')
                            No
                    @endif
                </td>
                <td style = "border-right: 1px solid #18537a;">{{ $subscription_to_display->Exams_access_limitation ?? '-----------' }}</td>
                <td>{{ $subscription_to_display->Exams_access_limitation_number ?? '-----------' }}</td>
            </tr>
            
        </table>
    </div>
    <!-- ================================= Subscription Access  (What you will get !) end ================================================== -->

    <!-- ================================= contact us regarding to this Subscription (start) ================================================== -->
    <div class="contact_us_subs_heading">
        <p>"Contact Us" Regarding to this Subscription</p>
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
<script>
    function goToCompareSubscriptionPage(subscriptionId){

        var url = '/Display/Subscription_Comparision/' + subscriptionId;
        window.location.href = url;
    }
</script>
</html>