<h1><a name="results" id="results" href="index.php#results">Results</a></h1>
<p><?php echo $this->html->link('Go back', '/') ?></p><br/>
<p>The following results are placed acording to the 2 top round scores combined for each team. If the place has brackets, then that team is tied with the team above it.</p>
<br/>
<table cellpadding="0" cellspacing="0" border="0" width="700">
    <tr>
        <td width="60"><b>Place</b></td>
        <td width="340"><b>Team Name</b></td>
        <td style="text-align: right;" width="100"><b>Total score</b></td>
    </tr>
    <?php foreach($teams as $team): ?>
    <tr>
        <td><?php echo $team->place ?></td>
        <td><?php echo $this->html->link($team->name, 'teams/view/' . $team->id) ?></td>
        <td style="text-align: right;"><?php echo $team->total ?></td>
    </tr>
    <?php endforeach; ?>
</table>