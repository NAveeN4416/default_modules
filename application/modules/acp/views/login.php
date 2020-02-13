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
    <!-- Custom styles for this template -->
    <style type="text/css">
        .g-recaptcha > div {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <style>
        .hide {
            display: none;
        }
    </style>
    <div id="wrapper">
        <div id="content">
            <div class="login-page">
                <div class="form">
                    <?PHP $log_img='' ; if(isset($__lang) && $__lang=='ar' ){ $log_img='logoar.png' ; } else { $log_img='logo.png' ; } ?>
                    <img align="middle" src="<?=base_url($GLOBALS['acp_img_dir'].'/'.$log_img)?>" alt="Ubrand" style="margin-bottom: 10px;">
                    <br>
                    <form action="<?=base_url('authentication/userLogin')?>" method="post" class="login-form" id="form">

                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <?PHP if(strlen($this->session->flashdata('loginFailed')) > 0){ ?>
                            <h6 class="alert alert-danger text-center check_err" style="background-color:#ffcece !important;color:#bd4a4a;border-color: #ffcccc;"><?PHP echo getSystemString(11) ?></h6>
                            <?PHP } ?>
                            
                            <?PHP if(strlen($this->session->flashdata('passwordChanged')) > 0){ ?>
                            <h6 class="alert alert-success text-center check_err" style="background-color:#dff0d8 !important;color:#3c763d;border-color: #d6e9c6;"><?PHP echo getSystemString(434); ?></h6>
                            <?PHP } ?>
                            
                        </div>


                        <input type="text" name="username" placeholder="<?=getSystemString(1)?>" required="" autofocus="" value='' <?PHP if(isset($__lang) && $__lang=='ar' ){ echo "dir='rtl'"; } ?>/>
                        <input type="password" name="password" placeholder="<?=getSystemString(2)?>" required="" value='' <?PHP if(isset($__lang) && $__lang=='ar' ){ echo "dir='rtl'"; } ?>/>


                        <div style="display: none">
                            <span style="font-size:13px; "><?=getSystemString(3)?></span>
                            <input type="checkbox" class="checkbox-inline checkbox" checked="" id="remember_me" name="remember_me" /> 
                        </div>

                        <?PHP if($this->session->userdata('site__auth') >= 3){ ?>
                        <div class="g-recaptcha" data-sitekey="6LebFBkUAAAAACgBPkudpmbxufBRJlakHM6E1YcC"></div>
                        <?PHP } ?>



                        <button type="submit" style="margin-top: 10px;" id="submit" name="submit">
                            <?=getSystemString(4)?>
                        </button>
                        <p class="message">
                            <?=getSystemString(5)?>
                                <a href="#">
                                    <?=getSystemString(6)?>
                                </a>
                        </p>
                        <br>
                    </form>

                    <form class="register-form" id="form-re" action="" method="post" style="display: none;">

                        <p class="success_mail result-message hide text-success" id="success_mail" style="background-color:#dff0d8 !important; color:#3c763d; border-color: #d6e9c6;font-size: 13px;padding: 10px">

                        </p>
                        <p class="error_mail result-message hide text-danger" id="error_mail" style="background-color:#ffcece !important;color:#bd4a4a;border-color: #ffcccc;font-size: 13px;padding: 10px">

                        </p>

                        <input type="text" name="re-email" id="re-email" placeholder="<?=getSystemString(10)?>" required="">
                        <button type="submit" name="submit">
                            <?=getSystemString(7)?>
                        </button>
                        <p class="message">
                            <?=getSystemString(8)?>
                                <a href="#">
                                    <?=getSystemString(9)?>
                                </a>
                        </p>
                    </form>
                    <?PHP $lng=@ $__lang=='en' ? 'ar' : 'en'; ?>
                    <p class="message-">
                        <a href="<?=base_url($__controller.'/changeLanguage/'.$lng)?>">
                            <?=getSystemString(12)?>
                        </a>
                    </p>
                    <br>
                </div>
            </div>

        </div>
    </div>

    <div class="center">
        <div id="footer">
            <img align="left" src="<?=base_url($GLOBALS['acp_img_dir'].'/dnet.png')?>" alt="">

            <p class="textcopyrights" align="left" style="margin-bottom:0px">
                All Copyrights Reserved 2013 -2017 ©.
                <br>Powered by <a target="_blank" href="https://www.dnet.sa">www.DNet.sa</a>
            </p>
            <br>

        </div>

    </div>
    <script src="<?=base_url($GLOBALS['acp_js_dir'].'/jquery.js')?>"></script>
    <script src="<?=base_url($GLOBALS['acp_js_dir'].'/jquery-cookie.js')?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        var set_cookie_flag = false;
        $(function() {

            $('.message a').click(function() {
                $('form').animate({
                    height: "toggle",
                    opacity: "toggle"
                }, "slow");
                return false;
            });

            if ($.cookie('dcart_acp_log') != undefined) {
                if ($.cookie('dcart_acp_log').length > 0) {
                    var data = $.cookie('dcart_acp_log');
                    console.log(data);
                    data = data.split('|');
                    $('input[name="username_m"]').val(data[0]);
                    $('input[name="password_m"]').val(data[1]);
                    $('#remember_me').attr('checked', 'checked');
                    set_cookie_flag = true;
                }
            }
            $('#remember_me').on('change', function() {
                if (!set_cookie_flag) {
                    $.removeCookie('dcart_acp_log');
                    var d = $('input[name="username_m"]').val() + '|' + $('input[name="password_m"]').val();
                    $.cookie("dcart_acp_log", d, {
                        expires: 14
                    });
                    set_cookie_flag = true;
                } else {
                    $.removeCookie('dcart_acp_log');
                    set_cookie_flag = false;
                }
            });

            $('#submit').click(function() {
                if (set_cookie_flag) {
                    $.removeCookie('dcart_acp_log');
                    var d = $('input[name="username_m"]').val() + '|' + $('input[name="password_m"]').val();
                    $.cookie("dcart_acp_log", d, {
                        expires: 14
                    });
                    $('#form').submit();
                    return true;
                } else {
                    $('#form').submit();
                    return true;
                }
            });

            $("#form-re").submit(function(e) {
                var data = {
                    email: $('#re-email').val()
                };
                $("#form-re input, #form-re button").attr('disabled', 'disabled');
                $.ajax({
                    url: "<?=base_url('authentication/passwordReset')?>",
                    type: "POST",
                    dataType: "JSON",
                    data: data,
                    success: function(result) {
                        $("#form-re input, #form-re button").removeAttr('disabled');
                        if (result.info != 0) {
                            $("#form-re #success_mail").removeClass("hide");
                            $("#form-re #error_mail").addClass("hide");
                            $("#form-re #success_mail").text(result.msg);
                            $("#form-re input").val('');
                        } else if (result.info) {
                            $("#form-re #error_mail").text(result.msg);
                            $("#form-re #success_mail").addClass("hide");
                            $("#form-re #error_mail").removeClass("hide");
                        }
                    },
                    error: function(err, status, xhr) {
                        $("#form-re input, #form-re button").removeAttr('disabled');
                        $("#form-re #error_mail").text('Error occured while sending you email, Please try again later.');
                        $("#form-re #success_mail").addClass("hide");
                        $("#form-re #error_mail").removeClass("hide");
                        console.log(err);
                        console.log(status);
                        console.log(xhr);
                    }
                });
                return false;
            });

        });
    </script>
</body>

</html>