<?php if($userObj == false) { die("You cannot edit this user."); } ?>
<?php echo $this->html->link('Back to Account Admin', $accountName . '/admin/accounts') ?>
<h2>Edit Account</h2>
<?php if(@$errorMsg): ?>
<p style="color:red"><?php echo $errorMsg ?></p>
<?php endif; ?>
<?php echo $this->form->create() ?>
<table>
    <tr>
        <td>Username:</td>
        <td><input type="text" name="username" value="<?php echo $userObj->username ?>"/></td>
    </tr>
    <tr>
        <td>Password:</td>
        <td><input type="password" name="password" /></td>
    </tr>
    <tr>
        <td>Type:</td>
        <td>
            <select name="account_type" onchange="checkSelectedPermission(this)">
                <option value="ADMIN" <?php echo ($userObj->account_type == "ADMIN") ? "selected=\"selected\"" : "" ?>>Administrator</option>
                <option value="ACCT_CREATOR" <?php echo ($userObj->account_type == "ACCT_CREATOR") ? "selected=\"selected\"" : "" ?>>Account Creator</option>
                <option value="PARENT" <?php echo ($userObj->account_type == "PARENT") ? "selected=\"selected\"" : "" ?>>Parent</option>
            </select>
        </td>
    </tr>
    <tr id="school_limit" <?php if($userObj->account_type =="ADMIN"): ?>style="display:none;"<?php endif; ?>>
            <td>School:</td>
            <td>
                <select name="school_limit">
                    <option value="">All</option>
                    <?php foreach($schools as $school): ?>
                    <option value="<?php echo $school->id ?>" <?php if($userObj->school_limit == $school->id) { echo "selected=\"selected\""; }?>><?php echo $school->name ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="Update" /></td>
    </tr>
</table>
<?php echo $this->form->end() ?>
<?php if($userObj->account_type == "PARENT"): ?>
<h2>Viewable Students:</h2>
<div style="margin-left: 20px">
    <h2>Add Student:</h2>
    <?php echo $this->form->create(null, array("url" => $accountName . "/admin/accounts/" . $userObj->id . "/add/team")) ?>
    <select name="team">
        <?php foreach($teams as $team): ?>
        <option value="<?php echo $team->id ?>"><?php echo $team->name ?>&nbsp;(<?php echo $team->school ?>)</option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Add" style="display:inline"/>
    <?php echo $this->form->end() ?>
    <h2>Current Students</h2>
    <table>
        <tr>
            <td>Name</td>
            <td>School</td>
        </tr>
        <?php foreach($currentTeams as $currentTeam): ?>
        <tr>
            <td><?php echo $currentTeam->name ?></td>
            <td><?php echo $currentTeam->school ?></td>
            <td><?php echo $this->html->link('x', $accountName . '/admin/accounts/' . $userObj->id . '/remove/team/' . $currentTeam->id) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>
<script type="text/javascript">
    function checkSelectedPermission(element) {
        if(element.value != 'ADMIN') {
            document.getElementById("school_limit").style.display = 'inline';
        } else {
            document.getElementById("school_limit").style.display = 'none';
        }
    }
</script>