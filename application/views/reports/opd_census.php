<?php
	if ($opd_census){
		echo "<h3>OPD Census for period ".date("F j, Y", strtotime($date1))." to ".date("F j, Y", strtotime($date2)).".</h3>";
		
		foreach ($opd_count as $opd){

			$total_type = $opd->new + $opd->comx + $opd->preop + $opd->cont; 
			if ($total_type){
			echo "<table id=\"census1\">";				
			echo "<tr><th>Type</th><th>Count</th><th>%Total</th></tr>";	
			echo "<tr><td>New Primary</td><td>".$opd->new."</td><td>".round($opd->new/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Co-managed</td><td>".$opd->comx."</td><td>".round($opd->comx/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Pre-operative</td><td>".$opd->preop."<td>".round($opd->preop/$total_type*100, 2)."</td></td>";
			echo "<tr><td>Continuity</td><td>".$opd->cont."</td><td>".round($opd->cont/$total_type*100, 2)."</td></tr>";
			echo "<tr><th>TOTAL</th><th>".$total_type."</th><th>100%</th></tr>";
			echo "</table>";
			}
			$total_status = $opd->attend + $opd->unattend + $opd->unsched;
			echo "<table id=\"census2\">";
			echo "<tr><th>Status</th><th>Count</th><th>%Total</th></tr>";
			echo "<tr><td>Attended</td><td>".$opd->attend."</td><td>".round($opd->attend/$total_status*100, 2)."</td></tr>";
			echo "<tr><td>Unattended</td><td>".$opd->unattend."</td><td>".round($opd->unattend/$total_status*100, 2)."</td></tr>";
			echo "<tr><td>Unscheduled</td><td>".$opd->unsched."</td><td>".round($opd->unsched/$total_status*100, 2)."</td></tr>";
			echo "<tr><th>TOTAL</th><th>".$total_status."</th><th>100%</th></tr>";
			echo "</table>";
			
			$total_sex = $opd->males + $opd->females;
			if($total_sex){
			echo "<table id=\"census3\">";
			echo "<tr><th>Sex</th><th>Count</th><th>%Total</th></tr>";
			echo "<tr><td>M &lt18</td><td>".$opd->m1."</td><td>".round($opd->m1/$total_sex*100, 2)."</td></tr>";
			echo "<tr><td>M 18 to &lt40</td><td>".$opd->m2."</td><td>".round($opd->m2/$total_sex*100, 2)."</td></tr>";
			echo "<tr><td>M 40 to &lt60</td><td>".$opd->m3."</td><td>".round($opd->m3/$total_sex*100, 2)."</td></tr>";	
			echo "<tr><td>M 60 to &lt80</td><td>".$opd->m4."</td><td>".round($opd->m4/$total_sex*100, 2)."</td></tr>";	
			echo "<tr><td>M &gt80</td><td>".$opd->m5."</td><td>".round($opd->m5/$total_sex*100, 2)."</td></tr>";			
			echo "<tr><td>F &lt18</td><td>".$opd->f1."</td><td>".round($opd->f1/$total_sex*100, 2)."</td></tr>";
			echo "<tr><td>F 18 to &lt40</td><td>".$opd->f2."</td><td>".round($opd->f2/$total_sex*100, 2)."</td></tr>";
			echo "<tr><td>F 40 to &lt60</td><td>".$opd->f3."</td><td>".round($opd->f3/$total_sex*100, 2)."</td></tr>";	
			echo "<tr><td>F 60 to &lt80</td><td>".$opd->f4."</td><td>".round($opd->f4/$total_sex*100, 2)."</td></tr>";	
			echo "<tr><td>F &gt80</td><td>".$opd->f5."</td><td>".round($opd->f5/$total_sex*100, 2)."</td></tr>";	
			echo "<tr><th>TOTAL</th><th>".$total_sex."</th><th>100%</th></tr>";															
			echo "</table>";
			}

		if($total_type){	
		echo "<table id=\"census4\">";
			echo "<tr><th>Source</th><th>Count</th><th>%Total</th></tr>";
			echo "<tr><td>Walk-in</td><td>".$opd->walkin."</td><td>".round($opd->walkin/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>ER</td><td>".$opd->er."</td><td>".round($opd->er/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Ward</td><td>".$opd->ward."</td><td>".round($opd->ward/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Continuity</td><td>".$opd->cont2."</td><td>".round($opd->cont2/$total_type*100, 2)."</td></tr>";		
			echo "<tr><td>CI</td><td>".$opd->ci."</td><td>".round($opd->ci/$total_type*100, 2)."</td></tr>";			
			echo "<tr><td>Dent</td><td>".$opd->dent."</td><td>".round($opd->dent/$total_type*100, 2)."</td></tr>";	
			echo "<tr><td>OBGYN</td><td>".$opd->ob."</td><td>".round($opd->ob/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Ortho</td><td>".$opd->ortho."</td><td>".round($opd->ortho/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Psych</td><td>".$opd->psych."</td><td>".round($opd->psych/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Burn</td><td>".$opd->burn."</td><td>".round($opd->burn/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Surgery</td><td>".$opd->surgery."</td><td>".round($opd->surgery/$total_type*100, 2)."</td></tr>";
		echo "</table>";			

		echo "<table id=\"census5\">";
			echo "<tr><th>Source</th><th>Count</th><th>%Total</th></tr>";
			echo "<tr><td>NSS</td><td>".$opd->nss."</td><td>".round($opd->nss/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Neuro</td><td>".$opd->neuro."</td><td>".round($opd->neuro/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Plastic</td><td>".$opd->plastic."</td><td>".round($opd->plastic/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Urology</td><td>".$opd->uro."</td><td>".round($opd->uro/$total_type*100, 2)."</td></tr>";		
			echo "<tr><td>TCVS</td><td>".$opd->tcvs."</td><td>".round($opd->tcvs/$total_type*100, 2)."</td></tr>";			
			echo "<tr><td>ORL</td><td>".$opd->orl."</td><td>".round($opd->orl/$total_type*100, 2)."</td></tr>";	
			echo "<tr><td>Ophtha</td><td>".$opd->ophtha."</td><td>".round($opd->ophtha/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Family Med</td><td>".$opd->fm."</td><td>".round($opd->fm/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Pedia</td><td>".$opd->pedia."</td><td>".round($opd->pedia/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Rehab</td><td>".$opd->rehab."</td><td>".round($opd->rehab/$total_type*100, 2)."</td></tr>";
		echo "</table>";		
						

		}	
			
		}
		$period_list = $this->config->item('period_list');
		$y = 1;
		echo "<table id=\"census6\">";
		echo "<tr><th>No.</th><th>Date of Appointment</th><th>Resident in Charge</th><th>Patient</th><th>Case Number</th><th>Type</th><th>Source</th><th>Diagnosis</th><th>Status</th></tr>";
		$type_list = $this->config->item('type_list');
		$source_list = $this->config->item('source_list');
		$app_status_list = $this->config->item('app_status_list');
		foreach ($opd_census as $oc){
			if ($oc->status == 1){
			echo "<tr><td>".$y."</td>";
			echo "<td>".date('m/d/Y', strtotime($oc->app_date))." - ".$period_list[$oc->period]."</td>";
			echo "<td>".$oc->rname."</td>";
			echo "<td>".strtoupper($oc->pname)." ".compute_age($oc->app_date, $oc->birthdate)."/".$oc->sex."</td>";				
			echo "<td>".$oc->casenumber."</td>";
			echo "<td>".$type_list[$oc->type]."</td>";
			echo "<td>".$source_list[$oc->source]."</td>";
			echo "<td><textarea readonly=\"readonly\" cols = \"15\" rows = \"3\" >".revert_input($oc->dx)."</textarea>";
			echo "<td>".$app_status_list[$oc->status]."</td></tr>";
			$y++;
			}		
		}
		echo "</table>";
	}
	else{
		echo "<h3>No Appointments from ".$date1." to ".$date2.".</h3>";
		
	}
	
?>

		

