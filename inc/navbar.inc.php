<?php
$current_uri = $_SERVER['REQUEST_URI'];
$user_role = strtolower($_SESSION['user_role'] ?? 'patient');
?>
<div class="w-full border-b border-b-(--color-gray-light)">

    <header class="py-3 flex justify-between items-center shadow-sm">
        <div class="flex flex-col">
            <div class="flex items-center space-x-2">
                <a href="<?= fixed_path('/') ?>">
                    <img src="/assets/images/icon.ico" alt="Logo" class="w-6 h-6 object-contain">
                </a>
                <span class="text-lg font-bold text-slate-800 tracking-tight">National Health Database System</span>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="text-xs text-gray-400 pl-8 -mt-0.5">Dashboard</span>
            <?php endif; ?>
        </div>

        <div class="flex items-center space-x-4">

            <div class="text-right">
                <div class="text-sm font-semibold text-slate-700"><?= htmlspecialchars($_SESSION['user_name'] ?? 'John Doe') ?></div>
                <span class="inline-block <?= $user_role === 'admin' ? 'bg-blue-500' : 'bg-purple-500' ?> text-white text-[10px] font-bold px-2 py-0.5 rounded rounded-md uppercase tracking-wider">
                    <?= htmlspecialchars($_SESSION['user_role'] ?? 'Unkown') ?>
                </span>
            </div>

            <form action="<?= fixed_path('/logout') ?>" method="POST" class="inline">
                <button type="submit" class="btn danger">
                    <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    <span>Logout</span>
                </button>
            </form>

        </div>
    </header>

    <nav class="flex space-x-8 text-sm font-medium">
        <!-- Admin Tabs -->
        <?php if ($user_role === 'admin'): ?>
            <?php $is_admin_users = (strpos($current_uri, '/admin/users') !== false); ?>
            <a href="<?= fixed_path('/admin/users') ?>" class="py-3.5 relative flex items-center space-x-2 transition-all duration-200 <?= $is_admin_users ? 'text-blue-500 font-semibold' : 'text-gray-400 hover:text-slate-600' ?>">
                <i class="fa-solid fa-users-gear text-base <?= $is_admin_users ? 'text-blue-500' : 'text-gray-400' ?>"></i>
                <span>Users Management</span>
                <?php if ($is_admin_users): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[3px] bg-blue-500 rounded-t-full"></span>
                <?php endif; ?>
            </a>
        <?php endif; ?>

        <!-- Patient Tabs -->
        <?php if ($user_role === 'patient'): ?>
            <?php $is_records = (strpos($current_uri, 'my-records') !== false); ?>
            <a href="<?= fixed_path('/my-records') ?>" class="py-3.5 relative flex items-center space-x-2 transition-all duration-200 <?= $is_records ? 'text-emerald-500 font-semibold' : 'text-gray-400 hover:text-slate-600' ?>">
                <i class="fa-regular fa-file-lines text-base <?= $is_records ? 'text-emerald-500' : 'text-gray-400' ?>"></i>
                <span>Medical Records</span>
                <?php if ($is_records): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[3px] bg-emerald-500 rounded-t-full"></span>
                <?php endif; ?>
            </a>

            <?php $is_prescriptions = (strpos($current_uri, 'my-prescriptions') !== false); ?>
            <a href="<?= fixed_path('/my-prescriptions') ?>" class="py-3.5 relative flex items-center space-x-2 transition-all duration-200 <?= $is_prescriptions ? 'text-emerald-500 font-semibold' : 'text-gray-400 hover:text-slate-600' ?>">
                <i class="fa-solid fa-pills text-base <?= $is_prescriptions ? 'text-emerald-500' : 'text-gray-400' ?>"></i>
                <span>Prescriptions</span>
                <?php if ($is_prescriptions): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[3px] bg-emerald-500 rounded-t-full"></span>
                <?php endif; ?>
            </a>
        <?php endif; ?>


        <!-- Doctor Tabs -->
        <?php if ($user_role === 'doctor'): ?>
            <?php $is_medical_records = (strpos($current_uri, '/medical-records') !== false); ?>
            <a href="<?= fixed_path('/medical-records') ?>" class="py-3.5 relative flex items-center space-x-2 transition-all duration-200 <?= $is_admin_users ? 'text-blue-500 font-semibold' : 'text-gray-400 hover:text-slate-600' ?>">
                <i class="fa-regular fa-file-lines text-base <?= $is_medical_records ? 'text-(--deep-teal)' : 'text-gray-400' ?>"></i>
                <span>Medical Records</span>
                <?php if ($is_medical_records): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[3px] bg-(--deep-teal) rounded-t-full"></span>
                <?php endif; ?>
            </a>

            <?php $is_patients = (strpos($current_uri, '/patients') !== false); ?>
            <a href="<?= fixed_path('/patients') ?>" class="py-3.5 relative flex items-center space-x-2 transition-all duration-200 <?= $is_admin_users ? 'text-blue-500 font-semibold' : 'text-gray-400 hover:text-slate-600' ?>">
                <i class="fa-solid fa-user text-base <?= $is_patients ? 'text-(--royal-purple)' : 'text-gray-400' ?>"></i>
                <span>My Patients</span>
                <?php if ($is_patients): ?>
                    <span class="absolute bottom-0 left-0 right-0 h-[3px] bg-(--royal-purple) rounded-t-full"></span>
                <?php endif; ?>
            </a>
        <?php endif; ?>


        <?php $is_profile = (strpos($current_uri, 'profile') !== false); ?>
        <a href="<?= fixed_path('/profile') ?>" class="py-3.5 relative flex items-center space-x-2 transition-all duration-200 <?= $is_profile ? 'text-emerald-500 font-semibold' : 'text-gray-400 hover:text-slate-600' ?>">
            <i class="fa-regular fa-user text-base <?= $is_profile ? 'text-emerald-500' : 'text-gray-400' ?>"></i>
            <span>Profile</span>
            <?php if ($is_profile): ?>
                <span class="absolute bottom-0 left-0 right-0 h-[3px] bg-emerald-500 rounded-t-full"></span>
            <?php endif; ?>
        </a>

    </nav>


</div>