<?php if (!isset($prescriptions) || !$prescriptions) return; ?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "My Prescriptions";
include "inc/head.inc.php"
?>

<body>
    <?php include 'inc/navbar.inc.php';?>
    <main>
        <h2 class="text-2xl text-(--color-gray-dark)">Prescriptions</h2>
        <p class="text-sm text-(--color-gray-dark) opacity-70">View and manage your prescriptions</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

            <?php foreach ($prescriptions as $prescription) { ?>

                <div class="rounded-xl p-6 shadow-sm border border-(--color-gray-dark)/10 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-(--deep-teal)/15 flex items-center justify-center">
                                <span class="text-2xl text-(--deep-teal)">
                                    <i class="fa-solid fa-pills"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="text-(--color-gray-dark)"><?= htmlspecialchars($prescription['medication_name'] ?? 'no medication') ?></h3>
                                <p class="text-xs text-(--color-gray-dark) opacity-70"><?= htmlspecialchars($prescription['dosage']  ?? 'no dosage') ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex items-center gap-2 text-sm text-(--color-gray-dark)">
                            <span class="text-(--soft-blue) ">
                                <i class="fa-regular fa-calendar"></i></span>
                            <span><?= htmlspecialchars(date('F j, Y', strtotime($prescription["prescribed_at"])) ?? 'unkown') ?></span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-(--color-gray-dark) opacity-70 mb-1">instructions:</p>
                        <p class="text-sm text-(--color-gray-dark)"><?= htmlspecialchars($prescription["instructions"] ?? 'no instructions') ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>


    </main>

</body>

</html>