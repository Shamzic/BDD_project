<h2> Videos </h2>
<div class="row">
    <?php
    foreach ($v as $video) {
        ?>
        <a href="#">
        <div class="small-12 medium-6 large-4 columns video_image">
        <?php
        echo '<img class="object-fit_none" src="data:image/jpg;base64,' . base64_encode($video->getTexte()) . '"/>';
        ?>
        <div class="video-title"><?php echo $video->getTitre(); ?></div>

        </div></a><?php
    }
    ?>
</div>
