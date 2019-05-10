<div id="page-content-wrapper" style="padding: 30px;">
    <div class="container-fluid">
<div class="row">
<div class="col-md-12">
<style type="text/css">
	.border_wrap{
		border: 2px solid #c1bfbf;
		padding: 23px;
		border-radius: 24px;
	}
	.legend-blue-color{
		color: green;
	}
</style>
 <?php if($this->session->flashdata('update')):
    echo '<p style="text-align: center" class="alert alert-success">'.$this->session->flashdata('update').'</p>';
  endif; ?>
  <?php if($this->session->flashdata('update_error')):
    echo '<p style="text-align: center" class="alert alert-success">'.$this->session->flashdata('update_error').'</p>';
  endif; ?>

  <?php 
  		foreach($district_info as $data){}
   ?>
  <h3 align="center" class="legend-blue-color"> Update: SA-16 - गाउँपालिकाको सामाजिक-आर्थिक जानकारी</h3>
  <form name="sa-18" method="post" action="<?php echo base_url(); ?>posts/SA_18_update" role="form" class="form-horizontal">
    <div class="col-md-12">
      <fieldset>
        
        <div class="form-row border_wrap">
        	<div class="col-md-2 mr-3">
          <label for="ward_no" class="control-label">वडा न:</label>
          
          <select name="ward_no" id="ward_no" class="form-control">
            <option value="<?php echo $data['ward_no'];?>"><?php echo $data['ward_no'];?></option>
                          <?php for($i=1;$i<10;$i++)echo "
                              <option> $i </option>";?>
          </select>
          </div>

          <?php foreach ($district_info as $data ) {?>
				<input  type="hidden"  name="u" id="u" value="<?php echo $data['user_id'];?> " >

			<?php } ?>

          <div class="col-md-2 mr-3">
		  <label for="main_language" class="control-label">मुख्य भाषा </label>
            <input type="text" value="<?php echo $data['main_langauge'];?>" name="main_langauge" id="ward_no" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3">
          <label for="main_religion_community" class="control-label">मुख्य धर्मीक समुदाय</label>
            <input value="<?php echo $data['main_religion_community'];?>" type="text" name="main_religion_community" id="main_religion_community" class="form-control"/>
          </div>
		  
          <!-- <div class="col-md-2 mt-2"> -->
          <div class="col-md-2 mr-3">
          <label for="litterate_rate_male" class="control-label">पुरुस सक्षरता दर</label>
            <input value="<?php echo $data['litterate_rate_male'];?>" type="text" name="litterate_rate_male" id="litterate_rate_male" class="form-control"/>
          </div>
       
          <div class="col-md-2 mr-3">
          <label for="litterate_rate_female" class="control-label">महिला सक्षरता दर</label>
            <input value="<?php echo $data['litterate_rate_female'];?>" type="text" name="litterate_rate_female" id="litterate_rate_female" class="form-control"/>
          </div>

        </div>
      </fieldset>
    </div>
    <div class="col-md-12 mt-5">
      <div class="form-row border_wrap">
        <legend class="legend-blue-color">मुख्य चाडपर्वहरु </legend>
		<?php foreach ($district_infos as $datas){ ?>
          <div class="col-md-2">
          <label for="festival_name" class="control-label">चाडपर्बहरुको नाम</label>
            <input value="<?php echo $datas['festival_name'];?>" type="text" name="festival_name[]" id="festival_name" class="form-control"/>
          </div>

          <div class="col-md-4">
          <label for="attendance_condition_festival_time" class="control-label">चाडपर्बको समयमा समुदायका काममा उपस्थित हुने अवस्था</label>
          
            <select class="form-control col-md-6 ml-5" id="attendance_condition_festival_time" name="attendance_condition_festival_time[]">
            <option value="<?php echo $datas['attendance_condition_festival_time'];?>"><?php echo $datas['attendance_condition_festival_time'];?>
              <option> छ </option>
              <option> छैन </option>
            </select>
          </div>

          <div class="col-md-4">
          <label for="effect_working_days" class="control-label">उक्त चाडपर्वले समाजिक कार्यमा असर पार्ने जम्मा दिन</label>
            <input value="<?php echo $datas['effect_working_days'];?>" type="number" min="0" name="effect_working_days[]" id="effect_working_days" class="form-control col-md-6 ml-5"/>
          </div>

          <div class="col-md-1">
          <label for="months" class="control-label col-md-2">महिना</label>
            <input type="text" value="<?php echo $datas['months'];?>" name="months[]" id="months" class="form-control"/>
          </div>
<?php } ?>
		  <div class="col-md-1 mt-4">
			<a href="" id="add_festival" class="btn btn-success" title="चाडपर्वहरु थप्नुहोस "><span class="glyphicon glyphicon-plus-sign"> + </span></a>
		  </div>		  
          <div id="more_festival"></div>
		</div>
      
    </div>

    <div class="col-md-12 mt-3 border_wrap">
      <fieldset>
        <legend class="legend-blue-color">उपलब्ध सेवाहरु </legend>
        <div class="form-group">
		<div class="col-md-12 table-responsive">
		<table class="table">
			<thead>
				<th> सेवाहरु </th>
				<th width="250px">उपलब्धता </th>
				<th>संख्या </th>
				<th>सेवा लिनको लागी नजिकको ठाउँ </th>
				<th>जान लाग्ने समय </th>
			</thead>
			<tbody>
				<tr>
					<td>प्राथमिक बिध्यालय</td>
					<td>
					<select id="primary_school_available" name="primary_school_available" class="form-control">
						<option value="<?php echo $data['primary_school_available'];?>"><?php echo $data['primary_school_available'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['primary_school_no'];?>" type="number" min="0" name="primary_school_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['primary_school_nearest_palce'];?>" type="text" name="primary_school_nearest_palce" class="form-control"/></td>
					<td><input value="<?php echo $data['primary_school_nearest_reach_time'];?>" type="text" name="primary_school_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<!-- <tr>
					<td>निम्न माध्यमिक बिध्यालय</td>
					<td><select id="#" name="lower_secondary_school_avaliable" class="form-control">
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input type="number" min="0" name="lower_secondary_school_no" class="form-control"/> </td>
					<td><input type="text" name="lower_secondary_school_nearest_place" class="form-control"/></td>
					<td><input type="text" name="lower_secondary_school_reach_time" class="form-control"/> </td>
				
				</tr> -->
				<tr>
					<td>माध्यमिक बिध्यालय</td>
					<td><select  name="secondary_school_avaliable" class="form-control">
						<option value="<?php echo $data['secondary_school_avaliable'];?>"><?php echo $data['secondary_school_avaliable'];?></option>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['secondary_school_no'];?>" type="number" min="0" name="secondary_school_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['secondary_school_nearest_place'];?>" type="text" name="secondary_school_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['secondary_school_nearest_reach_time'];?>" type="text" name="secondary_school_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>उच्च माध्यमिक बिध्यालय</td>
					<td><select name="higher_secondary_school_avaliable" class="form-control">
						<option value="<?php echo $data['higher_secondary_school_avaliable'];?>"><?php echo $data['higher_secondary_school_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?= $data['higher_secondary_school_no'];?>" type="number" min="0" name="higher_secondary_school_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['higher_secondary_school_nearest_place'];?>" type="text" name="higher_secondary_school_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['higher_secondary_nearest_reach_time'];?>" type="text" name="higher_secondary_nearest_reach_time" class="form-control"/> </td>				
				</tr>
				<tr>
					<td>उप स्वास्थ्य चौकी </td>
					<td><select name="sub_health_post_avaliable" class="form-control">	<option value="<?php echo $data['sub_health_post_avaliable'];?>"><?php echo $data['sub_health_post_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['sub_health_post_no'];?>" type="number" min="0" name="sub_health_post_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['sub_health_post_nearest_place'];?>" type="text" name="sub_health_post_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['sub_health_post_nearest_reach_time'];?>" type="text" name="sub_health_post_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>पशुसेवा केन्द्र</td>
					<td><select name="animal_service_center_avaliable" class="form-control">
						<option value="<?php echo $data['animal_service_center_avaliable'];?>"><?php echo $data['animal_service_center_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['animal_service_center_no'];?>" type="number" min="0" name="animal_service_center_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['animal_service_center_nearest_place'];?>" type="text" name="animal_service_center_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['animal_service_center_nearest_reach_time'];?>" type="text" name="animal_service_center_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>कृषि सेवा केन्द्र </td>
					<td><select name="agro_service_avaliable" class="form-control">
						<option value="<?php echo $data['agro_service_avaliable'];?>"><?php echo $data['agro_service_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['agro_service_no'];?>" type="number" min="0" name="agro_service_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['agro_service_nearest_place'];?>" type="text" name="agro_service_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['agro_service_nearest_reach_time'];?>" type="text" name="agro_service_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>हुलाक कार्यलय </td>
					<td><select name="post_office_avaliable" class="form-control">
						<option value="<?php echo $data['post_office_avaliable'];?>"><?php echo $data['post_office_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['post_office_no'];?>" type="number" min="0" name="post_office_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['post_office_nearest_place'];?>" type="text" name="post_office_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['post_office_nearest_reach_time'];?>" type="text" name="post_office_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>प्रहरी कार्यलय </td>
					<td><select  name="police_offcie_avaliable" class="form-control">
						<option value="<?php echo $data['police_offcie_avaliable'];?>"><?php echo $data['police_offcie_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['police_offcie_no'];?>" type="number" min="0" name="police_offcie_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['police_office_nearest_place'];?>" type="text" name="police_office_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['police_offcie_nearest_reach_time'];?>" type="text" name="police_offcie_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>श्रोत केन्द्र</td>
					<td><select name="source_center_avaliable" class="form-control">
						<option value="<?php echo $data['source_center_avaliable'];?>"><?php echo $data['source_center_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['source_center_no'];?>" type="number" min="0" name="source_center_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['source_center_nearest_place'];?>" type="text" name="source_center_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['source_center_nearest_reach_time'];?>" type="text" name="source_center_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>बैंक </td>
					<td><select name="bank_avaliable" class="form-control">
						<option value="<?php echo $data['bank_avaliable'];?>"><?php echo $data['bank_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['bank_no'];?>" type="number" min="0" name="bank_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['bank_nearest'];?>" type="text" name="bank_nearest" class="form-control"/></td>
					<td><input value="<?php echo $data['bank_nearest_reach_time'];?>" type="text" name="bank_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>सहकारी सस्था </td>
					<td><select name="cooperative_avaliable" class="form-control">
						<option value="<?php echo $data['cooperative_avaliable'];?>"><?php echo $data['cooperative_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['cooperative_no'];?>" type="number" min="0" name="cooperative_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['cooperative_nearest_place'];?>" type="text" name="cooperative_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['cooperative_nearest_reach_time'];?>" type="text" name="cooperative_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>टेलिफोन </td>
					<td><select name="telephone_avaliable" class="form-control">
						<option value="<?php echo $data['telephone_avaliable'];?>"><?php echo $data['telephone_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['telephone_no'];?>" type="number" min="0" name="telephone_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['telephone_nearest_place'];?>" type="text" name="telephone_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['telephone_nearest_reach_time'];?>" type="text" name="telephone_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>बिधुत प्राधिकरण </td>
					<td><select id="#" name="electricity_authority_avaliable" class="form-control">
						<option value="<?php echo $data['electricity_authority_avaliable'];?>"><?php echo $data['electricity_authority_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['electricity_authority_no'];?>" type="number" min="0" name="electricity_authority_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['electricity_authority_nearest_place'];?>" type="text" name="electricity_authority_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['electricity_nearest_reach_time'];?>" type="text" name="electricity_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
				<tr>
					<td>सामुदायिक सस्थाहरु  </td>
					<td><select id="#" name="community_org_avaliable" class="form-control">
						<option value="<?php echo $data['community_org_avaliable'];?>"><?php echo $data['community_org_avaliable'];?>
						<option> छ</option>
						<option>छैन </option>
					</select></td>
					<td><input value="<?php echo $data['community_org_no'];?>" type="number" min="0" name="community_org_no" class="form-control"/> </td>
					<td><input value="<?php echo $data['community_org_nearest_place'];?>" type="text" name="community_org_nearest_place" class="form-control"/></td>
					<td><input value="<?php echo $data['community_org_nearest_reach_time'];?>" type="text" name="community_org_nearest_reach_time" class="form-control"/> </td>
				
				</tr>
			</tbody>	
		</table>
		</div>		
        </div>
      </fieldset>
    </div>
    <div class="col-md-12 mt-3 border_wrap">
      <fieldset>
        <legend class="legend-blue-color">गाउँपालिका दक्ष मानब जनसक्ति बिबरण</legend>
        <div class="form-group">
			<div class="col-md-12 table-responsive"> 
				<table class="table">
					<thead> 
						<tr>
							<th rowspan="3">जानकारी जनसक्ति बिबरण </th>
							<th rowspan="3">दैनिक श्रमिक ज्याला रु. </th>
							<th colspan="6">दक्ष श्रमिक </th>						
						</tr>
						<tr>
							<th colspan="2">दलित </th>
							<th colspan="2">जनजाती</th>
							<th colspan="2">अन्य </th>						
						</tr>
						<tr>
							<th>पुरुस</th>
							<th>महिला </th>
							<th>पुरुस</th>
							<th>महिला </th>
							<th>पुरुस</th>
							<th>महिला </th>
																		
						</tr>
					</thead>
						<tr>
							<td>दक्ष मिस्त्री (कामदार)</td>
							<td><input value="<?= $data['skilled_mistri_wages_daily'];?>" type="number" min="0" name="skilled_mistri_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['skilled_mistri_dalit_male'];?>" type="number" min="0" name="skilled_mistri_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['skilled_mistri_dalit_female'];?>" type="number" min="0" name="skilled_mistri_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['skilled_mistri_janajati_male'];?>" type="number" min="0" name="skilled_mistri_janajati_male" class="form-control" /></td>
							<td><input value="<?= $data['skilled_mistri_janajati_female'];?>" type="number" min="0" name="skilled_mistri_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['skilled_mistri_other_male'];?>" type="number" min="0" name="skilled_mistri_other_male" class="form-control" /></td>
							<td><input value="<?= $data['skilled_mistri_other_female'];?>" type="number" min="0" name="skilled_mistri_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td>मर्मत सम्भार कार्यकर्ता (पानी चौकीदार)</td>
							<td><input value="<?= $data['maintenance_worker_wages_daily'];?>" type="number" min="0" name="maintenance_worker_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['maintenance_worker_dalit_male'];?>" type="number" min="0" name="maintenance_worker_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['maintenance_worker_dalit_female'];?>" type="number" min="0" name="maintenance_worker_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['maintenance_worker_janajati_male'];?>" type="number" min="0" name="maintenance_worker_janajati_male" class="form-control" /></td>
							<td><input value="<?= $data['maintenance_worker_janajati_female'];?>" type="number" min="0" name="maintenance_worker_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['maintenance_worker_other_male'];?>" type="number" min="0" name="maintenance_worker_other_male" class="form-control" /></td>
							<td><input value="<?= $data['maintenance_worker_other_female'];?>" type="number" min="0" name="maintenance_worker_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td>स्थानिय चप्री निर्माण कार्यकर्ता </td>
							<td><input value="<?= $data['local_toilet_developer_wages_daily'];?>" type="number" min="0" name="local_toilet_developer_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['local_toilet_developer_dalit_male'];?>" type="number" min="0" name="local_toilet_developer_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['local_toilet_developer_dalit_female'];?>" type="number" min="0" name="local_toilet_developer_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['local_toilet_developer_janajati_male'];?>" type="number" min="0" name="local_toilet_developer_janajati_male" class="form-control" /></td>
							<td><input value="<?= $data['local_toilet_developer_janajati_female'];?>" type="number" min="0" name="local_toilet_developer_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['local_toilet_developer_other_male'];?>" type="number" min="0" name="local_toilet_developer_other_male" class="form-control" /></td>
							<td><input value="<?= $data['local_toilet_developer_other_female'];?>" type="number" min="0" name="local_toilet_developer_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td>काठको काम गर्ने मिस्त्री  </td>
							<td><input value="<?= $data['carpenter_wages_daily'];?>" type="number" min="0" name="carpenter_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['carpenter_dalit_male'];?>" type="number" min="0" name="carpenter_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['carpenter_dalit_female'];?>" type="number" min="0" name="carpenter_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['carpenter_janajati_male'];?>" type="number" min="0" name="carpenter_janajati_male" class="form-control" /></td>
							<td><input value="<?= $data['carpenter_janajati_female'];?>" type="number" min="0" name="carpenter_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['carpenter_other_male'];?>" type="number" min="0" name="carpenter_other_male" class="form-control" /></td>
							<td><input value="<?= $data['carpenter_other_female'];?>" type="number" min="0" name="carpenter_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td>बिधुत प्राबिधिक  </td>
							<td><input value="<?= $data['electrician_wages_daily'];?>" type="number" min="0" name="electrician_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['electrician_dalit_male'];?>" type="number" min="0" name="electrician_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['electrician_dalit_female'];?>" type="number" min="0" name="electrician_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['electrician_janajati_male'];?>" type="number" min="0" name="electrician_janajati_male" class="form-control" /></td>
							<td><input value="<?= $data['electrician_janajati_female'];?>" type="number" min="0" name="electrician_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['electrician_other_male'];?>" type="number" min="0" name="electrician_other_male" class="form-control" /></td>
							<td><input value="<?= $data['electrician_other_female'];?>" type="number" min="0" name="electrician_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td>आकाशे घैटो बनाउने मिस्त्री   </td>
							<td><input value="<?= $data['community_org_nearest_reach_time'];?>" type="number" min="0" name="sky_pot_developer_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['community_org_nearest_reach_time'];?>" type="number" min="0" name="sky_pot_developer_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['community_org_nearest_reach_time'];?>" type="number" min="0" name="sky_pot_developer_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['community_org_nearest_reach_time'];?>" type="number" min="0" name="sky_pot_developer_janjati_male" class="form-control" /></td>
							<td><input value="<?= $data['community_org_nearest_reach_time'];?>" type="number" min="0" name="sky_pot_developer_janjati_female" class="form-control" /></td>
							<td><input value="<?= $data['community_org_nearest_reach_time'];?>" type="number" min="0" name="sky_pot_developer_other_male" class="form-control" /></td>
							<td><input value="<?= $data['community_org_nearest_reach_time'];?>" type="number" min="0" name="sky_pot_developer_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td> महिला स्वास्थ्य स्वयम सेविका   </td>
							<td><input value="<?= $data['women_health_volunteer_wages_daily'];?>" type="number" min="0" name="women_health_volunteer_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['women_health_volunteer_dalit_male'];?>" type="number" min="0" name="women_health_volunteer_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['women_health_volunteer_dalit_female'];?>" type="number" min="0" name="women_health_volunteer_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['women_health_volunteer_janajati_male'];?>" type="number" min="0" name="women_health_volunteer_janajati_male" class="form-control" /></td>
							<td><input value="<?= $data['women_health_volunteer_janajati_female'];?>" type="number" min="0" name="women_health_volunteer_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['women_health_volunteer_other_male'];?>" type="number" min="0" name="women_health_volunteer_other_male" class="form-control" /></td>
							<td><input value="<?= $data['women_health_volunteer_other_female'];?>" type="number" min="0" name="women_health_volunteer_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td>जलस्रोत प्राबिधिक </td>
							<td><input value="<?= $data['water_technician_wages_daily'];?>" type="number" min="0" name="water_technician_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['water_technician_dalit_male'];?>" type="number" min="0" name="water_technician_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['water_technician_dalit_female'];?>" type="number" min="0" name="water_technician_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['water_technician_janjati_male'];?>" type="number" min="0" name="water_technician_janjati_male" class="form-control" /></td>
							<td><input value="<?= $data['water_technician_janajati_female'];?>" type="number" min="0" name="water_technician_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['water_technician_other_male'];?>" type="number" min="0" name="water_technician_other_male" class="form-control" /></td>
							<td><input value="<?= $data['water_technician_other_female'];?>" type="number" min="0" name="water_technician_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td>कृषि प्राबिधिक </td>
							<td><input value="<?= $data['agro_technician_wages_daily'];?>" type="number" min="0" name="agro_technician_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['agro_technician_dalit_male'];?>" type="number" min="0" name="agro_technician_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['agro_technician_dalit_female'];?>" type="number" min="0" name="agro_technician_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['agro_technician_janajati_male'];?>" type="number" min="0" name="agro_technician_janajati_male" class="form-control" /></td>
							<td><input value="<?= $data['agro_technician_janajati_female'];?>" type="number" min="0" name="agro_technician_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['agro_technician_other_male'];?>" type="number" min="0" name="agro_technician_other_male" class="form-control" /></td>
							<td><input value="<?= $data['agro_technician_other_female'];?>" type="number" min="0" name="agro_technician_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td> पशु स्वास्थ्य प्राबिधिक </td>
							<td><input value="<?= $data['animal_health_technician_wages_daily'];?>" type="number" min="0" name="animal_health_technician_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['animal_health_technician_dalit_male'];?>" type="number" min="0" name="animal_health_technician_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['animal_health_technician_dalit_female'];?>" type="number" min="0" name="animal_health_technician_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['animal_health_technician_janajati_male'];?>" type="number" min="0" name="animal_health_technician_janajati_male" class="form-control" /></td>
							<td><input value="<?= $data['animal_health_technician_janajati_female'];?>" type="number" min="0" name="animal_health_technician_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['animal_health_technician_other_male'];?>" type="number" min="0" name="animal_health_technician_other_male" class="form-control" /></td>
							<td><input value="<?= $data['animal_health_technician_other_female'];?>" type="number" min="0" name="animal_health_technician_other_female" class="form-control" /></td>
						</tr>
						<tr>
							<td>समाजिक परिचालक </td>
							<td><input value="<?= $data['social_mobilizer_wages_daily'];?>" type="number" min="0" name="social_mobilizer_wages_daily" class="form-control" /></td>
							<td><input value="<?= $data['social_mobilizer_dalit_male'];?>" type="number" min="0" name="social_mobilizer_dalit_male" class="form-control" /></td>
							<td><input value="<?= $data['social_mobilizer_dalit_female'];?>" type="number" min="0" name="social_mobilizer_dalit_female" class="form-control" /></td>
							<td><input value="<?= $data['social_mobilizer_janajati_male'];?>" type="number" min="0" name="social_mobilizer_janajati_male" class="form-control" /></td>
							<td><input value="<?= $data['social_mobilizer_janajati_female'];?>" type="number" min="0" name="social_mobilizer_janajati_female" class="form-control" /></td>
							<td><input value="<?= $data['social_mobilizer_other_male'];?>" type="number" min="0" name="social_mobilizer_other_male" class="form-control" /></td>
							<td><input value="<?= $data['social_mobilizer_other_female'];?>" type="number" min="0" name="social_mobilizer_other_female" class="form-control" /></td>
						</tr>
					<tbody>
					</tbody>
				
				</table>
				
			</div>
		</div>

      </fieldset>
    </div>
    <div class="col-md-12 mt-3 border_wrap">
      <fieldset>
        <legend class="legend-blue-color">गाउँपालिकाको बिध्यमान आयआर्जन तथा जीविकोपार्जनका क्रियाकलापहरु </legend>
        <div class="form-group">
			<div class="col-md-12 table-responsive">
				<table class="table">
					<thead>
						<th>क्रियाकलापहरु </th>
						<th>घरधुरी </th>
						<th>क्रियाकलापहरु </th>
						<th>घरधुरी </th>
					</thead>
					<tbody>
						<tr>
							<td>तरकारी उत्पादन  </td>
							<td><input value="<?= $data['vegetalble_production_household'];?>"type="number" min="0" name ="vegetalble_production_household" class="form-control"/> </td>
							<td>तरकारी नर्सरी तथा बेर्ना  </td>
							<td><input value="<?= $data['vegetable_narsari_berna_production_household'];?>" type="number" min="0" name="vegetable_narsari_berna_production_household" class="form-control"/> </td>
						</tr>
						<tr>
							<td>बहुउदेश्य नर्सरी  </td>
							<td><input value="<?= $data['multipurpose_narsari_household'];?>" type="number" min="0" name="multipurpose_narsari_household" class="form-control"/> </td>
							<td>मसला खेति(अदुवा, खुर्सानी आदि ) </td>
							<td><input value="<?= $data['masala_khetif_household'];?>" type="number" min="0" name="masala_khetif_household" class="form-control"/> </td>
						</tr>
						<tr>
							<td>बिउ उत्पादन(तरकारी ,अन्न बाली )  </td>
							<td><input value="<?= $data['seed_production_household'];?>" type="number" min="0" name="seed_production_household" class="form-control"/> </td>
							<td>च्याउ खेति उत्पादन   </td>
							<td><input value="<?= $data['mushroom_production_household'];?>" type="number" min="0" name="mushroom_production_household" class="form-control"/> </td>
						</tr>
						<tr>
							<td>बाख्रा पालन </td>
							<td><input value="<?= $data['goat_household'];?>" type="number" min="0" name="goat_household" class="form-control"/> </td>
							<td>कुखुरा पालन </td>
							<td><input value="<?= $data['chicken_household'];?>" type="number" min="0" name="chicken_household" class="form-control"/> </td>
						</tr>
						<tr>
							<td>दुग्ध उत्पादन   </td>
							<td><input value="<?= $data['milk_household'];?>" type="number" min="0" name="milk_household" class="form-control"/> </td>
							<td>धागो उत्पादन (रम्बास /केतुकी, भिमल) आदि </td>
							<td><input value="<?= $data['dhogo_household'];?>" type="number" min="0" name="dhogo_household" class="form-control"/> </td>
						</tr>
						<tr>
							<td>गुन्द्री बुन्ने कार्य  </td>
							<td><input value="<?= $data['gundri_bune_household'];?>" type="number" min="0" name="gundri_bune_household" class="form-control"/> </td>
							<td>माहुरी पालन गर्ने</td>
							<td><input value="<?= $data['bee_household'];?>" type="number" min="0" name="bee_household" class="form-control"/> </td>
						</tr>
						<tr>
							<td>फलफूल खेति गर्ने</td>
							<td><input value="<?= $data['fruit_household'];?>" type="number" min="0" name="fruit_household" class="form-control"/> </td>
							<td>अचार उत्पादन गर्ने </td>
							<td><input value="<?= $data['pickle_hosehold'];?>" type="number" min="0" name="pickle_hosehold" class="form-control"/> </td>
						</tr>
						<tr>
							<td>जुत्ता बनाउने </td>
							<td><input value="<?= $data['shoes_production_household'];?>" type="number" min="0" name="shoes_production_household" class="form-control"/> </td>
							<td>एग्रो भेट पसल </td>
							<td><input value="<?= $data['agrovet_household'];?>" type="number" min="0" name="agrovet_household" class="form-control"/> </td>
						</tr>
						<tr>
							<td>बिजुली पसल </td>
							<td><input value="<?= $data['electirc_shop_household'];?>" type="number" min="0" name="electirc_shop_household" class="form-control"/> </td>
							<td>फलाम तथा आरनको काम </td>
							<td><input value="<?= $data['iron_work_household'];?>" type="number" min="0" name="iron_work_household" class="form-control"/> </td>
						</tr>
						<tr>
							<td>खुद्रा बिक्रेता </td>
							<td><input value="<?= $data['retailer_household'];?>" type="number" min="0" name="retailer_household" class="form-control"/> </td>
							<td>होटल ब्यबसाय </td>
							<td><input value="<?= $data['hotel_business_household'];?>" type="number" min="0" name="hotel_business_household" class="form-control"/> </td>
						</tr>
						<tr>
							<td>गैर कास्ट बैनपैदवारहरु </td>
							<td><input value="<?= $data['non_wood_forest_resource_household'];?>" type="number" min="0" name="non_wood_forest_resource_household" class="form-control"/> </td>
							<td>अन्य</td>
							<td><input value="<?= $data['other_household'];?>" type="number" min="0" name="other_household" class="form-control"/> </td>
						</tr>
					</tbody>
				</table>
			
			</div>
		</div>
		</fieldset>
		</div>
		
    <div class="col-md-12 mt-3 border_wrap">
      <fieldset>
        <legend class="legend-blue-color">बिगत १ वर्षको बसाईसराई सम्बन्धि तथ्यांक(रोजगारी तथा कामको खोजीमा)</legend>
        <div class="form-group">
          <div class="col-md-12 table-responsive">
			<table class="table">
			<thead>
			<th> कहाँ  </th>
			<th>ब्यतिको को संख्या(अनुमानित ) </th>
			<th>किन </th>
			<th>कति महिना </th>
			</thead>
			<tbody>
			<tr>
				<td> भारत(अस्थाई) </td>
				<td><input value="<?= $data['india_person_no'];?>" type="number" min="0" name="india_person_no" class="form-control"/> </td>
				<td><input value="<?= $data['india_why'];?>" type="text" name="india_why" class="form-control"/></td>
				<td><input value="<?= $data['india_how_month'];?>" type="text" name="india_how_month" class="form-control"/></td>
			</tr>
			<tr>
				<td>अन्य देशहरु(भारत बाहेक) </td>
				<td><input value="<?= $data['other_country_person_no'];?>" type="number" min="0" name="other_country_person_no" class="form-control"/> </td>
				<td><input value="<?= $data['other_country_why'];?>" type="text" name="other_country_why" class="form-control"/></td>
				<td><input value="<?= $data['other_country_how_month'];?>" type="text" name="other_country_how_month" class="form-control"/></td>
			</tr>
			<tr>
				<td> अन्य जिल्ला </td>
				<td><input value="<?= $data['other_district_person_no'];?>" type="number" min="0" name="other_district_person_no" class="form-control"/> </td>
				<td><input value="<?= $data['other_district_why'];?>" type="text" name="other_district_why" class="form-control"/></td>
				<td><input value="<?= $data['other_district_how_month'];?>" type="text" name="other_district_how_month" class="form-control"/></td>
			</tr>	
			
			</tbody>
			
			
			</table>		  
		  </div>
        </div>
      </fieldset>
    </div>
	<div class="col-md-12 mt-3 border_wrap">
      <fieldset>
        <legend class="legend-blue-color">कृषिको बारेमा जानकारी </legend>
        <div class="form-row ">

          <div class="col-md-2 mr-3 mt-3">
          <label for="household_use_crop" class="control-label">घरायसी प्रयोग </label>
            <input value="<?= $data['household_use_crop'];?>" type="text" name="household_use_crop" id="household_use_crop" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
          <label for="business_purpose_crop" class="control-label">ब्यबसायिक प्रयोग </label>
          
            <input value="<?= $data['business_purpose_crop'];?>" type="text" name="business_purpose_crop" id="business_purpose_crop" class="form-control"/>
          </div>
        
          <div class="col-md-3 mr-3 mt-3">
          <label for="income_business_purpose_crop" class="control-label">ब्यबसायिक बालीबाट एक वर्षको आम्दानी</label>
            <input value="<?= $data['income_business_purpose_crop'];?>" type="number" min="0" name="income_business_purpose_crop" id="income_business_purpose_crop" class="form-control" style="width: 200px;" />
          </div>

          <div class="col-md-2 mr-3 mt-3">
		  <label for="vegetable_kheti" class="control-label">तरकारी खेति </label><br>
            <input value="<?= $data['vegetable_kheti'];?>" type="radio" name="vegetable_kheti" value="छ"/> छ <input type="radio"  value="छैन" name="vegetable_kheti" checked="checked"/> छैन
          </div>
		  
		  <div class="col-md-2 mr-3 mt-3">
		  <label for="household_use_vegetable" class="control-label">घरायसी प्रयोग </label>
            <input value="<?= $data['household_use_vegetable'];?>" type="text" name="household_use_vegetable" id="household_use_vegetable" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
          <label for="business_purpose_vegetable" class="control-label">ब्यबसायिक प्रयोग </label>
            <input value="<?= $data['business_purpose_vegetable'];?>" type="text" name="business_purpose_vegetable" id="business_purpose_vegetable" class="form-control"/>
          </div>
		  
		  <div class="col-md-4 mr-3 mt-3">
		  <label for="income_business_purpose_vegetable" class="control-label">ब्यबसायिक तरकारी खेतीबाट एक वर्षको आम्दानी</label>
            <input value="<?= $data['income_business_purpose_vegetable'];?>" type="number" min="0" name="income_business_purpose_vegetable" id="income_business_purpose_vegetable" class="form-control" style="width: 200px;" />
          </div>
		  
		  <div class="col-md-2 mr-3 mt-3">
		   <label for="fruit_crop" class="control-label">फलफूल खेति </label><br>
            <input type="radio" name="fruit_crop" value="छ"/> छ <input type="radio" value="छैन" name="fruit_crop" checked="checked"/> छैन
          </div>

		  <div class="col-md-2 mr-3 mt-3">
		  <label for="fuirt_household_use" class="control-label">घरायसी प्रयोग </label>
            <input value="<?= $data['fuirt_household_use'];?>" type="text" name="fuirt_household_use" id="fuirt_household_use" class="form-control"/>
          </div>
		 
		 <div class="col-md-2 mr-3 mt-3">
		  <label for="business_purpose_fruit" class="control-label">ब्यबसायिक प्रयोग </label>
            <input value="<?= $data['business_purpose_fruit'];?>" type="text" name="business_purpose_fruit" id="business_purpose_fruit" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
		  <label for="income_business_purpose_fruit" class="control-label">ब्यबसायिक फलफूल खेतीबाट एक वर्षको आम्दानी</label>
            <input value="<?= $data['income_business_purpose_fruit'];?>" type="number" min="0" name="income_business_purpose_fruit" id="income_business_purpose_fruit" class="form-control"/>
          </div>
		  
		  <div class="col-md-2 mr-3 mt-3">
		  <label for="vegetable_fuirt_market_probablity" class="control-label">तरकारी र फलफूलको लागि बजार सम्भावना </label>
            <select name="vegetable_fuirt_market_probablity" id="vegetable_fuirt_market_probablity" class="form-control">
            	<option value="<?php echo $data['vegetable_fuirt_market_probablity'];?>"><?php echo $data['vegetable_fuirt_market_probablity'];?>
			<option>छ</option>
			<option>छैन</option>
			</select>
		</div>
			
          <div class="col-md-3 mr-3 mt-3">
		  <label for="benefitable_animal_business" class="control-label">ब्यबसायिक रुपमा पशुपालनको लागि उपयुक्त जनावर  </label>
            <input value="<?= $data['benefitable_animal_business'];?>" type="text" name="benefitable_animal_business" id="benefitable_animal_business" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
		  <label for="probablity_non_wooden_source" class="control-label">जडीबुटी को उपलब्धता</label>
            <input value="<?= $data['probablity_non_wooden_source'];?>" type="text" name="probablity_non_wooden_source" id="probablity_non_wooden_source" class="form-control mt-4"/>
          </div>

		  <div class="col-md-2 mr-3 mt-3">
		  <label for="nearest_market_jadibuti" class="control-label">जडीबुटी बिक्रीको लागि नजिकको बजार </label>
            <input value="<?= $data['nearest_market_jadibuti'];?>" type="text" name="nearest_market_jadibuti" id="nearest_market_jadibuti" class="form-control"/>
          </div>
		
		  <div class="col-md-2 mr-3 mt-3">
			<label for="others" class="control-label">अन्य </label>
            <input value="<?= $data['others'];?>" type="text" name="others" id="others" class="form-control"/>
          </div>

		  </div>
      </fieldset>
    </div>
	
	<div class="col-md-12 mt-3 border_wrap">
      <fieldset>
        <legend class="legend-blue-color">आम्दानीका अन्य श्रोतहरु (कृषि र सेवा बाहेक )</legend>

        <div class="form-row">
          <div class="col-md-2 mr-3 mt-3">
          <label for="export_materials" class="control-label">निर्यात सामग्रीहरु </label>
            <input value="<?= $data['export_materials'];?>" type="text" name="export_materials" id="export_materials" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
          <label for="micro_industry" class="control-label">लघु तथा साना उधोग </label>
            <input value="<?= $data['micro_industry'];?>" type="text" name="micro_industry" id="micro_industry" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
          <label for="retail_shop" class="control-label">खुद्रा पसलहरु </label>
            <input value="<?= $data['retail_shop'];?>" type="number" min="0" name="retail_shop" id="retail_shop" class="form-control"/>
          </div>

        
        <div class="col-md-2 mr-3 mt-3">
          <label for="hotel_resturant" class="control-label">होटल तथा रेस्टुरेन्ट </label>
            <input value="<?= $data['hotel_resturant'];?>" type="number" min="0" name="hotel_resturant" id="hotel_resturant" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
		  <label for="haat_bazzar" class="control-label">हाट बजार  </label>
            <input value="<?= $data['haat_bazzar'];?>" type="number" min="0" name="haat_bazzar" id="haat_bazzar" class="form-control"/>
          </div>
 
          <div class="col-md-2 mr-3 mt-3">
		  <label for="loan_source" class="control-label">ऋण लिने श्रोत </label>
           <select class="form-control" id="loan_source" name="loan_source">
           <option value="<?php echo $data['loan_source'];?>"><?php echo $data['loan_source'];?>
			<option> बैक </option>
			<option>सहकारी </option>
			<option>सामुदायिक सस्था  </option>
			<option>साहु महाजन </option>
		   </select>
          </div>
        
		<div class="col-md-2 mr-3 mt-3">
          <label for="bank_loan_rate" class="control-label">औसत रुपमा बैंक ब्याजदर </label>
            <input value="<?= $data['bank_loan_rate'];?>" type="text" name="bank_loan_rate" id="bank_loan_rate" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
          <label for="co_opertaive_loan_rate" class="control-label">सहकारी ब्याजदर </label>
            <input value="<?= $data['co_opertaive_loan_rate'];?>" type="text" name="co_opertaive_loan_rate" id="co_opertaive_loan_rate" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
          <label for="rich_people_loan_rate" class="control-label">साहु महाजनले  लिने ब्याजदर  </label>
            <input value="<?= $data['rich_people_loan_rate'];?>" type="text" name="rich_people_loan_rate" id="rich_people_loan_rate" class="form-control"/>
          </div>
       
         <div class="col-md-2 mr-3 mt-3">
          <label for="nearest_lagre_bazzar" class="control-label">नजिकको ठुलो बजारको नाम </label>
            <input value="<?= $data['nearest_lagre_bazzar'];?>" type="text" name="nearest_lagre_bazzar" id="nearest_lagre_bazzar" class="form-control"/>
          </div>

          <div class="col-md-2 mr-3 mt-3">
          <label for="large_bazzar_distance" class="control-label">नजिकको बजारको दुरी  </label>
            <input value="<?= $data['large_bazzar_distance'];?>" type="text" name="large_bazzar_distance" id="large_bazzar_distance" class="form-control"/>
          </div>          
        
        </div>
      </fieldset>
    </div>
	<div class="col-md-12 mt-3 border_wrap">
      <fieldset>
        <legend class="legend-blue-color">गाबिस स्तारमा उपलब्ध स्थानिय सामग्रीहरु </legend>
		<div class="form-group">
			<div class="col-md-12 table-responsive">
				<table class="table">
					<thead>
						<th> समाग्रीहरु  </th>
						<th>गा.बि.स. भित्र वा बाहिर </th>
						<th> कहाँ(ठाउँको नाम )</th>
						<th> पर्याप्त वा अपर्याप्त  </th>
						<th>ढुवानीको लागी आबसेक समय (घण्टा)</th>
					</thead>
					<tbody> 
					<tr>
						<td>ढुंगा </td>
						<td><input value="<?= $data['stone_inside_outside_vdc'];?>" type="text" name="stone_inside_outside_vdc" class="form-control"/></td>
						<td><input value="<?= $data['stone_place_name'];?>" type="text" name="stone_place_name" class="form-control"/> </td>
						<td><input value="<?= $data['stone_sufficient'];?>" type="text" name="stone_sufficient" class="form-control"/> </td>
						<td><input value="<?= $data['stone_carriage_required_hour'];?>" type="number" step="any" min="0" name="stone_carriage_required_hour" class="form-control"/> </td>
					</tr>
					<tr>
						<td>बालुवा  </td>
						<td><input value="<?= $data['sand_inside_outside_vdc'];?>" type="text" name="sand_inside_outside_vdc" class="form-control"/></td>
						<td><input value="<?= $data['sand_place_name'];?>" type="text" name="sand_place_name" class="form-control"/> </td>
						<td><input value="<?= $data['sand_sufficient'];?>" type="text" name="sand_sufficient" class="form-control"/> </td>
						<td><input value="<?= $data['sand_cariage_required'];?>" type="number" step="any" min="0" name="sand_cariage_required" class="form-control"/> </td>
					</tr>
					<tr>
						<td>काठ</td>
						<td><input value="<?= $data['wood_inside_outside_vdc'];?>" type="text" name="wood_inside_outside_vdc" class="form-control"/></td>
						<td><input value="<?= $data['wood_place_name'];?>" type="text" name="wood_place_name" class="form-control"/> </td>
						<td><input value="<?= $data['wood_sufficient'];?>" type="text" name="wood_sufficient" class="form-control"/> </td>
						<td><input value="<?= $data['wood_cariage_required'];?>" type="number" step="any" min="0" name="wood_cariage_required" class="form-control"/> </td>
					</tr>
					<tr>
						<td>बास</td>
						<td><input value="<?= $data['bamboo_inside_outside_vdc'];?>" type="text" name="bamboo_inside_outside_vdc" class="form-control"/></td>
						<td><input value="<?= $data['bamboo_place_name'];?>" type="text" name="bamboo_place_name" class="form-control"/> </td>
						<td><input value="<?= $data['bamboo_sufficient'];?>" type="text" name="bamboo_sufficient" class="form-control"/> </td>
						<td><input value="<?= $data['bamboo_cariage_requi'];?>" type="number" step="any" min="0" name="bamboo_cariage_requi" class="form-control"/> </td>
					</tr>
					<tr>
						<td>स्लेट घरको छतको लागि प्रयोग </td>
						<td><input value="<?= $data['slet_inside_outside_vdc'];?>" type="text" name="slet_inside_outside_vdc" class="form-control"/></td>
						<td><input value="<?= $data['slet_place_name'];?>" type="text" name="slet_place_name" class="form-control"/> </td>
						<td><input value="<?= $data['slet_sufficient'];?>" type="text" name="slet_sufficient" class="form-control"/> </td>
						<td><input value="<?= $data['slet_carriage_requied'];?>" type="number" step="any" min="0" name="slet_carriage_requied" class="form-control"/> </td>
					</tr>
					<tr>
						<td>अन्य </td>
						<td><input value="<?= $data['other_inside_outside_vdc'];?>" type="text" name="other_inside_outside_vdc" class="form-control"/></td>
						<td><input value="<?= $data['others_place_name'];?>" type="text" name="others_place_name" class="form-control"/> </td>
						<td><input value="<?= $data['others_sufficient'];?>" type="text" name="others_sufficient" class="form-control"/> </td>
						<td><input value="<?= $data['others_carriage_requied'];?>" type="number" step="any" min="0" name="others_carriage_requied" id="others_carriage_requied" class="form-control"/> </td>
					</tr>
					
					</tbody>
				</table>			
			
			</div>
		
		</div>
        
      </fieldset>
    </div>
	<div class="col-md-12 mt-3 border_wrap">
      <fieldset>
        <legend class="legend-blue-color">स्थानिय मानिसहरुको ब्यस्त हुने समय </legend>
		<div class="form-group">
			<div class="col-md-12 table-responsive">
				<table class="table">
					<thead>
					<tr>
						<th rowspan="2">नेपाली महिना  </th>
						<th colspan="2">ब्यस्त समय  </th>
						<th rowspan="2">नेपाली महिना  </th>
						<th colspan="2">ब्यस्त समय  </th>
					</tr>
					<tr>
						<th>पुरुस</th>
						<th>महिला </th>
						<th>पुरुस</th>
						<th>महिला </th>
					
					</tr>
					</thead>
					<tbody> 
					<tr>
						<td>बैशाख  </td>
						<td><input value="<?= $data['baisak_busy_male'];?>" type="text" name="baisak_busy_male" class="form-control"/></td>
						<td><input value="<?= $data['baisak_busy_female'];?>" type="text" name="baisak_busy_female" class="form-control"/> </td>
						<td> जेठ </td>
						<td><input value="<?= $data['jestha_busy_male'];?>" type="text" name="jestha_busy_male" class="form-control"/> </td>
						<td><input value="<?= $data['jestha_busy_female'];?>" type="text" name="jestha_busy_female" class="form-control"/> </td>
					</tr>
					<tr>
						<td>असार </td>
						<td><input value="<?= $data['ashad_busy_male'];?>" type="text" name="ashad_busy_male" class="form-control"/></td>
						<td><input value="<?= $data['ashad_busy_female'];?>" type="text" name="ashad_busy_female" class="form-control"/> </td>
						<td>साउन </td>
						<td><input value="<?= $data['shrawan_busy_male'];?>" type="text" name="shrawan_busy_male" class="form-control"/> </td>
						<td><input value="<?= $data['shrawan_busy_female'];?>" type="text" name="shrawan_busy_female" class="form-control"/> </td>
					</tr>
					<tr>
						<td>भाद्र</td>
						<td><input value="<?= $data['bhadra_busy_male'];?>" type="text" name="bhadra_busy_male" class="form-control"/></td>
						<td><input value="<?= $data['bhadra_busy_female'];?>" type="text" name="bhadra_busy_female" class="form-control"/> </td>
						<td>असोज</td>
						<td><input value="<?= $data['asoj_busy_male'];?>" type="text" name="asoj_busy_male" class="form-control"/> </td>
						<td><input value="<?= $data['asoj_busy_female'];?>" type="text" name="asoj_busy_female" class="form-control"/> </td>
					</tr>
					<tr>
						<td>कार्तिक</td>
						<td><input value="<?= $data['kartik_busy_male'];?>" type="text" name="kartik_busy_male" class="form-control"/></td>
						<td><input value="<?= $data['kartik_busy_female'];?>" type="text" name="kartik_busy_female" class="form-control"/> </td>
						<td>मंसिर</td>
						<td><input value="<?= $data['mangsir_busy_male'];?>" type="text" name="mangsir_busy_male" class="form-control"/> </td>
						<td><input value="<?= $data['mangsir_busy_female'];?>" type="text" name="mangsir_busy_female" class="form-control"/> </td>
					</tr>
					<tr>
						<td>पुस</td>
						<td><input value="<?= $data['poush_busy_male'];?>" type="text" name="poush_busy_male" class="form-control"/></td>
						<td><input value="<?= $data['poush_busy_female'];?>" type="text" name="poush_busy_female" class="form-control"/> </td>
						
						<td>माघ</td>
						<td><input value="<?= $data['magh_busy_male'];?>" type="text" name="magh_busy_male" class="form-control"/> </td>
						<td><input value="<?= $data['magh_busy_female'];?>" type="text" name="magh_busy_female" class="form-control"/> </td>
					</tr>
					<tr>
						<td>फाल्गुन</td>
						<td><input value="<?= $data['falgun_busy_male'];?>" type="text" name="falgun_busy_male" class="form-control"/></td>
						<td><input value="<?= $data['falgun_busy_female'];?>" type="text" name="falgun_busy_female" class="form-control"/> </td>
						<td>चैत्र</td>
						<td><input value="<?= $data['chaitra_busy_male'];?>" type="text" name="chaitra_busy_male" class="form-control"/> </td>
						<td><input value="<?= $data['chaitra_busy_femaile'];?>" type="text" name="chaitra_busy_femaile" class="form-control"/> </td>
					</tr>					
					</tbody>
				</table>		
			</div>		
		</div>        
      </fieldset>
    </div>
	
	<input type="hidden" name="rec_id" value="<?= $y; ?>">
	
    <div class="col-md-7 offset-5 mt-3">
      <input type="submit" name="save_record" class="btn btn-success top-buffer bottom-buffer" value="सेभ गर्नुहोस"/>
      <input type="reset" name="reset_form" class="btn btn-danger top-buffer bottom-buffer" value="रद गर्नुहोस"/>
            
            </div>
  </form>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
	$("#add_festival").click(function(){
		
		var new_festival = '<div class="form-row new_added_festival">'+
		'<div class="col-md-2">\
          <label for="festival_name" class="control-label">चाडपर्बहरुको नाम</label>\
            <input type="text" name="festival_name[]" id="festival_name" class="form-control"/>\
          </div>\
          <div class="col-md-4">\
          <label for="attendance_condition_festival_time" class="control-label">चाडपर्बको समयमा समुदायका काममा उपस्थित हुने अवस्था</label>\
          \
            <select class="form-control col-md-6 ml-5" id="attendance_condition_festival_time" name="attendance_condition_festival_time[]">\
              <option> छ </option>\
              <option> छैन </option>\
            </select>\
          </div>\
\
          <div class="col-md-4">\
          <label for="effect_working_days" class="control-label">उक्त चाडपर्वले समाजिक कार्यमा असर पार्ने जम्मा दिन</label>\
            <input type="number" min="0" name="effect_working_days[]" id="effect_working_days" class="form-control col-md-6 ml-5"/>\
          </div>\
\
          <div class="col-md-1">\
          <label for="months" class="control-label col-md-2">महिना</label>\
            <input type="text" name="months[]" id="months" class="form-control"/>\
          </div>\
\
		  <div class="col-md-1 mt-4">\
			<a href="" id="add_festival" class="btn btn-success" title="चाडपर्वहरु थप्नुहोस "><span class="glyphicon glyphicon-plus-sign"> + </span></a>\
		  </div>'+
		'</div>'
		
		$("#more_festival").append(new_festival);
		return false;
	
	});
	$("body").on("click",".remove_festival",function(){		
		$(this).parents(".new_added_festival").remove();		
		return false;
		
	});
	
});
</script>
