<h2> Video </h2>
<div class="row">
    <?php
    foreach ($v as $video) {
        ?>
        <div style="text-align: center;">
            <iframe class="video-player" src=<?php echo $video->getLink(); ?> frameborder="0" allowfullscreen></iframe>
        </div>
    <?php
    }
    ?>
</div>
