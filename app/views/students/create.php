<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create New Student</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 50, 0.5);
      z-index: 0;
    }
    #app {
      position: relative;
      z-index: 1;
    }
  </style>
</head>
<body
  class="min-h-screen flex items-center justify-center p-6 bg-cover bg-center relative"
  style="background-image: url('https://i.pinimg.com/originals/5e/aa/8e/5eaa8e51ed6d41bc1516bd610d191ee1.gif');"
>
  <div id="app" class="relative w-full max-w-3xl bg-white/90 rounded-2xl shadow-2xl p-8 backdrop-blur-md flex flex-col gap-8">
    <h1 class="text-4xl font-extrabold text-indigo-900 text-center tracking-wide drop-shadow-md">
      Create New Student
    </h1>

    <section class="bg-indigo-50 rounded-xl p-6 shadow-md w-full">
      <form action="<?=site_url('students/create');?>" method="POST" class="space-y-4" novalidate>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <input type="text" name="first_name" placeholder="First Name" required
            class="w-full px-4 py-2 border border-indigo-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          <input type="text" name="last_name" placeholder="Last Name" required
            class="w-full px-4 py-2 border border-indigo-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <input type="email" name="email" placeholder="Email" required pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
        title="Please enter a valid Gmail address (example@gmail.com)"
        class="w-full px-4 py-2 border border-indigo-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        <div class="flex justify-between items-center">
          <a href="<?=base_url('students/index');?>" 
            class="inline-block bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-400 transition duration-200">
            Cancel
          </a>
          <button type="submit"
            class="bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg hover:bg-indigo-800 transition duration-200">
            Create
          </button>
        </div>
      </form>
    </section>
  </div>

  <script>
    const form = document.querySelector('form');
    const emailInput = form.querySelector('input[name="email"]');

    form.addEventListener('submit', function(event) {
      const emailValue = emailInput.value.trim();
      const gmailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;

      if (!gmailPattern.test(emailValue)) {
        event.preventDefault();
        alert('Please enter a valid Gmail address (example@gmail.com).');
        emailInput.focus();
      }
    });
  </script>
</body>
</html>