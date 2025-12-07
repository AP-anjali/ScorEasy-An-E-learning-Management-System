<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('cssfiles/subscription_card.css')}}">
    <title>Subscription Card</title>
</head>
<body>
    <div class="container">

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

        @if(count($all_subscription) > 0)

            @foreach($all_subscription as $each_subscription)
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

                            <form action="{{ route('subscription_payment_by_students') }}" method="POST" class="razorpay-container">
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

        @else
            <script>
                window.location.href = '{{ route('common_page_nothing_to_show_in_subscriptions_page') }}';
            </script>
        @endif
    </div>

    
</body>
</html>