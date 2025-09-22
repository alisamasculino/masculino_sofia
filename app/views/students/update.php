<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Student Record</title>
  <style>
    /* Body */
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #f5f1e9, #e2d6c8);
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      color: #3b2f2f;
    }

    /* Header/Navbar */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      background: rgba(59, 47, 47, 0.1);
      backdrop-filter: blur(8px);
      box-shadow: 0 4px 12px rgba(59, 47, 47, 0.2);
      position: sticky;
      top: 0;
      z-index: 10;
    }

    header h1 {
      font-size: 2rem;
      font-weight: 700;
      letter-spacing: 1px;
      margin: 0;
      color: #3b2f2f;
    }

    header .nav a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 12px;
      background: #8b5e3c;
      transition: all 0.3s ease;
    }

    header .nav a:hover {
      background: #a17459;
      transform: translateY(-2px);
    }

    /* Main container */
    .app {
      display: flex;
      flex-wrap: wrap;
      max-width: 900px;
      margin: 60px auto 40px;
      gap: 20px;
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(6px);
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(59, 47, 47, 0.25);
      overflow: hidden;
    }

    /* Left image side */
    .left-side {
      flex: 1;
      min-width: 250px;
      background: url('https://i.pinimg.com/736x/fc/52/75/fc5275a6b1b78f5d20658a8ebd2c9c97.jpg') 
      center/cover no-repeat;
    }

    /* Right form side */
    .right-side {
      flex: 1;
      min-width: 300px;
      padding: 30px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .right-side h2 {
      font-size: 2rem;
      margin-bottom: 30px;
      font-weight: 700;
      color: #3b2f2f;
      text-align: center;
    }

    /* Form styling */
    .right-side form {
      width: 100%;
      max-width: 300px;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    form input[type="text"], form input[type="email"] {
      padding: 15px 10px;
      border-radius: 12px;
      border: 1px solid #8b5e3c;
      outline: none;
      font-size: 1rem;
      width: 100%;
      background: #f5f1e9;
      color: #3b2f2f;
    }

    .actions {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
    }

    .action-button {
      background: #8b5e3c;
      border: none;
      border-radius: 12px;
      padding: 12px 20px;
      color: #fff;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      text-decoration: none;
      text-align: center;
      transition: all 0.3s ease;
    }

    .action-button:hover {
      background: #a17459;
      transform: translateY(-2px);
    }

    .cancel-button {
      background: #d9774f;
    }

    .cancel-button:hover {
      background: #f0a472;
    }

    @media (max-width: 800px) {
      .app {
        flex-direction: column;
      }
      .left-side {
        height: 200px;
      }
    }

    /* Footer */
    footer {
      margin-top: 40px;
      padding: 20px;
      text-align: center;
      color: #3b2f2f;
      font-size: 0.9rem;
      background: rgba(235, 225, 210, 0.5);
      backdrop-filter: blur(6px);
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
    }

    footer p {
      margin: 6px 0;
    }
  </style>
</head>
<body>

  <!-- Header/Navbar -->
  <header>
    <h1>Student Management</h1>
    <div class="nav">
      <a href="<?=base_url('students/index');?>">Home</a>
    </div>
  </header>

  <!-- Main App -->
  <div class="app">
    <!-- Left image -->
    <div class="left-side"></div>

    <!-- Right form -->
    <div class="right-side">
      <h2>Update Student Record</h2>
      <form action="<?= site_url('students/update/'.$user['id']); ?>" method="POST" novalidate>
        <input type="text" name="first_name" placeholder="First Name" required value="<?= html_escape($user['first_name']); ?>">
        <input type="text" name="last_name" placeholder="Last Name" required value="<?= html_escape($user['last_name']); ?>">
        <input type="email" name="email" placeholder="Email (example@gmail.com)" required 
               value="<?= html_escape($user['email']); ?>" 
               pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" 
               title="Please enter a valid Gmail address (example@gmail.com)">
        <div class="actions">
          <a href="<?=base_url('students/index');?>"  class="action-button cancel-button">Cancel</a>
          <button type="submit" class="action-button">Update</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <p>&copy; <?= date('Y'); ?> Student Management System</p>
    <p>BSIT 3F2 Students | Mindoro State University</p>
  </footer>

</body>
</html>
