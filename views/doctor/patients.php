<?php if (!isset($patients) || !$patients) return; ?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "patients";
include "inc/head.inc.php"
?>

<body>
    <?php include 'views/navbar.php';?>
    <main>
        <h2 class="text-2xl text-(--color-gray-dark)">My Patients</h2>
        <p class="text-sm text-(--color-gray-dark) opacity-70">View your Patients</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <?php foreach ($patients as  $patient) { ?>
                <div class="rounded-xl p-6 shadow-sm border border-(--color-gray-dark)/10 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-(--deep-teal)/15 flex items-center justify-center">
                                <span class="text-2xl text-(--deep-teal)">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="text-(--color-gray-dark)"><?= htmlspecialchars($patient['name'] ?? 'Unkown') ?></h3>
                                <p class="text-xs text-(--color-gray-dark) opacity-70"><?= htmlspecialchars($patient['email']  ?? 'Unkown') ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex items-center gap-2 text-sm text-(--color-gray-dark)">
                            <span class="text-(--soft-blue)"><i class="fa-regular fa-calendar"></i></span>
                            <span><?= htmlspecialchars(date('F j, Y', strtotime($patient['created_at'])) ?? 'unkown') ?></span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-(--color-gray-dark)">
                            <span class="text-(--lavender-purple)/70"><i class="fa-solid fa-phone"></i></span>
                            <span><?= htmlspecialchars($patient['phone'] ?? 'unkown') ?></span>
                        </div>
                    </div>
                    <div class="flex justify-center items-center gap-4">
                        <a href="<?= fixed_path("/patients/{$patient['id']}/details") ?>" class="btn info w-full">
                            View Patient
                        </a>
                        <a href="<?= fixed_path("/record/add?patient={$patient['id']}") ?>" class="btn success w-full">
                            <i class="fa-solid fa-plus"></i>
                            Add Record
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

</body>

</html>