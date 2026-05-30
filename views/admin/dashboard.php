<!DOCTYPE html>
<html lang="en">

<?php include 'inc/head.inc.php'; ?>


<body>
    <?php include 'inc/navbar.inc.php'; ?>

    <main>

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">User Management</h1>
                <p class="text-sm text-gray-400 mt-1">Manage system users and their access permissions</p>
            </div>
            <a href="<?= fixed_path('/admin/users/add') ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-xl text-sm font-semibold flex items-center space-x-2 shadow-sm transition">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Add User</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6 shadow-sm">
            <div class="relative flex items-center justify-center gap-4">
                <i class="fa-solid fa-magnifying-glass text-gray-400 absolute left-4 text-sm"></i>
                <form action="" method="GET" class="w-full">
                    <input
                        name="search"
                        type="text"
                        placeholder="Search users by name or email..."
                        value="<?= isset($_GET['search']) ? $_GET['search'] : ""  ?>"
                        class="w-full pl-11 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder-gray-400 focus:outline-none focus:border-blue-400 transition">
                </form>
                <?php if (isset($_GET['search'])) { ?>
                    <a href="<?= fixed_path('/admin/users') ?>" class="text-(--color-gray-dark) hover:text-(--color-gray-dark)/80 transition">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                <?php } ?>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Total Users</span>
                <div class="text-4xl font-bold text-blue-600"><?= $totalUsers ?? 0 ?></div>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Doctors</span>
                <div class="text-4xl font-bold text-emerald-500"><?= $totalDoctors ?? 0 ?></div>
            </div>
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-2">Patients</span>
                <div class="text-4xl font-bold text-purple-500"><?= $totalPatients ?? 0 ?></div>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/70 border-b border-gray-100 text-xs font-bold text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Phone</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-slate-700 font-medium">
                        <?php if (!empty($usersList)): ?>
                            <?php foreach ($usersList as $u): ?>
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-6 py-4.5"><?= htmlspecialchars($u['name']) ?></td>
                                    <td class="px-6 py-4.5 text-slate-500 font-normal"><?= htmlspecialchars($u['email']) ?></td>
                                    <td class="px-6 py-4.5 text-slate-500 font-normal"><?= htmlspecialchars($u['phone'] ?? '—') ?></td>
                                    <td class="px-6 py-4.5">
                                        <?php
                                        $role = strtolower($u['role'] ?? 'patient');
                                        $badgeClass = $role === 'admin' ? 'bg-blue-500' : ($role === 'doctor' ? 'bg-emerald-500' : 'bg-purple-500');
                                        ?>
                                        <span class="inline-block <?= $badgeClass ?> text-white text-[10px] font-bold px-2.5 py-0.5 rounded-md uppercase tracking-wider">
                                            <?= htmlspecialchars($u['role']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4.5">
                                        <div class="flex justify-center items-center space-x-2">
                                            <a href="<?= fixed_path("/admin/users/{$u['id']}/edit") ?>" class="btn info">
                                                <i class="fa-regular fa-pen-to-square text-sm"></i>
                                            </a>
                                            <form action="<?= fixed_path("/admin/users/{$u['id']}/delete") ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <button type="submit" class="btn danger">
                                                    <i class="fa-regular fa-trash-can text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400 font-normal">
                                    No users found in the system.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if (isset($_GET['search'])) { ?>
            <a href="<?= fixed_path('/admin/users') ?>" class="btn classic w-fit mx-auto my-8">clear search</a>
        <?php } ?>
    </main>
</body>

</html>