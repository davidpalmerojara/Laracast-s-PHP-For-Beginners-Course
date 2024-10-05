<?php
    /**
     * @var array $notes
     */
?>

    <!-- Include the head partial -->
<?php require('partials/head.php'); ?>

    <!-- Include the navigation partial -->
<?php require('partials/nav.php'); ?>

    <!-- Include the banner partial -->
<?php require('partials/banner.php'); ?>

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <ul>
            <?php foreach ($notes as $note) : ?>
                <li>
                    <a href="/note?id=<?= htmlspecialchars($note['id']) ?>" class="text-blue-500 hover:underline">
                        <?= $note['body'] ?>
                    </a>
                </li>
            <?php endforeach ?>
            </ul>
            <p class="mt-6">
                <a href="/notes/create" class="text-blue-500 hover:underline">Create a new note</a>
            </p>
        </div>
    </main>

    <!-- Include the footer partial -->
<?php require('partials/footer.php'); ?>