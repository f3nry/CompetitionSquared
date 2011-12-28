<h1>Administration</h1>
<p>Welcome, <?php echo $user ?>!</p>
<br/>
<?php if($permissions == "ADMIN" || $permissions == "SUPERADMIN"): ?>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
    <tr>
        <td><?php echo $this->html->link('View Scores', $accountName . '/') ?><p class="adminLinkInfo">View all scores in your competition</p></td>
        <td><?php echo $this->html->link('Manage Scores', $accountName . '/admin/scores') ?><p class="adminLinkInfo">Manage Scores for students</p></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Enter Slideshow', $accountName . '/slideshow') ?><p class="adminLinkInfo">Enter Live Slideshow of all Events</p></td>
        <td><?php echo $this->html->link('Manage Score Cards', $accountName . '/admin/scorecards') ?><p class="adminLinkInfo">Manage your Competition's Score Cards</p></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Manage Configuration', $accountName . '/admin/config') ?><p class="adminLinkInfo">Manage application-wide configuration</p></td>
        <td><?php echo $this->html->link('Manage Students', $accountName . '/admin/teams') ?><p class="adminLinkInfo">Manage Students in your competition</p></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Manage Accounts', $accountName . '/admin/accounts') ?><p class="adminLinkInfo">Manage Administrators, Account Creators, and Parents</p></td>
        <td><?php echo $this->html->link('Manage Schools', $accountName . '/admin/schools') ?><p class="adminLinkInfo">Manage Schools in your competition</p></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Process Scores', $accountName . '/admin/scores/process') ?><p class="adminLinkInfo">Re-process all Scores in the competition</p></td>
        <td><?php echo $this->html->link('Manage Events', $accountName . '/admin/teams/types') ?><p class="adminLinkInfo">Manage your Competition's Contests/Categories/Events</p></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('School Summary', $accountName . '/schools') ?><p class="adminLinkInfo">Standings of Schools in your Competition</p></td>
        <td><?php echo $this->html->link('Score Calculation Log', $accountName . '/admin/scores/log') ?><p class="adminLinkInfo">View a logs of how scores where calculated</p></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Mass Account Wizard', $accountName . '/admin/wizards/accounts') ?><p class="adminLinkInfo">Mass Auto-Create Accounts based on Schools</p></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Import Joy of Tournaments Data', $accountName . '/admin/import/jot') ?><p class="adminLinkInfo">Import Contest and Student Data from Joy of Tournaments</p></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Process Scores', $accountName . '/admin/scores/process') ?><p class="adminLinkInfo">Re-process all Scores in the competition</p></td>
    </tr>
</table>
<?php elseif($permissions == "ACCT_CREATOR"): ?>
<table cellpadding=0 cellspacing=0 border=0 width=700>
    <tr>
        <td><?php echo $this->html->link('View Scores', $accountName . '/') ?><p class="adminLinkInfo">View all scores in this competition</p></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Enter Slideshow', $accountName . '/slideshow') ?><p class="adminLinkInfo">Enter Live Slideshow of all Events</p></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Manage Accounts', $accountName . '/admin/accounts') ?><p class="adminLinkInfo">Manage Account Creators and Parents</p></td>
    </tr>
</table>
<?php endif; ?>
<br/>
<p><?php echo $this->html->link('Logout', $accountName . '/admin/logout') ?>&nbsp;|&nbsp;<?php echo $this->html->link('Change Password', $accountName . '/admin/changepassword') ?></p>
