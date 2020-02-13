
<link charset="utf-8">      
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF" style="">
  <tr>
    <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">

      <table width="650" cellpadding="0" cellspacing="0" border="0" class="container" style="border-top: 4px solid #ff0000b0;
    padding-top: 2em;">
        <tr>
	      <td align="right" class="mobileOn">
          	
          </td>
          <td align="center" valign="buttom">
            <h3 class="text-center" style="color: #ff0000b0;font-size: 2em;">Account Activation</h3>
          </td>
          <td align="left">
          	
          </td>    
        </tr>
      </table>
      
      <table width="650" cellpadding="0" cellspacing="0" border="0" class="container" style="margin-top: 4em">
	      <tr>
		      <td align="" class="mobileOn">
			    <?php if($status==1){ ?>
				<p class="en" style="direction: ltr; color: #7f7f7f; font-size: 18px;">
					Hello! <br><br>
					You are receiving this email from <a href="<?=$_SERVER['HTTP_HOST']?>" target="_blank"><?=$_SERVER['HTTP_HOST']?></a> and we are here to notify you that<br>
					your account has been activated by the Bundlz's admin. Please click on the below button to login to your company account
					<br><br>
					<div align="center">
					<a href="<?=base_url('cp/login')?>" class="btn btn-default" target="_blank" style="background: #ff0000b0; padding: 1em 4em; color: white; text-decoration: none;">Login to account</a>
					</div>
					<br><br>
					<p style="color: #7f7f7f">
						<br><br>
						Regards.
					</p>
				</p>
				<?php }else{ ?>
				<p class="en" style="direction: ltr; color: #7f7f7f; font-size: 18px;">
					Hello! <br><br>
					You are receiving this email from <a href="<?=$_SERVER['HTTP_HOST']?>" target="_blank"><?=$_SERVER['HTTP_HOST']?></a> and we are here to notify you that<br>
					your account has been deactivated by the Bundlz's admin.
					<br><br>
					<p style="color: #7f7f7f">
						<br><br>
						Regards.
					</p>
				</p>
				<?php } ?>
	          </td>
	      </tr>
      </table>
      
      <table width="650" cellpadding="0" cellspacing="0" border="0" class="container" style="margin-top: 4em">
	      <tr>

		       <table width="650" cellpadding="0" cellspacing="0" border="0" class="container" style="margin-top: 6em;">
			      <tr>
				         <div align="center" style="border-top: 1px solid lightgray; padding-top: 2em;direction: ltr;width: 800px;">
							<a href="mailto:info@bundlz.sa?Subject=Enquiry%20" target="_top">
								<p>info@bundlz.sa</p>
							</a>
							<a href="https://www.dnet.sa" target="_blank" style="text-decoration: none;">
								<p class="copyright" style="color: #7f7f7f;text-decoration: none;">@ 2019 - 2020 Bundlz</p>
							</a>
						</div>
			      </tr>
		       </table>
	      </tr>
	      
      </table>
      
       

    </td>
  </tr>
  <tr>
    <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
  </tr>
</table> 