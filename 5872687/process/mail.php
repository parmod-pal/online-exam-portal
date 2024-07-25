<?php
	include "function.php";
	$pid='';$prname='';
	if(isset($_REQUEST['pid']))
	{
		$pid=$_REQUEST['pid'];
	}	
	$ano='';
	if(isset($_REQUEST['ano']))
	{
		$ano=$_REQUEST['ano'];
	}	
	$studlist=selrpt2($pid,$ano);		
	foreach($studlist as $slist)
	{	
		$bal=$slist['payable']-$slist['paid'];	}
		$to=$slist['emailid'];
		$subject='Fee Balance Notification';		
		$from = 'controller@rimsr.in';			
		$msg='<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Fee Balance Notification</title>
			<style type="text/css">
			body
			{
			font-family:Arial, Helvetica, sans-serif;
			font-size:14px;
			letter-spacing:1px;
			line-height:20px;
			}
			#main {
				height: 500px;
				width: 700px;
				margin-top: 0px;
				margin-right: auto;
				margin-bottom: 0px;
				margin-left: auto;
			}
			</style>
			</head>
			<body>
			<div id="main">
			<p>Dear '.$slist['firstname'].'</p>
			<p>This is to inform you that Rs.<font style="text-decoration:underline;font-weight:bold;">'.$bal.'</font> is the balance fee payable. You are requested to pay the aforesaid amount to the \'Controller,\' RIMSR, immediately.</p>
			<p>Please note that in the event the balance fee amount is not paid immediately, your registration is entitled to be cancelled, and in which case you will be unable to access the \'Gateway to PGDPM.\'</p><br/><br/><br/>
				

			With Regards,<br/>
					
			CONTROLLER<br/>
			RIMSR<br/><br/>
			</div>			  
			</body>
			</html>';			
		$mailsent=mail("$to","Receipt: $subject","$msg","From: $from\nReply-To: $from\ncontent-type:text/html");		
		if($mailsent)
		{
			mss("Mail Sent Successfully","../index.php?m=rpt1&a=template");
		}
		else
		{
			mss("Server Error. Try Later...","../index.php?m=rpt1&a=template");
		}
?>
<?php
	function mss($msg,$url)
	{
?>		<script type="text/javascript">
			alert("<?php echo $msg;?>");
			window.location="<?php echo $url;?>";	
		</script>
<?php
	}
?>