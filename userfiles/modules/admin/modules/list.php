<?
$modules_options = array();
$modules_options['skip_admin'] = true;
$modules_options['ui'] = true;

 if(!isset($modules ) ){
//$modules = scan_for_get_modules($modules_options );
 }
//

?>
<?
$mod_obj_str = 'modules';
 if(isset($is_elements) and $is_elements == true) {
                              $mod_obj_str = 'elements';
                              $el_params = array();
if(isset($params['layout_type'])){
  $el_params['layout_type'] = $params['layout_type'];
}
  $modules = get_elements_from_db($el_params);
										//
}     else {

 $modules = get_modules_from_db();

}

 ?>
   <?php foreach($modules as $moduleddasdas2): ?>
  <?php //d($moduleddasdas2); ?>
    <?php endforeach; ?>
<script type="text/javascript">

 Modules_List_<?php print $mod_obj_str ?> = {}

</script>

<ul class="modules-list list-<?php print $mod_obj_str ?>">
  <?php foreach($modules as $module2): ?>

   <?php if(isset($module2['module'])): ?>

  <?


		 $module_group2 = explode(DIRECTORY_SEPARATOR ,$module2['module']);
		 $module_group2 = $module_group2[0];
		?>
  <?php $module2['module'] = str_replace('\\','/',$module2['module']);

  $module2['module'] = rtrim($module2['module'],'/');
  $module2['module'] = rtrim($module2['module'],'\\');
                 $module2['categories'] =    get('fields=parent_id,id&limit=100&what=category_items&for='.$mod_obj_str.'&rel_id='.$module2['id']);
                              //d($module2['categories']);
               $temp = array();
			   // $temp2 = array();
			     if(is_array($module2['categories']) and !empty($module2['categories'])){


                   foreach($module2['categories'] as $it){
                    $temp[]            = $it['parent_id'];
					//  $temp2[]            = $it['id'];
                   }
                   $module2['categories'] = implode(',',$temp);
				 //   $module2['categories_ids'] = implode(',',$temp2);
				//   d( $module2['categories']);
                 }

   ?>
  <?php $module2['module_clean'] = str_replace('/','__',$module2['module']); ?>
  <?php $module2['name_clean'] = str_replace('/','-',$module2['module']); ?>
  <?php $module2['name_clean'] = str_replace(' ','-',$module2['name_clean']);
if(is_array($module2['categories'])){
$module2['categories'] = implode(',',$module2['categories']);
}

  ?>

   <?php $module_id = $module2['name_clean'].'_'.uniqid(); ?>
  <li  id="<?php print $module_id; ?>" data-module-name="<?php print $module2['module'] ?>" data-filter="<?php print $module2['name'] ?>" data-category="<?php isset($module2['categories'])? print addslashes($module2['categories']) : ''; ?>"    class="module-item <?php if(isset( $module2['as_element']) and intval($module2['as_element'] == 1) or (isset($is_elements) and $is_elements == true)) : ?> module-as-element<?php endif; ?>"> <span class="mw_module_hold">

  <script type="text/javascript">
      Modules_List_<?php print $mod_obj_str ?>['<?php print($module_id); ?>'] = {
       id:'<?php print($module_id); ?>',
       name:'<?php print $module2["module"] ?>',
       title:'<?php print $module2["name"] ?>',
       description:'<?php print addslashes($module2["description"]) ?>',
       category:'<?php print addslashes($module2["categories"]); ?>'
     }



  </script>



   <?php if($module2['icon']): ?>


    <span class="mw_module_image">


    <span class="mw_module_image_holder"><img
                alt="<?php print $module2['name'] ?>"
                title="<?php isset($module2['description'])? print addslashes($module2['description']) : ''; ?>"
                class="module_draggable"
                data-module-name-enc="<?php print $module2['module_clean'] ?>|<?php print $module2['name_clean'] ?>_<?php print date("YmdHis") ?>"
                src="<?php print $module2['icon'] ?>"
                 /> <s class="mw_module_image_shadow"></s></span></span>
    <?php endif; ?>
    <span class="module_name" alt="<?php isset($module2['description'])? print addslashes($module2['description']) : ''; ?>"><?php _e($module2['name']); ?></span>  </span> </li>



     <?php endif; ?>
  <?php endforeach; ?>

</ul>
