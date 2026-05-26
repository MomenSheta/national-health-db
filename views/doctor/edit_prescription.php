<?php if (!isset($prescription) || !$prescription) return; ?>

<h2>Edit Prescription</h2>
<form action="#" method="POST">
    <label for="medicationName">Medication Name:</label>
    <input type="text" name="medicationName" value="<?php echo htmlspecialchars($prescription['medication_name']); ?>" required><br/>

    <label for="dosage">Dosage:</label>
    <input type="text" name="dosage" value="<?php echo htmlspecialchars($prescription['dosage']); ?>" required><br/>

    <label for="instructions">Instructions:</label>
    <textarea name="instructions"><?php echo htmlspecialchars($prescription['instructions']); ?></textarea><br/>

    <button type="submit">Update Prescription</button>
</form>
