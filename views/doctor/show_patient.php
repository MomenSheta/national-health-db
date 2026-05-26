<?php if (!isset($patient) || !$patient) return; ?>



<!DOCTYPE html>
<html lang="en">

<?php
$title = "Patient Records";
include "inc/head.inc.php"
?>

<body>
    <main>
        <div class="flex flex-row justify-between w-full">
            <h1 class="text-2xl text-(--color-gray-dark) font-bold capitalize">Patient details</h1>
            <a href="<?= fixed_path("/") ?>" class="btn info w-fit capitalize">back home</a>
        </div>

        <div class="space-y-4 relative">
            <div>
                <label class="text-sm text-(--color-gray-dark) opacity-70">Patient Name</label>
                <p class="text-(--color-gray-dark) mt-1"><?= htmlspecialchars($patient["name"] ?? "Unkown") ?></p>
            </div>

            <div>
                <label class="text-sm text-(--color-gray-dark) opacity-70">Patient Email</label>
                <p class="text-(--color-gray-dark) mt-1"><?= htmlspecialchars($patient["email"] ?? "Unkown")  ?></p>
            </div>
            <div>
                <label class="text-sm text-(--color-gray-dark) opacity-70">Patient phone</label>
                <p class="text-(--color-gray-dark) mt-1"><?= htmlspecialchars($patient["phone"]  ?? "Unkown")  ?></p>
            </div>
            <div>
                <label class="text-sm text-(--color-gray-dark) opacity-70">Registerition Date</label>
                <p class="text-(--color-gray-dark) mt-1"><?= htmlspecialchars(date('F j, Y', strtotime($patient["created_at"])))  ?? 'unkown'  ?></p>
            </div>
        </div>

        <hr>

        <div class="flex flex-row justify-between w-full">
            <h1 class="text-2xl text-(--color-gray-dark) font-bold capitalize">Medical Records</h1>
            <?php if ($_SESSION["user_role"] == "doctor") { ?>
                <a href="<?= fixed_path("/record/add?patient={$patient['id']}") ?>" class="btn success w-fit">
                    <i class="fa-solid fa-plus"></i>
                    Add Record
                </a>
            <?php } ?>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <?php
            if (isset($records) && $records) {
                foreach ($records as $record) {
            ?>
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
                                    <form action="<?= fixed_path("/record/{$record['id']}/delete") ?>" method="post">
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
            <?php
                }
            } else {
                echo "no records yet...";
            }
            ?>
        </div>
    </main>

</body>

</html>