<div class="fixed bottom-5 right-5 space-y-2 z-50">
    <?php if (!empty($_SESSION['success'])): ?>
        <?php
        $successMessages = is_array($_SESSION['success']) ? $_SESSION['success'] : [$_SESSION['success']];
        foreach ($successMessages as $msg): ?>
            <div class="toast success ">
                <?= htmlspecialchars($msg); ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <?php
        $errorMessages = is_array($_SESSION['error']) ? $_SESSION['error'] : [$_SESSION['error']];
        foreach ($errorMessages as $msg): ?>
            <div class="toast error">
                <?= htmlspecialchars($msg); ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</div>

<script>
    setTimeout(() => {
        document.querySelectorAll('.fixed > div').forEach(el => el.remove());
    }, 5000);
</script>