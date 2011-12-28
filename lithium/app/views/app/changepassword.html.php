<h1>Change password</h1>
<?php if(@$error): ?>
<p style="color:red"><?php echo $error ?></p>
<?php endif; ?>
<?php echo $this->form->create() ?>
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td style="text-align: left;">Old password:&nbsp;</td>
            <td><input name="oldpass" type="password" size="30"/></td>
        </tr>
        <tr>
            <td style="text-align: left;">New password:&nbsp;</td>
            <td><input name="newpass" type="password" size="30"/></td>
        </tr>
        <tr>
            <td style="test-align: left;">Retype new password:&nbsp;</td>
            <td><input name="newpass2" type="password" size="30"/></td>
        </tr>
        <tr>
            <td><input type="submit" value="Change" /></td>
        </tr>
    </table>
<?php echo $this->form->end() ?>
