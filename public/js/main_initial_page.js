let toggleBtn = document.getElementById('toggle-btn');
let body = document.body;
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () =>{
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}

toggleBtn.onclick = (e) =>{
   darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enableDarkMode();
   }else{
      disableDarkMode();
   }
}

function confirmAdminLogout() {
   let answer = confirm("Are you sure you want to logout?");
   if (answer) {
       window.location.href = "/admin_logout";
   }
}

function confirmFacultyLogout() {
   let answer = confirm("Are you sure you want to logout?");
   if (answer) {
       window.location.href = "/faculty_logout";
   }
}

function confirmStudentLogout() {
   let answer = confirm("Are you sure you want to logout?");
   if (answer) {
       window.location.href = "/student_logout";
   }
}