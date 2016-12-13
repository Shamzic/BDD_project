<div class="page--padding">
    <h2 class="video-page--title"> Videos </h2>
    <div class="row">
        <?php
        foreach ($v as $video) {
        ?>
        <a href="index.php?ctrl=video&action=showVideoById&id_video=<?php echo $video->getId() ?>">
            <div class="small-12 medium-6 large-4 columns video-box end">
                <?php
                echo '<img class="object-fit_none video_image" src="data:image/jpg;base64,' . base64_encode($video->getTexte()) . '"/>';
                ?>

                <span class="video-title"><?php echo $video->getTitre(); ?></span>
        </a>
        <form method="post" action="index.php?ctrl=video&action=showVideos" class="video-fav">
            <input type="image" src="<?php if (in_array($video->getId(), $f)) {
                echo "images/star.png";
            } else {
                echo "images/emptystar.png";
            } ?>" alt="Submit" width="15" height="15" value="<?php echo $video->getId() ?>" name="fav">
        </form>
    </div><?php
    }
    ?>
</div>
</div>
