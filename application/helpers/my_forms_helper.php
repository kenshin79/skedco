<?php
function compute_age($today, $pbd)
    {
	 	    list($ay, $am, $ad) = explode("-",$today);
			list($py, $pm, $pd) = explode("-",$pbd);		
			$YearDiff = $ay - $py;
            $MonthDiff = $am - $pm;
            $DayDiff = $ad - $pd;
            if (($DayDiff < 0 && $MonthDiff == 0) || $MonthDiff < 0) 
              $YearDiff--; 
			return $YearDiff;  
    }
	
function clean_input($orig){
	return str_ireplace(",", "@", $orig);
	
}	

function revert_input($orig){
	return str_ireplace("@", ",", $orig);
}

?>