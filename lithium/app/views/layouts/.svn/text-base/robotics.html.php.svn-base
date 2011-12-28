<!doctype html>
<html>
    <head>
        <?php echo $this->html->charset(); ?>
        <title><?php echo $title; ?></title>
        <?php echo $this->html->style(array('debug', 'robotics')); ?>
        <?php
        if(@$jquery) {
            echo $this->html->script('jquery');
        }

        if(@$refresh) {
            echo "<meta http-equiv=\"refresh\" content=\"60\"";
        }
        ?>
        <?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
    </head>
    <body class="app">
        <div id="header">
            <table cellspacing=0 cellpadding=0 border=0>
                <tr>
                    <td><a href="http://www.esc7.net/" target="_blank" style="display:block; border: 0px; cursor:pointer"><img style="border: 0px" src="/img/header_brand_new.jpg" width="835" height="178" /></a></td>
                </tr>
            </table>
        </div>
        <div id="content">
            <?php echo $this->content ?>
        </div>
        <div id="bottom"></div>
        <p style="font-size: 70%; text-align: center; padding-right: 40%">System &copy; <a href="http://twitter.com/letuboy" target="_blank">Paul Henry</a>, 2010
            <br/>Powered by <a href="http://lithify.me">Lithium</a></p>
    </body>
</html>