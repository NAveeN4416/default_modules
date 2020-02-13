<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
	$pages_flags 		 = @$_SESSION['pages_flags'] ;
	$customers_flags 	 = @$_SESSION['customers_flags'] ;
	$trips_flags	     = @$_SESSION['trips_flags'] ;
	$reservations_flags  = @$_SESSION['reservations_flags'] ;
	$companies_flags     = @$_SESSION['companies_flags'] ;
	$partners_flags      = @$_SESSION['partners_flags'] ;
	$joinpartners_flags  = @$_SESSION['joinpartners_flags'] ;
	$notifications_flags = @$_SESSION['notifications_flags'] ;

	//echo "<pre>"; print_r($pages_flags);exit;

?>
<!DOCTYPE html>
<html lang="<?=$__lang?>" dir="<?PHP if($__lang == 'ar'){ echo 'rtl'; } else { echo 'ltr'; }?>">
<head>
	<title>Bundlz | Admin</title>
	<meta charset="utf-8">
	<meta name="robots" content="noindex, follow" />
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
    <meta http-equiv="content-language" content="en-us" />
    <meta http-equiv="content-language" content="ar-sa" />
    <link rel="alternate" href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" hreflang="en-us" />
    <link rel="alternate" href="<?=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" hreflang="ar-sa" />
	<link rel="shortcut icon" href="" />
	<link rel="icon" href="<?php echo base_url('favicon.ico')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/framework-all.css')?>" />
<?PHP
if($__lang == 'ar'){
	?>
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/framework-rtl.css')?>" />
	<?PHP
}
?>
	<link href="<?=base_url($GLOBALS['acp_css_dir'].'/dropzone.css')?>" rel="stylesheet" />
	<link href="<?=base_url($GLOBALS['acp_css_dir'].'/style.css')?>" rel="stylesheet" />
	<link rel="stylesheet" href="<?=base_url($GLOBALS['acp_css_dir'].'/croppie.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/d-custom.css')?>" />
<style>
.ui-state-highlight{
    background-color: #f5f5f5;
    padding-right:10px;
    height:45px;
}
</style>
</head>
<body class="" dir="<?PHP if($__lang == 'ar'){ echo 'rtl'; } else { echo 'ltr'; }?>">
<div class="loader-back"><div class="loader2"></div></div>

<div class="navbar">
	<a class="sidebar-toggle"></a>
 	<a href="<?=base_url('acp/')?>">
	 	<img src="<?=base_url('style/site/img/logo.png')?>" alt="" class="fr-logo" >

 	</a>
 	

	
 	<div class="navbar-options">
		<ul>
<!--
			<li>
				<a id="btn-fullscreen" href="#"><i class="fa fa-arrows-alt"></i></a>
			</li>
-->
			<li>
				<a>
					<img class="avatar" src="<?=base_url($GLOBALS['img_users_dir'].$this->session->userdata($this->acp_session->picture()))?>" onerror="this.src='<?=base_url($GLOBALS['acp_img_dir'].'/avatar1.png')?>'">
					<span><?=$this->session->userdata($this->acp_session->username())?></span>
				</a>
				<ul>
					<?PHP
						
						if($this->session->userdata($this->acp_session->role()) != 'super_admin') {
					?>
					<li><a href="<?=base_url('acp/profile')?>" class="unset"><i class="fa fa-user"></i> <?=getSystemString(88)?></a></li>
					<?PHP
						}
					?>
					<li><a href="<?=base_url('acp/logout')?>" class="unset"><i class="fa fa-sign-out"></i> <?=getSystemString(89)?></a></li>
				</ul>
			</li>
			<li>
			<a href="<?=base_url('')?>" target="_blank" class="unset" style="font-size: 15px;"><i class="fa fa-external-link"></i></a>

			</li>
			<li>
				<a class="unset" href="<?=base_url('acp/settings')?>"><i class="fa fa-cog"></i></a>
			</li>
			<?PHP
				if($this->session->userdata($this->acp_session->role()) == 'super_admin' || $this->session->userdata($this->acp_session->role()) == 'admin') {
			?>
			<li>
			<a class="unset" href="<?=base_url('acp/manageUsers')?>"><i class="fa fa-user"></i></a>
			</li>
			<?PHP
				}
				if($website_lang){
			?>
			<li>
			<?PHP $____lng = $__lang == 'en' ? 'ar' : 'en'; ?>
			<a class="unset" href="<?=base_url('acp/changeLanguage/'.$____lng)?>"><?=getSystemString(12)?></a></li>
			<?PHP
				}
			?>
 		</ul>
	</div>
</div>

<div class="content-container">
	<div class="sidebar">
		<div class="sidebar-top">
 		</div>

		<div class="sidebar-content">
			<ul class="menu-track">
				<li class="">
					<a href="<?=base_url('acp/')?>" class=""><i class="fa fa-tachometer"></i> <span><?=getSystemString(90)?></span></a>
				</li>
				<li class="">
					<a href="<?=base_url('acp/reports')?>" class=""><i class="fa fa-bar-chart"></i> <span><?=getSystemString(385)?></span></a>
				</li>
				<?php if(@$pages_flags['view_flag']=='1' || @$_SESSION['Role_ID']=='1'){ ?>
				<li>
					<a><i class="fa fa-file-text"></i> <span><?=getSystemString(91)?></span></a>
					<ul>
						<li>
							<a href="<?=base_url('acp/aboutus')?>"><?=getSystemString(219)?></a>
						</li>
						<li>
							<a href="<?=base_url('acp/faq')?>"><?=getSystemString(187)?></a>
						</li>
						<li>
							<a href="<?=base_url('acp/slider')?>"><?=getSystemString(107)?></a>
						</li>
						<li>
							<a href="<?=base_url('acp/contactus')?>"><?=getSystemString(108)?></a>
						</li>
						<li>
							<a href="<?=base_url('acp/terms_conditions')?>"><?=getSystemString(384)?></a>
						</li>
						<li>
							<a href="<?=base_url('acp/privacy_policy')?>"><?=getSystemString(380)?></a>
						</li>
					</ul>
				</li>
				<?php } ?>
				<?php if(@$pages_flags['view_flag']=='1' ||  @$_SESSION['Role_ID']=='1'){ ?>
				<li>
					<a href="<?=base_url('acp/customers_list')?>"><i class="fa fa-users"></i> <span><?=getSystemString(368)?></span></a>
				</li>
				<?php } ?>
				<?php if(@$customers_flags['view_flag']=='1' ||  @$_SESSION['Role_ID']=='1'){ ?>
				<li>
					<a href="<?=base_url('acp_company/companies_list')?>"><i class="fa fa-building-o"></i> <span><?=getSystemString(299)?></span></a>
				</li>
				<?php } ?>
				<?php if(@$customers_flags['view_flag']=='1' ||  @$_SESSION['Role_ID']=='1'){ ?>
				<li>
					<a href="<?=base_url('acp_company/Financial_Menu')?>"><i class="fa fa-money"></i> <span><?=getSystemString('Payment')?></span></a>
				</li>
				<?php } ?>
				<?php if(@$trips_flags['view_flag']=='1'  || @$_SESSION['Role_ID']=='1'){ ?>
				<li>
					<a href="<?=base_url('acp_company/campaigns_list')?>"><i class="fa fa-bullhorn"></i> <span><?=getSystemString(309)?></span></a>
				</li>
				<?php } ?>
				<?php if(@$reservations_flags['view_flag']=='1' ||  @$_SESSION['Role_ID']=='1'){ ?>
				<li>
					<a href="<?=base_url('reservations/reservations_list')?>"><i class="fa fa-calendar-check-o"></i> <span><?=getSystemString(478)?></span></a>
				</li>
				<?php } ?>
				<?php if(@$reservations_flags['view_flag']=='1' ||  @$_SESSION['Role_ID']=='1'){ ?>
				<li>
					<a href="<?=base_url('acp/manageServices')?>"><i class="fa fa-star"></i> <span><?=getSystemString('services')?></span></a>
				</li>
				<?php } ?>
				<li>
					<a href="<?=base_url('acp/news/manageNews')?>"><i class="fa fa-newspaper-o"></i> <span><?=getSystemString('news')?></span></a>
				</li>
				<?php if(@$partners_flags['view_flag']=='1' ||  @$_SESSION['Role_ID']=='1'){ ?>
				<li>
					<a href="<?=base_url('acp/partners')?>"><i class="fa fa-handshake-o"></i> <span><?=getSystemString('partner_list')?></span></a>
				</li>
				<?php } ?>
				<?php if(@$notifications_flags['view_flag']=='1' ||  @$_SESSION['Role_ID']=='1'){ ?>
				<li>
					<a><i class="fa fa-bell-o"></i> <span><?=getSystemString(493)?></span></a>
					<ul>
						<li>
							<a href="<?=base_url('acp/notifications/sms')?>"><?=getSystemString(391)?></a>
						</li>
						<li>
							<a href="<?=base_url('acp/notifications/sendMessage')?>"><?=getSystemString('send_email')?></a>
						</li>
						<li>
							<a href="<?=base_url('acp/notifications/pushNotifications')?>"><?=getSystemString(494)?></a>
						</li>
					</ul>
				</li>
				<?php } ?>
				<li>
					<a><i class="fa fa-ticket"></i> <span><?=getSystemString(211)?></span></a>
					<ul>
						<li>
							<a href="<?=base_url('acp/tickets/enquiries/users')?>"><?=getSystemString('user_tickets')?></a>
						</li>
						<li>
							<a href="<?=base_url('acp/tickets/enquiries/companies')?>"><?=getSystemString('company_tickets')?></a>
						</li>
					</ul>
				</li>
 			</ul>
		</div>

		<div class="footer">
			<ul class="footer-ul">
				<li><a href="https://dnet.sa" target="_blank"><img src="<?=base_url($GLOBALS['acp_img_dir'].'/dnet.png')?>"></a></li>
				<li><span><small>DP 3.2</small></span></li>
				<li>
					<span><small> Copyrights &copy;  <?=date("Y")?>. Powered by  <a href="https://dnet.sa" target="_blank">DNet</a></small></span>
				</li>
				<li class="ft-hvr">
				
					<a href="<?=base_url('acp/helpAndSupport')?>" class="ft-a unset">
						<i class="fa fa-support"></i><?=getSystemString(186)?></a>
				</li>
<!-- 				<li class="ft-hvr"><a href="<?=base_url('acp/commingSoon1')?>" class="ft-a unset"><?=getSystemString(187)?></a></li> -->
				
			</ul>
			
 		</div>
	</div>