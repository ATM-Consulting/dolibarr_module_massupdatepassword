<?php
/* Copyright (C) 2009-2010 Regis Houssin <regis.houssin@capnetworks.com>
 * Copyright (C) 2011-2013 Laurent Destailleur <eldy@users.sourceforge.net>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

header('Cache-Control: Public, must-revalidate');
header("Content-type: text/html; charset=".$conf->file->character_set_client);

if (GETPOST('dol_hide_topmenu')) $conf->dol_use_jmobile=1;
if (GETPOST('dol_hide_leftmenu')) $conf->dol_hide_leftmenu=1;
if (GETPOST('dol_optimize_smallscreen')) $conf->dol_optimize_smallscreen=1;
if (GETPOST('dol_no_mouse_hover')) $conf->dol_no_mouse_hover=1;
if (GETPOST('dol_use_jmobile')) $conf->dol_use_jmobile=1;

// If we force to use jmobile, then we reenable javascript
if (! empty($conf->dol_use_jmobile)) $conf->use_javascript_ajax=1;

print top_htmlhead('',$langs->trans('Login').' '.$title);
?>
<!-- BEGIN PHP TEMPLATE PASSWORDFORGOTTEN.TPL.PHP -->

<body class="bodylogin">

<?php if (empty($conf->dol_use_jmobile)) { ?>
<script type="text/javascript">
$(document).ready(function () {
	// Set focus on correct field
	<?php if ($focus_element) { ?>$('#<?php echo $focus_element; ?>').focus(); <?php } ?>		// Warning to use this only on visible element
});
</script>
<?php } ?>


<div align="center">
<div class="login_vertical_align">


<form id="login" name="login" method="post" action="<?php echo $php_self; ?>">
<input type="hidden" name="token" value="<?php echo $_SESSION['newtoken']; ?>">
<input type="hidden" name="action" value="validatenewpassword">

<table class="login_table_title center" summary="<?php echo dol_escape_htmltag($title); ?>">
<tr class="vmenu"><td align="center"><?php echo $title; ?></td></tr>
</table>
<br>

<div class="login_table">

<div id="login_line1">


<div id="login_left">

<img alt="Logo" title="" src="<?php echo $urllogo; ?>" id="img_logo" />

</div>


<div id="login_right">

<table summary="Login pass" class="centpercent">

<!-- Login -->
<tr>
<td valign="bottom" class="nowrap center">
<span class="span-icon-user">
<input type="text" placeholder="<?php echo $langs->trans("Login"); ?>" <?php echo $disabled; ?> id="username" name="username" class="flat input-icon-user" size="20" value="<?php echo dol_escape_htmltag($username); ?>" tabindex="1" />
</span>
</td>
</tr>

<tr>
<td valign="bottom" class="nowrap center">
<span class="span-icon-user">
<input type="text" placeholder="<?php echo $langs->trans("MassUpdatePasswordCurrentPassword"); ?>" <?php echo $disabled; ?> id="currentpassword" name="currentpassword" class="flat input-icon-user" size="20" value="<?php echo dol_escape_htmltag($currentpassword); ?>" tabindex="1" />
</span>
</td>
</tr>

<tr>
<td valign="bottom" class="nowrap center">
<span class="span-icon-user">
<input type="text" placeholder="<?php echo $langs->trans("MassUpdatePasswordNewPassword"); ?>" <?php echo $disabled; ?> id="newpassword" name="newpassword" class="flat input-icon-user" size="20" value="<?php echo dol_escape_htmltag($newpassword); ?>" tabindex="1" />
</span>
</td>
</tr>

<?php if ($message) { ?>
	<div class="center login_main_message" style="max-width: 520px">
	<?php echo dol_htmloutput_mesg($message,'','',1); ?>
	</div>
<?php } ?>

</table>

</div> <!-- end div left -->




</div>

<div id="login_line2" style="clear: both">

<!-- Button Send password -->
<br><input id="update" type="submit" <?php echo $disabled; ?> class="button" name="update" value="<?php echo $langs->trans('Update'); ?>" tabindex="4" />

<br>
<div align="center" style="margin-top: 8px;">
	<?php
	$moreparam='';
	if (! empty($conf->dol_hide_topmenu))   $moreparam.=(strpos($moreparam,'?')===false?'?':'&').'dol_hide_topmenu='.$conf->dol_hide_topmenu;
	if (! empty($conf->dol_hide_leftmenu))  $moreparam.=(strpos($moreparam,'?')===false?'?':'&').'dol_hide_leftmenu='.$conf->dol_hide_leftmenu;
	if (! empty($conf->dol_no_mouse_hover)) $moreparam.=(strpos($moreparam,'?')===false?'?':'&').'dol_no_mouse_hover='.$conf->dol_no_mouse_hover;
	if (! empty($conf->dol_use_jmobile))    $moreparam.=(strpos($moreparam,'?')===false?'?':'&').'dol_use_jmobile='.$conf->dol_use_jmobile;

	print '<a class="alogin" href="'.$dol_url_root.'/index.php'.$moreparam.'">('.$langs->trans('BackToLoginPage').')</a>';
	?>
</div>

</div>

</div>

</form>


<div class="center login_main_home" style="max-width: 80%">
<?php if ($mode == 'dolibarr' || ! $disabled) { ?>
	<font style="font-size: 12px;">
	<?php echo $langs->trans('MassUpdatePasswordRenew'); ?>
	</font>
<?php }else{ ?>
	<div class="warning" align="center">
	<?php echo $langs->trans('AuthenticationDoesNotAllowSendNewPassword', $mode); ?>
	</div>
<?php } ?>
</div>


</div>
</div>	<!-- end of center -->


</body>
</html>
<!-- END PHP TEMPLATE -->