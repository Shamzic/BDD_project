<div class="page--padding">
    <h2 class="video-page--title"> Category </h2>
    <div class="row">

        <?php
        foreach ($c as $category) {
        ?>

        <a href="index.php?ctrl=video&action=showVideosByCategory&id_cat=<?php echo $category->getId() ?>">
            <div class="small-12 columns category-box">
                <div class="category-title">


                    <?php echo '<input type="text" value="'.$category->getName().'"/>'; ?>
                </div>


                <input type="button" name="lien1" value="modify" onclick="self.location.href='lien.html'" 
                style="background-color:#183152; color:white; font-weight:bold"onclick> 

                <input type="button" name="lien1" value="delete" onclick="<?php Categorie::DeleteCategorie($category->getId())?>" 
                style="background-color:#183152; color:white; font-weight:bold"onclick> 

            </div></a>
        
        <?php
        }
        ?>

    </div>
</div>
