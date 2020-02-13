	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url($GLOBALS['acp_css_dir'].'/select2-bootstrap.min.css')?>">
<style>
	.fa-spin{
	    position: absolute;
	    right: 30px;
	    top: 10px;
	    font-size: 16px;
	    color: #aaa;
	}
	#video_frame{
		margin-top: 20px;
	}
		.smsInfolabel{
			padding: 5px;
			font-size: 14px;
			color: #333;
			line-height: 4;
		}
		.smsInfolabel font{
			font-weight: bold;
		}
		.breadcrumb{
			background: none;
		}
		.select2-drop-active{
							    margin-top: -25px;
							}
</style>

	<div id="content-main">
		<div class="row">
			<?PHP
				$this->load->view('acp_includes/response_messages');
			?>
			<div class="col-md-10">
				<h1><?=getSystemString(245)?></h1>
			</div>
			<div class="col-md-10">
				<form action="<?=base_url($__controller.'/sendSMS');?>" class="form-horizontal" method="post"> 
		          	<div class="panel white" style="padding-bottom: 50px;">
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="editor1">Choose Options</label>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-6 no-padding-left">
								<input type="checkbox" name="send_all_customers" class="form-control control rounded block" id="c7" onclick="check_all_cu(this)">
								<label for="c7"><span></span>All Customers</label>
								<input type="checkbox" name="send_all_companies" class="form-control control rounded block" id="c8" onclick="check_all_co(this)">
								<label for="c8"><span></span>All Companies</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="editor1"><?=getSystemString(390)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<select class="select2 tags-tokenizer" name="numbers[]" multiple id="mobile_numbers"></select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 col-sm-4 col-md-2">
								<label for="editor1"><?=getSystemString(245)?></label>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-6 no-padding-left">
								<textarea name="message" rows="7" placeholder="<?=getSystemString(260)?>" required="required" class="form-control"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12 text-center">
							<input type="submit" class="btn btn-primary" value="<?=getSystemString(246)?>" name="submit" />
						</div>
					</div>
				</form>
			</div>
		</div>

	<?PHP
		$this->load->view('acp_includes/footer');
	?>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/select2.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url($GLOBALS['acp_js_dir'].'/pagescripts/smsmessage.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

<script type="text/javascript">
function matchCustom(params, data) {

    // If there are no search terms, return all of the data
    if ($.trim(params.term) === '') {
      return data;
    }

    // Do not display the item if there is no 'text' property
    if (typeof data.text === 'undefined') {
      return null;
    }

    // `params.term` should be the term that is used for searching
    // `data.text` is the text that is displayed for the data object
    if (data.text.indexOf(params.term) > -1) {
      var modifiedData = $.extend({}, data, true);
      modifiedData.text += ' (matched)';

      // You can return modified objects from here
      // This includes matching the `children` how you want in nested data sets
      return modifiedData;
    }

    // Return `null` if the term should not be displayed
    return null;
}

	$(function()
	{
		$(".tags-tokenizer").select2({
		    matcher: matchCustom,
		    tokenSeparators: [','],
		    data: function(params) 
		    {
            	return {
                		 term: params.term
		            	}
		    },
		    placeholder: "<?=getSystemString(59)?>",
		    ajax: {
	          url: '<?=base_url($__controller.'/getMobileNumbers')?>',
	          dataType: 'json',
	          delay: 50,
	          processResults: function (data) 
	          {
	            return {
	              results: data
	            };
	          },
	          cache: true
	        }
		});
	});

function check_all_cu($this)
{
	$("#mobile_numbers").removeAttr('disabled');

	if($($this).is(':checked'))
	{
		$('#mobile_numbers').val(null).trigger('change');
		$("#mobile_numbers").prop('disabled',true);
	}
}


function check_all_co($this)
{
	$("#mobile_numbers").removeAttr('disabled');

	if($($this).is(':checked'))
	{
		//$("#mobile_numbers").empty();
		$('#mobile_numbers').val(null).trigger('change');
		$("#mobile_numbers").prop('disabled',true);
	}
}


</script>

</body>
</html>