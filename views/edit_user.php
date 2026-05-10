<?php if (!isset($user) || !$user) return; ?>

<h2>Edit User data</h2>

<form action="#" method="POST">
    <label for="name">User Name:</label>
    <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

    <br />

    <label for="email">User Email:</label>
    <input type="email" name="email" id="email" required><?php echo htmlspecialchars($user['email']); ?></input>

    <br />

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone"><?php echo htmlspecialchars($user['role']); ?></input>

    <br />

    <button type="submit">Update User</button>
</form>