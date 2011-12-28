<h1>Administration</h1>
<p>Welcome, <?php echo $user ?>! <br/>Here you will find several links to add teams, enter new scores, and delete scores</p>
<br/>
<table cellpadding=0 cellspacing=0 border=0 width=700>
    <tr>
        <td><?php echo $this->html->link('Manage Configuration', 'admin/config') ?></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Manage Students', 'admin/teams') ?></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Manage Scores', 'admin/scores') ?></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Manage Score Cards', 'admin/scorecards') ?></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Manage Events', 'admin/teams/types') ?></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Import Joy of Tournaments Data', 'admin/import/jot') ?></td>
    </tr>
    <tr>
        <td><?php echo $this->html->link('Process Scores', 'admin/scores/process') ?></td>
    </tr>
</table>
<br/>
<p><?php echo $this->html->link('Logout', 'admin/logout') ?>&nbsp;|&nbsp;<?php echo $this->html->link('Change Password', 'admin/changepassword') ?></p>
