<?php

 use app\models\AppConfig ?>
<?php echo $this->html->link('Back to Administration', $accountName . '/admin') ?>
<h1 style="margin-top:8px">Configuration</h1>
<p>Edit your application's configuration below.</p>
<?php echo $this->form->create(null, array('url' => $accountName . '/admin/config/set/competition_status')) ?>
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
<?php echo $this->form->create(null, array('url' => $accountName . '/admin/config/set/default_layout', 'style' => 'margin-top:0px;')) ?>
                        <table>
                            <tr><td><b>Layout:</b></td></tr>
                            <tr><td>
                                    <select name="default_layout">
                                        <option value="default" <?php
                        if (AppConfig::get("default_layout") == "default") {
                            echo "selected=\"selected\"";
                        } ?>>Default Layout</option>
                <option value="lisd" <?php
                        if (AppConfig::get("default_layout") == "lisd") {
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
<?php echo $this->form->create(null, array('url' => $accountName . '/admin/config/set/competition_name', 'style' => 'margin-top:0px;')) ?>
    <table>
        <tr><td><b>Competition Name:</b></td></tr>
        <tr><td>
                <input type="text" name="competition_name" value="<?php echo AppConfig::get("competition_name") ?>" />
                <input type="submit" value="Update" style="display:inline"/>
            </td>
        </tr>
    </table>
<?php echo $this->form->end() ?>
<?php echo $this->form->create(null, array('url' => $accountName . '/admin/config/set/frontpage_text', 'style' => 'margin-top:0px;')) ?>
    <table>
        <tr><td><b>Frontpage Text:</b></td></tr>
        <tr><td>
                <textarea name="frontpage_text" rows="5" cols="80"><?php echo AppConfig::get('frontpage_text') ?></textarea>
                <input type="submit" value="Update" />
            </td>
        </tr>
    </table>
<?php echo $this->form->end() ?>
<?php echo $this->form->create(null, array('url' => $accountName . '/admin/config/set/score_type', 'style' => 'margin-top:0px;')) ?>
    <table>
        <tr><td><b>Scoring Type:</b></td></tr>
        <tr><td>
                <select name="score_type">
                    <option value="sum" <?php echo (AppConfig::get('score_type') == 'sum') ? "selected=\"selected\"" : ''?>>Sum All Rounds</option>
                    <option value="sum-top-two" <?php echo (AppConfig::get('score_type') == 'sum-top-two') ? "selected=\"selected\"" : ''?>>Sum Top Two Rounds</option>
                    <option value="average" <?php echo (AppConfig::get('score_type') == 'average') ? "selected=\"selected\"" : ''?>>Average All Rounds</option>
                    <option value="noscoring" <?php echo (AppConfig::get('score_type') == 'noscoring') ? "selected=\"selected\"" : ''?>">No Scoring</option>
                </select>
                <input type="submit" value="Update" style="display:inline"/>
            </td>
        </tr>
    </table>  
<?php echo $this->form->end() ?>
<?php echo $this->form->create(null, array('url' => $accountName . '/admin/config/set/show_unset_scores', 'style' => 'margin-top:0px;')) ?>
<table>
    <tr><td><b>Show Unset Scores?</b></td></tr>
    <tr>
        <td>
            <select name="show_unset_scores">
                <option value="1" <?php echo (AppConfig::get('show_unset_scores') == "1") ? "selected=\"selected\"" : "" ?>>Yes</option>
                <option value="0" <?php echo (AppConfig::get('show_unset_scores') == "0") ? "selected=\"selected\"" : "" ?>>No</option>
            </select>
            <input type="submit" value="Update" style="display:inline" />
        </td>
    </tr>
</table>
<?php echo $this->form->end() ?>

<?php echo $this->form->create(null, array('url' => $accountName . '/admin/config/set/slideshow_update_interval', 'style' => 'margin-top:0px;')) ?>
    <table>
        <tr><td><b>Slideshow Update Interval, in seconds:</b></td></tr>
        <tr><td>
                <input type="text" name="slideshow_update_interval" value="<?php echo AppConfig::get("slideshow_update_interval") ?>" />
                <input type="submit" value="Update" style="display:inline"/>
            </td>
        </tr>
    </table>
<?php echo $this->form->end() ?>