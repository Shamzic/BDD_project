<div class="page--padding">
    <h2 class="video-page--title"> Recommended </h2>
    <div class="row">
        <?php
        foreach ($rec as $recvid) {
        ?>
        <a href="index.php?ctrl=video&action=showVideoById&id_video=<?php echo $recvid->getId() ?>">
            <div class="small-12 medium-6 large-4 columns video-box end">
                <?php
                echo '<img class="object-fit_none video_image" src="data:image/jpg;base64,' . base64_encode($recvid->getTexte()) . '"/>';
                ?>

                <span class="video-title"><?php echo $recvid->getTitre(); ?></span>
        </a>
        </form> 
    </div><?php
    }
    ?>
</div>
</div>