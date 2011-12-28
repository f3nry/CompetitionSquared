<div class="left">
    <h1>Manage Accounts</h1>
    <?php echo $this->html->link('Back to administration', 'admin') ?>
    <p>Here you may add or edit client accounts.</p>
</div>
<div class="clear"></div>
<div class="right" style="margin-right:20px">
    <h2>Add Account</h2>
    <?php echo $this->form->create(null, array('url' => 'admin/accounts/add')) ?>
    <table>
        <tr>
            <td>Account Name:</td>
            <td><input type="text" name="accountname" /></td>
        </tr>
        <tr>
            <td>Primary Username:</td>
            <td><input type="text" name="username" /></td>
        </tr>
        <tr>
            <td>Primary Password:</td>
            <td><input type="password" name="password" /></td>
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
            <td><b>Account Name</b></td>
        </tr>
        <?php if(!$accounts): ?>
        <tr>
            <td>No accounts! Use the form to the right to add new accounts.</td>
        </tr>
        <?php else: ?>
        <?php foreach ($accounts as $account): ?>
            <tr>
                <td><?php echo $account->accountname ?></td>
                <td>
                    [<?php echo $this->html->link('go', $account->accountname . '/') ?>]
                    [<?php echo $this->html->link('edit', 'admin/accounts/edit/' . $account->id) ?>] 
                    [<?php echo $this->html->link('x', 'admin/accounts/delete/' . $account->id, array("onclick" => "if(confirm('Are you sure you want to delete that account?')) { return true; } else { return false; }"))?>]</td>
            </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>
<div class="clear"></div>