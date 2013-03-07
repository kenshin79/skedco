<div id="error_log"></div>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$salt = $this->config->item('salt1').$this->config->item('salt2');
		$uname = $this->input->post('username', TRUE);
		$pword = crypt($this->input->post('password', TRUE), $salt);
		
		$verify = $this->Users_model->checkUserPwd($uname, $pword);
		if ($verify == 1){
			$uaccess = $this->Users_model->getAccess($uname, $pword);
			$this->session->set_userdata('login_user', $uname);
			foreach($uaccess as $ua){
				$this->session->set_userdata('user_access', $ua->access);
			}	

			$location = "Location: /skedco/index.php/welcome/admin_page";
			header($location);
		}
		else{
			echo "<script type=\"text/javascript\">";
			echo "document.getElementById(\"error_log\").innerHTML=\"Error: Log-in failed. Please try again.\"";	
			echo "</script>";
		}	
	}

?>

<div id="login_logo"><img src="/skedco/img/skedco.png" alt=""/></div>
<div id="login_form">
<table>	
<form action="" method="post">
<tr><td><label>User Name :</label></td><td><input type="text" name="username"/></td></tr>
<tr><td><label>Password  :</label></td><td><input type="password" name="password"/></td></tr>
</table>
<input type="submit" value=" LOG IN "/><br />
</form>

</div>
<div id="footer"><img src="/skedco/img/homers_seal.png" />programmed by: Dr Homer Uy Co Feb 2013</div>
