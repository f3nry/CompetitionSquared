<?php echo $this->form->create(null, array('url' => $accountName . '/admin/schools/add')) ?>
    <h1>School Setup</h1>
    <p><?php echo $this->html->link('Back to administration', $accountName . '/admin') ?></p>
    <h2>Add School</h2>
    <table>
        <tr>
            <td>School Name: </td>
            <td><input type="text" name="name" size="30" maxlength="256" /></td>
        </tr>
    </table>
    <input type="submit" value="Submit" style="display:inline" />
    <?php echo $this->form->end(); ?>
    <h2 style="margin-bottom:8px;">Current Schools</h2>
    <table style="width:100%">
        <tr>
            <th>Name</th>
            <th>Total Students</th>
        </tr>
        <?php foreach($schools as $school): ?>
        <tr>
            <td><?php echo $school->name ?></td>
            <td>&nbsp;<?php echo $school->getStudentCount() ?></td>
            <td>&nbsp;[<?php echo $this->html->link('edit', $accountName . '/admin/schools/edit/'. $school->id) ?>]
            [<?php echo $this->html->link('x', $accountName . '/admin/schools/delete/' . $school->id) ?>]</td>
        </tr>
        <?php endforeach; ?>
    </table>