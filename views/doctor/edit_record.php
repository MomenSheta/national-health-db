<?php if (!isset($record) || !$record) return; ?>

<h2>Edit Medical Record</h2>

<form action="#" method="POST">
    <!-- <label for="patientId">Patient ID:</label> -->
    <input hidden type="text" name="patientId" id="patientId" value="<?= htmlspecialchars($record['patient_id']); ?>" readonly>

    <!-- <br /> -->

    <label for="diagnosis">Diagnosis:</label>
    <textarea name="diagnosis" id="diagnosis" required><?= htmlspecialchars($record['diagnosis']); ?></textarea>

    <br />

    <label for="notes">Notes:</label>
    <textarea name="notes" id="notes"><?= htmlspecialchars($record['notes']); ?></textarea>

    <br />

    <label for="visitDate">Visit Date:</label>
    <input type="date" name="visitDate" id="visitDate" required value="<?= htmlspecialchars($record['visit_date']); ?>">

    <br />

    <button type="submit">Update Record</button>
</form>