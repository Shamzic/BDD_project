<div class="page--padding">
    <h2 class="video-page--title"> Videos </h2>
    <div class="row">
        <?php
        foreach ($vp as $videoProg) {
        ?>
        <a href="index.php?ctrl=video&action=showVideoById&id_video=<?php echo $videoProg->getId() ?>">
            <div class="small-12 medium-6 large-4 columns video_box end">
                <?php
                echo '<img class="object-fit_none video_image" src="data:image/jpg;base64,' . base64_encode($videoProg->getTexte()) . '"/>';
                ?>
                <span class="video-title"><?php echo $videoProg->getTitre(); ?></span>
        </a>
        <form method="post"
              action="index.php?ctrl=video&action=showVideosByProgram&id_prog=<?php echo $videoProg->getId() ?>"
              class="video-fav">
            <input type="image" src="<?php if (in_array($videoProg->getId(), $f)) {
                echo "images/star.png";
            } else {
                echo "images/emptystar.png";
            } ?>" alt="Submit" width="15" height="15" value="<?php echo $videoProg->getId() ?>" name="fav">
        </form>
    </div><?php
    }
    ?>
</div>
</div>

