<?php if (!isset($user) || !$user) return; ?>

<!DOCTYPE html>
<html lang="en">
<?php include "inc/head.inc.php" ?>

<body>
    <?php include 'inc/navbar.inc.php'; ?>
        <?php include 'inc/toaster.inc.php'; ?>

    <main>
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Profile</h1>
                <p class="text-sm text-gray-400 mt-0.5">Your personal information and settings</p>
            </div>

            <?php if ($_SESSION['user_role'] === 'admin') { ?>
                <a href="<?= fixed_path('/admin/users/' . ($user['id'] ?? $_SESSION['user_id'] ?? 1) . '/edit') ?>" class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded-xl text-xs font-semibold flex items-center space-x-1.5 shadow-sm transition">
                    <i class="fa-solid fa-pen text-[10px]"></i>
                    <span>Edit Profile</span>
                </a>
            <?php } ?>
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
                    <h2 class="text-2xl font-bold text-slate-800"><?= htmlspecialchars($user['name'] ?? 'John Doe') ?></h2>
                    <span class="bg-purple-100 text-purple-600 text-xs font-bold px-2.5 py-0.5 rounded-full uppercase">
                        <?= htmlspecialchars($user['role'] ?? 'Unknown') ?>
                    </span>
                </div>

                <div class="max-w-2xl space-y-6">
                    <h3 class="text-sm font-bold text-blue-900 border-b border-gray-100 pb-2 uppercase tracking-wide">Account Information</h3>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 block mb-1">Full Name</span>
                        <div class="text-sm text-slate-700 flex items-center space-x-2 bg-slate-50 p-3 rounded-xl border border-gray-100">
                            <i class="fa-regular fa-circle-user text-blue-400 text-sm"></i>
                            <span class="font-medium"><?= htmlspecialchars($user['name'] ?? 'John Doe') ?></span>
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
                </div>
            </div>
        </div>
    </main>

</body>

</html>