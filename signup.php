<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up | FindUrBuddy</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Quicksand', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #ffb3d9, #ff8dbd);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .signup-box {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(255, 94, 135, 0.2);
      padding: 40px;
      width: 400px;
      text-align: center;
    }

    .signup-box h2 {
      color: #ff5e87;
      margin-bottom: 20px;
    }

    .input-group {
      margin: 20px 0;
      text-align: left;
    }

    .input-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: #444;
    }

    .input-group input {
      width: 100%;
      padding: 10px 15px;
      border-radius: 10px;
      border: 1px solid #ddd;
    }

    .btn {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      border: none;
      background-color: #ff5e87;
      color: white;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn:hover {
      background-color: #ff3f6c;
    }

    .extra-links {
      margin-top: 20px;
    }

    .extra-links a {
      color: #888;
      text-decoration: none;
      font-size: 0.9rem;
      margin: 0 5px;
      transition: color 0.2s;
    }

    .extra-links a:hover {
      color: #ff5e87;
    }

    .logo-icon {
      font-size: 2rem;
      color: #ff5e87;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <form class="signup-box" method="POST" action="signupLogic.php">
    <div class="logo-icon">🐾</div>
    <h2>Join the FindUrBuddy Family</h2>
    <div class="input-group">
      <label for="firstname">First Name</label>
      <input type="text" name="firstname" id="firstname" required />
    </div>
    <div class="input-group">
      <label for="lastname">Last Name</label>
      <input type="text" name="lastname" id="lastname" required />
    </div>
    <div class="input-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required />
    </div>
    <div class="input-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" required />
    </div>
    <button type="submit" name="submit" class="btn">Sign Up</button>

    <div class="extra-links">
      <a href="login.php">Already have an account? Sign In</a>
    </div>
  </form>
</body>
</html>
