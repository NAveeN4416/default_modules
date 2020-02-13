<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="<?=@$__lang?>">

<head>
    <meta charset="utf-8">
    <meta charset="windows-125">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?=getSystemString(127)?>
    </title>
    <link rel="stylesheet" href="<?=base_url($GLOBALS['acp_css_dir'].'/alerts.min.css')?>" type="text/css" />
    <link rel="stylesheet" href="<?=base_url($GLOBALS['acp_css_dir'].'/login.css')?>" type="text/css" />
    <!-- Custom styles -->
     <style>
        .hide {
            display: none;
        }
        .form input[type='password']{
	        margin: 0px;
        }
        .form .input-container{
	        margin-bottom:  20px;
	        overflow: hidden;
        }
        .parsley-errors-list{
			list-style: none;
	        background-color: #f3c4cc;
	        float: left;
	        padding-left: 0px;
	        -webkit-transition: all 0.2s linear;
	        transition: all 0.2s linear;
	        display: table-footer-group;
	        padding: 0px;
	        margin: 0px;
	    }
	    .parsley-errors-list li {
	        font-size: 13px;
	        color: #b55767;
	        text-align: left;
	        padding: 10px;
	        -webkit-transition: all 0.2s linear;
	        transition: all 0.2s linear;
      	}
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="content">
            <div class="login-page">
                <div class="form">
                    <?PHP $log_img='' ; if(isset($__lang) && $__lang=='ar' ){ $log_img='logoar.png' ; } else { $log_img='logo.png' ; } ?>
                    
                    <img align="middle" src="<?=base_url($GLOBALS['acp_img_dir'].'/'.$log_img)?>" alt="" style="margin-bottom: 10px;">
                    
                    <br>
                    <form action="<?=base_url('authentication/changePassword_Request')?>" method="post" class="login-form" data-parsley-validate>
						
						<div class="input-container">
							<input type="hidden" name="reset_token" value="<?=$reset_token?>">
	                        <input type="password"
	                        		id="password"
	                        		name="password" 
	                        		placeholder="<?=getSystemString(340)?>"  
	                        		autofocus=""
	                        		required
	                        		data-parsley-trigger="keyup"
						            data-parsley-minlength="3" 
						            data-parsley-minlength-message="<?=getSystemString(224)?>"
						            data-parsley-maxlength="20" 
						            data-parsley-maxlength-message="<?=getSystemString(230)?>"
						            data-parsley-validation-threshold="20"
						            data-parsley-required-message="<?=getSystemString(213)?>"
	                        		<?PHP if(isset($__lang) && $__lang=='ar' ){ echo "dir='rtl'"; } ?>/>
						</div>
                        
                        <div class="input-container">		
	                        <input type="password" 
	                        		name="confirm_password" 
	                        		placeholder="<?=getSystemString(341)?>" 
	                        		required="" 
								    data-parsley-trigger="keyup"
								    data-parsley-equalto="#password"
								    data-parsley-equalto-message="<?=getSystemString(232)?>"
				                    data-parsley-minlength="3" 
					                data-parsley-minlength-message="<?=getSystemString(224)?>"
					                data-parsley-maxlength="20" 
					                data-parsley-maxlength-message="<?=getSystemString(230)?>"
				                    data-parsley-validation-threshold="20"
								    data-parsley-required-message="<?=getSystemString(213)?>"
	                        		<?PHP if(isset($__lang) && $__lang=='ar' ){ echo "dir='rtl'"; } ?>/>
                        </div>


                        <button type="submit" style="margin-top: 10px;" id="submit" name="submit">
                            <?=getSystemString(7)?>
                        </button>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <div class="center">
        <div id="footer">
            <img align="left" src="<?=base_url($GLOBALS['acp_img_dir'].'/dnet.png')?>" alt="">

            <p class="textcopyrights" align="left" style="margin-bottom:0px">
                All Copyrights Reserved 2019 - 2020 ©.
                <br>Powered by <a target="_blank" href="http://www.dnet.sa">www.DNet.sa</a>
            </p>
            <br>

        </div>

    </div>
    <script src="<?=base_url($GLOBALS['acp_js_dir'].'/jquery.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('style/site/js/jquery-parsley.min.js')?>"></script>
    <script>
	    $(function(){
		    $('form').submit(function(){
			    
			    var valid = $(this).parsley().validate();
			    if(!valid){
				    return false;
			    }
			    
		    });
	    });
    </script>
</body>

</html>