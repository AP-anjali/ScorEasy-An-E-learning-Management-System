<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact us</title>
   </style>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   <link rel="stylesheet" href="{{ asset('cssfiles/main_initial_page.css') }}">

</head>
<body class = "active">

<header class="header">
   
   <section class="flex">

      <a href="{{ route('main_initial_page') }}" class="logo" style = "font-family: 'poppins', sans-serif;">SCOR<span style = "color: purple;">E</span>ASY</a>

      <form action="search.html" method="post" class="search-form">
         <input type="text" name="search_box" required placeholder="search here..." maxlength="100">
         <button type="submit" class="fas fa-search"></button>
      </form>

      <div class="icons">

            @if(session('student_session'))
                  <a href="{{ route('main_student_dashboard') }}" class = "menuitem">
                     <div id="menu-btn1" class="fas" style = "width : 150px; font-family: 'poppins', sans-serif; font-size: 17px; font-weight:700; margin-right : 20px;">
                        <i class='bx bxs-user' id= "test1"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Account
                     </div>
                  </a>

                  <a onclick="confirmStudentLogout()" class = "menuitem">
                     <div id="menu-btn" class="fas" style = "width : 110px; font-family: 'poppins', sans-serif; font-size: 16px; font-weight:600; margin-right : 20px;">
                        <i class='bx bx-trending-up' id= "test2"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Logout
                     </div>
                  </a>

               @elseif(session('faculty_session'))
                  <a href="{{ route('main_faculty_dashboard') }}" class = "menuitem">
                     <div id="menu-btn1" class="fas" style = "width : 130px; font-family: 'poppins', sans-serif; font-size: 17px; font-weight:700; margin-right : 20px;">
                        <i class='bx bxs-user' id= "test1"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard
                     </div>
                  </a>

                  <a onclick="confirmFacultyLogout()" class = "menuitem">
                     <div id="menu-btn" class="fas" style = "width : 110px; font-family: 'poppins', sans-serif; font-size: 16px; font-weight:600; margin-right : 20px;">
                        <i class='bx bx-trending-up' id= "test2"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Logout
                     </div>
                  </a>

               @elseif(session('admin_session'))
                  <a href="{{ route('main_admin_dashboard') }}" class = "menuitem">
                     <div id="menu-btn1" class="fas" style = "width : 130px; font-family: 'poppins', sans-serif; font-size: 17px; font-weight:700; margin-right : 20px;">
                        <i class='bx bxs-user' id= "test1"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dashboard
                     </div>
                  </a>

                  <a onclick="confirmAdminLogout()" class = "menuitem">
                     <div id="menu-btn" class="fas" style = "width : 110px; font-family: 'poppins', sans-serif; font-size: 16px; font-weight:600; margin-right : 20px;">
                        <i class='bx bx-trending-up' id= "test2"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Logout
                     </div>
                  </a>

               @else
                  <a href="{{ route('students_first_window') }}" class = "menuitem">
                     <div id="menu-btn1" class="fas" style = "width : 130px; font-family: 'poppins', sans-serif; font-size: 17px; font-weight:700; margin-right : 20px;">
                        <i class='bx bxs-user' id= "test1"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Students
                     </div>
                  </a>

                  <a href="{{ route('faculities_first_window') }}" class = "menuitem">
                     <div id="menu-btn" class="fas" style = "width : 130px; font-family: 'poppins', sans-serif; font-size: 16px; font-weight:600; margin-right : 20px;">
                        <i class='bx bx-trending-up' id= "test2"></i>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Instructors
                     </div>
                  </a>
               @endif

         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>
   </section>

</header>

<script src="{{ asset('js/main_initial_page.js') }}"></script>  
</body>
</html>