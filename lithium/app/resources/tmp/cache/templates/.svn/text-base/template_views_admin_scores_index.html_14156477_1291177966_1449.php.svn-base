<?php 
    use app\models\TeamTypes;
    if(!TeamTypes::isloaded()) {
        TeamTypes::load();
    }
?>
<?php echo $this->html->link('Admin Home', 'admin') ?>
<h1>Manage Scores</h1>
<p><?php echo $this->form->create(null, array('url' => 'admin/scores/add')) ?>
    Team Type:
    <select name="type">
        <?php foreach(TeamTypes::$_types as $key => $type): ?>
        <option value="<?php echo $key ?>"><?php echo $type ?></option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="new" value="1" />
    <input type="submit" value="Add" style="display:inline"/>
    <?php echo $this->form->end() ?>
</p>
<h2>Scores</h2>
<table cellpadding="0" cellspacing="0" border="0" width="700">
    <tr>
        <td width="60"><b>Place</b></td>
        <td width="340"><b>Team Name</b></td>
        <td width="100"><b>Round</b></td>
        <td style="text-align: right;" width="200"><b>Total score</b></td>
    </tr>
    <?php $i = 1; ?>
    <?php foreach($scores as $score): ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $score->team->name ?></td>
        <td><?php echo $score->round ?></td>
        <td style="text-align:right;"><?php echo $score->total ?></td>
        <td>&nbsp;[<?php echo $this->html->link('edit', 'admin/scores/edit/'. $score->id) ?>]</td>
            <td>[<?php echo $this->html->link('x', 'admin/scores/delete/' . $score->id) ?>]</td>
    </tr>
    <?php endforeach; ?>
</table>