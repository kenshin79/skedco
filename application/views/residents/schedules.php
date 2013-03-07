    <script type="text/javascript">
      $(document).ready(function() {
      		prepViewSchedule();
      });
    </script>

<h2>1BO4 General Medicine Clinic Schedules</h2>
<br/>
<table>
	<tr><th colspan = 5>AM Clinic 8AM-12NN</th></tr>
	<tr>
		<td>
		<table>

			<tr><th>Monday</th></tr>
		<?php
			foreach ($monday1 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}
		?>
		</table>	
		</td>
		<td>
		<table>	
			<tr><th>Tuesday</th></tr>
		
		<?php
			foreach ($tuesday1 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}		
		?>
		</table>				
		</td>
		<td>
		<table>
			<tr><th>Wednesday</th></tr>
		<?php
			foreach ($wednesday1 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}		
		?>
		</table>					
		</td>		
		<td>
		<table>
			<tr><th>Thursday</th></tr>
		<?php
			foreach ($thursday1 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}		
		?>
		</table>				
		</td>
		<td>
		<table>
			<tr><th>Friday</th></tr>
		<?php
			foreach ($friday1 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}		
		?>
		</table>					
		</td>
	</tr>
</table>			
<table>
	<tr><th colspan="5">PM Clinic 1PM-5PM</th></tr>
	<tr>
		<td>
		<table>

			<tr><th>Monday</th></tr>			
		<?php
			foreach ($monday2 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}		
		?>
		</table>				
		</td>
		<td>
		<table>
			<tr><th>Tuesday</th></tr>			
		<?php
			foreach ($tuesday2 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}		
		?>
		</table>					
		</td>	
		<td>
		<table>
			<tr><th>Wednesday</th></tr>			
		<?php
			foreach ($wednesday2 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}		
		?>
		</table>					
		</td>
		<td>
		<table>
			<tr><th>Thursday</th></tr>			
		<?php
			foreach ($thursday2 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}		
		?>
		</table>					
		</td>
		<td>
		<table>
			<tr><th>Friday</th></tr>			
		<?php
			foreach ($friday2 as $row){
				echo "<tr><th>".$row->rname."</th></tr>";
				
			}		
		?>
		</table>					
		</td>
	</tr>
</table>

		



