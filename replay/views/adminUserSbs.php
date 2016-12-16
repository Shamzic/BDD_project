<div class="page--padding">
    <h2 class="video-page--title"> Admin Subscribtions </h2>
    <div class="row">
        <?php
        foreach ($sn as $index => $sbsname) {
            ?>
            <div class="small-12 columns line-margin">
                <div class="column-box--admin">
                    <?php echo $sbsname ?>
                    <form method="post" action="index.php?ctrl=user&action=showUserSbsAdmin&id_usr=<?php echo $idUser ?>" class="icon--admin">
                        <input type="image" src="images/delete.png" alt="Submit" width="20" height="20"
                               value="<?php echo $s[$index] ?>" name="del">
                    </form>
                </div>

            </div>

            <?php
        }
        ?>
    </div>
</div>
