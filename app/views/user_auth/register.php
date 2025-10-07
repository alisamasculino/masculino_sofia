<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80') no-repeat center center;
            background-size: cover;
            opacity: 0.15;
            z-index: -1;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .header-gradient {
            background: linear-gradient(135deg, #1a2a6c 0%, #b21f1f 50%, #fdbb2d 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1a2a6c 0%, #b21f1f 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 42, 108, 0.4);
        }

        .form-input {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(26, 42, 108, 0.2);
            transition: all 0.3s ease;
        }

        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(26, 42, 108, 0.1);
            border-color: #1a2a6c;
            background: rgba(255, 255, 255, 0.95);
        }

        /* Hide Edge/IE native password reveal so we only use the emoji toggle */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }

        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .image-container {
            background: linear-gradient(135deg, #1a2a6c 0%, #b21f1f 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            min-height: 200px;
        }

        .login-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1a2a6c 0%, #b21f1f 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            box-shadow: 0 8px 25px rgba(26, 42, 108, 0.3);
        }

        .error {
            color: red;
        }
    </style>
</head>

<body class="min-h-screen p-4 md:p-6 relative">

    <!-- Floating decorative elements -->
    <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-blue-400 opacity-20 floating-icon"></div>
    <div class="absolute bottom-20 right-10 w-16 h-16 rounded-full bg-red-400 opacity-20 floating-icon" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/3 right-1/4 w-12 h-12 rounded-full bg-yellow-400 opacity-20 floating-icon" style="animation-delay: 2s;"></div>

    <div class="relative w-full max-w-3xl mx-auto rounded-2xl glass-effect p-4">

        <!-- Header -->
        <header class="flex flex-col md:flex-row justify-between items-center gap-4 py-3 mb-6">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-full bg-white bg-opacity-20">
                    <i class="fas fa-user-plus text-2xl text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white drop-shadow-md">User Registration</h1>
                    <p class="text-white text-opacity-80 text-sm">Create your account</p>
                </div>
            </div>
        </header>

        <!-- Form Section -->
        <section class="form-container">
            <div class="header-gradient text-white p-4">
                <h2 class="text-lg md:text-xl font-semibold flex items-center gap-2">
                    <i class="fas fa-user-edit"></i>
                    Register Account
                </h2>
                <p class="text-white text-opacity-90 text-sm">Fill in your details to register</p>
            </div>

            <div class="p-5 md:p-6">
                <?php if (isset($error)): ?>
                    <p class="error text-center mb-4"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
                    <div class="image-container h-full">
                        <img src="https://i.pinimg.com/736x/c0/50/e4/c050e4b7cd705bb390c3ce021cc5f80d.jpg" alt="Register Illustration" class="w-full h-full object-cover rounded-lg shadow-lg">
                    </div>
                    <div class="h-full">
                        <form method="post" action="<?= site_url('register') ?>" class="space-y-5" novalidate>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                        <i class="fas fa-user text-blue-500"></i>
                                        Username
                                    </label>
                                    <input type="text" name="username" placeholder="Enter username" required
                                        class="w-full px-3 py-2 rounded-lg form-input focus:outline-none text-sm" />
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                        <i class="fas fa-envelope text-green-500"></i>
                                        Email
                                    </label>
                                    <input type="email" name="email" placeholder="Enter email" required
                                        class="w-full px-3 py-2 rounded-lg form-input focus:outline-none text-sm" />
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                        <i class="fas fa-lock text-red-500"></i>
                                        Password
                                    </label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password" placeholder="Enter password" required
                                            class="w-full px-3 py-2 pr-10 rounded-lg form-input focus:outline-none text-sm" />
                                        <button type="button" onclick="togglePassword()"
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none text-sm font-bold">
                                            <span id="password-toggle">👁️</span>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1 flex items-center gap-2">
                                        <i class="fas fa-user-tag text-purple-500"></i>
                                        Role
                                    </label>
                                    <select name="role"
                                            class="w-full px-3 py-2 rounded-lg form-input focus:outline-none text-sm">
                                        <option value="user" selected>User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>

                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-lg btn-primary text-white font-semibold shadow-lg text-sm">
                                    <i class="fas fa-user-plus"></i>
                                    Register
                                </button>

                                <p class="text-center text-gray-600 text-xs">
                                    Already have an account? 
                                    <a href="<?= site_url('login') ?>" class="text-blue-600 hover:text-blue-800 font-semibold">Login here</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center text-white text-opacity-70 py-3 mt-6 border-t border-white border-opacity-20 text-xs">
            <p class="flex items-center justify-center gap-1">
                <i class="fas fa-heart text-red-400"></i>
                <span>© 2023 Student Records Management System | BSIT 3F2 - Mindoro State University</span>
            </p>
        </footer>

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️';
            }
        }

        // Show spinner on submit
        (function() {
            const form = document.querySelector('form');
            if (!form) return;
            const submitBtn = form.querySelector('button[type="submit"]');
            if (!submitBtn) return;
            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span> Registering...</span>';
            });
        })();
    </script>

</body>
</html>
