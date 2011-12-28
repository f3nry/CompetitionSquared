<?php echo $this->form->create(null, array('url' => 'admin/teams/add')) ?>
    <h1>Team Setup</h1>
    <p><?php echo $this->html->link('Back to admin home', 'admin') ?></p>
    <h2>Add Student</h2>
    <p>Student name: <input type="text" name="name" size="20" maxlength="40" />
        <select name="type" style="height:20px;">
            <option value="">Select one...</option>
            <?php foreach ($types as $type): ?>
            <option value="<?php echo $type->type ?>"><?php echo $type->nice_name ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        School:
        <input type="text" name="school" size="28" maxlength="256" /><br/>
        <input type="submit" value="Submit" style="display:inline" />
        <button type="button" onclick="javascript:window.location = 'teams/types'">Manage Events</button>
    </p>
    <h2>Current Students</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Event</th>
            <th>School</th>
        </tr>
        <?php foreach($teams as $team): ?>
        <tr>
            <td><?php echo $team->name ?></td>
            <td>&nbsp;<?php echo $team->getType() ?></td>
            <td>&nbsp;<?php echo $team->school ?></td>
            <td>&nbsp;[<?php echo $this->html->link('edit', 'admin/teams/edit/'. $team->id) ?>]
            [<?php echo $this->html->link('x', 'admin/teams/delete/' . $team->id) ?>]</td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php echo $this->form->end(); ?>