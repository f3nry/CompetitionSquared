<h1>Results</h1>
<p><?php echo \app\models\AppConfig::get('frontpage_text') ?></p>
<table cellpadding="0" cellspacing="0" border="0" width="700">
    <tr>
        <td><?php echo $this->html->link('School Summary', $accountName . '/schools') ?></td>
    </tr>
    <?php foreach ($types as $type): ?>
    <?php if(!$type->hidden): ?>
    <tr>
        <td><?php echo $this->html->link($type->nice_name, $accountName . '/teams/type/' . $type->id) ?></td>
    </tr>
    <?php endif; ?>
    <?php endforeach; ?>
</table><br/>
<p><?php echo $this->html->link('Logout', $accountName . '/logout') ?>&nbsp;|&nbsp;<?php echo $this->html->link('Change Password', $accountName . '/changepassword') ?></p>