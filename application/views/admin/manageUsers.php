
<?php
	//array constants
	$access_list = $this->config->item('access_list');
echo "<div id=\"musers\">";
echo "<div>";
	if ($users){
		$y = 1;
		echo "<table class=\"mother_table\">";
		echo "<tr><th>No.</th><th>Username</th><th>Access</th><th>Action</th></tr>";
		foreach ($users as $us){
			$formname = "editUser".$y;
			echo form_open('', array('name'=>$formname));
			echo "<tr><td>".$y."</td><td>".$us->uname."</td>";
			echo "<td>".form_dropdown('access', $access_list, $us->access)."</td>";
			echo form_close();
			$a = "document.".$formname;			
			echo "<td><button onclick = \"editUser('".$us->id."', ".$a.".access.options[".$a.".access.selectedIndex].value)\">EDIT</button>";	
			echo "<button onclick = \"deleteUser('".$us->id."')\">DELETE</button></td></tr>";
			$y++;
		}
		echo "</table>";
	}
echo "</div>";
echo "<br/>";
echo "<div>";
echo "<h2>Add New User</h2>";
echo "<table class=\"mother_table\">";
echo form_open('', array('name'=>"addUser"));
echo "<tr><th>User Name</th><th>Password</th><th>Access</th><th>Action</th></tr>";
echo "<tr><td><input type=\"text\" name = \"uname\" size = 20 /></td>";
echo "<td><input type=\"text\" name =\"pword\" size = 20 /></td>";
echo "<td>".form_dropdown('access', $access_list, '1')."</td>";
echo form_close();
$b = "document.addUser";
echo "<td><button onclick = \"addUsers(".$b.".uname.value, ".$b.".pword.value, ".$b.".access.options[".$b.".access.selectedIndex].value)\">ADD</button></td></tr>";
echo "</table>";
echo "</div>";
echo "</div>";
?>
