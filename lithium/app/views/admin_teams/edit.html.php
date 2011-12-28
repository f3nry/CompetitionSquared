<h1>Edit Team</h1>
<?php echo $this->form->create() ?>
<table>
<tr>
    <td>Student First Name:</td>
    <td><input type="text" name="first_name" size="20" maxlength="128" value="<?php echo $team->first_name ?>"/></td>
</tr>
<tr>
    <td>Student Last Name:</td>
    <td><input type="text" name="last_name" size="20" maxlength="128" value="<?php echo $team->last_name ?>"/></td>
</tr>
<tr>
    <td>Event:</td>
    <td>
        <select name="type" style="height:24px;">
        <option value="">Select one...</option>
        <?php foreach ($types as $type): ?>
            <option value="<?php echo $type->id ?>" <?php if($team->type == $type->id) { echo "selected=\"selected\""; }?>>
                <?php echo $type->nice_name ?>
            </option>
        <?php endforeach; ?>
        </select>
    </td>
</tr>
<tr>
    <td>School:</td>
    <td>
        <select name="school" style="height:24px;">
            <option value="">Select one..</option>
        <?php foreach($schools as $school): ?>
            <option value="<?php echo $school->id ?>" <?php if($team->school->id == $school->id) { echo "selected=\"selected\""; } ?>><?php echo $school->name ?></option>
        <?php endforeach; ?>
        </select>
    </td>
<tr>
    <td><input type="submit" value="Submit" style="text-align: center;"/></td>
</tr>
</table>
<?php echo $this->form->end() ?>