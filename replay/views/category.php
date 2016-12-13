<div class="page--padding">
    <h2 class="video-page--title"> Category </h2>
    <div class="row">
        <?php
        foreach ($c as $category) {
            ?>
        <a href="index.php?ctrl=video&action=showVideosByCategory&id_cat=<?php echo $category->getId() ?>">
            <div class="small-12 columns category-box">
                <?php
                echo '<img class="object-fit_none video_image" src="data:image/jpg;base64,' . base64_encode($category->getImage()) . '"/>';
                ?>
                <div class="category-title"><?php echo $category->getName(); ?></div>

            </div></a><?php
        }
        ?>
    </div>
</div>
