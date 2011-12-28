<?php echo $this->html->link('Admin Home', $accountName . '/admin') ?>
<h1>Score Calculation Logs</h1>
<p>Here's a list of logs for score calculations. Newest is first.</p>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%" id="scores" class="display">
    <thead>
        <th width="15"><b>#</b></th>
        <th width="230"><b>Date</b></th>
        <th><b>Preview</b></th>
        <th width="40"><b>Action</b></th>
    </thead>
    <?php $i = 0; ?>
    <?php foreach($entries as $entry): ?>
        <tr>
            <td><?php echo $i++ ?></td>
            <td><?php echo $entry->datetime ?></td>
            <td><?php echo substr($entry->output, 0, 256) . "..."; ?></td>
            <td>[<?php echo $this->html->link('go', $accountName . '/admin/scores/log/entry/' . $entry->id) ?>]</td>
        </tr>
    <?php endforeach; ?>
</table>