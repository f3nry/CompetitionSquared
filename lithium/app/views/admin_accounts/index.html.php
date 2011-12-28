<div class="left">
    <h1>Manage Accounts</h1>
    <?php echo $this->html->link('Back to administration', $accountName . '/admin') ?>
    <p>Here you may add or edit your accounts.</p>
</div>
<div class="clear"></div>
<div class="right" style="margin-right:20px">
    <h2>Add Account</h2>
    <?php echo $this->form->create(null, array('url' => $accountName . '/admin/accounts/add')) ?>
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" /></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td>Type:</td>
            <td>
                <select name="account_type" onchange="checkSelectedPermission(this)">
                    <?php if($permissions == "ADMIN" || $permissions == "SUPERADMIN"): ?>
                    <option value="ADMIN">Administrator</option>
                    <?php endif; ?>
                    <option value="ACCT_CREATOR">Account Creator</option>
                    <option value="PARENT">Parent</option>
                </select>
            </td>
        </tr>
        <tr id="school_limit" style="display:none;">
            <td>School:</td>
            <td>
                <select name="school_limit">
                    <option value="">All</option>
                    <?php foreach($schools as $school): ?>
                    <option value="<?php echo $school->id ?>"><?php echo $school->name ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Add" /></td>
        </tr>
    </table>
    <?php echo $this->form->end() ?>
</div>
<div style="width:500px">
    <h2>Current Accounts</h2>
    <table>
        <tr>
            <td><b>Username</b></td>
        </tr>
        <?php if(!$users): ?>
        <tr>
            <td>No users! Use the form to the right to add new users.</td>
        </tr>
        <?php else: ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->username ?></td>
                <td><?php if($school = $user->getSchoolObj()) { echo $school->name; }?></td>
                <td>[<?php echo $this->html->link('edit', $accountName . '/admin/accounts/edit/' . $user->id) ?>]&nbsp;[<?php echo $this->html->link('x', 'admin/accounts/delete/' . $user->id) ?>]</td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>
<div style="clear:both"></div>
<script type="text/javascript">
    function checkSelectedPermission(element) {
        if(element.value != 'ADMIN') {
            document.getElementById("school_limit").style.display = 'table-row';
        } else {
            document.getElementById("school_limit").style.display = 'none';
        }
    }
</script>