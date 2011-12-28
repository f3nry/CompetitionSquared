<h1>Events</h1>
<p><?php echo $this->html->link('Back to Student Managment', 'admin/teams') ?></p>
<p>An Event allows you to seperate teams into virtual categories. These can be used to manage different events or contests, inside one competition.</p>
<h2>Add Event</h2>
<?php echo $this->form->create(null, array('url' => 'admin/teams/types/add')) ?>
<p>Name:&nbsp;<input type="text" name="nice_name" />&nbsp;
Scorecard:
<select name="score_card">
    <option>Select one..</option>
    <?php foreach($scorecards as $scorecard):?>
    <option value="<?php echo $scorecard->id ?>"><?php echo $scorecard->name ?></option>
    <?php endforeach; ?>
</select>
<input type="submit" value="Add" style="display:inline;" />
</p>
    <?php echo $this->form->end() ?>
<h2>Import Event</h2>
<p>
<?php echo $this->html->buttonLink('Import Joy of Tournaments Data', 'admin/teams/import/jot') ?>
</p>
<h2>Existing Events</h2>
<table>
    <?php foreach($types as $typeKey => $type): ?>
    <tr>
        <td><?php echo $type ?></td>
        <td>&nbsp;[<a href="/admin/teams/types/edit/<?php echo $typeKey ?>">edit</a>]
            [<a href="/admin/teams/types/delete/<?php echo $typeKey ?>">x</a>]</td>
    </tr>
    <?php endforeach; ?>
</table> 