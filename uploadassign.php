<?php
$image="";$s=0;
if($_POST['submit'])
{
	$fldname=$_GET['t'];
	if($fldname=="cs")
	{
		$flname="case-studies/studfile";
		$mssg="Case Studies";
	}
	else if($fldname=="a")
	{
		$flname="assignments/studfile";
		$mssg="Assignment";
	}
	else
	{	
		$flname="quiz/studfile";
		$mssg="Exercises/Quizes";
	}
	$image=$_FILES["assignment"]["name"];
	$image= str_replace(' ','',$image);
	if ($_FILES["assignment"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["assignment"]["error"] . "<br />";
	}
	else
	{
		$fnm=explode(".",$image);
		$n=count($fnm);
		for($i=0;$i<$n;$i++)
		{
			if($fname !='')
			{				
				$fname=$fname.'.'.$fnm[$i];	
			}
			else
			{				
				$fname=$fnm[$i].$_POST['studid'];	
			}				
		}
		
		$res=move_uploaded_file($_FILES["assignment"]["tmp_name"],"images/".$flname."/" . $fname);	
	}
	if($res>0)
	{
		$to="registrar@rimsr.in";
		//$to="drsschandra@gmail.com";
		$to1="info@rimsr.in";		
		$subject="Online ".$mssg;
		$msg="Click the below link to download the ".$mssg." <br/> <a href='http://www.rimsr.in/images/".$flname."/" . $fname."'>Download File</a>";
		$from = $email;
		$mailsent=mail("$to","Receipt: $subject","$msg","From: $to1\nContent-type:text/html;");
		if($mailsent>0)
		{
			$s=1;
		   //msg("Applicaiton Posted Successfully","http://www.rimsr.in/");
		}
		else
		{
			$s=0;
			//msg("Process Failed ","http://www.rimsr.in/");
		}
	}
	else
	{
		$s=0;
		//msg("Process Failed ","http://www.rimsr.in/");
	}
}
else
{
	$s=0;
	//msg("Process Failed ","http://www.rimsr.in/");
}
?>
<?php
function msg($msg,$url)
{?>
<script type="text/javascript">
alert ("<?php echo $msg;?>");
window.location="<?php echo $url;?>";
</script>
<?php } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>RIMSR Online Application</title>
<style>
body {
font-family:verdana;
font-size:15px;
}

a {color:#333; text-decoration:none}
a:hover {color:#ccc; text-decoration:none}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#ddd;
  display:none;
}
  
#boxes .window {
  position:absolute;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
}

#boxes #dialog {
  width:600px; 
  height:380px;
  padding:10px;
  background-color:#ffffff;
}


</style>

</head>
<body>
<?php

if($s==1)
{
?>
<script type="text/javascript" src="js/jquery.js"></script>
	<script>
 
$(document).ready(function() {	
	
	//Put in the DIV id you want to display
	launchWindow('#dialog');
	
	//if close button is clicked
	$('.window #close').click(function () {
		$('#mask').hide();
		$('.window').hide();
		window.location="http://www.rimsr.in/";
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
		window.location="http://www.rimsr.in/";
	});			
	

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});	
	
});

function launchWindow(id) {
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height());
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	

} 

</script>
<?php
}
else
{
	msg("Process Failed","http://www.rimsr.in/");
} 
?>
<div id="boxes">
	<div id="dialog" class="window" style="margin-top:150px;">
		<div id="page" class="page" style="width:600px; height:380px; background-color:#7AD8F3; -moz-box-shadow:1px 1px 5px 3px #000;
		  -webkit-box-shadow: 1px 1px 5px 3px #000; box-shadow:1px 1px 5px 3px #000;" align="center">
		  <span class="page" style="width:500px; height:400px;"><img src="images/hand1.png"  /></span>
		  <h2 style="color:#CC3300; font:Geneva; font-weight:bold;">
		  <?php
		  if($fldname=="cs")
		  {
			echo "Your Casestudy is Successfully Submitted. Our Administrative team will contact you soon.";
		  }
		  else if($fldname=="q")
		  {
			echo "Your Exercises/Quiz is Successfully Submitted. Our Administrative team will contact you soon.";
		  }
		  else
		  {
			echo "Your Assignment is Successfully Submitted. Our Administrative team will contact you soon.";
		  }
		  ?>
		  </h2>
		  <span style="float:right;color:blue;">--><a href="http://www.rimsr.in/" style="color:blue;font-family:arial;font-size:12px;font-weight:bold;">Go to Main Page</a></span>
		</div>
	</div>

	<!-- Mask to cover the whole screen -->
	<div id="mask"></div>
</div>

</div>
</body>
</html>