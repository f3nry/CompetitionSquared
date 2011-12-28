<?php use app\models\AppConfig ?>
<?php echo $this->html->link('Back to Score Management', $accountName . '/admin/scores') ?>
<?php echo $this->form->create() ?>
<h1>Scorecard</h1>
<h2>General</h2>
<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="text-align: right;">Round:&nbsp;</td>
        <td><input type="text" name="score_round" size="2" maxlength="3" value="<?php echo $score->round ?>"/></td>
    </tr>
    <tr>
        <td style="text-align:right;">Filter by Event:</td>
        <td>
            <select onchange="updateFilters(this)">
                <option value="">All</option>
                <?php foreach($team_types as $type): ?>
                <option value="<?php echo $type->id ?>"><?php echo $type->nice_name ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td style="text-align: right;">Team name:&nbsp;</td>
        <td>
            <select name="score_team_id" id="teams">
                <?php foreach ($teams as $team): ?>
                    <option value="<?php echo $team->id ?>" <?php if($score->team_id == $team->id) { echo "selected=\"selected\""; }?>>
                        <?php echo $team->getName() ?>
                        &nbsp;(<?php echo $team->getType() ?>)
                    </option>
                <?php endforeach; ?>
                </select>
                [<?php echo $this->html->link('Team Setup', 'admin/teams') ?>]
                </td>
            </tr>
            <?php if(AppConfig::get('score_type') == 'noscoring'): ?>
            <tr>
                <td style="text-align: right;">Place:&nbsp;</td><td><input type="text" name="place" size="3" value="<?php foreach($teams as $team) { if($score->team_id == $team->id) echo $team->place; } ?>"></td>
            </tr>
            <?php else: ?>
            <tr>
                <td style="text-align: right;">Round Runoff:&nbsp;</td><td><input type="checkbox" name="score_isrunoff" <?php if($score->isrunoff) { echo "checked=\"checked\""; } ?>></td>
            </tr>
            <?php endif; ?>
        </table>
        <h2>Score</h2>
        <table cellpadding="5" cellspacing="0" border="0" width="700">
            <tr>
                <td style="text-align: left" width="260"><b>Action</b></td>
                <td style="text-align: left;" width="280"><b>Points</b></td>
                <td style="text-align: right;" width="120"><b>Earned</b></td>
            </tr>
            <?php
            $i = 0;
            foreach($scorecard->score_card_actions as $action):?>
            <tr <?php if($i % 2 == 0) { echo "bgcolor=\"#DCDCDC\""; } ?>>
                <td><?php echo $action->action ?></td>
                <td><?php echo $action->points ?></td>
                <td style="text-align:right"><input type="text" name="field_<?php echo $i ?>" size="3" maxlength="6" value="<?php echo $score->getField("field_" .$i) ?>"/></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="2"></td>
                <td style="text-align: right;"><input type="text" name="totalScore" size="3" maxlength="3" disabled="disabled" style="text-align: right;" value="<?php echo $score->total ?>"/></td>
            </tr>
        </table>
        <p style="text-align: center;"><input type="submit" value="Submit" style="text-align: center;" /> <input type="reset" value="Reset" style="text-align: center;" /></p>
<?php echo $this->form->end() ?>
<script type="text/javascript">
    function updateFilters(select) {
        var url = "";

        if(select.value == "") {
            url = "/<?php echo $accountName ?>/admin/teams/get";
        } else {
            url = "/<?php echo $accountName?>/admin/teams/get/" + select.value;
        }

        $.post(url, '', function(html) {
           $("#teams").html(html);
        });
    }
</script>