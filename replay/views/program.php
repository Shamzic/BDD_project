<div class="page--padding">
    <h2 class="video-page--title"> Programs </h2>
    <div class="row">
        <?php
        foreach ($p as $program) {
        ?>
        <a href="index.php?ctrl=video&action=showVideosByProgram&id_prog=<?php echo $program->getId() ?>">
            <div class="small-12 medium-6 large-4 columns category-box end">
                <?php
                echo '<img class=" video_image program_image" src="data:image/jpg;base64,' . base64_encode($program->getImage()) . '"/>';
                ?>
                <span class="video-title"><?php echo $program->getName(); ?></span>

        </a>
        <form method="post" action="index.php?ctrl=program&action=showPrograms" class="video-fav">
            <input type="image" src="<?php if (in_array($program->getId(), $sp)) {
                echo "images/circleOn.png";
            } else {
                echo "images/circleOff.png";
            } ?>" alt="Submit" width="15" height="15" value="<?php echo $program->getId() ?>" name="prog">
        </form>
    </div>
    <?php
    }
    ?>
</div>
</div>
