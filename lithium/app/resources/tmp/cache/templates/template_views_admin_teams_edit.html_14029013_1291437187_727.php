<h1>Edit Team</h1>
<?php echo $this->form->create() ?>
<p>Team name: <input type="text" name="name" size="20" maxlength="40" value="<?php echo $team->name ?>"/>
    <select name="type">
        <option value="">Select one...</option>
        <?php foreach ($types as $type): ?>
            <option value="<?php echo $type->type ?>" <?php if($team->type == $type->type) { echo "selected=\"selected\""; }?>>
                <?php echo $type->nice_name ?>
            </option>
        <?php endforeach; ?>
        </select>
</p>
<p>
    School:
    <input type="text" value="<?php echo $team->school ?>" name="school" />
    <input type="submit" value="Submit" style="text-align: center;" />
</p>
<?php echo $this->form->end() ?>