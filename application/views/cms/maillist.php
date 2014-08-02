<div id="maillist"> 

	<?
	echo form_open('cms/maillist');
	if($_POST['mailbody'])
		$this->cms_m->send_mails();
	?>
	<h1>მეილის ტექსტი</h1>
	<br/>
	<?=form_textarea('mailbody', ' ',"class='ckeditor'")?>
	<input type="submit" value="გაგზავნა"/>
	<?
	echo form_close();
	$q = $this->db->get('maillist')->result_array();
	echo $this->table->generate($q);
	?>
</div>