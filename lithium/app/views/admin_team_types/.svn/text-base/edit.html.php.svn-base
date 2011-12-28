<h1>Team Types</h1>
<p><?php echo $this->html->link('Back to Team Type Managment', $accountName . '/admin/teams/types') ?></p>
<h2>Editing <?php echo $type->nice_name ?></h2>
<?php echo $this->form->create() ?>
<table>
    <tr>
        <td>Name:&nbsp;</td>
        <td><input type="text" name="nice_name" value="<?php echo $type->nice_name ?>" size="30"/></td>
    </tr>
    <tr>
        <td>Scorecard:</td>
        <td>
            <select name="score_card">
                <?php foreach($scorecards as $scorecard): ?>
                <option value="<?php echo $scorecard->id ?>"><?php echo $scorecard->name ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Hidden:&nbsp;</td>
        <td><input type="checkbox" name="hidden" <?php if($type->hidden) { echo "checked=\"checked\""; } ?>/></td>
    </tr>
    <tr>
        <td><input type="submit" value="Update"/></td>
    </tr>
</table>
<?php echo $this->form->end() ?>