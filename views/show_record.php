<?php if (!isset($record) || !$record) return; ?>

<!DOCTYPE html>
<html lang="en">

<?php
$title = "View Record";
include "inc/head.inc.php"
?>
<body>
    <main >
        <div class="flex flex-row justify-between w-full">
            <h1 class="text-2xl text-(--color-gray-dark) font-bold capitalize">record details</h1>
            <a href="<?= fixed_path("/") ?>" class="btn info w-fit capitalize">back home</a>
        </div>

        <div class="space-y-4 relative">
            <div>
                <label class="text-sm text-(--color-gray-dark) opacity-70">Patient Name</label>
                <p class="text-(--color-gray-dark) mt-1"><?= $record["patient_name"] ?? "Unkown" ?></p>
            </div>

            <div>
                <label class="text-sm text-(--color-gray-dark) opacity-70">Visit Date</label>
                <p class="text-(--color-gray-dark) mt-1"><?= $record["visit_date"] ?></p>
            </div>
            <div>
                <label class="text-sm text-(--color-gray-dark) opacity-70">Diagnosis</label>
                <p class="text-(--color-gray-dark) mt-1"><?= $record["diagnosis"] ?></p>
            </div>
            <div>
                <label class="text-sm text-(--color-gray-dark) opacity-70">Notes</label>
                <p class="text-(--color-gray-dark) mt-1"><?= $record["notes"] ?></p>
            </div>
            <div>
                <label class="text-sm text-(--color-gray-dark) opacity-70">Attending Physician</label>
                <p class="text-(--color-gray-dark) mt-1"><?= 'Dr. ' . $record["doctor_name"] ?></p>
            </div>

            <?php if ($_SESSION["user_role"] == "doctor") { ?>
                <div class="absolute right-0 bottom-0 flex flex-row gap-4">
                    <form action="<?= fixed_path("/record/{$record['id']}/delete") ?>" method="post">
                        <button type="submit" class="btn danger w-fit">
                            <i class="fa-regular fa-trash-can"></i> Delete record
                        </button>
                    </form>
                    <a href="<?= fixed_path("/record/{$record['id']}/edit") ?>" class="btn info w-fit">
                        <i class="fa-regular fa-pen-to-square"></i> Edit record
                    </a>
                </div>
            <?php } ?>
        </div>

        <hr>

        <div class="flex flex-row justify-between w-full">
            <h1 class="text-2xl text-(--color-gray-dark) font-bold capitalize">prescriptions</h1>
            <?php if ($_SESSION["user_role"] == "doctor") { ?>
                <a href="<?= fixed_path("/presc/add/{$record['id']}") ?>" class="btn success w-fit">
                    <i class="fa-solid fa-plus"></i>
                    New Prescription
                </a>
            <?php } ?>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <?php
            if (isset($prescriptions) && $prescriptions) {
                foreach ($prescriptions as $prescription) {
            ?>
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

                            <?php if ($_SESSION["user_role"] == "doctor") { ?>
                                <div class="flex flex-row gap-2">
                                    <a href="<?= fixed_path("/presc/{$prescription['id']}/edit") ?>" class="btn info w-9 h-9">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <form action="<?= fixed_path("/presc/{$prescription['id']}/delete") ?>" method="post">
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
                                    <i class="fa-regular fa-calendar"></i></span>
                                <span><?= htmlspecialchars(date('F j, Y', strtotime($prescription["prescribed_at"])) ?? 'unkown') ?></span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm text-(--color-gray-dark) opacity-70 mb-1">instructions:</p>
                            <p class="text-sm text-(--color-gray-dark)"><?= htmlspecialchars($prescription["instructions"] ?? 'no instructions') ?></p>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "no prescriptions yet...";
            }

            ?>
        </div>
    </main>
</body>

</html>