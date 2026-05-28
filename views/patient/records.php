<?php if (!isset($records) || !$records) return; ?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "My Records";
include "inc/head.inc.php"
?>

<body>
    <?php include 'views/navbar.php';?>
    <main>
        <h2 class="text-2xl text-(--color-gray-dark)">Medical Records</h2>
        <p class="text-sm text-(--color-gray-dark) opacity-70">View your medical history and diagnoses</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

            <!-- medical records cards -->
            <?php foreach ($records as $record) { ?>

                <div class="rounded-xl p-6 shadow-sm border border-(--color-gray-dark)/10 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-(--deep-teal)/15 flex items-center justify-center">
                                <span class="text-2xl text-(--deep-teal)">
                                    <i class="fa-regular fa-file-lines"></i>
                                </span>
                            </div>
                            <div>
                                <h3 class="text-(--color-gray-dark)"><?= htmlspecialchars($record['diagnosis'] ?? 'no diagnosis') ?></h3>
                                <p class="text-xs text-(--color-gray-dark) opacity-70"><?= 'Dr. ' . htmlspecialchars($record['doctor_name']  ?? 'no doctor') ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex items-center gap-2 text-sm text-(--color-gray-dark)">
                            <span class="text-(--soft-blue) ">
                                <i class="fa-regular fa-calendar"></i>
                            </span>
                            <span><?= htmlspecialchars(date('F j, Y', strtotime($record['visit_date'])) ?? 'unkown') ?></span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-(--color-gray-dark) opacity-70 mb-1">Notes:</p>
                        <p class="text-sm text-(--color-gray-dark)"><?= htmlspecialchars($record['notes'] ?? 'no notes') ?></p>
                    </div>

                    <a href="<?= fixed_path("/record/{$record['id']}/details") ?>" class="btn info w-full">
                        View Details
                    </a>
                </div>

            <?php }; ?>

        </div>
    </main>

</body>

</html>