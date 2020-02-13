var imageEditor;
$(function() {
    /*
     ** Sidebar Menu Tracking **
     */
    menu_track();

    $('form').areYouSure({
        message: 'It looks like you have been editing something. ' +
            'If you leave before saving, your changes will be lost.'
    });

    $('.unset').on('click', function() {
        //return false;
        sessionStorage.ActiveMenu = null;
        sessionStorage.ActiveSubMenu = null;
    });

    $('.lv-prev').on('keyup change', function() {
        var val = $(this).val();
        $(this).closest('.form-group').find('.sm-upd').html(val);
    });

    // for menu having single index
    $('.menu-track > li > a').on('click', function() {
        var ind = $(this).closest('li').index();
        if (typeof(Storage) !== "undefined") {
            sessionStorage.ActiveMenu = ind;
        } else {
            // Sorry! No Web Storage support..
        }
    });

    // for menu having sub indexing
    $('.menu-track > li > ul > li > a, .menu-track > li > ul > li > span').on('click', function() {
        var ind = $(this).closest('ul').closest('li').index();
        var sub_ind = $(this).closest('li').index();
        if (typeof(Storage) !== "undefined") {
            sessionStorage.ActiveMenu = ind;
            sessionStorage.ActiveSubMenu = sub_ind;
        } else {
            // Sorry! No Web Storage support..
        }
    });

    // click on plus sign in menu
    $(".add-direct").on("click", function() {
        window.location.href = $(this).attr("data-target");
    });
    
    $(document).on('click', '.delete-record', function(){
	    var _flag = confirm(__confirmMessage);
	    if(_flag){
		    return true;
	    }
	    
	    return false;
    });

    /*
     ** initialize hurkan switch for enable disable purpose  **
     */
    $(document).find('[data-toggle="hurkanSwitch"]').each(function() {
        $(this).hurkanSwitch({
            'on': function(r) {
                alert(r);
            },
            'off': function(r) {
                alert(r);
            },
            'onTitle': '<i class="fa fa-check"></i>',
            'offTitle': '<i class="fa fa-times"></i>',
            'width': 60

        });

    }); // end #hurkan switch

    // Live image preview
    $(document).on('change', '.fileToUpload', function() {
        readURL(this);
    });

    $(document).on("click", ".ci-preview-labels a, .change-pic", function() {
        $('.cropit-file').click();
        return false;
    });

    $(document).on("change", ".cropit-file", function() {
        cropItPreviewImg(this);
    });

    /*
     ** CROPIT Image init  **
     */
	 initializeCroppieEditor();

    // get Cropped image data on form submit +++ disable the submit button
    $("form").on("submit", function() {
        var valid = $(this).parsley().validate();
        if (!valid) {
            return false;
        }
        if ($('.crop-image').length) {
            var _img = $('.crop-image').croppie('result', {type: 'base64'}).then(function(base64){
		    	$('#image-data').val(base64);
		    	//console.log(base64);
	    	});
        }
        // disable submit button
        var submitBtn = $(this).find('input[type="submit"]');
        var btnWidth = $(submitBtn).outerWidth();
        var btnHeight = $(submitBtn).outerHeight();
        $('body[dir="ltr"]').find(submitBtn).after("<span style='top:0px;width: " + btnWidth + "px; height: " + (btnHeight + 0) + "px;margin-left: -" + btnWidth + "px' class='disable-btn'></span>");
        $('body[dir="rtl"]').find(submitBtn).after("<span style='top:0px;width: " + btnWidth + "px; height: " + (btnHeight + 0) + "px;margin-right: -" + btnWidth + "px' class='disable-btn'></span>");
    });
});


function initializeCroppieEditor(){
	if ($('.crop-image').length) {
        imageEditor = $('.crop-image').croppie({
			enforceBoundary: false,
			mouseWheelZoom: false,
		});
		
		$(document).on("click", ".change-pic.editor", function() {
			// trigger click input[type='file']
	        $('.editor-file').click();
	        return false;
		});
		
		// on drag and drop and onChange
		var dropzone = $('.crop-image'),
			input    = dropzone.find('input[type="file"]');

			dropzone.on({
				dragenter : dragin,
				dragleave : dragout
			});
			
			input.on('change', drop);
			
			function dragin(e) { //function for drag into element, just turns the bix X white
			    $(dropzone).addClass('hover');
			}
			
			function dragout(e) { //function for dragging out of element                         
			    $(dropzone).removeClass('hover');
			}
			
			function drop(e) {
			    var file = this.files[0];
			    
			    // upload file here
			    var fileType = file["type"];
			    var ValidImageTypes = ["image/jpeg", "image/png", "image/ico", "image/jpg" ];
			    if ($.inArray(fileType, ValidImageTypes) < 0) {
					alert('Please select `JPEG`, `PNG`, `ICO` images only.');
					return false;	
				}
				
				// if success render image
			    var reader = new FileReader(file);
				 	reader.readAsDataURL(file);
				 
			    reader.onload = function(e) {
			       imageEditor.croppie('bind', {
				       url: e.target.result
				    });
			        
			        cropImageActive();
			    }
		    	
			}
    }
}

function cropImageActive(){
	var _proceed = true;
	
    $('.cr-image').on("error", function () {
	    $('#check_chng_img').val(-1);
		_proceed = false;
    });

    if(_proceed)
    {
	 	var _chkChange = $('#check_chng_img').val();
	    $('#check_chng_img').val(parseInt(_chkChange) + 1);
	    
	    $('.editor-file.z-10').removeClass('z-10');
	    $('.change-pic').removeClass('hide');
	    $('.ci-preview-labels').remove();
	    $('.cr-boundary .cr-image, .cr-slider-wrap .cr-slider').show();   
    }
}

function selectFile(fileUrl) {
    window.opener.CKEDITOR.tools.callFunction(1, fileUrl);
}

function cropItPreviewImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            //$('.cropit-file').remove();
            $('.image-editor').cropit('imageSrc', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Image preview function
function readURL(input) {
    var requiredWidth = $(input).attr('data-thumb-width');
    var requiredHeight = $(input).attr('data-thumb-height');
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var fileType = file["type"];

        var ValidImageTypes = ["image/jpeg", "image/png", "image/ico", "image/jpg", ];
        if ($.inArray(fileType, ValidImageTypes) < 0) {
            alert('Please select `JPEG`, `PNG`, `ICO` images only.');
            $('.cropit-image-preview, .cropit-image-zoom-input').addClass('hide');
            $(input).val('');
            return false;
        }
        var reader = new FileReader();
        reader.onload = function(e) {

            var image = new Image();
            image.src = e.target.result;

            image.onload = function() {
                if (this.width < requiredWidth || this.height < requiredHeight) {
                    alert('Please select an image higher than ' + requiredWidth + "x" + requiredHeight);
                    $(input).val('');
                    $('.cropit-image-preview, .cropit-image-zoom-input').addClass('hide');
                    $('.image-editor').cropit('imageSrc', '');
                    return false;
                }

                $(input).next('img').attr('src', this.src);
                $(input).next('img').css({
                    "visibility": "visible",
                    "display": "block"
                });
                $('.cropit-image-preview, .cropit-image-zoom-input').removeClass('hide');
            }; // end image onload

        }; // end file reader

        reader.readAsDataURL(input.files[0]);
    }
}

// menu track function
function menu_track() {

    var str = window.location.href;
    var targetMenu = str.split('/', 6).join('/');
    if ($('.menu-track a[href="' + targetMenu + '"]').length == 0) {
        var ind = sessionStorage.ActiveMenu;
        var sub_ind = sessionStorage.ActiveSubMenu;
        $('.menu-track > li:eq(' + ind + ') > a').addClass("active");
        $('.menu-track > li:eq(' + ind + ') > ul').addClass("opened");
        $('.menu-track > li:eq(' + ind + ')> ul > li:eq(' + sub_ind + ') > a').addClass("active");
    } else {
        $('.menu-track a[href="' + targetMenu + '"]').addClass("active");
        $('.menu-track a[href="' + targetMenu + '"]').closest("ul").addClass("opened");
        $('.menu-track a[href="' + targetMenu + '"]').closest("ul").prev().addClass("active");
        $('.footer-ul a[href="' + targetMenu + '"]').closest("li").addClass("active");
    }

}

// manually select a menu
function menu_track_manual(index, subindex) {
    /*
    			$('.menu-track > li').eq(index).addClass('selected');
    			$('.menu-track > li:eq('+index+', .menu-track > li:eq('+index+') ul li:eq('+subindex+') > a').addClass('active');
    			$('.menu-track > li:eq('+index+') ul').addClass('opened');
    */
}

// change status for post,article,slider,service, project etc
function ChangeStatusFor(currentTb, tb_loc) {
    var status = 1;
    var hurkan = $(currentTb).prev('div');
    var get_Status = $(hurkan).attr('data-status');
    if (get_Status == 1) {
        status = 0;
        $(hurkan).attr('data-status', 0);
    } else {
        status = 1;
        $(hurkan).attr('data-status', 1);
    }
    var id = $(currentTb).closest('tr').find('td:eq(0)').text();

    // trigger the targeted location
    ChangeStatus(id, status, tb_loc);
}

function ChangeStatus(id, status, tb_loc) {
    var data = {
        id: id,
        status: status,
        tb_loc: tb_loc
    };
    return $.ajax({
        url: __base_url + "acp/ChangeStatus",
        type: "POST",
        dataType: "JSON",
        data: data,
        success: function(result) {
            console.log(result);
        },
        error: function(err, status, xhr) {
            console.log(err);
            console.log(status);
            console.log(xhr);
        }
    });
}

// change List order for post,article,slider,service, project etc
function ChangeOrder(key) {
    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function(i) {
                $(this).html(i + 1);
            });

            var arr = {};
            var i = 0;
            $(".sortable-1 tbody tr, .sortable-2 tbody tr, .sortable-3 tbody tr").each(function(e, v) {
                i++;
                $id = $(this).attr('id');
                $ind = $(this).find('td:eq(1)').text();
                arr[$id] = $ind;
            });
            var data = {};
            data[key.toString()] = JSON.stringify(arr);
            $.ajax({
                url: __base_url + "acp/ChangeOrder",
                type: "POST",
                dataType: "JSON",
                data: data,
                success: function(result) {
                    console.log(result);
                },
                error: function(err, status, xhr) {
                    console.log(err);
                    console.log(status);
                    console.log(xhr);
                }
            });

        };

    $(".sortable-1 tbody, .sortable-2 tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex,
        handle: '.drag-handle',
        placeholder: "ui-state-highlight"
    }).disableSelection();

}

function getUrlVars() {
    var vars = [],
        hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

//get youtube id
function getYoutubeId(url) {
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);

    if (match && match[2].length == 11) {
        return match[2];
    } else {
        return 0;
    }
}