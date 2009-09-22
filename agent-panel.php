<!--Options file for User Agent Displayer-->
<div class="wrap">
<h2><?php _e('User Agent Displayer Options Page','user-agent-displayer'); ?> <small>(<?php _e('still in progress','user-agent-displayer'); ?>...)</small></h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); 
$imgsize = get_option('imgsize');
$suas = get_option('showuas');
switch($suas){
	case 'mouseover':
		$hover = 'SELECTED';
		break;
	case 'click':
		$click = 'SELECTED';
		break;
	case 'none':
		$none = 'SELECTED';
		break;
	}
?>
<table class="form-table">
<tr valign="top">
<th scope="row"><?php _e('Images Size','user-agent-displayer'); ?>:<br /></th>
<td><input type="text" name="imgsize" value="<?php echo $imgsize; ?>" size="1" /><i>px (<small><?php _e('Larger than 24px you might lose the quality','user-agent-displayer'); ?>.</small>)</i> </td>
</tr>
<tr valign="top">
<th scope="row"><?php _e('UserAgent String Display Mode','user-agent-displayer'); ?>:</th>
<td><select name="showuas">
	<option value="mouseover" <?php echo $hover; ?>><?php _e('On Mouse Hover','user-agent-displayer'); ?></option>
	<option value="click" <?php echo $click; ?>><?php _e('On Click','user-agent-displayer'); ?></option>
	<option value="none" <?php echo $none; ?>><?php _e('Do Not Display','user-agent-displayer'); ?></option>
	</select>
</td>
</tr>
</table>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="imgsize,showuas" />
<?php settings_fields( 'uad-options' ); ?>
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
