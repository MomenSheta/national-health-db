<h2>Create Medical Record</h2>

<form action="#" method="POST">
    <label for="patientId">Patient ID:</label>
    <Select>
        <?php
        if (isset($my_patients)) {
            foreach ($my_patients as $patient) {
        ?>
                <option value="<?= $patient["id"] ?>" <?= isset($selected) && $patient["id"] == $selected ? "selected" : "" ?>>
                    <?= $patient["name"] ?>
                </option>
        <?php
            }
        }
        ?>
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
</form>