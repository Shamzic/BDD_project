<h2 class="video-page--title"> Videos </h2>
<div class="row">
    <?php
    foreach ($v as $video) {
    ?>
    <a href="index.php?ctrl=video&action=showVideoById&id_video=<?php echo $video->getId() ?>">
        <div class="small-12 medium-6 large-4 columns video_image">
            <?php
            echo '<img class="object-fit_none" src="data:image/jpg;base64,' . base64_encode($video->getTexte()) . '"/>';
            ?>

    <span class="video-title"><?php echo $video->getTitre(); ?></span>
    </a>
    <i class="fi-star fi-star--clicked"></i>


</div><?php
}
?>
</div>
