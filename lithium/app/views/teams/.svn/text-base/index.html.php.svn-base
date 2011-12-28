<?php use app\models\AppConfig; use app\models\TeamTypes; ?>
<h1><a name="results" href="#results"><?php echo $team_type; ?> - Results</a></h1>
<?php if(!@$content_only): ?>
<p><?php echo $this->html->link('Go back', $accountName . '/') ?></p>
<?php endif; ?>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
    <tr>
        <td width="60"><b>Place</b></td>
        <td width="340"><b>Student Name</b></td>
        <td><b>School</b></td>
        <td style="text-align: right;" width="100"><b>Total score</b></td>
    </tr>
    <?php 
        $i = 0;
        $currentTeam = null;
    ?>
    <?php foreach($teams as $team): ?>
    <?php if(AppConfig::get('show_unset_scores') == 1 || $team->hasScore()): ?>
        <tr <?php if($i++ % 2 == 0) { echo 'bgcolor="#DCDCDC"'; }?>>
            <td><?php
            if(@$hidePlaces) {
                echo "[Hidden]";
            } else {
                if($currentTeam != null && $team->total == $currentTeam->total) {
                    echo "[" . $team->place . "]";
                } else {
                    echo $team->place;
                    $currentTeam = $team;
                }
            } ?></td>
            <td><?php echo $this->html->link($team->getName(), $accountName . '/teams/view/' . $team->id) ?></td>
            <td><?php echo $team->school->name ?></td>
            <td style="text-align: right;"><?php if(@$hidePlaces) { echo "[Hidden]"; } else { echo $team->displayed_total; }?></td>
        </tr>
    <?php endif; ?>
    <?php endforeach; ?>
</table>
<?php
if($prevPage != false) {
    echo $this->html->link("Previous Page", $accountName . "/teams/type/" . $team_type . "/page/" . $prevPage) . "&nbsp;";
}
?>
<?php
if($nextPage != false) {
    echo $this->html->link("Next Page", $accountName . "/teams/type/" . $team_type . "/page/" . $nextPage);
}
?>
<br/><br/>
Pages:
<?php foreach($pages as $loopPage): ?>
<?php if($page == $loopPage): ?>
<?php echo $loopPage ?>
<?php else: ?>
<?php echo $this->html->link($loopPage, $accountName . "/teams/type/" . $team_type . "/page/" . $loopPage) ?>
<?php endif; ?>
&nbsp;
<?php endforeach; ?>