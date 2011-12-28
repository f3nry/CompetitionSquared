<?php echo $this->form->create(null, array('url' => $accountName . '/admin/teams/add')) ?>
    <h1>Team Setup</h1>
    <p><?php echo $this->html->link('Back to administration', $accountName . '/admin') ?></p>
    <h2>Add Student</h2>
    <table>
        <tr>
            <td>Student First Name:</td>
            <td> <input type="text" name="first_name" size="20" maxlength="128" /></td>
        </tr>
        <tr>
            <td>Student Last Name: </td>
            <td><input type="text" name="last_name" size="20" maxlength="128" /></td>
        </tr>
        <tr>
            <td>Event:</td>
            <td>
                <select name="type" style="height:24px;">
                    <option value="">Select one...</option>
                    <?php foreach ($types as $type): ?>
                    <option value="<?php echo $type->id ?>"><?php echo $type->nice_name ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>School: </td>
            <td>
                <select name="school_id" style="height:24px;">
                    <option value="">Select one..</option>
                <?php foreach($schools as $school): ?>
                    <option value="<?php echo $school->id ?>"><?php echo $school->name ?></option>
                <?php endforeach; ?>
                </select>
            </td>
        </tr>
    </table>
    <input type="submit" value="Submit" style="display:inline" />
    <button type="button" onclick="javascript:window.location = '/<?php echo $accountName?>/admin/teams/types'">Manage Events</button>
    <?php echo $this->form->end(); ?>
    <h2 style="margin-bottom:8px;">Current Students</h2>
    Filter by Event: <select style="margin-bottom:16px;" onchange="if(this.options[this.selectedIndex].value != '') { window.location='/<?php echo $accountName ?>/admin/teams/type/' + this.options[this.selectedIndex].value } else { window.location='/<?php echo $accountName ?>/admin/teams' }">
        <option value="">All Events</option>
        <?php foreach($types as $type): ?>
        <option value="<?php echo $type->id ?>" <?php echo ($type->id == @$selectedType) ? "selected=\"selected\"" : "" ?>><?php echo $type->nice_name ?></option>
        <?php endforeach ?>
    </select>
    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;" id="teams" class="display">
        <thead>
            <th>Name</th>
            <th>Event</th>
            <th>School</th>
            <th>Action</th>
        </thead>
        <?php foreach($teams as $team): ?>
        <tr>
            <td><?php echo $team->getName(); ?></td>
            <td>&nbsp;<?php echo $team->getType() ?></td>
            <td>&nbsp;<?php echo $team->school_name ?></td>
            <td>&nbsp;[<?php echo $this->html->link('edit', $accountName . '/admin/teams/edit/'. $team->id) ?>]
            [<?php echo $this->html->link('x', $accountName . '/admin/teams/delete/' . $team->id) ?>]</td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div style="clear:both"></div>
    <script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
    <?php echo $this->html->style(array('demo_table')); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#teams").dataTable();
        });
    </script>