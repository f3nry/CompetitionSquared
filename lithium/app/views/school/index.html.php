<?php use app\models\AppConfig; ?>
<h1><a name="results" id="results" href="#results"></a></h1>
<?php if(!@$content_only): ?>
<p><?php echo ($showBack) ? $this->html->link('Go back', $accountName . '/') : false ?></p>
<?php endif; ?>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
    <tr>
        <td width="10"><b>Place</b></td>
        <td width="340"><b>School</b></td>
        <td align="right"><b>Score</b></td>
    </tr>
    <?php
        $i = 0;
        $currentSchool = null;
    ?>
    <?php foreach($schools as $school): ?>
        <tr <?php if($i++ % 2 == 0) { echo 'bgcolor="#DCDCDC"'; }?>>
            <td><?php
            if(@$hidePlaces) {
                echo "[Hidden]";
            } else {
                if($currentSchool != null && $school->score == $currentSchool->score) {
                    echo "[" . $school->place . "]";
                } else {
                    echo $school->place;
                    $currentSchool = $school;
                }
            } ?></td>
            <td><?php echo $this->html->link($school->name, '#') ?></td>
            <td align="right"><?php echo (@$hidePlaces) ? "[Hidden]" : $school->score ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br/><br/>