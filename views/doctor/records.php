<?php if (!isset($records) || $records === null) return; ?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "Medical Records";
include "inc/head.inc.php"
?>

<body>
    <?php include 'inc/navbar.inc.php';?>
    <main>
        <div class="flex flex-row w-full justify-between items-end">
            <div>
                <h2 class="text-2xl text-(--color-gray-dark)">Medical Records</h2>
                <p class="text-sm text-(--color-gray-dark) opacity-70">View and manage your Medical Records</p>
            </div>
            <a href="<?= fixed_path('/record/add') ?>" class="btn success w-fit">
                <i class="fa-solid fa-plus"></i>
                New Record
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <!-- todo: add better UI for no data yet -->
            <?= empty($records) ? "there is no records yet" : "" ?>

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
                                <p class="text-xs text-(--color-gray-dark) opacity-70"><?= htmlspecialchars($record['patient_name']  ?? 'Unknown') ?></p>
                            </div>
                        </div>
                        <?php if ($_SESSION['user_role'] === "doctor") { ?>
                            <div class="flex flex-row gap-2">
                                <a href="<?= fixed_path("/record/{$record['id']}/edit") ?>" class="btn info w-9 h-9">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <form action="<?= fixed_path("/record/{$record['id']}/delete") ?>" method="post" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    <button type="submit" class="btn danger w-9 h-9">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        <?php } ?>

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
                    <div class="flex justify-center items-center gap-4">
                        <a href="<?= fixed_path("/record/{$record['id']}/details") ?>" class="btn info w-full">
                            View Details
                        </a>
                    </div>
                </div>

            <?php }; ?>

        </div>
    </main>

</body>

</html>