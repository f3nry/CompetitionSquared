<?php

 use app\models\AppConfig ?>
<?php echo $this->html->link('Back to Administration', 'admin') ?>
<h1 style="margin-top:8px">Configuration</h1>
<p>Edit your application's configuration below.</p>
<?php echo $this->form->create(null, array('url' => 'admin/config/set/competition_status')) ?>
<table>
    <tr><td><b>Status:<b/></td></tr>
    <tr><td>
            <select name="competition_status">
                <option value="ALLOW_ALL_VIEW" <?php
if (app\models\AppConfig::get("competition_status") == "ALLOW_ALL_VIEW") {
    echo "selected=\"selected\"";
}
?>>Allow all users to view scores.</option>
                <option value="ONLY_ADMIN_VIEW" <?php
                        if (app\models\AppConfig::get("competition_status") == "ONLY_ADMIN_VIEW") {
                            echo "selected=\"selected\"";
                        }
?> >Allow only administrators to view scores.</option>
            </select>
            <input type="submit" value="Update" style="display:inline"/>
        </td></tr>
</table>
<?php echo $this->form->end() ?>
<?php echo $this->form->create(null, array('url' => 'admin/config/set/default_layout', 'style' => 'margin-top:0px;')) ?>
                        <table>
                            <tr><td><b>Layout:</b></td></tr>
                            <tr><td>
                                    <select name="default_layout">
                                        <option value="default" <?php
                        if (AppConfig::get("default_layout") == "default") {
                            echo "selected=\"selected\"";
                        } ?>>Default Layout</option>
                <option value="lisd" <?php
                        if (AppConfig::get("default_layout") == "default") {
                            echo "selected=\"selected\"";
                        }
?>>LISD Layout</option>
                <option value="robotics" <?php
                        if (AppConfig::get("default_layout") == "robotics") {
                            echo "selected=\"selected\"";
                        }
?>>Robotics Layout</option>
            </select>
            <input type="submit" value="Update" style="display:inline" />
        </td>
    </tr>
</table>
<?php echo $this->form->end() ?>
<?php echo $this->form->create(null, array('url' => 'admin/config/set/competition_name', 'style' => 'margin-top:0px;')) ?>
                        <table>
                            <tr><td><b>Competition Name:</b></td></tr>
                            <tr><td>
                                    <input type="text" name="competition_name" value="<?php echo AppConfig::get("competition_name") ?>" />
                                    <input type="submit" value="Update" style="display:inline"/>
                                </td>
                            </tr>
                        </table>
<?php echo $this->form->end() ?>
<?php echo $this->form->create(null, array('url' => 'admin/config/set/frontpage_text', 'style' => 'margin-top:0px;')) ?>
                        <table>
                            <tr><td><b>Frontpage Text:</b></td></tr>
                            <tr><td>
                                    <textarea name="frontpage_text" rows="5" cols="80"><?php echo AppConfig::get('frontpage_text') ?></textarea>
                                    <input type="submit" value="Update" />
                                </td>
                            </tr>
                        </table>
<?php echo $this->form->end() ?>
<?php echo $this->form->create(null, array('url' => 'admin/config/set/score_type', 'style' => 'margin-top:0px;')) ?>
                        <table>
                            <tr><td><b>Scoring Type:</b></td></tr>
                            <tr><td>
                                    <select name="score_type">
                                        <option value="sum">Sum All Rounds</option>
                                        <option value="sum-top-two">Sum Top Two Rounds</option>
                                        <option value="average">Average All Rounds</option>
                                    </select>
                                    <input type="submit" value="Update" style="display:inline"/>
                                </td>
                            </tr>
                        </table>                        
<?php echo $this->form->end() ?>