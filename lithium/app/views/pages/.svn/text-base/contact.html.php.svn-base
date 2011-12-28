<h3>Drop us a message!</h3>
<p>Have a question? Send us a message! We can get you hooked up with a test account, or even let you run on a competition on us!</p>
<?php if(isset($error) && @$error): ?>
<p style="color: #ff0000"><?php echo $message ?></p>
<?php elseif(isset($error)): ?>
<p style="color: #37DA23"><?php echo $message ?></p>
<?php endif; ?>
<?php echo $this->form->create() ?>
<table>
    <tr>
        <td><label>Your Name:</label></td>
        <td><input type="text" name="name"/></td>
    </tr>
    <tr>
        <td><label>Your Email Address:</label></td>
        <td><input type="text" name="email"/></td>
    </tr>
    <tr>
        <td><label>Subject:</label></td>
        <td><input type="text" name="subject" /></td>
    </tr>
    <tr>
        <td colspan="2"><label>Message:</label></td>
    </tr>
    <tr>
        <td colspan="2"><textarea name="message" rows="8" style="width:100%"></textarea></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="Submit" /></td>
    </tr>
</table>
<?php echo $this->form->end() ?>
<style type="text/css">
    input[type=text], textarea {
        width:350px;
        margin-bottom:8px;
    }
</style>