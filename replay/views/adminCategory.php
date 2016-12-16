<div class="page--padding">
    <h2 class="video-page--title"> Admin Categories </h2>
    <div class="row">
        <?php
        foreach ($c as $category) {
            ?>
            <div class="small-12 columns line-margin">
                <div class="column-box--admin">
                    <?php echo $category->getName() ?>
                    <form method="post" action="index.php?ctrl=category&action=showCategoryAdmin" class="icon--admin">
                        <input type="image" src="images/delete.png" alt="Submit" width="20" height="20"
                               value="<?php echo $category->getId() ?>" name="del">
                    </form>
                    <a href="index.php?ctrl=category&action=showCategoryAdminEdit&id_cat=<?php echo $category->getId() ?>" class="button edit-button"><i class="fi-page-edit"></i> </a>
                </div>

            </div>
            <?php
        }
        ?>
    </div>
</div>
