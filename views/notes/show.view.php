<?php
    /**
     * @var array $note
     */
?>

    <!-- Include the head partial -->
<?php require base_path('views/partials/head.php'); ?>

    <!-- Include the navigation partial -->
<?php require base_path('views/partials/nav.php'); ?>

    <!-- Include the banner partial -->
<?php require base_path('views/partials/banner.php'); ?>

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p><?= htmlspecialchars($note['body']) ?></p>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/notes" class="text-sm font-semibold leading-6 text-gray-900">Go back</a>
                <a href="/note/edit?id=<?= $note['id']?>"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Edit
                </a>

            </div>

        </div>
    </main>

    <!-- Include the footer partial -->
<?php require base_path('views/partials/footer.php'); ?>