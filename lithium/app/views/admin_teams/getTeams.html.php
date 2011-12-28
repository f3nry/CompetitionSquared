<?php use app\models\TeamTypes ?>
<?php foreach($teams as $team): ?>
<option value="<?php echo $team->id?>"><?php echo $team->last_name . ', ' . $team->first_name . ' (' . TeamTypes::getName($team->type) . ')'?></option>
<?php endforeach; ?>