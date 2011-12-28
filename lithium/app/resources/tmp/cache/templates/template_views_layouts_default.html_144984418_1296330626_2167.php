<?php use lithium\storage\Session; ?>
<!doctype html>
<html>
    <head>
        <?php echo $this->html->charset(); ?>
        <title>Competition Squared <?php echo @$title; ?></title>
        <?php echo $this->html->style(array('debug', 'style')); ?>
        <?php
        if(@$jquery) {
            echo $this->html->script('jquery');
        }
        ?>
        <?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?></head>
    <body class="app">
        <div class="box">
            <div class="header">
                <div class="left">
                    <h2>Competition Squared</h2>
                    <h4>your competition, simplified</h4>
                </div>
                <?php if(@$isPage): ?>
                <div class="right">
                    <ul id="menu">
                        <li><a href="/" <?php if($page == "home") { echo "class=\"current\""; }?>>Home</a></li>
                        <li><a href="/pages/about" <?php if($page == "about") { echo "class=\"current\""; }?>>Screen Shots</a></li>
                        <li><a href="/pages/demo" <?php if($page == "demo") { echo "class=\"current\""; }?>>Demo</a>
                        <li><a href="/pages/code" <?php if($page == "code") { echo "class=\"current\""; }?>>Code</a>
                        <li><a href="/contact" <?php if($page == "contact") { echo "class=\"current\""; }?>>Contact Us</a></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
            <div class="contents">
                <h1><?php echo \app\models\AppConfig::get('competition_name') ?></h1>
                    <?php if(!@$admin && (Session::read('permissions') == 'ADMIN' || Session::read('permissions') == 'ACCT_CREATOR') && !$isPage): ?>
                    <?php echo $this->html->link('Administration', @$accountName . '/admin', array('style' => 'padding-bottom:8px;')) ?>
                    <?php endif; ?>
                <?php echo $this->content ?>
            </div>
        </div>
        <div class="footer">
            &copy; 2010 <a href="http://mphwebsystems.com">Paul Henry</a>
        </div>
    </body>
</html>