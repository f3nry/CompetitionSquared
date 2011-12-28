<?php echo $this->form->create(null, array('enctype' => 'multipart/form-data')) ?>
    <p>
        Please select a file to be imported:<br/> <input type="file" name="jotfile" />
        <input type="submit" value="Run Import" />
    </p>
<?php echo $this->form->end() ?>
