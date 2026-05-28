<!DOCTYPE html>
<html lang="en">

<?php include "inc/head.inc.php" ?>

<body class="bg-slate-100 min-h-screen flex flex-col font-sans">

    <div class="bg-white border-b border-gray-100 px-8 py-4 flex justify-between items-center shadow-sm h-16">
        <div class="flex items-center space-x-2 text-blue-600">
            <img src="assets/images/icon.ico" alt="Logo" class="w-8 h-8 object-contain">
            <span class="text-xl font-semibold text-slate-700">National Health Database System</span>
        </div>
        <a href="<?= fixed_path('/register') ?>" class="bg-blue-500 text-white px-5 py-1.5 rounded-full text-sm font-medium hover:bg-blue-600 transition shadow-sm">Register</a>
    </div>

    <main class="flex-1 flex items-center justify-center py-12 px-4">
        <div class="bg-white p-10 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md">

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Welcome Back</h2>
                <p class="text-gray-400 text-sm mt-2">Sign in to your account</p>
            </div>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-2.5 rounded-lg text-sm mb-5">
                    <?= $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form action="<?= fixed_path('/login') ?>" method="POST" class="space-y-5 ">

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" name="email" required placeholder="john@example.com"
                            class="w-full bg-slate-200/60 border border-gray-200 rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5 uppercase tracking-wider">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </span>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="w-full bg-slate-200/60 border border-gray-200 rounded-xl py-3 pl-11 pr-4 text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <!-- <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center space-x-2 text-slate-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded text-blue-500 focus:ring-blue-400 border-gray-300">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="text-blue-400 hover:underline">Forgot password?</a>
                </div> -->

                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-blue-500 text-white font-semibold rounded-xl py-3.5 text-sm shadow-md hover:bg-blue-600 active:scale-[0.99] transition duration-150">
                        Sign In
                    </button>
                </div>

                <div class="text-center text-xs text-slate-500 pt-1">
                    Don't have an account? <a href="<?= fixed_path('/register') ?>" class="text-blue-500 hover:underline font-medium">Register now</a>
                </div>

                <div class="bg-blue-50/60 border border-blue-100 rounded-xl p-4 mt-6 text-xs text-slate-600 leading-relaxed">
                    <strong class="text-slate-800 block mb-1">Demo:</strong>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                </div>

            </form>
        </div>
    </main>

</body>

</html>