<div class="page--padding">
    <h2 class="video-page--title"> Admin Users </h2>
    <div class="row">
        <?php
        foreach ($u as $user) {
            ?>
            <div class="small-12 columns line-margin">
                <div class="column-box--admin">
                    <?php echo $user->getLogin() ?>
                    <form method="post" action="index.php?ctrl=user&action=showUserAdmin" class="icon--admin">
                        <input type="image" src="images/delete.png" alt="Submit" width="20" height="20"
                               value="<?php echo $user->getId() ?>" name="del">
                    </form>
                    <a href="index.php?ctrl=user&action=showUserAdminEdit&id_usr=<?php echo $user->getId() ?>" class="button edit-button"><i class="fi-page-edit"></i> </a>
                </div>

            </div>

            <?php
        }
        ?>

    </div>
</div>
