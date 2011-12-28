<script type="text/javascript">
    $(document).ready(function() {
        var types = Array(
            "summary",
            <?php foreach($types as $type): ?>
                    <?php if(!$type->hidden): ?>
                    "<?php echo $type->id ?>",
                    <?php endif; ?>
            <?php endforeach; ?>
            ""
        );

        var current = types[0];
        var i = 0;
        var tmpUrl = "";

        if(current == "summary") {
            tmpUrl = '/<?php echo $accountName ?>/schools';
        } else {
            tmpUrl = '/<?php echo $accountName ?>/teams/type/' + current;
        }

        $.post(tmpUrl, { content_only: 1 }, function(html) {
            $("#slide-" + current).html(html);
        });

        function goToNext() {
            i = i + 1;
            current = types[i];

            if(types.length - 1 == i) {
                i = 0;
                current = types[0];
                location.reload(true);
            }

            if(current == "summary") {
                tmpUrl = '/<?php echo $accountName ?>/schools';
            } else {
                tmpUrl = '/<?php echo $accountName ?>/teams/type/' + current;
            }

            $.post(tmpUrl, { content_only: 1 }, function(html) {
                $("#slide-" + current).html(html);

                $(".content-scroller").animate({
                    scrollLeft: i * 900
                }, 1000);

                setTimeout(goToNext, <?php echo app\models\AppConfig::get("slideshow_update_interval", false, 5) ?> * 1000);
            });
        }
        
        setTimeout(goToNext, <?php echo app\models\AppConfig::get("slideshow_update_interval", false, 5) ?> * 1000);
    });
</script>
<style type="text/css">
    .content-wrapper, .content-scroller {
        width:900px;
        height:600px;
        position: relative;
        overflow: hidden;
    }

    .content-holder {
        width: <?php echo count($types) * 900; ?>px;
        height:600px;
    }

    .slide {
        width:900px;
        float:left;
    }

    div.contents {
        margin:0;
    }
</style>
<div class="content-wrapper">
    <div class="content-scroller">
        <div class="content-holder">
            <div class="slide" id="slide-summary"></div>
            <?php foreach($types as $type): ?>
            <?php if(!$type->hidden): ?>
            <div class="slide" id="slide-<?php echo $type->id ?>">
                
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script src="/js/jquery-ui-1.8.8.custom.min.js" type="text/javascript"></script>