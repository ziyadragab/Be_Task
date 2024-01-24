<!DOCTYPE html>
<html>
<head>
  <title>Sign In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 30px;
      padding: 0;
      background-color: #f1f1f1;
    }
    
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    h2 {
      text-align: center;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    .form-group input[type="text"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    
    .form-group button {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    
    .form-group button:hover {
      background-color: #45a049;
    }
    
    .toggle-form {
      text-align: center;
      margin-top: 20px;
    }
    
    .toggle-form a {
      color: #4CAF50;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 id="loginhead">Login</h2>
    <form id="loginForm" action="login.php" method="POST">
      <div class="form-group">
        <label for="loginUsername">Username</label>
        <input type="text" id="loginUsername" name="loginUsername" placeholder="Enter your username" required>
      </div>
      <div class="form-group">
        <label for="loginPassword">Password</label>
        <input type="password" id="loginPassword" name="loginPassword" placeholder="Enter your password" required>
      </div>
      <div class="form-group">
        <button type="submit">Login</button>
      </div>
    </form>


   
    <form id="registerForm" action="{{ route('register') }}" method="POST" style="display: none;">
        @csrf
        <div class="form-group">
          <label for="registerUsername">Username</label>
          <input type="text" id="registerUsername" name="name" placeholder="Choose a username" class="@error('name') is-invalid @enderror">
          @error('name')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      
        <div class="form-group">
          <label for="registerEmail">Email</label>
          <input type="text" id="registerEmail" name="email" placeholder="Enter your email"  class="@error('email') is-invalid @enderror">
          @error('email')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="registerPassword">Password</label>
          <input type="password" id="registerPassword" name="password" placeholder="Choose a password"  class="@error('password') is-invalid @enderror">
          @error('password')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
       
        <div class="form-group">
          <button type="submit">Register</button>
        </div>
      </form>
    
    <div class="toggle-form">
      <a href="#" id="toggleLink">Create an account</a>
    </div>
  </div>
  
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const loginForm = document.getElementById("loginForm");
      const registerForm = document.getElementById("registerForm");
      const toggleLink = document.getElementById("toggleLink");
      const loginHead = document.getElementById("loginhead");

      // Check if a form was previously selected
      const lastForm = sessionStorage.getItem("lastForm");
      if (lastForm === "register") {
        loginForm.style.display = "none";
        registerForm.style.display = "block";
        toggleLink.textContent = "Login";
        loginHead.textContent = "Register";
      } else {
        loginForm.style.display = "block";
        registerForm.style.display = "none";
        toggleLink.textContent = "Create an account";
        loginHead.textContent = "Login";
      }

      toggleLink.addEventListener("click", function(event) {
        event.preventDefault();

        if (loginForm.style.display === "none") {
          loginForm.style.display = "block";
          registerForm.style.display = "none";
          toggleLink.textContent = "Create an account";
          loginHead.textContent = "Login";
          sessionStorage.setItem("lastForm", "login"); // Store the selected form
        } else {
          loginForm.style.display = "none";
          registerForm.style.display = "block";
          toggleLink.textContent = "Login";
          loginHead.textContent = "Register";
          sessionStorage.setItem("lastForm", "register"); // Store the selected form
        }
      });
    });
  </script>
  @include('sweetalert::alert')
</body>
</html>