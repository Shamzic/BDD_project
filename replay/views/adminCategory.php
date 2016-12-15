<div class="page--padding">
    <h2 class="video-page--title"> Admin Categories </h2>
    <div class="row">

        <?php
        foreach ($c as $category) {
            ?>


                <div class="small-12 columns category-box">
                    <div class="category-box--admin">
                        <?php echo $category->getName() ?>
                    </div>


                    <input type="button" name="lien1" value="modify" onclick="self.location.href='lien.html'"
                           style="background-color:#183152; color:white; font-weight:bold"onclick>

                    <input type="button" name="lien1" value="delete" onclick="<?php Category::DeleteCategorie($category->getId())?>"
                           style="background-color:#183152; color:white; font-weight:bold"onclick>

                </div>

            <?php
        }
        ?>

    </div>
</div>
