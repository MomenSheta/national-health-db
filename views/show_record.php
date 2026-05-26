<?php if (!isset($record) || !$record) return; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>record</title>
    <style>
        <?php include "./assets/css/main.css" ?>
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <main class="relative">
        <a href="<?= fixed_path("/my-records") ?>" class="btn info w-fit absolute right-0 me-4 capitalize">back home</a>

        <?php if ($_SESSION["user_role"] == "doctor") { ?>
            <form action="./delete" method="post">
                <button type="submit">delete</button>
            </form>
            <a href="./edit"> edit</a>
        <?php } ?>

        <h1 class="text-2xl text-(--color-gray-dark) font-bold capitalize">record details</h1>
        <div class="space-y-4">
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
        </div>

        <hr>

        <h1 class="text-2xl text-(--color-gray-dark) font-bold capitalize">prescriptions</h1>
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
                        <!-- <a href="#" class="btn w-full border-(--deep-blue) text-(--deep-blue) hover:text-(--color-white) hover:bg-(--deep-blue)"> edit </a> -->
                        <!-- <a href="#" class="btn w-full border-(--deep-blue) text-(--deep-blue) hover:text-(--color-white) hover:bg-(--deep-blue)"> delete</a> -->
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