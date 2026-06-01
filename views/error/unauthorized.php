<!DOCTYPE html>
<html lang="en">

<?php
if (!function_exists('fixed_path')) {
    require_once __DIR__ . '/../../util/Redirect.php'; 
}

$title = "Error 403 - Unauthorized";
include "inc/head.inc.php";

$user_role = strtolower($_SESSION['user_role'] ?? 'patient');
$redirect_home = fixed_path('/profile');

if ($user_role === 'admin') {
    $redirect_home = fixed_path('/admin/users');
} elseif ($user_role === 'patient') {
    $redirect_home = fixed_path('/my-records');
}
?>

<body>
    <?php include 'inc/toaster.inc.php'; ?>

    <main class="flex h-screen bg-slate-50">
        <div class="flex flex-col items-center justify-center gap-6 m-auto w-full max-w-md h-full text-center p-6">
            
            <div class="w-24 h-24 bg-red-50 text-red-500 rounded-full flex items-center justify-center border border-red-100 shadow-sm animate-pulse">
                <i class="fa-solid fa-shield-halved text-4xl"></i>
            </div>

            <div class="space-y-2">
                <h1 class="text-6xl font-extrabold text-slate-800 tracking-tight">403</h1>
                <h2 class="text-lg font-bold text-slate-700">Access Denied / Unauthorized</h2>
                <p class="text-xs text-gray-400 max-w-xs mx-auto leading-relaxed">
                    Sorry, you don't have the required permissions to access this area. This action has been securely logged.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full justify-center">
                <a href="<?= $redirect_home ?>" class="btn info w-fit flex items-center space-x-1.5 justify-center">
                    <i class="fa-solid fa-house text-[10px]"></i>
                    <span>Back to Dashboard</span>
                </a>
                
                <button onclick="history.back()" class="border border-gray-200 text-slate-600 bg-white hover:bg-slate-50 px-4 py-2 rounded-xl text-xs font-semibold flex items-center justify-center space-x-1.5 transition shadow-sm">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Go Back</span>
                </button>
            </div>

        </div>
    </main>
        
</body>

</html>