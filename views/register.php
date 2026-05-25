<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Health Database System - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/images/icon.ico">
</head>
<body class="bg-slate-100 min-h-screen flex flex-col font-sans">

    <header class="bg-white border-b border-gray-100 px-8 py-4 flex justify-between items-center shadow-sm">
        <div class="flex items-center space-x-2 text-blue-600">
<img src="/national-health-db/assets/images/icon.ico" alt="Logo" class="w-8 h-8 object-contain">
    <span class="text-xl font-semibold text-slate-700">National Health Database System</span>
</div>
        <a href="index.php" class="border border-blue-400 text-blue-500 px-5 py-1.5 rounded-full text-sm font-medium hover:bg-blue-50 transition">Login</a>
    </header>

    <main class="flex-1 flex items-center justify-center py-12 px-4">
        <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-100 w-full max-w-lg">
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Create Account</h2>
                <p class="text-gray-400 text-sm mt-2">Register to access the health database system</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-2.5 rounded-lg text-sm mb-5">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form action="register" method="POST" class="space-y-5">
                
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Full Name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        <input type="text" name="name" required placeholder="John Doe" 
                               class="w-full bg-slate-50 border border-gray-200 rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" name="email" required placeholder="john@example.com" 
                               class="w-full bg-slate-50 border border-gray-200 rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Phone Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-solid fa-phone-flip text-xs"></i>
                        </span>
                        <input type="text" name="phone" required placeholder="01234567890" 
                               class="w-full bg-slate-50 border border-gray-200 rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Role</label>
                    <div class="relative">
                        <select name="role" required 
                                class="w-full bg-slate-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-slate-700 appearance-none focus:outline-none focus:border-blue-400 focus:bg-white transition">
                            <option value="patient">Patient</option>
                            <option value="doctor">Doctor</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </span>
                        <input type="password" name="password" required placeholder="••••••••" 
                               class="w-full bg-slate-50 border border-gray-200 rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" 
                            class="w-full bg-blue-500 text-white font-semibold rounded-xl py-3.5 text-sm shadow-md hover:bg-blue-600 active:scale-[0.99] transition duration-150">
                        Create Account
                    </button>
                </div>

                <div class="text-center text-xs text-slate-500 pt-1">
                    Already have an account? <a href="index.php" class="text-blue-500 hover:underline font-medium">Sign in</a>
                </div>
            </form>
        </div>
    </main>

</body>
</html>