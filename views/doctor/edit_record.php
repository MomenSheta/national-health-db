<?php if (!isset($record) || !$record) return; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medical Record - <?= htmlspecialchars($record['id']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen flex flex-col font-sans">

    <?php include __DIR__ . '/../navbar.php'; ?>

    <main class="flex-1 max-w-3xl w-full mx-auto p-8">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Edit Medical Record</h1>
                <p class="text-sm text-gray-400 mt-0.5">Updating record for Patient ID: #<?= htmlspecialchars($record['patient_id']); ?></p>
            </div>
            
            <a href="javascript:history.back()" class="border border-gray-200 text-slate-600 bg-white hover:bg-slate-50 px-4 py-2 rounded-xl text-xs font-semibold flex items-center space-x-1.5 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>Cancel</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden p-8">
            
            <form action="<?= fixed_path('/record/' . $record['id'] . '/edit') ?>" method="POST" class="space-y-6">                
                
                <input type="hidden" name="patientId" id="patientId" value="<?= htmlspecialchars($record['patient_id']); ?>">

                <div>
                    <label for="diagnosis" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Diagnosis (Symptoms & Condition)</label>
                    <div class="relative">
                        <textarea name="diagnosis" id="diagnosis" rows="4" class="w-full bg-slate-50 text-sm text-slate-700 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 focus:bg-white transition resize-none" required><?= htmlspecialchars($record['diagnosis']); ?></textarea>
                        <div class="absolute top-3.5 left-3.5 text-slate-400">
                            <i class="fa-solid fa-stethoscope text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="notes" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Additional Notes / Treatment Plan</label>
                    <div class="relative">
                        <textarea name="notes" id="notes" rows="3" class="w-full bg-slate-50 text-sm text-slate-700 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none focus:border-blue-400 focus:bg-white transition resize-none"><?= htmlspecialchars($record['notes']); ?></textarea>
                        <div class="absolute top-3.5 left-3.5 text-slate-400">
                            <i class="fa-regular fa-clipboard text-sm"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="visitDate" class="text-xs font-bold text-slate-700 block mb-2 uppercase tracking-wide">Visit Date</label>
                    <div class="relative">
                        <input type="date" name="visitDate" id="visitDate" value="<?= htmlspecialchars($record['visit_date']); ?>" class="w-full bg-slate-100 text-sm text-gray-400 p-3 pl-10 rounded-xl border border-gray-200 focus:outline-none cursor-not-allowed" readonly required>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-regular fa-calendar text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end space-x-3">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2.5 rounded-xl text-sm font-semibold flex items-center space-x-2 shadow-md transition-all">
                        <i class="fa-regular fa-floppy-disk text-xs"></i>
                        <span>Update Record</span>
                    </button>
                </div>

            </form>
        </div>

    </main>

</body>
</html>