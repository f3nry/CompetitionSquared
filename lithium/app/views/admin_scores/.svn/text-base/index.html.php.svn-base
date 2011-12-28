<?php 
    use app\models\TeamTypes;
    use lithium\storage\Session;
    if(!TeamTypes::isloaded()) {
        TeamTypes::load();
    }
?>
<h1>Manage Scores</h1>
<?php echo $this->html->link('Admin Home', $accountName . '/admin') ?>
<h2>Add Score</h2>
<p><?php echo $this->form->create(null, array('url' => $accountName . '/admin/scores/add')) ?>
<p>Select an event, then press "Add Score" to add a new score for that event.</p>
    Event:
    <select name="type">
        <?php foreach(TeamTypes::$_types as $type): ?>
        <option value="<?php echo $type->id ?>" <?php echo ($type->id == Session::read("scoreLastSelectedType")) ? "selected=\"selected\"" : "" ?>><?php echo $type->nice_name ?></option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="new" value="1" />
    <input type="submit" value="Add Score" style="display:inline"/>
    <?php echo $this->form->end() ?>
<h2>Current Scores</h2>
Filter by Event:
    <select onchange="if(this.options[this.selectedIndex].value != '') { window.location='/<?php echo $accountName ?>/admin/scores/type/' + this.options[this.selectedIndex].value } else { window.location='/admin/scores' }">
        <option value="all" <?php echo (@$selectedType == "") ? "selected=\"selected\"" : "" ?>>All Events</option>
        <?php foreach(TeamTypes::$_types as $type): ?>
        <option value="<?php echo $type->id ?>" <?php echo ($type->id == @$selectedType) ? "selected=\"selected\"" : "" ?>><?php echo $type->nice_name ?></option>
        <?php endforeach ?>
    </select>
    <table cellpadding="0" cellspacing="0" border="0" style="width:100%" id="scores" class="display">
    <thead>
        <th width="15"><b>#</b></th>
        <th width="180"><b>Team Name</b></th>
        <th width="250"><b>School</b></th>
        <th width="250"><b>Event</b></th>
        <th width="180"><b>Displayed Score</b></th>
        <th width="180" style="text-align: right;"><b>Total score</b></th>
        <th><b>Action</b></th>
    </thead>
    <?php $i = 1; ?>
    <?php foreach($scores as $score): ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $score->team_last_name . ", " . $score->team_first_name ?></td>
        <td><?php echo $score->school_name ?></td>
        <td><?php echo $score->getType($score->team_type) ?></td>
        <td><?php echo $score->displayed_total ?></td>
        <td style="text-align:right;"><?php echo $score->total ?></td>
        <td>[<?php echo $this->html->link('edit', $accountName . '/admin/scores/edit/'. $score->id) ?>]&nbsp;[<?php echo $this->html->link('x', $accountName . '/admin/scores/delete/' . $score->id) ?>]</td>
    </tr>
    <?php endforeach; ?>
</table>
<div style="clear:both; "></div>
<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
<?php echo $this->html->style(array('demo_table')); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#scores").dataTable();
    });
</script>