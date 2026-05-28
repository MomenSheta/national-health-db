<!-- <h2>Create Medical Record</h2>

<form action="#" method="POST">
    <label for="patientId">Patient ID:</label>
    <Select name="patientId" id="patientId">
        <option disabled selected>choose patient</option>
        php
        if (isset($patients)) {
            foreach ($patients as $patient) {
        ?>
                <option value="= $patient["id"] ?>" = isset($selected) && $patient["id"] == $selected ? "selected" : "" ?>>
                    = $patient["name"] ?>
                </option>
        php
            }
        }
        
    </Select>

    <br />

    <label for="diagnosis">Diagnosis:</label>
    <textarea name="diagnosis" required></textarea>

    <br />

    <label for="notes">Notes:</label>
    <textarea name="notes"></textarea>

    <br />

    <label for="visitDate">Visit Date:</label>
    <input type="date" name="visitDate" required>

    <br />

    <button type="submit">Create Record</button>
</form> -->
<!DOCTYPE html>
<html lang="en">
<?php
$title = "Edit User Info";
include "inc/head.inc.php";
?>

<body class="bg-slate-50 flex flex-col font-sans">
    <?php include "inc/navbar.inc.php" ?>

    <main class="flex-1 max-w-3xl w-full mx-auto p-8">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Create Medical Record</h1>
                <p class="text-sm text-gray-400 mt-0.5">Add a new medical record to the patient's history</p>
            </div>

            <a href="javascript:history.back()" class="border border-gray-200 text-slate-600 bg-white hover:bg-slate-50 px-4 py-2 rounded-xl text-xs font-semibold flex items-center space-x-1.5 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Cancel</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden p-8">

            <form action="<?= fixed_path('/record/add') ?>" method="POST" class="space-y-6">
                <div>
                    <label for="patientId" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Patient Name</label>
                    <div class="relative">
                        <select name="patientId" id="patientId" class="w-full bg-slate-50 text-sm text-slate-700 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 focus:bg-white transition appearance-none cursor-pointer" required>
                            <option value="" disabled selected>Choose patient...</option>
                            <?php
                            if (isset($patients)) {
                                foreach ($patients as $patient) {
                            ?>
                                    <option value="<?= $patient["id"] ?>" <?= isset($selected) && $patient["id"] == $selected ? "selected" : "" ?>>
                                        <?= htmlspecialchars($patient["name"]) ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-user-injured text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="diagnosis" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Diagnosis (Symptoms & Condition)</label>
                    <div class="relative">
                        <textarea name="diagnosis" id="diagnosis" rows="4" placeholder="e.g., Persistent cough, chest discomfort, mild fever..." class="w-full bg-slate-50 text-sm text-slate-700 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 focus:bg-white transition resize-none" required></textarea>
                        <div class="absolute top-3.5 left-3.5 text-slate-400">
                            <i class="fa-solid fa-stethoscope text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="notes" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Additional Notes / Treatment Plan</label>
                    <div class="relative">
                        <textarea name="notes" id="notes" rows="3" placeholder="Prescribed medication details or follow-up instructions..." class="w-full bg-slate-50 text-sm text-slate-700 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 focus:bg-white transition resize-none"></textarea>
                        <div class="absolute top-3.5 left-3.5 text-slate-400">
                            <i class="fa-regular fa-clipboard text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="visitDate" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Visit Date</label>
                    <div class="relative">
                        <input type="date" name="visitDate" id="visitDate" value="<?= date('Y-m-d') ?>" class="w-full bg-slate-50 text-sm text-slate-700 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 focus:bg-white transition" required>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-regular fa-calendar text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold flex items-center space-x-2 shadow-md transition-all">
                        <i class="fa-solid fa-plus text-xs"></i>
                        <span>Create Record</span>
                    </button>
                </div>

            </form>
        </div>

    </main>

</body>

</html>