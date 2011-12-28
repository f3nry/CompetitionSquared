<?php echo $this->html->link('Back to Score Management', 'admin/scores') ?>
<?php echo $this->form->create() ?>
<h1>Scorecard</h1>
<h2>General</h2>
<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="text-align: right;">Round:&nbsp;</td>
        <td><input type="text" name="score_round" size="2" maxlength="3" /></td>
    </tr>
    <tr>
        <td style="text-align: right;">Team name:&nbsp;</td>
        <td>
            <select name="score_team_id">
                <?php foreach ($teams as $team): ?>
                    <option value="<?php echo $team->id ?>">
                        <?php echo $team->name ?>
                        &nbsp;(<?php echo $team->getType() ?>)
                    </option>
                <?php endforeach; ?>
                </select>
                [<?php echo $this->html->link('Team Setup', 'admin/teams') ?>]
                </td>
            </tr>
            <tr>
                <td style="text-align: right;">Round Runoff:&nbsp;</td><td><input type="checkbox" name="score_isrunoff"></td>
            </tr>
        </table>
        <h2>Score</h2>
        <table cellpadding="5" cellspacing="0" border="0" width="700">
            <tr>
                <td style="text-align: left" width="260"><b>Action</b></td>
                <td style="text-align: left;" width="280"><b>Points</b></td>
                <td style="text-align: right;" width="120"><b>Earned</b></td>
            </tr>
            <tr bgcolor="#DCDCDC">
                <td>Booster Canisters - white and orange ping pong balls</td>
                <td style="text-align: left;">Storage Containers&nbsp;&nbsp: 20pts each<br/>
        													Display Unit Stage 1&nbsp;: 30pts each<br/>
        													Display Unit Stage 2&nbsp;: 40pts each<br/>
        													Display Unit Stage 3&nbsp;: 50pts each<br/>
        													Center Display Stage: 75pts each<br/>
                </td>
                <td style="text-align: right;" align="right">
                    <input type="text" name="field_1" size="3" maxlength="3" onchange="calcScore();"/>
                </td>
            </tr>
            <tr>
                <td>Colored Powder Balls - large pompoms</td>
                <td style="text-align: left;">Storage Containers&nbsp;&nbsp: 5pts each<br/>
        													Display Unit Stage 1&nbsp;: 30pts each<br/>
        													Display Unit Stage 2&nbsp;: 40pts each<br/>
        													Display Unit Stage 3&nbsp;: 50pts each<br/>
        													Center Display Stage: 75pts each<br/>
                </td>
                <td style="text-align: right;">
                    <input type="text" name="field_2" size="3" maxlength="3" onchange="calcScore();"/>
                </td>
            </tr>
            <tr bgcolor="#DCDCDC">
                <td>Master Blaster Shells - wiffle balls</td>
                <td style="text-align: left;">Storage Containers&nbsp;&nbsp: 10pts each<br/>
        													Center Display Stage: 100pts each<br/>
                </td>
                <td style="text-align: right;">
                    <input type="text" name="field_3" size="3" maxlength="3" onchange="calcScore();"/>
                </td>
            </tr>
            <tr>
                <td>Colorant mixed together - small pompoms<br/>At least one pompom from each container must be out of the cup and in the mixing vat.</td>
                <td style="text-align: left;">100pts and team name in drawing
                </td>
                <td style="text-align: right;">
                    <input type="text" name="field_4" size="3" maxlength="3" onchange="calcScore();"/>
                </td>
            </tr>

            <tr>
                <td colspan="2"></td>
                <td style="text-align: right;"><input type="text" name="totalScore" size="3" maxlength="3" disabled="disabled" style="text-align: right;" /></td>
            </tr>
        </table>
        <p style="text-align: center;"><input type="submit" value="Submit" style="text-align: center;" /> <input type="reset" value="Reset" style="text-align: center;" /></p>
<?php echo $this->form->end() ?>