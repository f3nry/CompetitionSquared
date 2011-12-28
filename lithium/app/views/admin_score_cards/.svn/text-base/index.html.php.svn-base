<p><?php echo $this->html->link('Back to Administration', $accountName . '/admin') ?></p>
<h1>Scorecards</h1>
<p>Here are your current score cards. You can attach one score card to one or more teams.</p>
<?php echo $this->html->buttonLink('Add Score Card', $accountName . '/admin/scorecards/add'); ?>
<h2>Current Score Cards</h2>
<table width="100%">
    <tr>
        <td style="font-weight:bold;">Name</td>
    </tr>
    <?php foreach($scorecards as $scorecard): ?>
    <tr>
        <td><?php echo $scorecard->name ?></td>
        <td>[<?php echo $this->html->link('edit', $accountName . '/admin/scorecards/edit/' . $scorecard->id) ?>]&nbsp;[<?php echo $this->html->link('x', $accountName . '/admin/scorecards/delete/' . $scorecard->id) ?>]</td>
    </tr>
    <?php endforeach; ?>
</table>