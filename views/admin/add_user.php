<!DOCTYPE html>
<html lang="en">
<?php
$title = "Create User";
include "inc/head.inc.php"
?>

<body>
    <?php include 'inc/navbar.inc.php'; ?>
    <?php include 'inc/toaster.inc.php'; ?>
    <main class=" px-12 py-8 flex flex-col items-center justify-center">

        <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm w-full max-w-lg transition-all">

            <div class="mb-8 text-center">
                <div class="bg-blue-50 text-blue-500 w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid fa-user-plus text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Create New User</h1>
                <p class="text-sm text-gray-400 mt-1">Add a new doctor, patient, or admin to the system</p>
            </div>

            <form action="<?= fixed_path('/admin/users/add') ?>" method="POST" class="space-y-5">

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                    <div class="relative flex items-center">
                        <i class="fa-regular fa-user text-gray-400 absolute left-4 text-sm"></i>
                        <input type="text" name="name" required placeholder="John Doe"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                    <div class="relative flex items-center">
                        <i class="fa-regular fa-envelope text-gray-400 absolute left-4 text-sm"></i>
                        <input type="email" name="email" required placeholder="example@domain.com"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Phone Number</label>
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-phone text-gray-400 absolute left-4 text-sm"></i>
                        <input type="tel" name="phone" placeholder="+2010XXXXXXXX"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password</label>
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-lock text-gray-400 absolute left-4 text-sm"></i>
                        <input type="password" name="password" required placeholder="••••••••"
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">User Role</label>
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-id-card text-gray-400 absolute left-4 text-sm"></i>
                        <select name="role" required
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 appearance-none focus:outline-none focus:border-blue-400 focus:bg-white transition cursor-pointer">
                            <option value="patient">Patient</option>
                            <option value="doctor">Doctor</option>
                            <option value="admin">Admin</option>
                        </select>
                        <i class="fa-solid fa-chevron-down text-gray-400 absolute right-4 text-xs pointer-events-none"></i>
                    </div>
                </div>

                <div class="flex items-center space-x-3 pt-4">
                    <a href="<?= fixed_path('/admin/users') ?>"
                        class="w-1/2 text-center border border-slate-200 text-slate-500 py-3 rounded-xl text-sm font-semibold hover:bg-slate-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-1/2 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl text-sm font-semibold shadow-sm transition">
                        Save User
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>