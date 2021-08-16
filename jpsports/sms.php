<?php

													
				$smsmsg = "There are no Bibs or T-Shirts for the IIM Chaos Fun Run.Reporting Time is 6.30am at IIM-A Main Campus";									
				$pass_data = "mobile=9879766651&pass=jpsports@123&senderid=JPEVNT&to="9925039468"&msg=".$smsmsg;

				$url = "http://smsidea.dynasoft.in/sendsms.aspx";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL,$url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $pass_data);
				$data = curl_exec($ch);
				//print_r($data);exit;
				
				if (curl_errno($ch)){
					print curl_error($ch);
				} else {
					curl_close($ch);		
				}
?>
