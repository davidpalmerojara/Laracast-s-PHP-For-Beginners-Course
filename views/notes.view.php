<!-- Include the head partial -->
<?php require('partials/head.php');?>

<!-- Include the navigation partial -->
<?php require('partials/nav.php');?>

<!-- Include the banner partial -->
<?php require('partials/banner.php');?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <?php foreach ($notes as $note) :?>
            <li><?= $note['body'] ?></li>
        <?php endforeach ?>
    </div>
</main>

<!-- Include the footer partial -->
<?php require('partials/footer.php');?>