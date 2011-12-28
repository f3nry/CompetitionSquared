<h1><a name="results">Results</a></h1>
<br/>
<p><?php echo $this->html->link('Back to all results', 'teams/type/' . $scores[0]->team->type); ?></p>
<br/>
<table cellpadding="0" cellspacing="0" border="0" width="700">
    <tr>
        <td width="40"><b>Place</b></td>
        <td width="80"><b>Team Name</b></td>
        <td width="50"><b>Round</b></td>
        <td style="text-align: right;" width="100"><b>Total score</b></td>
    </tr>
    <?php $i = 1;?>
    <?php foreach($scores as $score): ?>
    <tr <?php if(($i - 1) % 2 == 0) { echo 'bgcolor="#DCDCDC"'; }?>>
        <td><?php echo $i++ ?></td>
        <td><?php echo $this->html->link($score->team->name, 'teams/' . $score->team->id . '/score/' . $score->id) ?></td>
        <td><?php echo $score->round ?></td>
        <td style="text-align:right;"><?php echo $score->total ?></td>
    </tr>
    <?php endforeach; ?>
</table>