<?php use lithium\storage\Session ?>
<!doctype html>
<html>
    <head>
        <?php echo $this->html->charset(); ?>
        <title><?php echo $title; ?></title>
        <?php echo $this->html->style(array('debug', 'lisd/lisd')); ?>
        <?php
        if (@$jquery) {
            echo $this->html->script('jquery');
        }
        ?>
        <?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?></head>
    <body class="app">
        <div class="wrapper">
            <div class="box">
                <div class="header"></div>
                <div class="contents">
                    <h1><?php echo \app\models\AppConfig::get('competition_name') ?></h1>
                    <?php if(!@$admin && (Session::read('permissions') == 'ADMIN' || Session::read('permissions') == 'ACCT_CREATOR')): ?>
                    <?php echo $this->html->link('Administration', $accountName . '/admin') ?>
                    <?php endif; ?>
                    <?php echo $this->content ?>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="left">Copyright &copy; Longview Independent School District</div>
            <div class="right">Powered By <a href="http://mphwebsystems.com">MPH Web Systems</a></div>
        </div>
    </body>
</html>