<h2> Videos </h2>
<div class="row">
    <?php
    foreach ($v as $video) {
        ?>
        <a href="#">
        <div class="large-4 columns">
        <?php
        echo '<img class="object-fit_none" src="data:image/jpg;base64,' . base64_encode($video->getTexte()) . '"/>';
        ?>
        <div class="video-title"><?php echo $video->getTitre(); ?></div>

        </div></a><?php
    }
    ?>
</div>
