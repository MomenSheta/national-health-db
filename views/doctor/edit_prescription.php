<?php if (!isset($prescription) || !$prescription) return; ?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = "Edit Prescription";
include "inc/head.inc.php";
?>

<body class=" flex flex-col font-sans">
    <?php include "inc/navbar.inc.php" ?>
    <?php include 'inc/toaster.inc.php'; ?>


    <main class="flex-1 max-w-3xl w-full mx-auto p-8">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Edit Prescription</h1>
                <p class="text-sm text-gray-400 mt-0.5">Updating medication details for Prescription ID: #<?= htmlspecialchars($prescription['id']); ?></p>
            </div>
            
            <a href="javascript:history.back()" class="border border-gray-200 text-slate-600 bg-white hover:bg-slate-50 px-4 py-2 rounded-xl text-xs font-semibold flex items-center space-x-1.5 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Cancel</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden p-8">
            
            <form action="<?= fixed_path('/presc/' . $prescription['id'] . '/edit') ?>" method="POST" class="space-y-6">                
                
                <div>
                    <label for="medicationName" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Medication Name</label>
                    <div class="relative">
                        <input type="text" name="medicationName" id="medicationName" value="<?= htmlspecialchars($prescription['medication_name']); ?>" placeholder="e.g., Amoxicillin 500mg" class="w-full bg-slate-50 text-sm text-slate-700 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:border-teal-400 focus:bg-white transition" required>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-capsules text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="dosage" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Dosage (Frequency)</label>
                    <div class="relative">
                        <input type="text" name="dosage" id="dosage" value="<?= htmlspecialchars($prescription['dosage']); ?>" placeholder="e.g., 1 tablet - 3 times a day" class="w-full bg-slate-50 text-sm text-slate-700 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:border-teal-400 focus:bg-white transition" required>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-clock text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="instructions" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Instructions / Special Notes</label>
                    <div class="relative">
                        <textarea name="instructions" id="instructions" rows="4" placeholder="e.g., Take after meals..." class="w-full bg-slate-50 text-sm text-slate-700 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:border-teal-400 focus:bg-white transition resize-none"><?= htmlspecialchars($prescription['instructions']); ?></textarea>
                        <div class="absolute top-3.5 left-3.5 text-slate-400">
                            <i class="fa-regular fa-comment-dots text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold flex items-center space-x-2 shadow-md transition-all">
                        <i class="fa-regular fa-floppy-disk text-xs"></i>
                        <span>Update Prescription</span>
                    </button>
                </div>

            </form>
        </div>

    </main>

</body>
</html>