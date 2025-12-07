const cover = document.querySelector('.cover');
const registerlink = document.querySelector('.register-link');
const loginlink = document.querySelector('.login-link');

registerlink.onclick = () => {
    cover.classList.add('active');

}

loginlink.onclick = () => {
    cover.classList.remove('active');

}

function showPlaceholder() {
    var input = document.getElementById('myInput');
    input.value = ''; // Clear the input field
    input.placeholder = 'Create your Unique Username'; // Show the placeholder text
  }

  function showPlaceholder1() {
    var input = document.getElementById('myInput1');
    input.value = ''; // Clear the input field
    input.placeholder = 'Create your Strong Password'; // Show the placeholder text
  }

  function showPlaceholder2() {
    var input = document.getElementById('myInput2');
    input.value = ''; // Clear the input field
    input.placeholder = 'Enter password again'; // Show the placeholder text
  }

  function showPlaceholder3() {
    var input = document.getElementById('myInput3');
    input.value = ''; // Clear the input field
    input.placeholder = 'Enter Your Username'; // Show the placeholder text
  }

  function showPlaceholder4() {
    var input = document.getElementById('myInput4');
    input.value = ''; // Clear the input field
    input.placeholder = 'Enter Your password'; // Show the placeholder text
  }

  function showPlaceholder5() {
    var input = document.getElementById('myInput5');
    input.value = ''; // Clear the input field
    input.placeholder = 'Enter Your Name'; // Show the placeholder text
  }

  function showPlaceholder6() {
    var input = document.getElementById('myInput6');
    input.value = ''; // Clear the input field
    input.placeholder = 'Enter Your Email Address'; // Show the placeholder text
  }