<?php
// require_once(dirname(__FILE__) . '/third_party/mpdf60/mpdf.php');

include APPPATH . 'third_party/mpdf60/mpdf.php';

$stylesheet ='

  body{
  line-height: 1.52;
  font-family: "Open Sans", sans-serif;
  font-weight: 400;
}

.headerpdf{
	padding-left:15%;
	margin-bottom:30px;
		padding-bottom:20px

}
.titlepdf , .contentpdf{
	padding-bottom:5%;
  border:1px solid grey;

}
 .titlepdf{
    text-align:center;
    width:40%;
    padding-top:5%;
}
.contentpdf{
  padding-top:5%;
	padding-left:10%;
	padding-bottom:5%;
	width:60%;
	
}
li{
  list-style-type: none;
  font-size:20px;
}
.row {
  border-bottom:1px solid grey;
}

';

$name = 'Aditya';$telPhone='9841254587';$email='test@test.com';
$profile = 'Empty';$gender='male';
$html =  '
	<!DOCTYPE html>
<html>
<head>
	<title>Resume</title>
	
</head>
<body>
 
<table class="headerpdf" style="width:100%">
<tr class="row" style="outline: thin solid">
<td style="width:80%">
 	<div class="name-space" style="text-align:center;">
 		<h1 class="name"> '.$name .'</h1>
 		<h6 class="contact"> Contact: '.$telPhone .'</h6>	
 		<h6 class="Email"> Email: '.$email .'</h6>	
 	</div>
 </td>
<td style="width:20%">
 	<div class="photo" style="">
 		
 		'. $profile .'
 	</div>
 </td>
</table>
 
 	<table class="cv" style="width:100%;">
 
 	  <tr class="row" style="outline: thin solid">
 	  	<td class="titlepdf" > <h1> Personal Info </h1></td>
 	  	<td class="contentpdf ">
 	  		
		    <h4>Gender: '. $gender.'</h4>
        <h4>Address: </h4>
        <h4>Brith Date:</h4>
        <h4>Marital Status:</h4>
 	  		
 	  	</td>
 	  </tr>
 	  <tr class="row" style="outline: thin solid">
 	   	<td class="titlepdf">  <h1> Work Experience </h1></td>
 	   	<td class="contentpdf"> <p></p></td>
 	   </tr>
 	  <tr class="row" style="outline: thin solid">
 	    <td class="titlepdf"> <h1> Education and Training </h1> </td>
 	    <td class="contentpdf"> <p></p></td>
 	   </tr>
 	   <tr class="row" style="outline: thin solid">
 	   	<td class=".titlepdf">  <h1> Personal Skills </h1></td>
 	   	<td class="contentpdf"> 
 	   	  <h3> Language  </h3>
 	   	
 	   	  	
 	   	  		<p></p>
 	   	  	
 	   	   
 	   	  <h3>Technical Skills  </h3>
 	   	  <p></p>
 	   	  <h3> Computer Skills</h3>
 	   	  <p> </p>
 	   	  <h3> Extra Skills</h3>
 	   	  <p> </p>
 	   	</td>
 	   </tr>
 	</table>

</body>
</html>';

ob_start();
$printvalue = ob_get_contents();
ob_end_clean();        
  
 $mpdf = new mPDF();
 $mpdf->WriteHTML($printvalue);

 $mpdf->Output($location . $filename, 'F');
?>