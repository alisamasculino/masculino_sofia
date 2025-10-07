<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="<?=base_url();?>public/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .password-toggle {
      cursor: pointer;
      user-select: none;
    }
    .error {
      color: red;
    }
  </style>
</head>

<body class="min-h-screen font-sans bg-gradient-to-br from-pink-100 via-white to-pink-50 flex items-center justify-center px-4">

  <!-- Main Content -->
  <div class="bg-white border border-pink-200 shadow-lg rounded-2xl p-8 w-full max-w-md">

    <!-- Header -->
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-pink-600">Register</h1>
    </div>

    <?php if (isset($error)): ?>
      <p class="error text-center mb-4"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="<?= site_url('register') ?>" class="space-y-4">
      <div>
        <label for="username" class="block text-gray-700 font-medium mb-2">Username:</label>
        <input type="text" id="username" name="username" required
               class="w-full px-3 py-2 border border-pink-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-500" />
      </div>

      <div>
        <label for="email" class="block text-gray-700 font-medium mb-2">Email:</label>
        <input type="email" id="email" name="email" required
               class="w-full px-3 py-2 border border-pink-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-500" />
      </div>

      <div>
        <label for="password" class="block text-gray-700 font-medium mb-2">Password:</label>
        <div class="relative">
          <input type="password" id="password" name="password" required
                 class="w-full px-3 py-2 border border-pink-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-500" />
          <span class="password-toggle absolute right-3 top-2 text-pink-500" onclick="togglePassword()">👁️</span>
        </div>
      </div>

      <div>
        <label for="role" class="block text-gray-700 font-medium mb-2">Role:</label>
        <select id="role" name="role"
                class="w-full px-3 py-2 border border-pink-300 rounded-full focus:outline-none focus:ring-2 focus:ring-pink-500">
          <option value="user" selected>User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded-full shadow transition duration-200">
        Register
      </button>
    </form>

    <p class="text-center mt-4">Already have an account? <a href="<?= site_url('login') ?>" class="text-pink-600 hover:text-pink-800">Login here</a></p>

  </div>

  <script>
    function togglePassword() {
      var pwd = document.getElementById('password');
      if (pwd.type === 'password') {
        pwd.type = 'text';
      } else {
        pwd.type = 'password';
      }
    }
  </script>

</body>
</html>