<div class="page--padding">
    <h2 class="video-page--title"> Admin Favorites </h2>
    <div class="row">
        <?php
        foreach ($fn as $index => $favname) {
            ?>
            <div class="small-12 columns line-margin">
                <div class="column-box--admin">
                    <?php echo $favname ?>
                    <form method="post" action="index.php?ctrl=user&action=showUserFavAdmin&id_usr=<?php echo $idUser ?>" class="icon--admin">
                        <input type="image" src="images/delete.png" alt="Submit" width="20" height="20"
                               value="<?php echo $f[$index] ?>" name="del">
                    </form>
                </div>

            </div>

            <?php
        }
        ?>
    </div>
</div>
