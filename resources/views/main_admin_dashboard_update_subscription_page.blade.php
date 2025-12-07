@extends('main_admin_dashboard_layout')

@section('title')
<title>Subscription Management</title>
@endsection

@section('style')
<style>
    #Subscriptions{
        border-left : 6px solid #305d72;
        background: #B7C9E2;
        border-radius: 4px;
    } 

    #Update_Subscription{
        border: 2px solid #3d5ee1;
        border-radius: 8px;
    }
</style>
@endsection


@section('body')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- <div>Hello From main_admin_dashboard_update_subscription_page</div><br> -->

            @if(Session()->has('message'))

                <div class="msg" id="msg1">
                    {{session()->get('message')}}
                    <button type="button" onclick = "document.getElementById('msg1').style.display = 'none';" id="popup-btn2" >X</button>
                </div>

            @endif

            <!-- <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta http-equiv="X-UA-Compatible" content="ie=edge" />
                <link rel="stylesheet" href="{{ asset('cssfiles/simple_cute_form.css') }}">
            </head>
            <body>
                <div id = "nested_bodyy">
                    <section class="container">
                    <header>Update Subscription Record</header>
                    <form action="{{ route('updating_subscription_form_submission_route', $subscription_to_update->id) }}" class="form" method = "post" enctype="multipart/form-data">
                        @csrf
                        <div class="column">
                            <div class="input-box">
                                <label>Subscription Name</label>
                                <input type="text" name = "subscription_name" value = "{{ $subscription_to_update->subscription_name }}" placeholder="Enter Subscription Name" required />
                            </div>
                            <div class="input-box">
                                <label>Subscription Title</label>
                                <input type="text" name = "subscription_title" value = "{{ $subscription_to_update->subscription_title }}" placeholder="Enter Subscription Title" required />
                            </div>
                        </div>

                        <div class="input-box">
                        <label>Subscription Discription</label>
                        <input type="text" name = "subscription_discription" value = "{{ $subscription_to_update->subscription_discription }}" placeholder="Enter Subscription Discription" required />
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label>Subscription Price [Without Discount]</label>
                                <input type="number" name = "subscription_price_without_discount" value = "{{ $subscription_to_update->subscription_price_without_discount }}" placeholder="Price Without Discount" required />
                            </div>
                            <div class="input-box">
                                <label>Subscription Price [With Discount]</label>
                                <input type="number" name = "subscription_price_with_discount" value = "{{ $subscription_to_update->subscription_price_with_discount }}" placeholder="Price With Discount" required />
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label>Subscription Duration</label>
                                <input type="text" name = "subscription_duration" value = "{{ $subscription_to_update->subscription_duration }}" placeholder="Enter Subscription Duration" required />
                            </div>
                            <div class="input-box">
                                <label>Background Color</label>
                                <input type="text" name = "subscription_bg_color" value = "{{ $subscription_to_update->subscription_bg_color }}" placeholder="Write color name or #code" required />
                            </div>
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label>Thumbnail Image</label>
                                <input type="file" name = "subscription_thumnail_image" id = "file_input" />
                            </div>
                            <div class="input-box">
                                <label>Background Image</label>
                                <input type="file" name = "subscription_bg_pic" id = "file_input2" />
                            </div>
                        </div>

                        <div class="column" >
                            <div class="input-box" style = "display : flex;">
                                <button style = "margin: 0 10px; font-size: 17px;" onclick="showCurrentThumnailImage(event)">Current Thumbnail Image</button>
                                <button style = "margin: 0 10px; font-size: 17px;" onclick="showCurrentBGImage(event)">Current Background Image</button>
                            </div>
                        </div>

                        
                        <div class="input-box address">
                        <label>Subscription Status</label>
                            <div class="column" id = "chalo_uppar">
                                <div class="select-box">
                                <select  name = "subscription_status">
                                    <option selected>{{ $subscription_to_update->subscription_status }}</option>
                                    <option>active</option>
                                    <option>inactive</option>
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="tc-container">
                            <label for="tc" class="tc">
                                <input type="checkbox" name="tc" id="tc" checked required>
                                By submitting your details, you agree to the <a href="#">terms and conditions</a>
                            </label>
                        </div>
                        <button type = "submit">Submit</button>
                    </form>
                    </section>
                </div>
            </body>
            </html> -->

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta http-equiv="X-UA-Compatible" content="ie=edge" />
                <link rel="stylesheet" href="{{ asset('cssfiles/simple_cute_form.css') }}">
            </head>
            <body>
                <div id = "nested_bodyy">
                    <section class="container">
                    <header>Update Subscription Record</header>
                    <form action="{{ route('updating_subscription_form_submission_route', $subscription_to_update->id) }}" class="form" method = "post" enctype="multipart/form-data">
                        @csrf
                        <div class="column">
                            <div class="input-box">
                                <label>Subscription Name</label>
                                <input type="text" name = "subscription_name" value = "{{ $subscription_to_update->subscription_name }}" placeholder="Enter Subscription Name" required />
                            </div>
                            <div class="input-box">
                                <label>Subscription Title</label>
                                <input type="text" name = "subscription_title" value = "{{ $subscription_to_update->subscription_title }}" placeholder="Enter Subscription Title" required />
                            </div>
                        </div>

                        <div class="input-box">
                        <label>Subscription Discription</label>
                        <input type="text" name = "subscription_discription" value = "{{ $subscription_to_update->subscription_discription }}" placeholder="Enter Subscription Discription" required />
                        </div>

                        <div class="column">
                            <div class="input-box">
                                <label>Subscription Price [Without Discount]</label>
                                <input type="number" name = "subscription_price_without_discount" value = "{{ $subscription_to_update->subscription_price_without_discount }}" placeholder="Price Without Discount" required />
                            </div>
                            <div class="input-box">
                                <label>Subscription Price [With Discount]</label>
                                <input type="number" name = "subscription_price_with_discount" value = "{{ $subscription_to_update->subscription_price_with_discount }}" placeholder="Price With Discount" required />
                            </div>
                        </div>

                        <div class="column">
                        
                            <div class="input-box">
                                
                                <label>Subscription Duration</label><br>
                                <input type="number" name = "subscription_duration_number" value = "{{ $subscription_to_update->subscription_duration_number }}" min = "1" id = "sub_duration" required />
                            </div>

                            <div style="display: flex; align-items: center; position: absolute; margin-top: 63px; margin-left: 100px;">
                                <label>
                                    <input type="radio" name="subscription_duration_unit" value="Days" style="cursor: pointer;" {{ $subscription_to_update->subscription_duration_unit == 'Days' ? 'checked' : '' }} required> <span style="margin-right: 15px;">Days</span>
                                </label>
                                <label>
                                    <input type="radio" name="subscription_duration_unit" value="Weeks" style="cursor: pointer;" {{ $subscription_to_update->subscription_duration_unit == 'Weeks' ? 'checked' : '' }}> <span style="margin-right: 15px;">Weeks</span>
                                </label>
                                <label>
                                    <input type="radio" name="subscription_duration_unit" value="Months" style="cursor: pointer;" {{ $subscription_to_update->subscription_duration_unit == 'Months' ? 'checked' : '' }}> <span style="margin-right: 15px;">Months</span>
                                </label>
                                <label>
                                    <input type="radio" name="subscription_duration_unit" value="Years" style="cursor: pointer;" {{ $subscription_to_update->subscription_duration_unit == 'Years' ? 'checked' : '' }}> <span>Years</span>
                                </label>
                            </div>
                        </div>

                        <!-- ======================================== Subscription Access Rights area ========================================= -->

                        <!-- ---------- View Videos & PDFs Access Start ------------ -->
                        <div class="column">
                        
                                <div class="input-box">
                                    
                                    <label>Access Rights <span style = "font-size: 13px;">[Here, In this Section, PDFs include both "Tutorials" and "Old Exam Papers" PDFs]</span></label><br>
                                    <span>View Videos & PDFs &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</span>
                                </div>

                                <span style="display: flex; align-items: center; position: absolute; margin-top: 53px; margin-left: 190px;">
                                    <!-- -------- Yes/No ---------- -->
                                    <label>
                                        <input type="radio" name="View_Videos_and_PDFs_access_boolean" value="true" style="cursor: pointer;" id = "Videos_and_PDFs_access_yes" {{ $subscription_to_update->View_Videos_and_PDFs_access_boolean == 'true' ? 'checked' : '' }} required> <span style="margin-right: 15px;">Yes</span>
                                    </label>
                                    <label id="no-label">
                                        <input type="radio" name="View_Videos_and_PDFs_access_boolean" value="false" style="cursor: pointer;" id = "Videos_and_PDFs_access_no" {{ $subscription_to_update->View_Videos_and_PDFs_access_boolean == 'false' ? 'checked' : '' }}> <span style="margin-right: 15px;">No</span>
                                    </label>
                                    <!-- --------------- -->

                                    <!-- ---------- limited/unlimited ---------- -->
                                    <label id="limited-label">
                                        <input type="radio" name="View_Videos_and_PDFs_access_limitation" value="Limited" style="cursor: pointer;" id = "Videos_and_PDFs_access_limit_limited" {{ $subscription_to_update->View_Videos_and_PDFs_access_limitation == 'Limited' ? 'checked' : '' }}> <span style="margin-right: 15px;">Limited</span>
                                    </label>
                                    <label id="unlimited-label">
                                        <input type="radio" name="View_Videos_and_PDFs_access_limitation" value="Unlimited" style="cursor: pointer;" id = "Videos_and_PDFs_access_limit_unlimited" {{ $subscription_to_update->View_Videos_and_PDFs_access_limitation == 'Unlimited' ? 'checked' : '' }}> <span style="margin-right: 15px;">Unlimited</span>
                                    </label>
                                    <!-- --------------- -->

                                    <!-- ---------- limited numbers [if applicable] ---------- -->
                                    <span style="margin-top: -10px; margin-left: 10px; display: none;" id = "limit_number_input">
                                        <input type="number" name = "View_Videos_and_PDFs_access_limitation_number" value = "{{ $subscription_to_update->View_Videos_and_PDFs_access_limitation_number ? $subscription_to_update->View_Videos_and_PDFs_access_limitation_number : '--' }}" min = "1" id = "Videos_and_PDFs_access_limit_number" />
                                    </span>
                                    <!-- --------------- -->

                                </span>
                        </div>
                        <!-- ---------- View Videos & PDFs Access End ------------ -->



                        <!-- ---------- Download Videos & PDFs Access Start ------------ -->
                        <div class="column">
                        
                                <div class="input-box">
                                    <span>Download Videos & PDFs &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</span>
                                </div>

                                <span style="display: flex; align-items: center; position: absolute; margin-top: 21px; margin-left: 230px;">
                                    <!-- -------- Yes/No ---------- -->
                                    <label>
                                        <input type="radio" name="Download_Videos_and_PDFs_access_boolean" value="true" style="cursor: pointer;" id = "Download_Videos_and_PDFs_access_yes" {{ $subscription_to_update->Download_Videos_and_PDFs_access_boolean == 'true' ? 'checked' : '' }} required> <span style="margin-right: 15px;">Yes</span>
                                    </label>
                                    <label id="no-label2">
                                        <input type="radio" name="Download_Videos_and_PDFs_access_boolean" value="false" style="cursor: pointer;" id = "Download_Videos_and_PDFs_access_no" {{ $subscription_to_update->Download_Videos_and_PDFs_access_boolean == 'false' ? 'checked' : '' }}> <span style="margin-right: 15px;">No</span>
                                    </label>
                                    <!-- --------------- -->

                                    <!-- ---------- limited/unlimited ---------- -->
                                    <label style="display: none" id="limited-label2">
                                        <input type="radio" name="Download_Videos_and_PDFs_access_limitation" value="Limited" style="cursor: pointer;" id = "Download_Videos_and_PDFs_access_limit_limited" {{ $subscription_to_update->Download_Videos_and_PDFs_access_limitation == 'Limited' ? 'checked' : '' }}> <span style="margin-right: 15px;">Limited</span>
                                    </label>
                                    <label style="display: none" id="unlimited-label2">
                                        <input type="radio" name="Download_Videos_and_PDFs_access_limitation" value="Unlimited" style="cursor: pointer;" id = "Download_Videos_and_PDFs_access_limit_unlimited" {{ $subscription_to_update->Download_Videos_and_PDFs_access_limitation == 'Unlimited' ? 'checked' : '' }}> <span style="margin-right: 15px;">Unlimited</span>
                                    </label>
                                    <!-- --------------- -->

                                    <!-- ---------- limited numbers [if applicable] ---------- -->
                                    <span style="margin-top: -10px; margin-left: 10px; display: none;" id = "limit_number_input2">
                                        <input type="number" name = "Download_Videos_and_PDFs_access_limitation_number" value = "{{ $subscription_to_update->Download_Videos_and_PDFs_access_limitation_number ? $subscription_to_update->Download_Videos_and_PDFs_access_limitation_number : '--' }}" min = "1" id = "Download_Videos_and_PDFs_access_limit_number"  />
                                    </span>
                                    <!-- --------------- -->

                                </span>
                        </div>
                        <!-- ---------- Download Videos & PDFs Access End ------------ -->



                        <!-- ---------- Exams Access Start ------------ -->
                        <div class="column">
                        
                                <div class="input-box">
                                    <span>Exams &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</span>
                                </div>

                                <span style="display: flex; align-items: center; position: absolute; margin-top: 21px; margin-left: 90px;">
                                    <!-- -------- Yes/No ---------- -->
                                    <label>
                                        <input type="radio" name="Exams_access_boolean" value="true" style="cursor: pointer;" id = "Exams_access_yes" {{ $subscription_to_update->Exams_access_boolean == 'true' ? 'checked' : '' }} required> <span style="margin-right: 15px;">Yes</span>
                                    </label>
                                    <label id="no-label3">
                                        <input type="radio" name="Exams_access_boolean" value="false" style="cursor: pointer;" id = "Exams_access_no" {{ $subscription_to_update->Exams_access_boolean == 'false' ? 'checked' : '' }} > <span style="margin-right: 15px;">No</span>
                                    </label>
                                    <!-- --------------- -->

                                    <!-- ---------- limited/unlimited ---------- -->
                                    <label style="display: none" id="limited-label3">
                                        <input type="radio" name="Exams_access_limitation" value="Limited" style="cursor: pointer;" id = "Exams_access_limit_limited" {{ $subscription_to_update->Exams_access_limitation == 'Limited' ? 'checked' : '' }}> <span style="margin-right: 15px;">Limited</span>
                                    </label>
                                    <label style="display: none" id="unlimited-label3">
                                        <input type="radio" name="Exams_access_limitation" value="Unlimited" style="cursor: pointer;" id = "Exams_access_limit_unlimited" {{ $subscription_to_update->Exams_access_limitation == 'Unlimited' ? 'checked' : '' }}> <span style="margin-right: 15px;">Unlimited</span>
                                    </label>
                                    <!-- --------------- -->

                                    <!-- ---------- limited numbers [if applicable] ---------- -->
                                    <span style="margin-top: -10px; margin-left: 10px; display: none;" id = "limit_number_input3">
                                        <input type="number" name = "Exams_access_limitation_number" value = "{{ $subscription_to_update->Exams_access_limitation_number ? $subscription_to_update->Exams_access_limitation_number : '--' }}" min = "1" id = "Exams_access_limit_number" />
                                    </span>
                                    <!-- --------------- -->

                                </span>
                        </div>
                        <!-- --------- Exams access End ------------- -->
                        <!-- ======================================== End of Subscription Access Rights area ========================================= -->

                        <div class="input-box">
                                <label>Background Color</label>
                                <input type="text" name = "subscription_bg_color" value = "{{ $subscription_to_update->subscription_bg_color }}" placeholder="Write color name or #code" required />
                            </div>

                        <div class="column">
                            <div class="input-box">
                                <label>Thumbnail Image</label>
                                <input type="file" name = "subscription_thumnail_image" id = "file_input"  />
                            </div>
                            <div class="input-box">
                                <label>Background Image</label>
                                <input type="file" name = "subscription_bg_pic" id = "file_input2"  />
                            </div>
                        </div>

                        <div class="column" >
                            <div class="input-box" style = "display : flex;">
                                <button style = "margin: 0 10px; font-size: 17px;" onclick="showCurrentThumnailImage(event)">Current Thumbnail Image</button>
                                <button style = "margin: 0 10px; font-size: 17px;" onclick="showCurrentBGImage(event)">Current Background Image</button>
                            </div>
                        </div>
                        
                        <div class="input-box address">
                        <label>Subscription Status</label>
                            <div class="column" id = "chalo_uppar">
                                <div class="select-box">
                                <select  name = "subscription_status">
                                    <option selected>{{ $subscription_to_update->subscription_status }}</option>
                                    <option>active</option>
                                    <option>inactive</option>
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="tc-container">
                            <label for="tc" class="tc">
                                <input type="checkbox" name="tc" id="tc" checked required>
                                By submitting your details, you agree to the <a href="#">terms and conditions</a>
                            </label>
                        </div>
                        <button type = "submit">Update</button>
                    </form>
                    </section>
                </div>
            </body>
            </html>
        </div>
    </div>
@endsection
@section('script')
<script>
    function showCurrentThumnailImage(){
        event.preventDefault();
        var subscriptionId = "{{ $subscription_to_update->id }}";
        var url = '{{ route("show_current_thumbnail_image_of_subscription_to_admin", ["id" => $subscription_to_update->id]) }}';
        window.open(url, '_blank');
    }

    function showCurrentBGImage(){
        event.preventDefault();
        var subscriptionId = "{{ $subscription_to_update->id }}";
        var url = '{{ route("show_current_background_image_of_subscription_to_admin", ["id" => $subscription_to_update->id]) }}';
        window.open(url, '_blank');
    }
</script>

<script src="{{ asset('js/simple_cute_form2.js') }}"></script>
@endsection