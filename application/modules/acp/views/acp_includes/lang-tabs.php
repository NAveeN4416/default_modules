<?PHP if($website_lang){?>
	<ul class="nav nav-tabs">
      <li class="<?PHP if ($__lang == 'en') { echo 'active'; } ?>">
      		<a data-toggle="tab" href="#lang_en" <?PHP if(isset($extra_targets_en)){ echo 'data-target="'.$extra_targets_en.'"'; } ?>>English</a>
      </li>
      <li class="<?PHP if ($__lang == 'ar') { echo 'active'; } ?>">
      		<a data-toggle="tab" href="#lang_ar" <?PHP if(isset($extra_targets_ar)){ echo 'data-target="'.$extra_targets_ar.'"'; } ?> >العربي</a>
      </li>
	</ul>
<?PHP
	}
?>