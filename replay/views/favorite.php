<div class="page--padding">
    <h2 class="video-page--title"> Favorite </h2>
    <div class="row">
        <?php
        foreach ($f as $favideo) {
        ?>
        <a href="index.php?ctrl=video&action=showVideoById&id_video=<?php echo $favideo->getId() ?>">
            <div class="small-12 medium-6 large-4 columns video-box end">
                <?php
                echo '<img class="object-fit_none video_image" src="data:image/jpg;base64,' . base64_encode($favideo->getTexte()) . '"/>';
                ?>

                <span class="video-title"><?php echo $favideo->getTitre(); ?></span>
        </a>
        <form method="post" action="index.php?ctrl=video&action=showVideosByFavorite" class="video-fav">
            <input type="image" src="images/star.png" alt="Submit" width="15" height="15"
                   value="<?php echo $favideo->getId() ?>" name="fav">
        </form>
    </div><?php
    }
    ?>
</div>
</div>
