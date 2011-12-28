<h1>Events</h1>
<p><?php echo $this->html->link('Back to administration', $accountName . '/admin') ?></p>
<p>An Event allows you to seperate teams into virtual categories. These can be used to manage different events or contests, inside one competition.</p>
<h2>Add Event</h2>
<?php echo $this->form->create(null, array('url' => $accountName . '/admin/teams/types/add')) ?>
<table>
    <tr>
        <td>Name:&nbsp;</td>
        <td><input type="text" name="nice_name" />&nbsp;</td>
    </tr>
    <tr>
        <td>Scorecard:&nbsp;</td>
        <td>
            <select name="score_card">
                <option>Select one..</option>
                <?php foreach($scorecards as $scorecard):?>
                <option value="<?php echo $scorecard->id ?>"><?php echo $scorecard->name ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Hidden:&nbsp;</td>
        <td><input type="checkbox" name="hidden" /></td>
    </tr>
    <tr>
        <td><input type="submit" value="Add" style="display:inline;" /></td>
    </tr>
</table>
    <?php echo $this->form->end() ?>
<h2>Import Event</h2>
<p>
<?php echo $this->html->buttonLink('Import Joy of Tournaments Data', $accountName . '/admin/teams/import/jot') ?>
</p>
<h2>Existing Events</h2>
<table>
    <?php if(!count($types) > 0): ?>
    <tr><td>No events entered!</td></tr>
    <?php else: ?>
    <?php foreach($types as $type): ?>
    <tr>
        <td><?php echo $type->nice_name ?></td>
        <td>&nbsp;[<a href="/<?php echo $accountName ?>/teams/type/<?php echo $type->id ?>">go</a>]
            [<a href="/<?php echo $accountName ?>/admin/teams/types/edit/<?php echo $type->id ?>">edit</a>]
            [<a href="/<?php echo $accountName ?>/admin/teams/types/delete/<?php echo $type->id ?>">x</a>]</td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table> 