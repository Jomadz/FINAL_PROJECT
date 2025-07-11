<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <style>
    /* Splash Screen */
    #splash-screen {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 100vw;
      background-color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    #splash-screen img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Full page styling */
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    #main-content {
      display: none;
      height: 100vh;
      display: flex;
      justify-content: flex-end;
      align-items: center;
      background-image: url('{{ asset("images/login4.gif") }}'); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 0 5vw 40px 0; /* right margin and bottom margin */
      box-sizing: border-box;
    }

    .login-card {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 15px;
      border-radius: 12px;
      width: 350px;
        max-width: 350px; 
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      animation: slideIn 1s ease-out;
      box-sizing: border-box;
      margin-left: auto;
margin-right: 0; 
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(100px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    .input-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      color: #555;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border-radius: 6px;
      border: 1px solid #ccc;
      box-sizing: border-box; 
    }

    input[type="checkbox"] {
      margin-right: 8px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: rgb(14, 40, 68);
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: rgb(5, 17, 31);
    }

    .error-messages {
      background-color: #f8d7da;
      color: rgb(183, 15, 15);
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 20px;
    }

    /* Responsive Styles */

    @media (max-width: 1024px) {
      #main-content {
        justify-content: center;
        padding: 20px;
      }

      .login-card {
        width: 80%;
           max-width: 350px;
       
      }
    }

    @media (max-width: 768px) {
      .login-card {
         justify-content: center;
        width: 90%;
      }
    }

    @media (max-width: 480px) {
      .login-card {
         justify-content: center;
        width: 95%;
        padding: 10px;
      }

      h2 {
        font-size: 18px;
      }

      button {
        font-size: 14px;
        padding: 10px;
      }
    }
  </style>
</head>
<body>

  <!-- Splash Screen -->
  <div id="splash-screen" style="
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: black;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  ">
    <img src="{{ asset('images/login4.gif') }}" alt="Loading...">
  </div>

  <!-- Main content -->
  <div id="main-content">
    <div class="login-card">
      <h2>POS-INVENTORY LOGIN</h2>

      <!-- Error Messages -->
      @if($errors->any())
        <div class="error-messages">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" required>
        </div>

        <div class="input-group">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" required>
        </div>

        <div class="input-group">
          <input type="checkbox" name="remember" id="remember">
          <label for="remember">Remember Me</label>
        </div>

        <button type="submit">Login</button>
      </form>
    </div>
  </div>

  <script>
    // Hide splash and show login after 5 seconds
    window.addEventListener('load', function() {
      setTimeout(function() {
        document.getElementById('splash-screen').style.display = 'none';
        document.getElementById('main-content').style.display = 'flex';
      }, 5000);
    });
  </script>
</body>
</html>
