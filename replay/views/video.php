 <head>
    <link rel="stylesheet" href="css/video.css" type="text/css">
 </head>

<div class="page--padding">
    <?php
    foreach ($v as $video) {
        ?>
        <h2 class="video-page--title"> <?php echo $video->getTitre(); ?>  </h2>
        <div class="row">
            <div style="text-align: center;">
                <iframe class="video-player" src=<?php echo $video->getLink(); ?> frameborder="0"
                        allowfullscreen height="36rem"></iframe>

                <div class="description">
                    <br>Description :<br>

                    <div class="sous-desc" style="font-size:15px;">
                        <?php echo $video->getDesc(); ?> 
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

