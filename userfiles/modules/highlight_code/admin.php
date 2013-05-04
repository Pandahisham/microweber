<?php 
 
$rand_id = md5(serialize($params)); ?>

<div id="mw_email_source_code_editor<?php print $rand_id ?>">
  <fieldset class="inputs">
    <legend><span>Source code editor</span></legend>
     
        <?php $langs = array( "html","php", "javascript",  "css",  "python",  "sql", 
    "java",  "perl","xml", "ruby", "c", "cpp", "csharp"); ?>
        <?php $l_sel =  get_option('source_code_language', $params['id']); ?>
        <label  class="label">Source Code Language</label>
        <select name="source_code_language" class="mw_option_field mw_tag_editor_input mw_tag_editor_input_wider selectable"   type="text" data-refresh="highlight_code"  id="link_existing_bookmark">
          <option value="<?php print $l_sel ?>"><?php print $l_sel ?></option>
          <?php foreach($langs as $lan): ?>
          <option value="<?php print $lan ?>" <?php if($lan == $l_sel): ?> selected="selected" <?php endif; ?>><?php print $lan ?></option>
          <?php endforeach; ?>
        </select>
       <hr />
        <textarea name="source_code" cols=""  class="mw_option_field" style="height:200px; width:300px;" data-refresh="highlight_code"     rows="2"><?php print get_option('source_code', $params['id']) ?></textarea>
      
  </fieldset>
</div>
