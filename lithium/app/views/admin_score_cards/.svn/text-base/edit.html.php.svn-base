<p><?php echo $this->html->link('Back to Administration', $accountName . '/admin') ?></p>
<h2 style="margin-bottom:12px">Add Score Card</h2>
<div class="actions">
    <?php echo $this->form->create(null, array('id' => 'scorecard-form')) ?>
    <label>Score Card Name:</label>
    <input type="text" name="name" size="40" id="name" value="<?php echo @$scorecard->name ?>"/>
    <h2>General</h2>
    <table cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td style="text-align: right;">Round:&nbsp;</td>
            <td><input type="text" name="score_round" size="2" maxlength="3" disabled="disabled"/></td>
        </tr>
        <tr>
            <td style="text-align: right;">Team name:&nbsp;</td>
            <td>
                <select name="score_team_id" disabled="disabled">
                    <option>(Team Name)</option>
                </select>
                [<a href="/admin/teams">Team Setup</a>]
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">Round Runoff:&nbsp;</td><td><input type="checkbox" name="score_isrunoff" disabled="disabled"></td>
        </tr>
    </table>
    <h2>Score</h2>
    <label style="padding-top:8px">Actions (An action is an individual field for a score card):</label>
    <table cellpadding="5" cellspacing="0" border="0" style="width:100%" id="action-table">
        <thead>
            <th style="text-align: left" width="260"><b>Action</b></th>
            <th style="text-align: left;" width="280"><b>Points</b></th>
            <th style="text-align: left;">Type</th>
            <th style="text-align: right;" width="120"><b>Earned</b></th>
        </thead>
        <?php $i = 0; ?>
        <?php if(isset($scorecard)): ?>
            <?php foreach($scorecard->score_card_actions as $action): ?>
            <tr id="field_<?php echo $i ?>" class="row">
                <td id="field_<?php echo $i ?>_action"><?php echo $action->action ?></td>
                <td id="field_<?php echo $i ?>_points"><?php echo $action->points ?></td>
                <td id="field_<?php echo $i ?>_type">
                    <select name="field_<?php echo $i ?>_type">
                        <option value="TEXT" <?php if($action->type == "TEXT") { echo "selected=\"selected\""; } ?>>Displayed Score</option>
                        <option value="HIDDEN" <?php if($action->type == "HIDDEN") { echo "selected=\"selected\""; } ?>>Non-Displayed Score</option>
                    </select>
                </td>
                <td id="field_<?php echo $i ?>_input" style="text-align:right"><input type="text" name="field_<?php echo $i++ ?>" size="3" maxlength="6" disabled="disabled"/></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <div id="hovermenu" style="display: none; position: absolute;">
        <a id="hovermenu_save" style="display:none;"><?php echo $this->html->image('application_form_add.png') ?></a>
        <a id="hovermenu_edit"><?php echo $this->html->image('application_form_edit.png') ?></a>
        <a id="hovermenu_delete"><?php echo $this->html->image('application_form_delete.png') ?></a>
    </div>
    <input type="submit" value="Update Scorecard" />
    <?php echo $this->form->end() ?>
</div>
<div class="newAction">
    <h2 style="margin-bottom:12px">Add New Action</h2>
    <div style="width:40%;float:left">
        <label>A quick description of the action:</label>
        <textarea name="action" id="action" rows="10" cols="40"></textarea>
    </div>
    <div>
        <label>A quick description of the points for this action:</label>
        <textarea name="points" id="points" rows="10" cols="40"></textarea>
    </div>
    <div>
        <label style="display:inline">Type:</label>
        <select id="type">
            <option value="TEXT">Displayed Score</option>
            <option value="HIDDEN">Non-Displayed Score</option>
        </select>
    </div>
    <button id="add-action" style="margin-top:8px">Add</button>
</div>
<?php echo $this->html->script('scorecard_editor') ?>