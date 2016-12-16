<div class="page--padding">
    <h2 class="video-page--title"> Admin Videos </h2>
    <div class="row">
        <?php
        foreach ($v as $video) {
            ?>
            <div class="small-12 columns line-margin">
                <div class="column-box--admin">
                    <?php echo $video->getTitre() ?>
                    <form method="post" action="index.php?ctrl=video&action=showVideoAdmin" class="icon--admin">
                        <input type="image" src="images/delete.png" alt="Submit" width="20" height="20"
                               value="<?php echo $video->getId() ?>" name="del">
                    </form>
                    <a href="index.php?ctrl=video&action=showVideoAdminEdit&id_vid=<?php echo $video->getId() ?>" class="button edit-button"><i class="fi-page-edit"></i> </a>
                </div>

            </div>

            <?php
        }
        ?>

    </div>
</div>
