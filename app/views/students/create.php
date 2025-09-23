<!DOCTYPE html>
<html lang="en">
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
      background: rgba(42, 139, 42, 0.55); 
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
  style="background-image: url('https://i.pinimg.com/originals/1f/bc/87/1fbc87e7d73c792eb7e4d5e27d1814e1.gif');">
 

  <div id="app" class="relative w-full max-w-2xl bg-white/80 rounded-3xl shadow-2xl p-10 backdrop-blur-lg border border-white/40">
    
 
    <h1 class="text-4xl font-extrabold text-green-800 text-center tracking-wide drop-shadow-md mb-6">
       Create New Student
    </h1>

    <section>
      <form action="<?=site_url('students/create');?>" method="POST" class="space-y-5" novalidate>
        

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <div>
            <label class="block text-sm font-semibold text-green-700 mb-1">First Name</label>
            <input type="text" name="first_name" placeholder="Enter first name" required
              class="w-full px-4 py-3 border border-indigo-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" />
          </div>
          <div>
            <label class="block text-sm font-semibold text-green-700 mb-1">Last Name</label>
            <input type="text" name="last_name" placeholder="Enter last name" required
              class="w-full px-4 py-3 border border-indigo-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" />
          </div>
        </div>

   
        <div>
          <label class="block text-sm font-semibold text-green-700 mb-1">Gmail Address</label>
          <input type="email" name="email" placeholder="example@gmail.com" required 
            pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
            title="Please enter a valid Gmail address (example@gmail.com)"
            class="w-full px-4 py-3 border border-indigo-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" />
        </div>


        <div class="flex justify-between items-center pt-4">
          <a href="<?=base_url('students/index');?>"
            class="inline-block bg-gray-200 text-gray-800 font-semibold px-6 py-3 rounded-xl shadow hover:bg-gray-300 hover:shadow-md transition duration-200">
             Back
          </a>
          <button type="submit"
            class="bg-green-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-800 hover:shadow-xl transition duration-200">
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