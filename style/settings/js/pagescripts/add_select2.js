var Select2Options = Select2Options || {};

Select2Options.init = function(options){
	
	var settings = {
		formId 	 	  : options.formId,
		ENNameId 	  : options.ENNameId,
		ARNameId      : options.ARNameId,
		parentId      : options.parentId || 0,
		postURL       : options.postURL,
		selectFieldId : options.selectFieldId
	};
	
	//console.log(settings);
	
	var initEvents = function()
	{
		
		$('#'+settings.formId).off("submit").on('submit', function()
		{
			var _self = $(this);
			
			//debugger;
			var _parent_id;
			var _option_ar = document.getElementById(settings.ARNameId).value;
			var _option_en = document.getElementById(settings.ENNameId).value;
			
			if(settings.parentId !== 0)
			{
				_parent_id = document.getElementById(settings.parentId).value;
			}
			
			var _data = {
				option_ar : _option_ar,
				option_en : _option_en,
				parent_id : _parent_id
			};
			
			var _new_option = _option_ar;
			if(_lang == 'en') { _new_option = _option_en; }
			
			$.post(settings.postURL, _data, function(result)
			{
				var _result = JSON.parse(result);
				
				if(_result.id > 0)
				{
					var newOption = new Option(_new_option, _result.id, true, true);
					$('#'+settings.selectFieldId+'.select2').append(newOption).trigger('change');
				}
				
				//$(_self).find('.alert').removeClass('hide');
				document.getElementById(settings.ARNameId).value = '';
				document.getElementById(settings.ENNameId).value = '';
				
				$(_self).closest('.modal').modal('hide');
			});
			
			return false;
			
		});
	}();
	
};