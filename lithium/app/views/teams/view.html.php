<h1><a name="results">Results</a></h1>
<br/>
<p><?php echo $this->html->link('Back to all results', $accountName . '/teams/type/' . $team->type); ?></p>
<br/>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
    <tr>
        <td width="40"><b>Place</b></td>
        <td width="80"><b>Student Name</b></td>
        <td width="50"><b>Round</b></td>
        <td style="text-align: right;" width="100"><b>Total score</b></td>
    </tr>
    <?php $i = 1;?>
    <?php foreach($scores as $score): ?>
    <tr <?php if(($i - 1) % 2 == 0) { echo 'bgcolor="#DCDCDC"'; }?>>
        <td><?php echo $i++ ?></td>
        <td><?php echo $this->html->link($score->team->getName(), $accountName . '/teams/' . $score->team->id . '/score/' . $score->id) ?></td>
        <td><?php echo $score->round ?></td>
        <td style="text-align:right;"><?php echo $score->displayed_total ?></td>
    </tr>
    <?php endforeach; ?>
</table>