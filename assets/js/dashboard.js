var question = 1;
var radio_value_count =1;
var checkbox_value_count =1;
var dropdown_value_count =1;
$('#showmee')
.click
(function()
{
	$(".submit-name").removeAttr("disabled");
	$('#fieldsds1')
	.append(`
			<section class="container" style="padding:10px;border: 1px solid grey;border-radius:15px;margin-top:10px;">
			<div class="row">
				<div class="col-md-10 offset-2">
					<button class="btn btn-primary btn-sm input-btn`+question+`">+ Input</button>
					<button class="btn btn-outline-success btn-sm radio-btn`+question+`">+ Radio</button>
					<button class="btn btn-outline-success btn-sm checkbox-btn`+question+`">+ Checkbox</button>
					<button class="btn btn-outline-success btn-sm dropdown-btn`+question+`">+ Dropdown</button>
					<button class="btn btn-outline-success btn-sm upload-btn`+question+`">+ Upload Photo</button>
					<button class="btn btn-outline-success btn-sm gps-btn`+question+`">+ GPS</button>
					<button class="btn btn-outline-success btn-sm qr-btn`+question+`">+ QR Code</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="pt-4 ml-4 form-inline">
						<label for="Legend"><strong>Insert Legend:<strong></label>
						<input type="text" name="fields[]" class="form-control" placeholder="Legend Here" style="width: 500px;margin-left:140px;" required/>
						<input type="hidden" name="types[]" value="legend" class="form-control col-md-7">
      					<input type="hidden" name="nepali_title[]" value="legend" class="form-control col-md-7">
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 appendhere`+ question +`">
						</div>
					</div>
					<div class="pt-4 form-inline"><p class="btn btn-outline-dark btn-sm remove-section">Remove Section</p></div>
				</div>
			</div>
			</section>
		  `);

	var appendhere = '.appendhere'+question;
	var input_count = 1;
	//Input Button
	var inputbtn = '.input-btn'+question;
	$(inputbtn).click(function(e){
		e.preventDefault();
		$(appendhere).append(`
								<div class="row inp">
									<div class="col-md-1"><label>Field Name:</label></div>
									<div class="col-md-2"><input type="text" name="fields[]" class="form-control" placeholder="In english" required/></div>
									<div class="col-md-1"><label>फिल्डको नाम:</label></div>
									<div class="col-md-3"><input type="text" name="nepali_title[]" class="form-control" required/></div>
									<div class="col-md-1"><label>Type:</label></div>
									<div class="col-md-3">
										<select type="text" name="types[]" class="form-control">
											<option value="VARCHAR">VARCHAR</option>
											<option value="INT">INT</option>      
											<option value="TEXT">TEXTAREA</option>
										</select>
									</div>
									<div class="col-md-1">
										<b class="btn btn-sm btn-danger ml-3 delete_input`+ input_count +`">-</b>
									</div>
								</div>
							`);
		var delete_input = '.delete_input'+input_count;
		$(delete_input).click(function(){
			$(this).closest('.inp').remove();
		});
	});

	//Radio Button
	var radiobtn = '.radio-btn'+question;	
	var radio_delete_count = 1;
	
	$(radiobtn).click(function(e){
		e.preventDefault();
		var temprad = radio_value_count-1;
		$('.delete_radio_input'+temprad).css('display','none');
		$(appendhere).append(`
								<div class="row inp">
									<div class="col-md-1"><label>Field Name:</label></div>
									<div class="col-md-2"><input type="text" name="fields[]" class="form-control" placeholder="In english" required/></div>
									<div class="col-md-1"><label>फिल्डको नाम:</label></div>
									<div class="col-md-2"><input type="text" name="nepali_title[]" class="form-control" required/></div>
									<div class="col-md-2"><label>Radio Values:</label></div>
									<input type="hidden" name="types[]" value="radio`+radio_value_count+`" />
									<div class="col-md-4" id="add_more_here`+radio_value_count+`">
										<div class="form-inline row">
										<input type="text" class="form-control col-md-6" name="values[radio`+radio_value_count+`][]" placeholder="Add Value" required>
										<input type="button" class="btn btn-outline-info btn-sm" style="margin-left:5px;" id="addmore`+radio_value_count+`" value="+ Add">
										<b class="btn btn-sm btn-danger ml-3 delete_radio_input`+radio_value_count+`">-</b>
										</div>
									</div>
								</div>
							`);
		var add_more = '#addmore'+radio_value_count;
		var add_more_here = '#add_more_here'+radio_value_count;	
		var radio_value_number = radio_value_count;
		$(add_more).click(function(){
			$(add_more_here).append(`
										<div class="form-inline row">
										<input type="text" class="form-control col-md-6" name="values[radio`+radio_value_number+`][]" placeholder="Add Value">
										</div>
									`);
		});
		var delradio = '.delete_radio_input' + radio_value_count;
		$(delradio).click(function(){
			$(this).closest('.inp').remove();
			radio_value_count--;
			$('.delete_radio_input'+(radio_value_count-1)).css('display','block');
		});
		radio_value_count++;
	});

	//Checkbox Button
	var checkboxbtn = '.checkbox-btn'+question;	
	$(checkboxbtn).click(function(e){
		e.preventDefault();
		var tempchk = checkbox_value_count-1;
		$('.delete_checkbox_input'+tempchk).css('display','none');
		$(appendhere).append(`
								<div class="row inp">
									<div class="col-md-1"><label>Field Name:</label></div>
									<div class="col-md-2"><input type="text" name="fields[]" class="form-control" placeholder="In english" required/></div>
									<div class="col-md-1"><label>फिल्डको नाम:</label></div>
									<div class="col-md-2"><input type="text" name="nepali_title[]" class="form-control" required/></div>
									<div class="col-md-2"><label>Checkbox Values:</label></div>
									<input type="hidden" name="types[]" value="checkbox`+checkbox_value_count+`" />
									<div class="col-md-4" id="checkbox_add_more_here`+checkbox_value_count+`">
										<div class="form-inline row">
										<input type="text" class="form-control col-md-6" name="values[checkbox`+checkbox_value_count+`][]" placeholder="Add Value" required>
										<input type="button" class="btn btn-outline-info btn-sm" style="margin-left:5px;" id="checkbox_addmore`+checkbox_value_count+`" value="+ Add">
										<b class="btn btn-sm btn-danger ml-3 delete_checkbox_input`+checkbox_value_count+`">-</b>
										</div>
									</div>
								</div>
							`);
		var add_more = '#checkbox_addmore'+checkbox_value_count;
		var add_more_here = '#checkbox_add_more_here'+checkbox_value_count;	
		var checkbox_value_number = checkbox_value_count;
		$(add_more).click(function(){
			$(add_more_here).append(`
										<div class="form-inline row">
										<input type="text" class="form-control col-md-6" name="values[checkbox`+checkbox_value_number+`][]" placeholder="Add Value">
										</div>
									`);
		});
		var delcheckbox = '.delete_checkbox_input' + checkbox_value_count;
		$(delcheckbox).click(function(){
			$(this).closest('.inp').remove();
			checkbox_value_count--;
			$('.delete_checkbox_input'+(checkbox_value_count-1)).css('display','block');
		});
		checkbox_value_count++;
	});

	//Dropdown Button
	var dropdownbtn = '.dropdown-btn'+question;	
	$(dropdownbtn).click(function(e){
		e.preventDefault();
		var tempdrop = dropdown_value_count-1;
		$('.delete_dropdown_input'+tempdrop).css('display','none');
		$(appendhere).append(`
								<div class="row inp">
									<div class="col-md-1"><label>Field Name:</label></div>
									<div class="col-md-2"><input type="text" name="fields[]" class="form-control" placeholder="In english" required/></div>
									<div class="col-md-1"><label>फिल्डको नाम:</label></div>
									<div class="col-md-2"><input type="text" name="nepali_title[]" class="form-control" required/></div>
									<div class="col-md-2"><label>Dropdown Values:</label></div>
									<input type="hidden" name="types[]" value="dropdown`+dropdown_value_count+`" />
									<div class="col-md-4" id="dropdown_add_more_here`+dropdown_value_count+`">
										<div class="form-inline row">
										<input type="text" class="form-control col-md-6" name="values[dropdown`+dropdown_value_count+`][]" placeholder="Add Value" required>
										<input type="button" class="btn btn-outline-info btn-sm" style="margin-left:5px;" id="dropdown_addmore`+dropdown_value_count+`" value="+ Add">
										<b class="btn btn-sm btn-danger ml-3 delete_dropdown_input`+dropdown_value_count+`">-</b>
										</div>
									</div>
								</div>
							`);
		var add_more = '#dropdown_addmore'+dropdown_value_count;
		var add_more_here = '#dropdown_add_more_here'+dropdown_value_count;	
		var dropdown_value_number = dropdown_value_count;
		$(add_more).click(function(){
			$(add_more_here).append(`
										<div class="form-inline row">
										<input type="text" class="form-control col-md-6" name="values[dropdown`+dropdown_value_number+`][]" placeholder="Add Value">
										</div>
									`);
		});
		var deldropdown = '.delete_dropdown_input' + dropdown_value_count;
		$(deldropdown).click(function(){
			$(this).closest('.inp').remove();
			dropdown_value_count--;
			$('.delete_dropdown_input'+(dropdown_value_count-1)).css('display','block');
		});
		dropdown_value_count++;
	});

	//Upload Button
	var uploadbtn = '.upload-btn'+question;	
	upload_count = 1;
	$(uploadbtn).click(function(e){
		
		e.preventDefault();
		$(appendhere).append(`
								<div class="row inp">
									<div class="col-md-1"><label>Field Name:</label></div>
									<div class="col-md-2"><input type="text" name="fields[]" class="form-control" placeholder="In english" required/></div>
									<div class="col-md-1"><label>फिल्डको नाम:</label></div>
									<div class="col-md-3"><input type="text" name="nepali_title[]" class="form-control" required/></div>
									<div class="col-md-1"><label>Type:</label></div>
									<div class="col-md-3">
										<select type="text" name="types[]" class="form-control">
											<option value="file">Image</option>
										</select>
									</div>
									<div class="col-md-1">
										<b class="btn btn-sm btn-danger ml-3 delete_input`+ upload_count +`">-</b>
									</div>
								</div>
							`);
		var delete_input = '.delete_input'+upload_count;
		$(delete_input).click(function(){
			$(this).closest('.inp').remove();
		});
	
	});

	//GPS Button
	var gpsbtn = '.gps-btn'+question;	
	var gps_count = 1;
	$(gpsbtn).click(function(e){
		
		e.preventDefault();
		$(appendhere).append(`
								<div class="row inp">
									<div class="col-md-1"><label>Field Name:</label></div>
									<div class="col-md-2"><input type="text" name="fields[]" class="form-control" placeholder="In english" required/></div>
									<div class="col-md-1"><label>फिल्डको नाम:</label></div>
									<div class="col-md-3"><input type="text" name="nepali_title[]" class="form-control" required/></div>
									<div class="col-md-1"><label>Type:</label></div>
									<div class="col-md-3">
										<select type="text" name="types[]" class="form-control">
											<option value="gps">GPS</option>
										</select>
									</div>
									<div class="col-md-1">
										<b class="btn btn-sm btn-danger ml-3 delete_input`+ gps_count +`">-</b>
									</div>
								</div>
							`);
		var delete_input = '.delete_input'+gps_count;
		$(delete_input).click(function(){
			$(this).closest('.inp').remove();
		});
	});

	//QR Button
	var qrbtn = '.qr-btn'+question;	
	var qrcode_count = 1;
	$(qrbtn).click(function(e){
		
		e.preventDefault();
		$(appendhere).append(`
								<div class="row inp">
									<div class="col-md-1"><label>Field Name:</label></div>
									<div class="col-md-2"><input type="text" name="fields[]" class="form-control" placeholder="In english" required/></div>
									<div class="col-md-1"><label>फिल्डको नाम:</label></div>
									<div class="col-md-3"><input type="text" name="nepali_title[]" class="form-control" required/></div>
									<div class="col-md-1"><label>Type:</label></div>
									<div class="col-md-3">
										<select type="text" name="types[]" class="form-control">
											<option value="qrcode">QR Code</option>
										</select>
									</div>
									<div class="col-md-1">
										<b class="btn btn-sm btn-danger ml-3 delete_input`+ qrcode_count +`">-</b>
									</div>
								</div>
							`);
		var delete_input = '.delete_input'+qrcode_count;
		$(delete_input).click(function(){
			$(this).closest('.inp').remove();
		});
	});


	//Remove entire section
	$('.remove-section').click(function(){
		$(this).closest('section').remove();
		question--;
		radio_value_count=question;
	});
	//Prevent from submitting
	$('.btn-outline-success , .btn-primary').click(function(e){
		e.preventDefault();
	});

question++;	
});

//input




