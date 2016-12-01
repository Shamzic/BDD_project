<?php
foreach ($v as $video) {
    ?>
    <h2 class="video-page--title"> <?php echo $video->getTitre(); ?>  </h2>
    <div class="row">
            <div style="text-align: center;">
                <iframe class="video-player" src=<?php echo $video->getLink(); ?> frameborder="0"
                        allowfullscreen></iframe>
                <script type="text/javascript" language="javascript">
                    $('.video-player').css('height', $(window).height()+'px');
                </script>
            </div>
    </div>
    <?php
}
?>

