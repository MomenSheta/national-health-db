<?php if (!isset($user) || !$user) return; ?>

<h2>Edit User data</h2>

<form action="#" method="POST">
    <label for="name">User Name:</label>
    <input type="text" name="name" id="name" required value="<?= htmlspecialchars($user['name']); ?>">

    <br />

    <label for="email">User Email:</label>
    <input type="email" name="email" id="email" required value="<?= htmlspecialchars($user['email']); ?>">

    <br />

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($user['phone']);?>">

    <br />

    <button type="submit">Update User</button>
</form>