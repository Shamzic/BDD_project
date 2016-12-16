<div class="page--padding">
    <h2 class="video-page--title"> Admin Programs </h2>
    <div class="row">
        <?php
        foreach ($p as $program) {
            ?>
            <div class="small-12 columns line-margin">
                <div class="column-box--admin">
                    <?php echo $program->getName() ?>
                    <form method="post" action="index.php?ctrl=program&action=showProgramAdmin" class="icon--admin">
                        <input type="image" src="images/delete.png" alt="Submit" width="20" height="20"
                               value="<?php echo $program->getId() ?>" name="del">
                    </form>
                    <a href="index.php?ctrl=program&action=showProgramAdminEdit&id_prog=<?php echo $program->getId() ?>" class="button edit-button"><i class="fi-page-edit"></i> </a>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
