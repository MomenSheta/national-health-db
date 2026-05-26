<?php if (!isset($record) || !$record) return; ?>

<h2>Edit Medical Record</h2>

<form action="#" method="POST">
    <label for="patientId">Patient ID:</label>
    <input type="text" name="patientId" id="patientId" value="<?php echo htmlspecialchars($record['patient_id']); ?>" readonly>

    <br />

    <label for="diagnosis">Diagnosis:</label>
    <textarea name="diagnosis" id="diagnosis" required><?php echo htmlspecialchars($record['diagnosis']); ?></textarea>

    <br />

    <label for="notes">Notes:</label>
    <textarea name="notes" id="notes"><?php echo htmlspecialchars($record['notes']); ?></textarea>

    <br />

    <label for="visitDate">Visit Date:</label>
    <input type="date" name="visitDate" id="visitDate" required value="<?php echo htmlspecialchars($record['visit_date']); ?>">

    <br />

    <button type="submit">Update Record</button>
</form>