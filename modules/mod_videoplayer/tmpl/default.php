<?php defined('_JEXEC') or die; ?>

<div class="mod-videoplayer">
    <?php if ($use_videojs): ?>
        <!-- VideoJS Player -->
        <video id="video-player" class="video-js vjs-default-skin" width="640" height="360" 
               data-setup='{"fluid": true}' <?php echo $autoplay; ?> <?php echo $loop; ?> <?php echo $muted; ?> <?php echo $controls; ?>>
            <source src="<?php echo htmlspecialchars($video, ENT_QUOTES, 'UTF-8'); ?>" type="video/mp4">
            <p class="vjs-no-js">
                To view this video, enable JavaScript and consider upgrading to a web browser that supports HTML5 video.
            </p>
        </video>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var player = videojs('video-player');
            });
        </script>

    <?php else: ?>
        <!-- UIKit Video Player -->
        <video class="uk-video" width="100%" height="auto" poster="<?php echo htmlspecialchars($holding_image, ENT_QUOTES, 'UTF-8'); ?>" 
               <?php echo $autoplay; ?> <?php echo $loop; ?> <?php echo $muted; ?> <?php echo $controls; ?>>
            <source src="images/hero/video/<?php echo htmlspecialchars($video, ENT_QUOTES, 'UTF-8'); ?>" type="video/mp4">
        </video>
    <?php endif; ?>
</div>
