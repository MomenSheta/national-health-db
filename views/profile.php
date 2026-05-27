<?php 
// 1. استدعاء ملف الـ Utility عشان الصفحة تتعرف على دالة fixed_path
require_once __DIR__ . '/../util/Redirect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Health Database System - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= fixed_path('/assets/css/main.css') ?>">
</head>
<body class="bg-slate-100 min-h-screen flex flex-col font-sans">

   <?php include 'navbar.php'; ?>

    <main class="flex-1 max-w-7xl w-full mx-auto p-8">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Profile</h1>
                <p class="text-sm text-gray-400 mt-0.5">Manage your personal information and settings</p>
            </div>
            
            <a href="<?= fixed_path('/admin/users/' . ($user['id'] ?? $_SESSION['user_id'] ?? 1) . '/edit') ?>" class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded-xl text-xs font-semibold flex items-center space-x-1.5 shadow-sm transition">
                <i class="fa-solid fa-pen text-[10px]"></i>
                <span>Edit Profile</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            
            <div class="h-44 bg-gradient-to-r from-sky-400 via-indigo-400 to-purple-500 relative">
                <div class="absolute -bottom-10 left-8 bg-white p-1 rounded-full shadow-md">
                    <div class="bg-blue-50 text-blue-500 w-24 h-24 rounded-full flex items-center justify-center border border-gray-100">
                        <i class="fa-regular fa-circle-user text-5xl"></i>
                    </div>
                </div>
            </div>

            <div class="pt-14 p-8">
                
                <div class="flex items-center space-x-3 mb-8">
                    <h2 class="text-2xl font-bold text-slate-800"><?= htmlspecialchars($user['name'] ?? 'Nadeen Samy') ?></h2>
                    <span class="bg-purple-100 text-purple-600 text-xs font-bold px-2.5 py-0.5 rounded-full uppercase">
                        <?= htmlspecialchars($user['role'] ?? 'Patient') ?>
                    </span>
                </div>
                
                <div class="max-w-2xl space-y-6">
                    <h3 class="text-sm font-bold text-blue-900 border-b border-gray-100 pb-2 uppercase tracking-wide">Account Information</h3>
                    
                    <div>
                        <span class="text-xs font-semibold text-gray-400 block mb-1">Full Name</span>
                        <div class="text-sm text-slate-700 flex items-center space-x-2 bg-slate-50 p-3 rounded-xl border border-gray-100">
                            <i class="fa-regular fa-circle-user text-blue-400 text-sm"></i>
                            <span class="font-medium"><?= htmlspecialchars($user['name'] ?? 'Nadeen Samy') ?></span>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 block mb-1">Email Address</span>
                        <div class="text-sm text-slate-700 flex items-center space-x-2 bg-slate-50 p-3 rounded-xl border border-gray-100">
                            <i class="fa-regular fa-envelope text-emerald-400 text-sm"></i>
                            <span class="text-slate-600 font-medium"><?= htmlspecialchars($user['email'] ?? 'nadeensamy415@gmail.com') ?></span>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 block mb-1">Phone Number</span>
                        <div class="text-sm text-slate-700 flex items-center space-x-2 bg-slate-50 p-3 rounded-xl border border-gray-100">
                            <i class="fa-solid fa-phone text-purple-400 text-sm"></i>
                            <span class="<?= !empty($user['phone']) ? 'text-slate-700 font-medium' : 'text-gray-400 italic' ?>">
                                <?= htmlspecialchars(!empty($user['phone']) ? $user['phone'] : 'Not provided') ?>
                            </span>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 block mb-1">Account Type / Role</span>
                        <div class="text-sm text-slate-700 flex items-center space-x-2 bg-slate-50 p-3 rounded-xl border border-gray-100">
                            <i class="fa-solid fa-user-shield text-indigo-400 text-sm"></i>
                            <span class="text-slate-700 font-medium capitalize"><?= htmlspecialchars($user['role'] ?? 'Patient') ?></span>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 block mb-1">Member Since</span>
                        <div class="text-sm text-slate-700 flex items-center space-x-2 bg-slate-50 p-3 rounded-xl border border-gray-100">
                            <i class="fa-regular fa-calendar text-amber-400 text-sm"></i>
                            <span class="<?= !empty($user['created_at']) ? 'text-slate-600 font-medium' : 'text-gray-400 italic' ?>">
                                <?= !empty($user['created_at']) ? date('F Y', strtotime($user['created_at'])) : 'Recently' ?>      
                            </span>
                        </div>
                    </div>

                    <div class="bg-blue-50/60 border border-blue-100 rounded-xl p-4 flex items-start space-x-3 mt-6">
                        <i class="fa-solid fa-shield-halved text-blue-500 mt-0.5"></i>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Your account settings and personal details are encrypted and secure within the National Health Database System.
                        </p>
                    </div>

                </div>

            </div>
        </div>

    </main>

</body>
</html>