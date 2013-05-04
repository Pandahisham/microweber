<?php only_admin_access(); ?>
<script  type="text/javascript">
$(document).ready(function(){

  mw.options.form('.<?php print $config['module_class'] ?>', function(){
      mw.notification.success("<?php _e("Email settings are saved"); ?>.");
    });
});




mw.email_send_test = function(){

	var email_to = {}
	email_to.to = $('#test_email_to').val();;
	email_to.subject = $('#test_email_subject').val();;
	
	
	
	 $.post("<?php print site_url('api_html/email_send_test'); ?>", email_to, function(msg){
//Alert("<pre>"+msg+"</pre>")

		mw.tools.modal.init({
			html:"<pre>"+msg+"</pre>",	
			title:"Email send results..."
		});
			// $('#email_send_test_btn_output').html(msg);
	  });
}
</script>

<div class="<?php print $config['module_class'] ?>">
  <div class="mw-ui-field-holder">
    <label class="mw-ui-label">Your email address<br>
      <small>Your email address (ex. my@email.com )</small> </label>
    <input name="email_from" class="mw_option_field mw-ui-field"    type="text" option-group="email"   value="<?php print get_option('email_from','email'); ?>" />
  </div>
  <div class="mw-ui-field-holder">
    <label class="mw-ui-label">From name<br>
      <small>example: Site Admin</small> </label>
    <input name="email_from_name" class="mw_option_field mw-ui-field"    type="text" option-group="email"   value="<?php print get_option('email_from_name','email'); ?>" />
  </div>
  <label class="mw-ui-label">Send email function <small><a class="mw-ui-btn mw-ui-btn-small" href="javascript:$('#test_eml_toggle').toggle(); void(0);">[test]</a></small></label> 
  <?php   $email_transport = get_option('email_transport','email');

 if($email_transport == false){
	$email_transport = 'php';
 }
  ?>
  <div class="mw-ui-select">
    <select name="email_transport" class="mw_option_field"   type="text" option-group="email" data-refresh="settings/group/email">
      <option value="php" <?php if($email_transport == 'php'): ?> selected="selected" <?php endif; ?>>PHP mail function</option>
      <option value="gmail" <?php if($email_transport == 'gmail'): ?> selected="selected" <?php endif; ?>>GMail</option>
      <option value="yahoo" <?php if($email_transport == 'yahoo'): ?> selected="selected" <?php endif; ?>>Yahoo</option>
      <option value="hotmail" <?php if($email_transport == 'hotmail'): ?> selected="selected" <?php endif; ?>>HotMail</option>
      <option value="smtp" <?php if($email_transport == 'smtp'): ?> selected="selected" <?php endif; ?>>SMTP server</option>
    </select>
 
  </div>
  
  
  
  <div class="vSpace"></div>
  <table width=" 100%" border="0" id="test_eml_toggle" style="display:none">
    <tr>
      <td><label class="mw-ui-label">Send test email to</label>
        <input name="test_email_to" id="test_email_to" class="mw_option_field mw-ui-field"   type="text" option-group="email"   value="<?php print get_option('test_email_to','email'); ?>"  />
         <div class="vSpace"></div>
        <label class="mw-ui-label">Test mail subject</label>

        <input name="test_email_subject" id="test_email_subject" class="mw_option_field mw-ui-field"   type="text" option-group="email"   value="<?php print get_option('test_email_subject','email'); ?>"  />
        <div class="vSpace"></div>

        <span onclick="mw.email_send_test();" class="mw-ui-btn mw-ui-btn-green" id="email_send_test_btn">Send test email</span></td>
      <td><pre id="email_send_test_btn_output"></pre></td>
    </tr>
    
  </table>
  <div class="vSpace"></div>
  <div class="vSpace"></div>
  
  <?php if($email_transport == 'smtp' or $email_transport == 'gmail' or $email_transport == 'yahoo' or $email_transport == 'hotmail' or $email_transport == 'smtp'): ?>
    <label class="mw-ui-label"><?php print ucfirst($email_transport); ?> Username <br />
    <small>example: user@email.com</small></label>
  <input name="smtp_username" class="mw_option_field mw-ui-field mw-title-field"   type="text" option-group="email"  value="<?php print get_option('smtp_username','email'); ?>" />
  <div class="vSpace"></div>
  <label class="mw-ui-label"><?php print ucfirst($email_transport); ?> Password </label>
  <input name="smtp_password" class="mw_option_field mw-ui-field mw-title-field"   type="password" option-group="email"  value="<?php print get_option('smtp_password','email'); ?>" />
  <div class="vSpace"></div>
  <?php endif; ?>
  
  
  
  <?php if($email_transport == 'smtp'): ?>
  <label class="mw-ui-label">Smtp Email Host <br />
    <small>example: smtp.gmail.com</small></label>
  <input name="smtp_host" class="mw_option_field mw-ui-field mw-title-field"   type="text" option-group="email"  value="<?php print get_option('smtp_host','email'); ?>" />
  <div class="vSpace"></div>
  <label class="mw-ui-label">Smtp Email Port <br />
    <small>example: 587 or 995, 465, 110, 25</small></label>
  <input name="smtp_port" class="mw_option_field mw-ui-field mw-title-field"   type="text" option-group="email"  value="<?php print get_option('smtp_port','email'); ?>" />
  <div class="vSpace"></div>

  <label class="mw-ui-label">Enable SMTP authentication</label>
  <?php  $email_smtp_auth = get_option('smtp_auth','email'); ?>
  <div class="mw-ui-select">
    <select name="smtp_auth" class="mw_option_field"   type="text" option-group="email" data-refresh="settings/group/email">
      <option value="n" <?php if($email_smtp_auth == 'n'): ?> selected="selected" <?php endif; ?>>No</option>
      <option value="y" <?php if($email_smtp_auth == 'y'): ?> selected="selected" <?php endif; ?>>Yes</option>
    </select>
  </div>
  <div class="vSpace"></div>
  <label class="mw-ui-label">Enable SMTP Secure Method</label>
  <?php  $email_smtp_secure = get_option('smtp_secure','email'); ?>
  <div class="mw-ui-select">
    <select name="smtp_secure" class="mw_option_field"   type="text" option-group="email" data-refresh="settings/group/email">
      <option value="0" <?php if($email_smtp_secure == ''): ?> selected="selected" <?php endif; ?>>None</option>
      <option value="1" <?php if($email_smtp_secure == '1'): ?> selected="selected" <?php endif; ?>>SSL</option>
      <option value="2" <?php if($email_smtp_secure == '2'): ?> selected="selected" <?php endif; ?>>TLS</option>
    </select>
  </div>
  <?php endif; ?>
</div>
