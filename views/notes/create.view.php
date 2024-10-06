<?php
    /**
     * @var array $note
     * @var array $errors
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
            <form method="POST" action="/notes">
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">


                        <div class="col-span-full">
                            <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Note</label>
                            <div class="mt-2">
                                <textarea id="body" name="body" placeholder="Write your note's content..." rows="3"
                                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $_POST['body'] ?? ''; ?></textarea>
                                <?php if (isset($errors['body'])) : ?>
                                    <p class="text-sm text-red-500"><?= $errors['body']; ?></p>
                                <?php endif; ?>
                            </div>

                        </div>


                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="/notes" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                            <button type="submit"
                                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Save
                            </button>
                        </div>
            </form>

    </main>

    <!-- Include the footer partial -->
<?php require base_path('views/partials/footer.php'); ?>