<h2> Category </h2>
<div class="row">
    <?php
    foreach ($c as $category) {
        ?>
        <a href="#">
        <div class="small-12 columns video_image">
            <?php
            echo '<img class="object-fit_none category_image" src="data:image/jpg;base64,' . base64_encode($category->getImage()) . '"/>';
            ?>
            <div class="category-title"><?php echo $category->getName(); ?></div>

        </div></a><?php
    }
    ?>
</div>
