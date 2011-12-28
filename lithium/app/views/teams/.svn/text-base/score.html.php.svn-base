<?php echo $this->html->link('Back to ' . $score->team->name . '\'s results.', $accountName . '/teams/view/' . $score->team->id) ?>
<?php echo $this->form->create() ?>
<h1>Scorecard</h1>
<h2>General</h2>
<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="text-align: right;">Round:&nbsp;</td>
        <td><input type="text" name="score_round" size="2" maxlength="3" disabled="disabled" value="<?php echo $score->round ?>"/></td>
    </tr>
    <tr>
        <td style="text-align: right;">Team name:&nbsp;</td>
        <td>
            <select name="score_team_id" disabled="disabled">
                    <option value="<?php echo $score->team->id ?>">
                        <?php echo $score->team->getName() ?>
                        &nbsp;(<?php echo $score->team->getType() ?>)
                    </option>
                </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Round Runoff:&nbsp;</td><td><input type="checkbox" name="score_isrunoff" disabled="disabled" <?php if($score->isrunoff) { echo 'checked="checked"'; } ?>></td>
            </tr>
        </table>
        <h2>Score</h2>
        <table cellpadding="5" cellspacing="0" border="0" style="width:100%">
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
                <td style="text-align:right"><input type="text" name="field_<?php echo $i ?>" size="3" maxlength="3" value="<?php echo $score->getField("field_" .$i) ?>" disabled="disabled"/></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>

            <tr>
                <td colspan="2"></td>
                <td style="text-align: right;"><input type="text" name="totalScore" size="3" maxlength="3" disabled="disabled" style="text-align: right;" value="<?php echo $score->total ?>" /></td>
            </tr>
        </table>
<?php echo $this->form->end() ?>