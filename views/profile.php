<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Health Database System - Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 min-h-screen flex flex-col font-sans">

    <header class="bg-white border-b border-gray-100 px-8 py-3 flex justify-between items-center shadow-sm">
        <div class="flex flex-col">
            <div class="flex items-center space-x-2 text-blue-600">
                <img src="/national-health-db/assets/images/icon.ico" alt="Logo" class="w-6 h-6 object-contain">
                <span class="text-lg font-bold text-slate-800 tracking-tight">National Health Database System</span>
            </div>
            <span class="text-xs text-gray-400 pl-8 -mt-1">Dashboard</span>
        </div>
        
        <div class="flex items-center space-x-4">
            <div class="text-right">
                <div class="text-sm font-semibold text-slate-700"><?= htmlspecialchars($_SESSION['user_name'] ?? ($user['name'] ?? 'Nadeen Samy')) ?></div>
                <span class="inline-block bg-purple-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">
                    <?= htmlspecialchars($_SESSION['user_role'] ?? ($user['role'] ?? 'Patient')) ?>
                </span>
            </div>
            
            <form action="logout" method="POST" class="inline">
                <button type="submit" class="border border-red-200 text-red-500 hover:bg-red-50 px-4 py-1.5 rounded-xl text-sm font-medium flex items-center space-x-1.5 transition">
                    <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </header>

    <nav class="bg-white border-b border-gray-200 px-8 flex space-x-8 text-sm font-medium text-gray-500">
        <a href="myrecords" class="py-3.5 hover:text-blue-600 flex items-center space-x-2 border-b-2 border-transparent">
            <i class="fa-regular fa-file-lines text-gray-400"></i>
            <span>Medical Records</span>
        </a>
        <a href="myprescreptions" class="py-3.5 hover:text-blue-600 flex items-center space-x-2 border-b-2 border-transparent">
            <i class="fa-solid fa-link text-gray-400"></i>
            <span>Prescriptions</span>
        </a>
        <a href="#" class="py-3.5 text-emerald-500 border-b-2 border-emerald-500 flex items-center space-x-2">
            <i class="fa-regular fa-user"></i>
            <span>Profile</span>
        </a>
    </nav>

    <main class="flex-1 max-w-7xl w-full mx-auto p-8">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Profile</h1>
                <p class="text-sm text-gray-400 mt-0.5">Manage your personal information and settings</p>
            </div>
            <button class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded-xl text-xs font-semibold flex items-center space-x-1.5 shadow-sm transition">
                <i class="fa-solid fa-pen text-[10px]"></i>
                <span>Edit Profile</span>
            </button>
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
                        <i class="fa-regular fa-shield-halved text-blue-500 mt-0.5"></i>
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