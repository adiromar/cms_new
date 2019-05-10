<div class="row" style="padding: 25px;">
  <div class="col-md-12">
  <h3 align="center" class="legend-blue-color"> SA-16 - गाउँपालिकाको सामाजिक-आर्थिक जानकारी</h3>
  
   <?php if($this->session->flashdata('post_deleted')):
    echo '<p style="text-align: center" class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>';
  endif; ?>

 <?php if(empty($display_reocrds))
 {?>
	 <div class="alert alert-danger"> Record Doesn't Exists  </div>
 <?php } else { ?>
  <div class="table table-responsive">
	<table border="1" class="table">
		
	<thead bgcolor="#acc">	
		<th>सि. न:</th>
		<th>वडा न:</th>
        <th>मुख्य भाषा</th> 
		<th>मुख्य धर्मीक समुदाय</td>
		<th>पुरुस सक्षरता दर</th>
		<th>महिला सक्षरता दर</th>
		<?php  $user_type = $this->session->userdata("user_type");
			 if($user_type == "admin"){?>
		<th bgcolor="#ccc">रेकर्ड दाखिला गर्नेको नाम </th>
		<?php } ?>
		<th>Content Control </th>
         <?php if($user_type == "verifier"){?>
		<th bgcolor="#ccc" width="75px;">verify</th>
		<?php } ?>
		</thead>
		<tbody>
		<?php foreach($display_reocrds as $data)
		{?>
			<tr>	
				<td><?php echo $data['vdc_socio_economic_id']; ?> </td>	
                <td><?php echo $data['ward_no']; ?> </td>		
				<td><?php echo $data['main_langauge']; ?> </td>
				<td><?php echo $data['main_religion_community']; ?> </td>
				<td><?php echo $data['litterate_rate_male']; ?> </td>				
				<td><?php echo $data['litterate_rate_female']; ?>  </td>
				<?php if($user_type == "Admin" || $user_type == "SuperAdmin"){
					$name = $this->user_model->get_user($data['user_id']);
					$name = $name[0]['user_name'];
					?>
						
						<td><?php echo $name; ?></td>	
				<?php } ?>	
				<td><a href="<?php echo base_url();?>pages/delete_sa18/<?php echo $data['vdc_socio_economic_id'];?>" class="delete-record"> <span class="fas fa-trash"></span></a></td>
                 <?php // if($user_type == "Admin" || $user_type ="SuperAdmin"){
					
					?>
				<td><a href="<?php echo base_url(); ?>pages/sa16_update/<?php echo $data['vdc_socio_economic_id'];?>" onclick="return confirmDelete();" class="fa fa-edit"><span style="color:red" class="glyphicon glyphicon-remove"></span></a></td>
				<?php // } ?>							
																			
			</tr> 
		<?php } ?>
		
		</tbody>	
	</table>
</div>	

<div class="table table-responsive">	
	<table border="1" class="table">
		<legend>मुख्य चाडपर्वहरु </legend>
	<thead bgcolor="#acc">
		<th>सि.नं.</th>	
		<th>चाडपर्बहरुको नाम</th> 
		<th>चाडपर्बको समयमा समुदायका काममा उपस्थित हुने अवस्था</td>
		<th>उक्त चाडपर्वले समाजिक कार्यमा असर पार्ने जम्मा दिन</th>
        <th>महिना</th>
					
		</thead>
		<tbody>
		<?php foreach($festivals as $data)
		{?>
			<tr>	
				<td><?= $data['vdc_socio_economic_id'] ?></td>		
				<td><?php echo $data['festival_name']; ?> </td>
				<td><?php echo $data['attendance_condition_festival_time']; ?> </td>
				<td><?php echo $data['effect_working_days']; ?> </td>
                <td><?php echo $data['months']; ?> </td>																		
			</tr> 
		<?php } ?>
		
		</tbody>	
	</table>
	</div>
	<div class="table table-responsive">
<table border="1" class="table">
		<legend>उपलब्ध सेवाहरु</legend>
	<thead bgcolor="#acc">	
		<th>सेवाहरु </th> 
		<th>उपलब्धता </td>
		<th>संख्या </th>
		<th>सेवा लिनको लागी नजिकको ठाउँ  </th>
		<th>जान लाग्ने समय  </th>
					
		</thead>
		<tbody>
		<?php foreach($display_reocrds as $data)
		{?>
			<tr>
				<td>प्राथमिक बिध्यालय</td> 
				<td><?php echo $data['primary_school_available']; ?> </td>
				<td><?php echo $data['primary_school_no']; ?> </td>
				<td><?php echo $data['primary_school_nearest_palce']; ?> </td>
				<td><?php echo $data['primary_school_nearest_reach_time']; ?> </td>																						
			</tr> 
			<!-- <tr>
				<td>निम्न माध्यमिक बिध्यालय</td> 
				<td><?php echo $data['lower_secondary_school_avaliable']; ?> </td>
				<td><?php echo $data['lower_secondary_school_no']; ?> </td>
				<td><?php echo $data['lower_secondary_school_nearest_place']; ?> </td>
				<td><?php echo $data['lower_secondary_school_reach_time']; ?> </td>																						
			</tr>  -->
			<tr>
				<td>माध्यमिक बिध्यालय</td> 
				<td><?php echo $data['secondary_school_avaliable']; ?> </td>
				<td><?php echo $data['secondary_school_no']; ?> </td>
				<td><?php echo $data['secondary_school_nearest_place']; ?> </td>
				<td><?php echo $data['secondary_school_nearest_reach_time']; ?> </td>																						
			</tr> 
			<tr>
				<td>उच्च माध्यमिक बिध्यालय</td> 
				<td><?php echo $data['higher_secondary_school_avaliable']; ?> </td>
				<td><?php echo $data['higher_secondary_school_no']; ?> </td>
				<td><?php echo $data['higher_secondary_school_nearest_place']; ?> </td>
				<td><?php echo $data['higher_secondary_nearest_reach_time']; ?> </td>																						
			</tr> 
			<tr>
				<td>उप स्वास्थ्य चौकी </td> 
				<td><?php echo $data['sub_health_post_avaliable']; ?> </td>
				<td><?php echo $data['sub_health_post_no']; ?> </td>
				<td><?php echo $data['sub_health_post_nearest_place']; ?> </td>
				<td><?php echo $data['sub_health_post_nearest_reach_time']; ?> </td>																						
			</tr> 
			<tr>
				<td>पशुसेवा केन्द्र </td> 
				<td><?php echo $data['animal_service_center_avaliable']; ?> </td>
				<td><?php echo $data['animal_service_center_no']; ?> </td>
				<td><?php echo $data['animal_service_center_nearest_place']; ?> </td>
				<td><?php echo $data['animal_service_center_nearest_reach_time']; ?> </td>																						
			</tr> 
			<tr>
				<td>कृषि सेवा केन्द्र  </td> 
				<td><?php echo $data['agro_service_avaliable']; ?> </td>
				<td><?php echo $data['agro_service_no']; ?> </td>
				<td><?php echo $data['agro_service_nearest_place']; ?> </td>
				<td><?php echo $data['agro_service_nearest_reach_time']; ?> </td>																						
			</tr> 
			<tr>
				<td>हुलाक कार्यलय   </td> 
				<td><?php echo $data['post_office_avaliable']; ?> </td>
				<td><?php echo $data['post_office_no']; ?> </td>
				<td><?php echo $data['post_office_nearest_place']; ?> </td>
				<td><?php echo $data['post_office_nearest_reach_time']; ?> </td>																						
			</tr> 
			<tr>
				<td>प्रहरी कार्यलय </td> 
				<td><?php echo $data['police_offcie_avaliable']; ?> </td>
				<td><?php echo $data['police_offcie_no']; ?> </td>
				<td><?php echo $data['police_office_nearest_place']; ?> </td>
				<td><?php echo $data['police_offcie_nearest_reach_time']; ?> </td>																						
			</tr> 
			<tr>
				<td>श्रोत केन्द्र</td> 
				<td><?php echo $data['source_center_avaliable']; ?> </td>
				<td><?php echo $data['source_center_no']; ?> </td>
				<td><?php echo $data['source_center_nearest_place']; ?> </td>
				<td><?php echo $data['source_center_nearest_reach_time']; ?> </td>																						
			</tr> 
			<tr>
				<td>बैंक </td> 
				<td><?php echo $data['bank_avaliable']; ?> </td>
				<td><?php echo $data['bank_no']; ?> </td>
				<td><?php echo $data['bank_nearest']; ?> </td>
				<td><?php echo $data['bank_nearest_reach_time']; ?> </td>																						
			</tr>
			<tr>
				<td>सहकारी सस्था </td> 
				<td><?php echo $data['cooperative_avaliable']; ?> </td>
				<td><?php echo $data['cooperative_no']; ?> </td>
				<td><?php echo $data['cooperative_nearest_place']; ?> </td>
				<td><?php echo $data['cooperative_nearest_reach_time']; ?> </td>																						
			</tr>
			<tr>
				<td>टेलिफोन  </td> 
				<td><?php echo $data['telephone_avaliable']; ?> </td>
				<td><?php echo $data['telephone_no']; ?> </td>
				<td><?php echo $data['telephone_nearest_place']; ?> </td>
				<td><?php echo $data['telephone_nearest_reach_time']; ?> </td>																						
			</tr>
			<tr>
				<td>बिधुत प्राधिकरण</td> 
				<td><?php echo $data['electricity_authority_avaliable']; ?> </td>
				<td><?php echo $data['electricity_authority_no']; ?> </td>
				<td><?php echo $data['electricity_authority_nearest_place']; ?> </td>
				<td><?php echo $data['electricity_nearest_reach_time']; ?> </td>																						
			</tr>
			<tr>
				<td>सामुदायिक सस्थाहरु </td> 
				<td><?php echo $data['community_org_avaliable']; ?> </td>
				<td><?php echo $data['community_org_no']; ?> </td>
				<td><?php echo $data['community_org_nearest_place']; ?> </td>
				<td><?php echo $data['community_org_nearest_reach_time']; ?> </td>																						
			</tr>
		<?php } ?>
		
		</tbody>	
	</table>
	</div>
	<div class="table table-responsive">
	<table class="table" border="1">
	<legend>गा.बि.स. दक्ष मानब जनसक्ति बिबरण </legend>
		<thead bgcolor="#acc"> 
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
							<td><?php echo $data["skilled_mistri_wages_daily"];?></td>
							<td><?php echo $data["skilled_mistri_dalit_male"];?></td>
							<td><?php echo $data["skilled_mistri_dalit_female"];?></td>
							<td><?php echo $data["skilled_mistri_janajati_male"];?></td>
							<td><?php echo $data["skilled_mistri_janajati_female"];?></td>
							<td><?php echo $data["skilled_mistri_other_male"];?></td>
							<td><?php echo $data["skilled_mistri_other_female"];?></td>
						</tr>
						<tr>
							<td>मर्मत सम्भार कार्यकर्ता (पानी चौकीदार)</td>
							<td><?php echo $data["maintenance_worker_wages_daily"];?></td>
							<td><?php echo $data["maintenance_worker_dalit_male"];?></td>
							<td><?php echo $data["maintenance_worker_dalit_female"];?></td>
							<td><?php echo $data["maintenance_worker_janajati_male"];?></td>
							<td><?php echo $data["maintenance_worker_janajati_female"];?></td>
							<td><?php echo $data["maintenance_worker_other_male"];?></td>
							<td><?php echo $data["maintenance_worker_other_female"];?></td>
						</tr>
						<tr>
							<td>स्थानिय चप्री निर्माण कार्यकर्ता </td>
							<td><?php echo $data["local_toilet_developer_wages_daily"];?></td>
							<td><?php echo $data["local_toilet_developer_dalit_male"];?></td>
							<td><?php echo $data["local_toilet_developer_dalit_female"];?></td>
							<td><?php echo $data["local_toilet_developer_janajati_male"];?></td>
							<td><?php echo $data["local_toilet_developer_janajati_female"];?></td>
							<td><?php echo $data["local_toilet_developer_other_male"];?></td>
							<td><?php echo $data["local_toilet_developer_other_female"];?></td>
							
						</tr>
						<tr>
							<td>काठको काम गर्ने मिस्त्री  </td>
							<td><?php echo $data["carpenter_wages_daily"];?></td>
							<td><?php echo $data["carpenter_dalit_male"];?></td>
							<td><?php echo $data["carpenter_dalit_female"];?></td>
							<td><?php echo $data["carpenter_janajati_male"];?></td>
							<td><?php echo $data["carpenter_janajati_female"];?></td>
							<td><?php echo $data["carpenter_other_male"];?></td>
							<td><?php echo $data["carpenter_other_female"];?></td>
						</tr>
						<tr>
							<td>बिधुत प्राबिधिक  </td>
							<td><?php echo $data["electrician_wages_daily"];?></td>
							<td><?php echo $data["electrician_dalit_male"];?></td>
							<td><?php echo $data["electrician_dalit_female"];?></td>
							<td><?php echo $data["electrician_janajati_male"];?></td>
							<td><?php echo $data["electrician_janajati_female"];?></td>
							<td><?php echo $data["electrician_other_male"];?></td>
							<td><?php echo $data["electrician_other_female"];?></td>
						</tr>
						<tr>
							<td>आकाशे घैटो बनाउने मिस्त्री   </td>
							<td><?php echo $data["sky_pot_developer_wages_daily"];?></td>
							<td><?php echo $data["sky_pot_developer_dalit_male"];?></td>
							<td><?php echo $data["sky_pot_developer_dalit_female"];?></td>
							<td><?php echo $data["sky_pot_developer_janjati_male"];?></td>
							<td><?php echo $data["sky_pot_developer_janjati_female"];?></td>
							<td><?php echo $data["sky_pot_developer_other_male"];?></td>
							<td><?php echo $data["sky_pot_developer_other_female"];?></td>
						</tr>
						<tr>
							<td> महिला स्वास्थ्य स्वयम सेविका   </td>
							<td><?php echo $data["women_health_volunteer_wages_daily"];?></td>
							<td><?php echo $data["women_health_volunteer_dalit_male"];?></td>
							<td><?php echo $data["women_health_volunteer_dalit_female"];?></td>
							<td><?php echo $data["women_health_volunteer_janajati_male"];?></td>
							<td><?php echo $data["women_health_volunteer_janajati_female"];?></td>
							<td><?php echo $data["women_health_volunteer_other_male"];?></td>
							<td><?php echo $data["women_health_volunteer_other_female"];?></td>
						</tr>
						<tr>
							<td>जलस्रोत प्राबिधिक </td>
							<td><?php echo $data["water_technician_wages_daily"];?></td>
							<td><?php echo $data["water_technician_dalit_male"];?></td>
							<td><?php echo $data["water_technician_dalit_female"];?></td>
							<td><?php echo $data["water_technician_janjati_male"];?></td>
							<td><?php echo $data["water_technician_janajati_female"];?></td>
							<td><?php echo $data["water_technician_other_male"];?></td>
							<td><?php echo $data["water_technician_other_female"];?></td>
						</tr>
						<tr>
							<td>कृषि प्राबिधिक </td>
							<td><?php echo $data["agro_technician_wages_daily"];?></td>
							<td><?php echo $data["agro_technician_dalit_male"];?></td>
							<td><?php echo $data["agro_technician_dalit_female"];?></td>
							<td><?php echo $data["agro_technician_janajati_male"];?></td>
							<td><?php echo $data["agro_technician_janajati_female"];?></td>
							<td><?php echo $data["agro_technician_other_male"];?></td>
							<td><?php echo $data["agro_technician_other_female"];?></td>
						</tr>
						<tr>
							<td> पशु स्वास्थ्य प्राबिधिक </td>
							<td><?php echo $data["animal_health_technician_wages_daily"];?></td>
							<td><?php echo $data["animal_health_technician_dalit_male"];?></td>
							<td><?php echo $data["animal_health_technician_dalit_female"];?></td>
							<td><?php echo $data["animal_health_technician_janajati_male"];?></td>
							<td><?php echo $data["animal_health_technician_janajati_female"];?></td>
							<td><?php echo $data["animal_health_technician_other_male"];?></td>
							<td><?php echo $data["animal_health_technician_other_female"];?></td>
						</tr>
						<tr>
							<td>समाजिक परिचालक </td>
							<td><?php echo $data["social_mobilizer_wages_daily"];?></td>
							<td><?php echo $data["social_mobilizer_dalit_male"];?></td>
							<td><?php echo $data["social_mobilizer_dalit_female"];?></td>
							<td><?php echo $data["social_mobilizer_janajati_male"];?></td>
							<td><?php echo $data["social_mobilizer_janajati_female"];?></td>
							<td><?php echo $data["social_mobilizer_other_male"];?></td>
							<td><?php echo $data["social_mobilizer_other_female"];?></td>
						</tr>
					<tbody>
					</tbody>
				
				</table>
				</div>
				<div class="table table-responsive">				
				<table class="table" border="1">
					<legend>गाबीसको बिध्यमान आयआर्जन तथा जीविकोपार्जनका क्रियाकलापहरु </legend>
					<thead bgcolor="#acc">
						<th>क्रियाकलापहरु </th>
						<th>घरधुरी </th>
						<th>क्रियाकलापहरु </th>
						<th>घरधुरी </th>
					</thead>
					<tbody>
						<tr>
							<td>तरकारी उत्पादन  </td>
							<td><?php echo $data["vegetalble_production_household"];?> </td>
							<td>तरकारी नर्सरी तथा बेर्ना  </td>
							<td><?php echo $data["vegetable_narsari_berna_production_household"];?></td>
						</tr>
						<tr>
							<td>बहुउदेश्य नर्सरी  </td>
							<td><?php echo $data["multipurpose_narsari_household"];?> </td>
							<td>मसला खेति(अदुवा, खुर्सानी आदि ) </td>
							<td><?php echo $data["masala_khetif_household"];?></td>
						</tr>
						<tr>
							<td>बिउ उत्पादन(तरकारी ,अन्न बाली )  </td>
							<td><?php echo $data["seed_production_household"];?></td>
							<td>च्याउ खेति उत्पादन   </td>
							<td><?php echo $data["mushroom_production_household"];?></td>
						</tr>
						<tr>
							<td>बाख्रा पालन </td>
							<td><?php echo $data["goat_household"];?></td>
							<td>कुखुरा पालन </td>
							<td><?php echo $data["chicken_household"];?></td>
						</tr>
						<tr>
							<td>दुग्ध उत्पादन   </td>
							<td><?php echo $data["milk_household"];?></td>
							<td>धागो उत्पादन (रम्बास /केतुकी, भिमल) आदि </td>
							<td><?php echo $data["dhogo_household"];?></td>
						</tr>
						<tr>
							<td>गुन्द्री बुन्ने कार्य  </td>
							<td><?php echo $data["gundri_bune_household"];?></td>
							<td>माहुरी पालन गर्ने</td>
							<td><?php echo $data["bee_household"];?></td>
						</tr>
						<tr>
							<td>फलफूल खेति गर्ने</td>
							<td><?php echo $data["fruit_household"];?></td>
							<td>अचार उत्पादन गर्ने </td>
							<td><?php echo $data["pickle_hosehold"];?></td>
						</tr>
						<tr>
							<td>जुत्ता बनाउने </td>
							<td><?php echo $data["shoes_production_household"];?></td>
							<td>एग्रो भेट पसल </td>
							<td><?php echo $data["agrovet_household"];?></td>
						</tr>
						<tr>
							<td>बिजुली पसल </td>
							<td><?php echo $data["electirc_shop_household"];?></td>
							<td>फलाम तथा आरनको काम </td>
							<td><?php echo $data["iron_work_household"];?></td>
						</tr>
						<tr>
							<td>खुद्रा बिक्रेता </td>
							<td><?php echo $data["retailer_household"];?></td>
							<td>होटल ब्यबसाय </td>
							<td><?php echo $data["hotel_business_household"];?></td>
						</tr>
						<tr>
							<td>गैर कास्ट बैनपैदवारहरु </td>
							<td><?php echo $data["non_wood_forest_resource_household"];?></td>
							<td>अन्य</td>
							<td><?php echo $data["other_household"];?></td>
						</tr>
					</tbody>
				</table>
				</div>
				
				<div class="table table-responsive">				
				<table class="table" border="1">
					<legend>बिगत १ वर्षको बसाईसराई सम्बन्धि तथ्यांक(रोजगारी तथा कामको खोजीमा) </legend>
			<thead bgcolor="#acc">
			<th> कहाँ  </th>
			<th>ब्यतिको को संख्या(अनुमानित ) </th>
			<th>किन </th>
			<th>कति महिना </th>
			</thead>
			<tbody>
			<tr>
				<td> भारत(अस्थाई) </td>
				<td><?php echo $data["india_person_no"];?></td>
				<td><?php echo $data["india_why"];?></td>
				<td><?php echo $data["india_how_month"];?></td>
			</tr>
			<tr>
				<td>अन्य देशहरु(भारत बाहेक) </td>
				<td><?php echo $data["other_country_person_no"];?></td>
				<td><?php echo $data["other_country_why"];?></td>
				<td><?php echo $data["other_country_how_month"];?></td>
			</tr>
			<tr>
				<td> अन्य जिल्ला </td>
				<td><?php echo $data["other_district_person_no"];?></td>
				<td><?php echo $data["other_district_why"];?></td>
				<td><?php echo $data["other_district_how_month"];?></td>
			</tr>	
			
			</tbody>
			
			
			</table>
			</div>
			
			<div class="table table-responsive">
			
			<table class="table" border="1">
			<legend>कृषिको बारेमा जानकारी</legend>
			<thead bgcolor="#acc">
			
			<th>घरायसी प्रयोग </th>
			<th>ब्यबसायिक प्रयोग</th>
			<th>ब्यबसायिक बालीबाट एक वर्षको आम्दानी </th>
			<th>तरकारी खेति </th>
			<th>घरायसी प्रयोग </th>
			<th>ब्यबसायिक प्रयोग </th>
			<th>ब्यबसायिक तरकारी खेतीबाट एक वर्षको आम्दानी </th>
			<th>फलफूल खेति </th>
			<th>घरायसी प्रयोग </th>
			<th>ब्यबसायिक प्रयोग </th>
			<th>ब्यबसायिक फलफूल खेतीबाट एक वर्षको आम्दानी </th>
			<th>तरकारी र फलफूलको लागि बजार सम्भावना  </th>
			<th>ब्यबसायिक रुपमा पशुपालनको लागि उपयुक्त जनावर </th>
			<th>जडीबुटी को उपलब्धता </th>
			<th>जडीबुटी बिक्रीको लागि नजिकको बजार </th>
			<th>अन्य </th>
			</thead>
			<tbody>
			<tr>
				
				<td><?php echo $data["household_use_crop"];?></td>
				<td><?php echo $data["business_purpose_crop"];?></td>
				<td><?php echo $data["income_business_purpose_crop"];?></td>
				<td><?php echo $data["vegetable_kheti"];?></td>
				<td><?php echo $data["household_use_vegetable"];?></td>
				<td><?php echo $data["business_purpose_vegetable"];?></td>
				<td><?php echo $data["income_business_purpose_vegetable"];?></td>
				<td><?php echo $data["fruit_crop"];?></td>
				<td><?php echo $data["fuirt_household_use"];?></td>
				<td><?php echo $data["business_purpose_fruit"];?></td>
				<td><?php echo $data["income_business_purpose_fruit"];?></td>
				<td><?php echo $data["vegetable_fuirt_market_probablity"];?></td>
				<td><?php echo $data["benefitable_animal_business"];?></td>
				<td><?php echo $data["probablity_non_wooden_source"];?></td>
				<td><?php echo $data["nearest_market_jadibuti"];?></td>
				<td><?php echo $data["others"];?></td>
				
				
			</tr>
			
			</tbody>
			
			
			</table>
			</div>
			
			<div class="table table-responsive">
			
			<table class="table" border="1">
			<legend>आम्दानीका अन्य श्रोतहरु (कृषि र सेवा बाहेक )</legend>
			<thead bgcolor="#acc">
			<th>निर्यात सामग्रीहरु  </th>
			<th>लघु तथा साना उधोग </th>
			<th>खुद्रा पसलहरु </th>
			<th>होटल तथा रेस्टुरेन्ट</th>
			<th>हाट बजार </th>
			<th>ऋण लिने श्रोत </th>
			<th>औसत रुपमा बैंक ब्याजदर </th>
			<th>सहकारी ब्याजदर </th>
			<th>साहु महाजनले लिने ब्याजदर </th>
			<th>नजिकको ठुलो बजारको नाम </th>
			<th>नजिकको बजारको दुरी </th>
			</thead>
			<tbody>
			<tr>
				
				<td><?php echo $data["export_materials"];?></td>
				<td><?php echo $data["micro_industry"];?></td>
				<td><?php echo $data["retail_shop"];?></td>
				<td><?php echo $data["hotel_resturant"];?></td>
				<td><?php echo $data["haat_bazzar"];?></td>
				<td><?php echo $data["loan_source"];?></td>
				<td><?php echo $data["bank_loan_rate"];?></td>
				<td><?php echo $data["co_opertaive_loan_rate"];?></td>
				<td><?php echo $data["rich_people_loan_rate"];?></td>
				<td><?php echo $data["nearest_lagre_bazzar"];?></td>
				<td><?php echo $data["large_bazzar_distance"];?></td>
				
			</tr>
			
			</tbody>
			
			
			</table>
			</div>
			
			
			
			
			<div class="table table-responsive">
			<table class="table" border="1">
				<legend>गाबिस स्तारमा उपलब्ध स्थानिय सामग्रीहरु </legend>
					<thead bgcolor="#acc">
						<th> समाग्रीहरु  </th>
						<th>गा.बि.स. भित्र वा बाहिर </th>
						<th> कहाँ(ठाउँको नाम )</th>
						<th> पर्याप्त वा अपर्याप्त  </th>
						<th>ढुवानीको लागी आबसेक समय (घण्टा)</th>
					</thead>
					<tbody> 
					<tr>
						<td>ढुंगा </td>
						<td><?php echo $data["stone_inside_outside_vdc"];?></td>
						<td><?php echo $data["stone_place_name"];?></td>
						<td><?php echo $data["stone_sufficient"];?></td>
						<td><?php echo $data["stone_carriage_required_hour"];?></td>
					</tr>
					<tr>
						<td>बालुवा  </td>
						<td><?php echo $data["sand_inside_outside_vdc"];?></td>
						<td><?php echo $data["sand_place_name"];?></td>
						<td><?php echo $data["sand_sufficient"];?></td>
						<td><?php echo $data["sand_cariage_required"];?></td>
					</tr>
					<tr>
						<td>काठ</td>
						<td><?php echo $data["wood_inside_outside_vdc"];?></td>
						<td><?php echo $data["wood_place_name"];?></td>
						<td><?php echo $data["wood_sufficient"];?></td>
						<td><?php echo $data["wood_cariage_required"];?></td>
					</tr>
					<tr>
						<td>बास</td>
						<td><?php echo $data["bamboo_inside_outside_vdc"];?></td>
						<td><?php echo $data["bamboo_place_name"];?></td>
						<td><?php echo $data["bamboo_sufficient"];?></td>
						<td><?php echo $data["bamboo_cariage_requi"];?></td>
					</tr>
					<tr>
						<td>स्लेट घरको छतको लागि प्रयोग </td>
						<td><?php echo $data["slet_inside_outside_vdc"];?></td>
						<td><?php echo $data["slet_place_name"];?></td>
						<td><?php echo $data["slet_sufficient"];?></td>
						<td><?php echo $data["slet_carriage_requied"];?></td>
					</tr>
					<tr>
						<td>अन्य </td>
						<td><?php echo $data["other_inside_outside_vdc"];?></td>
						<td><?php echo $data["others_place_name"];?></td>
						<td><?php echo $data["others_sufficient"];?></td>
						<td><?php echo $data["others_carriage_requied"];?></td>
					</tr>
					
					</tbody>
				</table>
				</div>
				<div class="table table-responsive">

			<table class="table" border="1">
				<legend>स्थानिय मानिसहरुको ब्यस्त हुने समय</legend>
			
					<thead bgcolor="#acc">
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
						<td><?php echo $data["baisak_busy_male"];?></td>
						<td><?php echo $data["baisak_busy_female"];?></td>
						<td> जेठ </td>
						<td><?php echo $data["jestha_busy_male"];?></td>
						<td><?php echo $data["jestha_busy_female"];?></td>
					</tr>
					<tr>
						<td>असार </td>
						<td><?php echo $data["ashad_busy_male"];?></td>
						<td><?php echo $data["ashad_busy_female"];?></td>
						<td>साउन </td>
						<td><?php echo $data["shrawan_busy_male"];?></td>
						<td><?php echo $data["shrawan_busy_female"];?></td>
					</tr>
					<tr>
						<td>भाद्र</td>
						<td><?php echo $data["bhadra_busy_male"];?></td>
						<td><?php echo $data["bhadra_busy_female"];?></td>
						<td>असोज</td>
						<td><?php echo $data["asoj_busy_male"];?></td>
						<td><?php echo $data["asoj_busy_female"];?></td>
					</tr>
					<tr>
						<td>कार्तिक</td>
						<td><?php echo $data["kartik_busy_female"];?></td>
						<td><?php echo $data["kartik_busy_male"];?></td>
						<td>मंसिर</td>
						<td><?php echo $data["mangsir_busy_male"];?></td>
						<td><?php echo $data["mangsir_busy_female"];?></td>
					</tr>
					<tr>
						<td>पुस</td>
						<td><?php echo $data["poush_busy_male"];?></td>
						<td><?php echo $data["poush_busy_female"];?></td>
						
						<td>माघ</td>
						<td><?php echo $data["magh_busy_male"];?></td>
						<td><?php echo $data["magh_busy_female"];?></td>
					</tr>
					<tr>
						<td>फाल्गुन</td>
						<td><?php echo $data["falgun_busy_male"];?></td>
						<td><?php echo $data["falgun_busy_female"];?></td>
						<td>चैत्र</td>
						<td><?php echo $data["chaitra_busy_male"];?></td>
						<td><?php echo $data["chaitra_busy_femaile"];?></td>
					</tr>					
					</tbody>
				</table>
					</div>
  </div>
 <?php } ?>
 </div>
 </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script>
$(document).ready(function(){
	$(".delete-record").click(function(){
		var check_permission = confirm("Confirm Delete This Data ?");
		if(check_permission == true)
		{
			return true;
		}
		else{
			return false;
		}
	})
})
   
    function confirmDelete(){
       // alert(title);
        var r=confirm("Confirm Delete this Data?")
        if (r==true)
          window.location = url+"pages/delete/"+title+id;
        else
          return false;
        } 

</script>