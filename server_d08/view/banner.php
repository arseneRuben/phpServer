<?php
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    if ($op = 60) {
?>
        <div class="banner">
            <video autoplay muted loop>
                <source src="./images/video/MontrealBeautyShot.mp4" type="video/mp4">
            </video>
            <h1><?= $pageData['bannertitle'] ?></h1>
        </div>
    <?php

    } else {
    ?>
        <div class="banner">
            <img src="<?= $pageData['bannerimage'] ?>" alt="Completement Cirque">
            <h1><?= $pageData['bannertitle'] ?></h1>
            <!-- <span><a href="../index.html">Explorer</a></span> -->
        </div>
<?php
    }
}
?>