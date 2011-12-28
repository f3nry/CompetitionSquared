<h2>Mass Account Wizard</h2>
<?php echo $this->html->link('Back to administration', $accountName . '/admin') ?>
<p>Select a school below, then press the 'Run' button. You will get a CSV file with the usernames, passwords, and students, for the school you ran the wizard against.</p>
<?php echo $this->form->create() ?>
<select name="school">
    <option value="">All Schools</option>
    <?php foreach($schools as $school): ?>
    <option value="<?php echo $school["school"] ?>"><?php echo $school["school"] ?></option>
    <?php endforeach; ?>
</select>
<input type="hidden" name="step" value="1" />
<input type="submit" value="Run" />
<?php echo $this->form->end() ?>