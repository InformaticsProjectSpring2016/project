<?php
	ob_start();
	$menuHighlight = 0;
	$pageTitle="Verify SMS";
	include_once("header.php");
	include_once('UTILITIES/SendSms.php');
?>
<div class ="container">
<div class = "col-xs-12">
	<!-- jumbotron--> 
	<div class="jumbotron">
		<div class="text-center">
			<form id="sms" action="<?php echo "verifySMS.php?number=".$_GET['number'];?>" class="form-horizontal" method="post">
				<input type='hidden' name='Cell' id='Cell' value='<?php if(isset($_GET['number'])){echo $_GET['number'];} if(isset($_POST['number'])){echo $_POST['number'];}?>'/>
				<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label">Registration Code</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" placeholder="Enter the registration code sent to your phone." name="code"/>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-success margin" name="submit">Verify</button>
				<button type="submit" class="btn btn-warning margin" name="resend" value="resend">Re-Send</button>
			</form>
		</div>
	</div>

</div>
</div>


<?php
if(isset($_POST['code']) && $_POST['code'] != 0 ){
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$Cell = $_POST['Cell'];
	$query = "select Token from SMSTokens where Cell = '$Cell';";
	$result = queryDB($query,$db);
	//echo mysqli_fetch_row($result)[0];
	echo "<br>";
	$code = $_POST['code'];
	if(nTuples($result) > 0){
		$row = mysqli_fetch_row($result);
		if($row[0] == $code){
			$query = "UPDATE Users SET Verified ='1' where Phone = '$Cell';";
			$result = queryDB($query,$db);
			$query = "DELETE from SMSTokens where Cell = '$Cell';";
			$result = queryDB($query,$db);
			Echo "<div class='text-center'><div class='alert alert-success animated fadeIn' role='alert'>Congrats! You've Registered, please log in now.</div></div>";
			header("Refresh: 3; url=http://webdev.divms.uiowa.edu/~ngramer/project/login.php?register=1");
		}else{
			echo "<div class='text-center'><div class='alert alert-danger animated fadeIn' role='alert'>This code is incorrect.</div></div>";
		}
	}else{
	//this means we dont have a code for some reason
	$token = SendSMS($Cell);
	echo "problem";
	$query = "insert into SMSTokens (Cell, Token) VALUES ('$Cell','$token');";
	$result = queryDB($query,$db);
	header("Refresh: 1; url=http://webdev.divms.uiowa.edu/~ngramer/project/verifySMS.php?number=".$Cell);
	}
}
if(isset($_POST['resend'])){
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
$Cell = $_GET['number'];
$query = "DELETE from SMSTokens where Cell = '$Cell';";
$result = queryDB($query,$db);
$token = SendSMS($Cell);
$query = "insert into SMSTokens (Cell, Token) VALUES ('$Cell','$token');";
$result = queryDB($query,$db);
header("Refresh: 1; url=http://webdev.divms.uiowa.edu/~ngramer/project/verifySMS.php?number=".$Cell);
}
include_once("footer.php");
ob_flush();
?>