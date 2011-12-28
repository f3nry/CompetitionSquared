<?php echo $this->form->create(null, array('enctype' => 'multipart/form-data')) ?>
    <p>
        Please select a file to be imported:<br/> <input type="file" name="jotfile" /><br/>
        Please select an event to import the data into:
        <select name="event">
            <option value="-1">..in File</option>
            <?php foreach($types as $type): ?>
            <option value="<?php echo $type->id ?>"><?php echo $type->nice_name ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Run Import" />
    </p>
<?php echo $this->form->end() ?>
