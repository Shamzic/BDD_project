<h2> Videos </h2>
<div class="row">
    <?php
    foreach ($vc as $videoCat) {
        ?>
        <a href="#">
        <div class="small-12 medium-6 large-4 columns video_image">
            <?php
            echo '<img class="object-fit_none" src="data:image/jpg;base64,' . base64_encode($videoCat->getTexte()) . '"/>';
            ?>
            <div class="video-title"><?php echo $videoCat->getTitre(); ?></div>

        </div></a><?php
    }
    ?>
</div>
