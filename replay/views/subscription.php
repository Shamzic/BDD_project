<div class="page--padding">
    <h2 class="video-page--title"> Subscriptions </h2>
    <div class="row">
        <?php
        foreach ($s as $subvideo) {
        ?>
        <a href="index.php?ctrl=video&action=showVideoById&id_video=<?php echo $subvideo->getId() ?>">
            <div class="small-12 medium-6 large-4 columns video-box end">
                <?php
                echo '<img class="object-fit_none video_image" src="data:image/jpg;base64,' . base64_encode($subvideo->getTexte()) . '"/>';
                ?>

                <span class="video-title"><?php echo $subvideo->getTitre(); ?></span>
        </a>
        <form method="post" action="index.php?ctrl=video&action=showVideosBySubscriptions" class="video-fav">
            <input type="image" src="<?php if (in_array($subvideo->getId(), $f)) {
                echo "images/star.png";
            } else {
                echo "images/emptystar.png";
            } ?>" alt="Submit" width="15" height="15" value="<?php echo $subvideo->getId() ?>" name="fav">
        </form>
    </div><?php
    }
    ?>
</div>
</div>
