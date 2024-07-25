</div>
</div>
<div id="icon" class="icon" style="width:100%;text-align:center;font-size:14px;font-weight:bold;color:#fff;">COPYRIGHT RESERVED RIMSR</div>
</body>
</html>
<!--<script src="js/jquery-1.9.1-min.js"></script>-->
<script type="text/javascript" src="js/ajaxjquerymin.js"></script>
	<script>
		/* !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>'); */
	</script>
	<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script src="js/jquery-ui.js"></script>	
<script>
	$(document).ready(function(){
		$("#moddet").css('display','none');
		$("#dtl").css('display','none');
		$('#admsrch').css('display','none');
		$('#mentsrch').css('display','none');
		//$('#excel').css('display','none');
		$('#dtfrm').css('display','none');
		/* $('#frmprint').css('display','none'); */		
		$('#ps1').css('display','none');
		$('#ps2').css('display','none');
		$('#ps3').css('display','none');
		/* var fln=document.getElementById('rptfile').value;
		if(fln=="rptstdlist")
		{
			$('#excel').css('display','block');
			$('#dtfrm').css('display','block');
		}
		*/
		
	});
	
	function chkps()
	{		
		if(document.getElementById('chkval').value == 0)
		{				
			$.fancybox(document.getElementById('ps1').innerHTML);			
		}
	}
	function delchkps(val)
	{
		document.getElementById('delexp').value=val;			
		$.fancybox(document.getElementById('ps2').innerHTML);			
		
	}
	function delstd(val)
	{
		document.getElementById('delusr').value=val;			
		$.fancybox(document.getElementById('ps3').innerHTML);			
		
	}
	/* $(".rmv").click(function(){
		var strval =this.id;
		var len=strval.length;		
		var eid=strval.substring(1,len);
		var exid=document.getElementById('expid'+eid).value;		
		var sid=document.getElementById('studid').value;
		var pid=document.getElementById('prid').value;
		var URL="process/deleteexp.php?id="+exid+"&s="+sid+"&p="+pid;		
		$.ajax({
		url:URL,
		success:function(){
			$('tr#row'+eid).remove();
			alert("Experiance detail removed");
		}}); 
	}); */
	function delusr()
	{
		var $textbox = $('#fancybox-wrap').find('input[type="password"]'),
        textVal  = $textbox.val();		
		var URL="process/chkpswd.php?f="+textVal;			
		$.ajax({
		url:URL,
		success:function(res){				
			if(res == "fail")
			{
				alert("Invalid Password");
			}
			else if(res == "restrict")
			{
				alert("Permission denied");
			}
			else
			{		
				chkdel('Are you sure want to delete?');					
			} 
		}});
	}
	function chkdel(message)
	{				
		var answer = confirm(message)
		if (answer)
		{					
			var sid =document.getElementById('delusr').value;				
			var URL="process/delete.php?id="+sid;				
			$.ajax({
			url:URL,
			success:function(){	
				window.location.reload(); 			
			}});
			 // This line added			
		}
		
	}
	function delchkusr()
	{
		var $textbox = $('#fancybox-wrap').find('input[type="password"]'),
        textVal  = $textbox.val();		
		var URL="process/chkpswd.php?f="+textVal;			
		$.ajax({
		url:URL,
		success:function(res){		
			if(res == "fail")
			{
				alert("Invalid Password");
			}
			else if(res == "restrict")
			{
				alert("Permission denied");
			}
			else
			{				
				var strval =document.getElementById('delexp').value;
				var len=strval.length;		
				var eid=strval.substring(1,len);
				var exid=document.getElementById('expid'+eid).value;		
				var sid=document.getElementById('studid').value;
				var pid=document.getElementById('prid').value;
				var URL="process/deleteexp.php?id="+exid+"&s="+sid+"&p="+pid;				
				$.ajax({
				url:URL,
				success:function(){
					$('tr#row'+eid).remove();
					alert("Experiance detail removed");
					window.location.reload();
				}});
			} 
		}});
	}
	function chkusr()
	{
		var $textbox = $('#fancybox-wrap').find('input[type="password"]'),
        textVal  = $textbox.val();		
		var URL="process/chkpswd.php?f="+textVal;			
		$.ajax({
		url:URL,
		success:function(res){		
			if(res == "fail")
			{
				alert("Invalid Password");
			}
			else if(res == "restrict")
			{
				alert("Permission denied");
			}
			else
			{
				document.studentinfo.submit();
			} 
		}});
	}
	function toupper(id)
	{
		var data=document.getElementById(id).value.toUpperCase();
		document.getElementById(id).value=data;
	}
	function chkmode(mode)
	{
		var data=document.getElementById('mop').value;
		if(data !="Cash")
		{
			$("#moddet").css('display','block');
			$("#dtl").css('display','block');
		}
		else
		{
			$("#moddet").css('display','none');
			$("#dtl").css('display','none');
		}		
	}	
/**************************************** Report Data Function Start**********************************************/	
	$("#selprg").change(function(){
		var pid=this.value;	
		var cour='';
		var fln=document.getElementById('rptfile').value;
		var URL="";
		$('#frmrpt').css('display','block');
		$('#fadmsrch').css('display','none');
		$('#admsrch').css('display','none');
		$('#mentsrch').css('display','none');
		if(fln=="rpt3a")
		{
			URL="process/rpt3.php?pid="+pid+"&cour=assignment";			
		}
		else if(fln=="rpt3b")
		{
			URL="process/rpt3.php?pid="+pid+"&cour=casestudies";
		}
		else if(fln=="rpt3c")
		{
			URL="process/rpt3.php?pid="+pid+"&cour=tests";			
		}
		else if(fln=="rpt3d")
		{
			URL="process/rpt3.php?pid="+pid+"&cour=examination";			
		}
		else if(fln=="rpt5a")
		{
			URL="process/rpt5.php?pid="+pid+"&r=passed";			
		}
		else if(fln=="rpt5b")
		{
			URL="process/rpt5.php?pid="+pid+"&r=failed";			
		}
		else if(fln=="stdinfo")
		{
			$('#frmrpt').css('display','none');
			$('#admsrch').css('display','block');
			$('#mentsrch').css('display','none');
			$('#fadmsrch').css('display','none');
			URL="process/"+fln+".php";			
		}
		else if(fln=="rpt7")
		{
			$('#frmrpt').css('display','none');
			$('#admsrch').css('display','none');
			$('#mentsrch').css('display','block');
			$('#fadmsrch').css('display','none');
			URL="process/"+fln+".php";			
		}
		else if(fln=="rpt2")
		{
			$('#frmrpt').css('display','block');
			$('#admsrch').css('display','none');
			$('#mentsrch').css('display','none');
			$('#fadmsrch').css('display','block');
			var ano=document.getElementById('fadsrch').value;
			URL="process/"+fln+".php?pid="+pid+"&ano="+ano;			
		}	
		else 
		{
			URL="process/"+fln+".php?pid="+pid;
		}	
		
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});	
	$("#fadmiss").live('click',function(){			
		var ano=document.getElementById('fadsrch').value;	
		var prg=document.getElementById('selprg').value;			
		var URL="process/rpt2.php?ano="+ano+"&pid="+prg;
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});
	$("#dtsrch").live('click',function(){			
		var frm=document.getElementById('frmdt').value;	
		var to=document.getElementById('todt').value;	
		var prg=document.getElementById('selprg').value;
		var fil=document.getElementById('fil').value;
		var URL='';
		if(fil=="studlist")
		{
			URL="process/rptstdlist.php?pid="+prg+"&frm="+frm+"&to="+to;
		}
		else
		{
			URL="process/rpt5.php?pid="+prg+"&frm="+frm+"&to="+to+"&r="+fil;
		}	
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});
	$("#padmiss").live('click',function(){	
		var ano=document.getElementById('padsrch').value;	
		var pr=document.getElementById('selprint').value;
		var URL='';
		if(pr==2)
		{
			URL="process/receipt.php?ano="+ano;
		}
		else if(pr==3)
		{
			URL="process/marksheet.php?ano="+ano;
		}
		else if(pr==4)
		{
			URL="process/provrpt.php?ano="+ano;
		}
		else if(pr==5)
		{
			URL="process/submarksheet.php?ano="+ano;
		}
		else if(pr==6)
		{
			URL="process/welcomeletter.php?ano="+ano;
		}
		else
		{
			URL="process/idcard.php?ano="+ano;
		}		
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});		
	$("#rpadmiss").live('click',function(){	
		var ano=document.getElementById('rpadsrch').value;			
		var URL="process/provrpt.php?rep=1&ano="+ano;				
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});	
	$("#repadmiss").live('click',function(){	
		var rcno=document.getElementById('rpreceipt').value;			
		var URL="process/receipt.php?rno="+rcno;			
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});	
	$("#mentor").change(function(){	
		var ment=this.value;
		var pid=document.getElementById('mselprg').value;		
		var URL="process/rpt7.php?m="+ment+"&pid="+pid;
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});	
	$("#admiss").click(function(){			
		var ano=document.getElementById('adsrch').value;		
		var URL="process/stdinfo.php?ano="+ano;
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});	
	$("#mselprg").change(function(){	
		var pid=this.value;
		var ment=document.getElementById('mentor').value;		
		var URL="process/rpt7.php?m="+ment+"&pid="+pid;
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});	
	$('.sib li a').live('click',function()
	{
		$('.sib li a').removeClass('active');
		$(this).addClass('active');
		$('#frmrpt').css('display','none');
		$('#admsrch').css('display','none');
		$('#fadmsrch').css('display','none');
		$('#mentsrch').css('display','none');
		$('#frmprint').css('display','none');
		$('#excel').css('display','none');
		$('#reprint').css('display','none');
		$('#dtfrm').css('display','none');
		var strval =this.id;
		if(strval !="rpt8" && strval != "rpt9")
		{
			$('#frmrpt').css('display','block');			
			document.getElementById('rptfile').value=strval;	
			var pid=document.getElementById('selprg').value;	
			var cour='';		
			var URL="";
			if(strval=="rpt3a")
			{
				$('#dtfrm').css('display','none');
				URL="process/rpt3.php?pid="+pid+"&cour=assignment";			
			}
			else if(strval=="rpt3b")
			{
				$('#dtfrm').css('display','none');
				URL="process/rpt3.php?pid="+pid+"&cour=casestudies";
			}
			else if(strval=="rpt3c")
			{
				$('#dtfrm').css('display','none');
				URL="process/rpt3.php?pid="+pid+"&cour=tests";			
			}
			else if(strval=="rpt3d")
			{
				$('#dtfrm').css('display','none');
				URL="process/rpt3.php?pid="+pid+"&cour=examination";			
			}
			else if(strval=="rpt5a")
			{
				$('#dtfrm').css('display','block');
				document.getElementById('fil').value="passed";
				URL="process/rpt5.php?pid="+pid+"&r=passed";			
			}
			else if(strval=="rpt5b")
			{
				$('#dtfrm').css('display','block');
				document.getElementById('fil').value="failed";
				URL="process/rpt5.php?pid="+pid+"&r=failed";			
			}
			else if(strval=="rpt2")
			{	
				$('#admsrch').css('display','none');
				$('#fadmsrch').css('display','block');
				$('#mentsrch').css('display','none');
				$('#dtfrm').css('display','none');
				URL="process/"+strval+".php?pid="+pid;			
			}
			else if(strval=="stdinfo")
			{
				$('#frmrpt').css('display','none');
				$('#admsrch').css('display','block');
				$('#mentsrch').css('display','none');
				$('#dtfrm').css('display','none');
				URL="process/"+strval+".php";			
			}
			else if(strval=="rpt7")
			{
				$('#frmrpt').css('display','none');
				$('#admsrch').css('display','none');
				$('#mentsrch').css('display','block');
				$('#dtfrm').css('display','none');
				URL="process/"+strval+".php";			
			}		
			else 
			{
				if(strval=="rptstdlist")
				{
					$('#excel').css('display','block');
					$('#dtfrm').css('display','block');
				}
				else
				{
					$('#excel').css('display','none');
					$('#dtfrm').css('display','none');
				}
				URL="process/"+strval+".php?pid="+pid;
			}		
			$.ajax({
			url:URL,
			success:function(result){
				$("#display").html(result);
			}});
		}
		else if(strval == "rpt9")
		{
			$('#frmrpt').css('display','none');
			$('#admsrch').css('display','none');
			$('#fadmsrch').css('display','none');
			$('#mentsrch').css('display','none');
			$('#frmprint').css('display','none');
			$('#reprint').css('display','block');
			
			window.location="index.php?m=rerpt&a=template";
		}		
		else
		{
			$('#frmrpt').css('display','none');
			$('#admsrch').css('display','none');
			$('#fadmsrch').css('display','none');
			$('#mentsrch').css('display','none');
			$('#frmprint').css('display','block');
			
			window.location="index.php?m=provrpt&a=template";
		}
	}); 
	$("#selprg1").change(function(){
		var pid=this.value;		
		var URL="process/rpt2.php?pid="+pid;
		$.ajax({
		url:URL,
		success:function(result){
			$("#display").html(result);
		}});
	});
/**************************************** Report Data Function End **********************************************/
/****************************************User details function start **********************************************/

$('.usrpro').click(function()
	{		
		$('.usrpro').removeClass('active');
		$(this).addClass('active');
		var strval =this.id;	
		var URL='';	
		if(strval=="vp")
		{
			URL="process/viewprofile.php";			
		}
		else if(strval=="cu")
		{
			URL="process/createusr.php";
		}
		else if(strval=="eu")
		{
			URL="process/viewusr.php";
		}
		else 
		{
			URL="process/changepassword.php";
		}
					
		$.ajax({	
		url:URL,
		success:function(result){			
			$("#display").html(result);
		}});
	}); 

/**************************************** User details function end **********************************************/


	$('.progedit').click(function()
	{		
		$('.progedit').removeClass('active');
		$(this).addClass('active');
		var strval =this.id;			
		var eid=strval.substring(2);
		var URL="process/viewlist.php?pid="+eid;			
		$.ajax({	
		url:URL,
		success:function(result){			
			$("#display").html(result);
		}});
	}); 
	
	$('#anp').click(function()
	{
		var amt=document.getElementById('fpayable').value;
		var bal=document.getElementById('bal').value;
		var pid=document.getElementById('pgrid').value;
		var URL="template/newpayment.php?py="+amt+"&pv="+bal+"&pi="+pid;			
		$.ajax({	
		url:URL,
		success:function(result){			
			$("#pymnt").html(result);
		}});
	}); 
	$('#ena').click(function()
	{	
		var URL="template/newattempt.php";			
		$.ajax({	
		url:URL,
		success:function(result){			
			$("#natmt").html(result);			
			$("#doe").datepicker({ minDate: "-10Y",maxDate:"+10Y", numberOfMonths: 1});
		}});
	});
		
	$(function() 
	{					
			$("#dob").datepicker({ minDate: "-100Y",maxDate:"+0D", numberOfMonths: 1,changeMonth: true,
			changeYear: true });
			/* $("#dob").datepicker({ minDate: "-100Y",maxDate:"+0D", numberOfMonths: 1});	 */
			$("#doi").datepicker({ minDate: "-20Y",maxDate:"+0D", numberOfMonths: 1});	
			$("#valupto").datepicker({ minDate: "+0D",maxDate:"+20Y", numberOfMonths: 1});
			$("#certificate").datepicker({ minDate: "-20Y",maxDate:"+10Y", numberOfMonths: 1});				
			$("#doc").datepicker({ minDate: "-10Y",maxDate:"+10Y", numberOfMonths: 1});
			$("#doa").datepicker({ minDate: "-10Y",maxDate:"+10Y", numberOfMonths: 1});	
			$("#doe").datepicker({ minDate: "-10Y",maxDate:"+10Y", numberOfMonths: 1});	
			$("#frmdt").datepicker({ minDate: "-10Y",maxDate:"+10Y", numberOfMonths: 1});	
			$("#todt").datepicker({ minDate: "-10Y",maxDate:"+10Y", numberOfMonths: 1});	
			var $tbs=$("#wrapper" ).tabs();			
			
			/**************************************disable tab link *********************************/		
		 	$('#ad').css('pointer-events','none');
			$('#fd').css('pointer-events','none');
			$('#sd').css('pointer-events','none');
			$('#eq').css('pointer-events','none');
			$('#ex').css('pointer-events','none'); 
			$('#sstd').css('pointer-events','none'); 
			/**************************************change the left side menu css*********************************/
			$('#pr').click(function() {
				
					$('#cssmenu').css('height','1148');
					$('#ad').removeClass('active');
					$('#pr').addClass('active'); 
					$('#fd').removeClass('active');
					$('#sd').removeClass('active');
					$('#eq').removeClass('active');
					$('#ex').removeClass('active');
					$('#admission').css('display','none');
					$('#perinfo').css('display','block');
					$('#feedet').css('display','none');
					$('#scholastic').css('display','none');
					$('#edu').css('display','none');
					$('#exp').css('display','none');
					$('#sstd').removeClass('active');
					$('#substudied').css('display','none');
					
			});
			$('#ad').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ad').addClass('active');
					$('#pr').removeClass('active'); 
					$('#fd').removeClass('active');
					$('#sd').removeClass('active');
					$('#eq').removeClass('active');
					$('#ex').removeClass('active');
					$('#admission').css('display','block');
					$('#perinfo').css('display','none');
					$('#feedet').css('display','none');
					$('#scholastic').css('display','none');
					$('#edu').css('display','none');
					$('#exp').css('display','none');
					$('#sstd').removeClass('active');
					$('#substudied').css('display','none');
					
			});
			$('#fd').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ad').removeClass('active');
					$('#pr').removeClass('active'); 
					$('#fd').addClass('active');
					$('#sd').removeClass('active');
					$('#eq').removeClass('active');
					$('#ex').removeClass('active');
					$('#admission').css('display','none');
					$('#perinfo').css('display','none');
					$('#feedet').css('display','block');
					$('#scholastic').css('display','none');
					$('#edu').css('display','none');
					$('#exp').css('display','none');
					$('#sstd').removeClass('active');
					$('#substudied').css('display','none');
					
			});
			$('#sd').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ad').removeClass('active');
					$('#pr').removeClass('active'); 
					$('#fd').removeClass('active');
					$('#sd').addClass('active');
					$('#eq').removeClass('active');
					$('#ex').removeClass('active');
					$('#admission').css('display','none');
					$('#perinfo').css('display','none');
					$('#feedet').css('display','none');
					$('#scholastic').css('display','block');
					$('#edu').css('display','none');
					$('#exp').css('display','none');
					$('#sstd').removeClass('active');
					$('#substudied').css('display','none');
					
			});
			$('#eq').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ad').removeClass('active');
					$('#pr').removeClass('active'); 
					$('#fd').removeClass('active');
					$('#sd').removeClass('active');
					$('#eq').addClass('active');
					$('#ex').removeClass('active');
					$('#admission').css('display','none');
					$('#perinfo').css('display','none');
					$('#feedet').css('display','none');
					$('#scholastic').css('display','none');
					$('#edu').css('display','block');
					$('#exp').css('display','none');
					$('#sstd').removeClass('active');
					$('#substudied').css('display','none');
					
			});
			$('#ex').click(function() {				
				$('#cssmenu').css('height','400');
				$('#ad').removeClass('active');
				$('#pr').removeClass('active'); 
				$('#fd').removeClass('active');
				$('#sd').removeClass('active');
				$('#eq').removeClass('active');
				$('#ex').addClass('active');
				$('#admission').css('display','none');
				$('#perinfo').css('display','none');
				$('#feedet').css('display','none');
				$('#scholastic').css('display','none');
				$('#edu').css('display','none');
				$('#exp').css('display','block');
				$('#sstd').removeClass('active');
				$('#substudied').css('display','none');
			});
			$('#sstd').click(function() {				
				$('#cssmenu').css('height','400');
				$('#ad').removeClass('active');
				$('#pr').removeClass('active'); 
				$('#fd').removeClass('active');
				$('#sd').removeClass('active');
				$('#eq').removeClass('active');
				$('#ex').removeClass('active');
				$('#admission').css('display','none');
				$('#perinfo').css('display','none');
				$('#feedet').css('display','none');
				$('#scholastic').css('display','none');
				$('#edu').css('display','none');
				$('#exp').css('display','none');
				$('#sstd').addClass('active');
				$('#substudied').css('display','block');
			});
			
			/************************************** change the edit page left side menu css *********************************/
			$('#epi').click(function() {
				
					$('#cssmenu').css('height','968');
					$('#ead').removeClass('active');
					$('#epi').addClass('active'); 
					$('#efd').removeClass('active');
					$('#esd').removeClass('active');
					$('#eeq').removeClass('active');
					$('#eex').removeClass('active');
					$('#esstd').removeClass('active');
			});
			$('#ead').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ead').addClass('active');
					$('#epi').removeClass('active'); 
					$('#efd').removeClass('active');
					$('#esd').removeClass('active');
					$('#eeq').removeClass('active');
					$('#eex').removeClass('active');
					$('#esstd').removeClass('active');
			});
			$('#efd').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ead').removeClass('active');
					$('#epi').removeClass('active'); 
					$('#efd').addClass('active');
					$('#esd').removeClass('active');
					$('#eeq').removeClass('active');
					$('#eex').removeClass('active');
					$('#esstd').removeClass('active');
			});
			$('#esd').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ead').removeClass('active');
					$('#epi').removeClass('active'); 
					$('#efd').removeClass('active');
					$('#esd').addClass('active');
					$('#eeq').removeClass('active');
					$('#eex').removeClass('active');
					$('#esstd').removeClass('active');
			});
			$('#eeq').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ead').removeClass('active');
					$('#epi').removeClass('active'); 
					$('#efd').removeClass('active');
					$('#esd').removeClass('active');
					$('#eeq').addClass('active');
					$('#eex').removeClass('active');
					$('#esstd').removeClass('active');
			});
			$('#eex').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ead').removeClass('active');
					$('#epi').removeClass('active'); 
					$('#efd').removeClass('active');
					$('#esd').removeClass('active');
					$('#eeq').removeClass('active');
					$('#eex').addClass('active');
					$('#esstd').removeClass('active');
			});
			$('#esstd').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ead').removeClass('active');
					$('#epi').removeClass('active'); 
					$('#efd').removeClass('active');
					$('#esd').removeClass('active');
					$('#eeq').removeClass('active');
					$('#eex').removeClass('active');
					$('#esstd').addClass('active');
			});
			/**************************************previous button*********************************/
			$('#prev1').click(function() {
									
					$('#cssmenu').css('height','1148');
					$('#ad').removeClass('active');
					$('#pr').addClass('active'); 
					$('#fd').removeClass('active');
					$('#sd').removeClass('active');
					$('#eq').removeClass('active');
					$('#ex').removeClass('active');
					$('#admission').css('display','none');
					$('#perinfo').css('display','block');
					$('#feedet').css('display','none');
					$('#scholastic').css('display','none');
					$('#edu').css('display','none');
					$('#exp').css('display','none');
					$('#sstd').removeClass('active');
					$('#substudied').css('display','none');
					
			});
			$('#prev2').click(function() {
								
					$('#cssmenu').css('height','400');
					$('#ad').removeClass('active');
					$('#pr').removeClass('active'); 
					$('#fd').removeClass('active');
					$('#sd').removeClass('active');
					$('#eq').addClass('active');
					$('#ex').removeClass('active');
					$('#admission').css('display','none');
					$('#perinfo').css('display','none');
					$('#feedet').css('display','none');
					$('#scholastic').css('display','none');
					$('#edu').css('display','block');
					$('#exp').css('display','none');
					$('#sstd').removeClass('active');
					$('#substudied').css('display','none');
					
			});
			$('#prev3').click(function() {
				
					$('#cssmenu').css('height','400');
					$('#ad').removeClass('active');
					$('#pr').removeClass('active'); 
					$('#fd').removeClass('active');
					$('#sd').removeClass('active');
					$('#eq').removeClass('active');
					$('#ex').addClass('active');
					$('#admission').css('display','none');
					$('#perinfo').css('display','none');
					$('#feedet').css('display','none');
					$('#scholastic').css('display','none');
					$('#edu').css('display','none');
					$('#exp').css('display','block');
					$('#sstd').removeClass('active');
					$('#substudied').css('display','none');
					
			});
			$('#prev4').click(function() {	
				
					$('#cssmenu').css('height','400');
					$('#ad').addClass('active');
					$('#pr').removeClass('active'); 
					$('#fd').removeClass('active');
					$('#sd').removeClass('active');
					$('#eq').removeClass('active');
					$('#ex').removeClass('active');
					$('#admission').css('display','block');
					$('#perinfo').css('display','none');
					$('#feedet').css('display','none');
					$('#scholastic').css('display','none');
					$('#edu').css('display','none');
					$('#exp').css('display','none');
					$('#sstd').removeClass('active');
					$('#substudied').css('display','none');
					
			});
			$('#prev5').click(function() {				
				$('#cssmenu').css('height','400');
				$('#ad').removeClass('active');
				$('#pr').removeClass('active'); 
				$('#fd').addClass('active');
				$('#sd').removeClass('active');
				$('#eq').removeClass('active');
				$('#ex').removeClass('active');
				$('#admission').css('display','none');
				$('#perinfo').css('display','none');
				$('#feedet').css('display','block');
				$('#scholastic').css('display','none');
				$('#edu').css('display','none');
				$('#exp').css('display','none');
				$('#sstd').removeClass('active');
				$('#substudied').css('display','none');
				
			});
			$('#prev6').click(function() {				
				$('#cssmenu').css('height','400');
				$('#ad').removeClass('active');
				$('#pr').removeClass('active'); 
				$('#fd').removeClass('active');
				$('#sd').addClass('active');
				$('#eq').removeClass('active');
				$('#ex').removeClass('active');
				$('#admission').css('display','none');
				$('#perinfo').css('display','none');
				$('#feedet').css('display','none');
				$('#scholastic').css('display','block');
				$('#edu').css('display','none');
				$('#exp').css('display','none');
				$('#sstd').removeClass('active');
				$('#substudied').css('display','none');
				
			});
	});	
	/************************************************* Experience Add More*****************************************/
	function addmore()
	{
		var i=document.getElementById('cnt').value;		
		if(i<6)
		{			
			$(".admore").append('<tr id="row'+i+'"><td><input type="text" style="width:98%;" size="10" id="ins'+i+'" value=""  name="ins'+i+'" ></td><td><input type="text" style="width:98%;" size="14" id="des'+i+'" value=""  name="des'+i+'" ></td><td width="315"><input type="text" style="margin-right:5px;" id="empf'+i+'" value=""  name="empf'+i+'"  placeholder="From"><input type="text" id="empt'+i+'" value=""  name="empt'+i+'"  placeholder="To" ></td><td><input type="text" style="width:98%;" size="14" id="wrk'+i+'" value=""  name="wrk'+i+'" ></td><td><input type="hidden" id="expid'+i+'" value=""  name="expid'+i+'"></td><td><a href="#" id="r'+i+'" class="rmv" title="remove">X</a></td></tr>'); 
			i++;			
			document.getElementById('cnt').value=i;			
		}
		else
		{
			alert('Maximum 6 employment details');
		}	
	}
	/************************************************* Personal Info Validation*****************************************/
	function valperinfo(val)
	{
		var valid;
		valid=true;	
		
		if (document.getElementById('admin').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter the Admission No.</font>";
			document.getElementById('admin').value="";
			document.getElementById('admin').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if (document.getElementById('fname').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter your First Name</font>";
			document.getElementById('fname').value="";
			document.getElementById('fname').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		/* if(document.getElementById('lname').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter your Last Name</font>";
			document.getElementById('lname').value="";
			document.getElementById('lname').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		} */
		if((studentinfo.gender[0].checked == false ) && (studentinfo.gender[1].checked == false ))
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Select Gender</font>";			
			document.getElementById('chkval').value="1";
			valid=false;
			return valid;
		}		
		if(document.getElementById('phone1').value!="")
		{
			str11=document.getElementById('phone1').value;
			str12="0123456789";
			lenth=str11.length;
			if (lenth > 6)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Code Number, Please enter valid code.</font>";
				document.getElementById('phone1').value="";
				document.getElementById('phone1').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			else
			{
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Code Number, Please enter only digits 0-9.</font>";
						document.getElementById('phone1').value="";
						document.getElementById('phone1').focus();
						break;
						document.getElementById('chkval').value="1";valid=false;
						return valid;
					}
				}
			}
		}
		if(document.getElementById('phone1').value =="" && document.getElementById('phone').value !="")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please enter area code.</font>";
			document.getElementById('phone1').value="";
			document.getElementById('phone1').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if(document.getElementById('phone').value !="")
		{
			str11=document.getElementById('phone').value;
			str12="0123456789";
			lenth=str11.length;
			if (lenth < 6 || lenth > 10)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Phone Number.</font>";
				document.getElementById('phone').value="";
				document.getElementById('phone').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			else
			{
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Phone Number, Please enter only digits 0-9.</font>";
						document.getElementById('phone').value="";
						document.getElementById('phone').focus();
						break;
						document.getElementById('chkval').value="1";valid=false;
						return valid;
					}
				}
			}
		}
		/* if(document.getElementById('mobile').value == "" || document.getElementById('mobile').value == "+91")
		{		
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter your Cell Number.</font>";
			document.getElementById('mobile').value="+91";
			document.getElementById('mobile').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		} */
		if(document.getElementById('mobile').value!="" && document.getElementById('mobile').value != "+91")
		{
			str11=document.getElementById('mobile').value;
			str12="0123456789+";
			lenth=str11.length;
			if (lenth < 13)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Cell Number, Please enter Cell Number with country code(eg. +91,+11).</font>";
				document.getElementById('mobile').value="";
				document.getElementById('mobile').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			else
			{
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Cell Number, Please enter only digits 0-9.</font>";
						document.getElementById('mobile').value="";
						document.getElementById('mobile').focus();
						break;
						document.getElementById('chkval').value="1";valid=false;
						return valid;
					}
				}
			}
		}
		if(document.getElementById('email').value=="")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Write Your Email.</font>";
			document.getElementById('email').value="";
			document.getElementById('email').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if(document.getElementById('email').value!="")
		{
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		   var college = document.getElementById('email').value;
		   if(reg.test(college) == false)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Email Address, Check '@' or '.' in the Email Address.</font>";
				document.getElementById('email').value="";
				document.getElementById('email').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
		}
		if (document.getElementById('dob').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Your Dateofbirth.</font>";
			document.getElementById('dob').value="";
			document.getElementById('dob').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		/* if (document.getElementById('nationality').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Nationality</font>";
			document.getElementById('nationality').value="";
			document.getElementById('nationality').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		} */
		if (document.getElementById('passport').value != "")
		{
			if (document.getElementById('poi').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Passport Details</font>";
				document.getElementById('poi').value="";
				document.getElementById('poi').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			if (document.getElementById('doi').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Passport Details</font>";
				document.getElementById('doi').value="";
				document.getElementById('doi').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			if (document.getElementById('valupto').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Passport Details</font>";
				document.getElementById('valupto').value="";
				document.getElementById('valupto').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
		}
		/* if (document.getElementById('marital').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Marital Status</font>";
			document.getElementById('marital').value="";
			document.getElementById('marital').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		} */
		
		/*************************************** Present Address validation*********************************/
		
		/* if (document.getElementById('pa').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Current Address</font>";
			document.getElementById('pa').value="";
			document.getElementById('pa').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if (document.getElementById('city').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Current City</font>";
			document.getElementById('city').value="";
			document.getElementById('city').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if (document.getElementById('state').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Current State</font>";
			document.getElementById('state').value="";
			document.getElementById('state').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if (document.getElementById('pin').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Current Pincode</font>";
			document.getElementById('pin').value="";
			document.getElementById('pin').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		} */
		if(document.getElementById('pin').value!="")
		{
			str11=document.getElementById('pin').value;
			str12="0123456789";
			lenth=str11.length;
			if (lenth!=6)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Pin Number, Please enter 6 digits.</font>";
				document.getElementById('pin').value="";
				document.getElementById('pin').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			else
			{
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Pin Number, Please enter only digits 0-9.</font>";
						document.getElementById('pin').value="";
						document.getElementById('pin').focus();
						break;
						document.getElementById('chkval').value="1";valid=false;
						return valid;
					}
				}
			}
		}
		/*************************************** Permenant Address validation*********************************/
		if(document.getElementById('sadd').checked==false)
		{
			/* if (document.getElementById('pa1').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Permenant Address</font>";
				document.getElementById('pa1').value="";
				document.getElementById('pa1').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			if (document.getElementById('pcity').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Permenant City</font>";
				document.getElementById('pcity').value="";
				document.getElementById('pcity').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			if (document.getElementById('pstate').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Permenant State</font>";
				document.getElementById('pstate').value="";
				document.getElementById('pstate').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			if (document.getElementById('ppin').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Permenant Pincode</font>";
				document.getElementById('ppin').value="";
				document.getElementById('ppin').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			} */
			if(document.getElementById('ppin').value!="")
			{
				str11=document.getElementById('ppin').value;
				str12="0123456789";
				lenth=str11.length;
				if (lenth!=6)
				{
					document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Pin Number, Please enter 6 digits.</font>";
					document.getElementById('ppin').value="";
					document.getElementById('ppin').focus();
					document.getElementById('chkval').value="1";valid=false;
					return valid;
				}
				else
				{
					var i =0;
					for(i = 0 ; i < lenth;i++)
					{
						str13=str11.slice(i,i+1);
						var id=str12.indexOf(str13);
						if(id == -1)
						{
							document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Pin Number, Please enter only digits 0-9.</font>";
							document.getElementById('ppin').value="";
							document.getElementById('ppin').focus();
							break;
							document.getElementById('chkval').value="1";valid=false;
							return valid;
						}
					}
				}
			}
		}
		/*************************************** Guardian details validation*********************************/
		
		/* if (document.getElementById('father').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter your Father/Guardian Name</font>";
			document.getElementById('father').value="";
			document.getElementById('father').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if(document.getElementById('fmobile').value=="")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter your Father/Guardian Mobile Number.</font>";
			document.getElementById('fmobile').value="";
			document.getElementById('fmobile').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		} */
		if(document.getElementById('fmobile').value!="")
		{
			str11=document.getElementById('fmobile').value;
			str12="0123456789";
			lenth=str11.length;
			if (lenth < 7 || lenth > 13)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Mobile Number.</font>";
				document.getElementById('fmobile').value="";
				document.getElementById('fmobile').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			else
			{
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Mobile Number, Please enter only digits 0-9.</font>";
						document.getElementById('fmobile').value="";
						document.getElementById('fmobile').focus();
						break;
						document.getElementById('chkval').value="1";valid=false;
						return valid;
					}
				}
			}
		}
		/* if(document.getElementById('femail').value=="")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Write Your Father/Guardian Email.</font>";
			document.getElementById('femail').value="";
			document.getElementById('femail').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		} */
		if(document.getElementById('femail').value!="")
		{
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		   var college = document.getElementById('femail').value;
		   if(reg.test(college) == false)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Email Address, Check '@' or '.' in the Email Address.</font>";
				document.getElementById('femail').value="";
				document.getElementById('femail').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
		}
		/* if (document.getElementById('address').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Father/Guardian Address</font>";
			document.getElementById('address').value="";
			document.getElementById('address').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if (document.getElementById('fcity').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Father/Guardian City</font>";
			document.getElementById('fcity').value="";
			document.getElementById('fcity').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if (document.getElementById('fstate').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Father/Guardian State</font>";
			document.getElementById('fstate').value="";
			document.getElementById('fstate').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		}
		if (document.getElementById('fpin').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Father/Guardian Pincode</font>";
			document.getElementById('fpin').value="";
			document.getElementById('fpin').focus();
			document.getElementById('chkval').value="1";valid=false;
			return valid;
		} */
		if(document.getElementById('fpin').value!="")
		{
			str11=document.getElementById('fpin').value;
			str12="0123456789";
			lenth=str11.length;
			if (lenth!=6)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Pin Number, Please enter 6 digits.</font>";
				document.getElementById('fpin').value="";
				document.getElementById('fpin').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			else
			{
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Pin Number, Please enter only digits 0-9.</font>";
						document.getElementById('fpin').value="";
						document.getElementById('fpin').focus();
						break;
						document.getElementById('chkval').value="1";valid=false;
						return valid;
					}
				}
			}
		}
		if(val !="edit")
		{
			/* if(document.getElementById('image').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Upload your photo</font>";
				document.getElementById('image').value="";
				document.getElementById('image').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			if(document.getElementById('sslcfile').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Upload SSLC marks card</font>";
				document.getElementById('sslcfile').value="";
				document.getElementById('sslcfile').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			if(document.getElementById('ugfile').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Upload Degree Certificate/font>";
				document.getElementById('ugfile').value="";
				document.getElementById('ugfile').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
			if(document.getElementById('addrfile').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Upload address proof</font>";
				document.getElementById('addrfile').value="";
				document.getElementById('addrfile').focus();
				document.getElementById('chkval').value="1";valid=false;
				return valid;
			}
						
			if(studentinfo.community[3].checked == false)
			{				
				if(document.getElementById('comfile').value == "")
				{
					document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Upload community certificate</font>";
					document.getElementById('comfile').value="";
					document.getElementById('comfile').focus();
					document.getElementById('chkval').value="1";valid=false;
					return valid;
				}
			} */
		}
		document.getElementById('chkval').value=0;		
	}
		
	function nxt1()
	{
		/* $('#nxt1').click(function() {	 */			
			if(document.getElementById('chkval').value == 0)
			{
				$('#eq').css('pointer-events','auto');							
				$('#cssmenu').css('height','400');
				$('#ad').removeClass('active');
				$('#pr').removeClass('active'); 
				$('#fd').removeClass('active');
				$('#sd').removeClass('active');
				$('#eq').addClass('active');
				$('#ex').removeClass('active');
				$('#admission').css('display','none');
				$('#perinfo').css('display','none');
				$('#feedet').css('display','none');
				$('#scholastic').css('display','none');
				$('#edu').css('display','block');
				$('#exp').css('display','none');
				$('#substudied').css('display','none');
				$('#sstd').removeClass('active');
				document.getElementById('chkval').value="0";
				document.getElementById('error').innerHTML="";
			}			
		/* }); */
	}
	/*************************************************** Education Fields validation**********************************************/
	function valedu()
	{
		var valid;
		valid=true;	
		if(document.getElementById('pyear1').value =="" && document.getElementById('pyear2').value == "" && document.getElementById('pyear3').value =="" && document.getElementById('pyear4').value =="")
		{
			document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Please Enter Education Qualification.</font>";
			document.getElementById('pyear1').value="";
			document.getElementById('pyear1').focus();
			document.getElementById('chkval4').value="1";valid=false;
			return valid;
		}
		/* if (document.getElementById('pyear1').value == "")
		{
			document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Please Enter SSLC year of passing.</font>";
			document.getElementById('pyear1').value="";
			document.getElementById('pyear1').focus();
			document.getElementById('chkval4').value="1";valid=false;
			return valid;
		} */
		if(document.getElementById('pyear1').value!="")
		{
			str11=document.getElementById('pyear1').value;
			str12="0123456789";
			lenth=str11.length;	
			if (lenth!=4)
			{
				document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year, Please enter 4 digits.</font>";
				document.getElementById('pyear1').value="";
				document.getElementById('pyear1').focus();
				document.getElementById('chkval4').value="1";
				valid=false;
				return valid;
			}
			else
			{				
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year, Please enter only digits 0-9.</font>";
						document.getElementById('pyear1').value="";
						document.getElementById('pyear1').focus();				
						document.getElementById('chkval4').value="1";
						valid=false;
						return valid;
					}
				}
				var d = new Date();
				var n = d.getFullYear();
				if(document.getElementById('pyear1').value > n)
				{
					document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year.</font>";
					document.getElementById('pyear1').value="";
					valid=false;
					return valid;
				}	
			}
		}
		/* if (document.getElementById('subject1').value == "")
		{
			document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Please Enter Suject offered.</font>";
			document.getElementById('subject1').value="";
			document.getElementById('subject1').focus();
			document.getElementById('chkval4').value="1";valid=false;
			return valid;
		}
		if (document.getElementById('institute1').value == "")
		{
			document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Please Enter Insititute Name.</font>";
			document.getElementById('institute1').value="";
			document.getElementById('institute1').focus();
			document.getElementById('chkval4').value="1";valid=false;
			return valid;
		}
		if (document.getElementById('university1').value == "")
		{
			document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Please Enter University Name.</font>";
			document.getElementById('university1').value="";
			document.getElementById('university1').focus();
			document.getElementById('chkval4').value="1";valid=false;
			return valid;
		}	
		if (document.getElementById('award1').value == "")
		{
			document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Please Enter Class Awarded.</font>";
			document.getElementById('award1').value="";
			document.getElementById('award1').focus();
			document.getElementById('chkval4').value="1";valid=false;
			return valid;
		} */
		if(document.getElementById('pyear2').value!="")
		{
			str11=document.getElementById('pyear2').value;
			str12="0123456789";
			lenth=str11.length;	
			if (lenth!=4)
			{
				document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year, Please enter 4 digits.</font>";
				document.getElementById('pyear2').value="";
				document.getElementById('pyear2').focus();
				document.getElementById('chkval4').value="1";valid=false;
				return valid;
			}
			else
			{	
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year, Please enter only digits 0-9.</font>";
						document.getElementById('pyear2').value="";
						document.getElementById('pyear2').focus();				
						document.getElementById('chkval4').value="1";
						valid=false;
						return valid;
					}
				}
				var d = new Date();
				var n = d.getFullYear();
				if(document.getElementById('pyear2').value > n)
				{
					document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year.</font>";
					document.getElementById('pyear2').value="";
					valid=false;
					return valid;
				}	
			}
		}
		if(document.getElementById('pyear3').value!="")
		{
			str11=document.getElementById('pyear3').value;
			str12="0123456789";
			lenth=str11.length;	
			if (lenth!=4)
			{
				document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year, Please enter 4 digits.</font>";
				document.getElementById('pyear3').value="";
				document.getElementById('pyear3').focus();
				document.getElementById('chkval4').value="1";valid=false;
				return valid;
			}
			else
			{	
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year, Please enter only digits 0-9.</font>";
						document.getElementById('pyear3').value="";
						document.getElementById('pyear3').focus();				
						document.getElementById('chkval4').value="1";
						valid=false;
						return valid;
					}
				}
				var d = new Date();
				var n = d.getFullYear();
				if(document.getElementById('pyear3').value > n)
				{
					document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year.</font>";
					document.getElementById('pyear3').value="";
					valid=false;
					return valid;
				}	
			}
		}
		if(document.getElementById('pyear4').value!="")
		{
			str11=document.getElementById('pyear4').value;
			str12="0123456789";
			lenth=str11.length;	
			if (lenth!=4)
			{
				document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year, Please enter 4 digits.</font>";
				document.getElementById('pyear4').value="";
				document.getElementById('pyear4').focus();
				document.getElementById('chkval4').value="1";valid=false;
				return valid;
			}
			else
			{		
				var i =0;
				for(i = 0 ; i < lenth;i++)
				{
					str13=str11.slice(i,i+1);
					var id=str12.indexOf(str13);
					if(id == -1)
					{
						document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year, Please enter only digits 0-9.</font>";
						document.getElementById('pyear4').value="";
						document.getElementById('pyear4').focus();
						document.getElementById('chkval4').value="1";
						valid=false;
						return valid;
					}
				}
				var d = new Date();
				var n = d.getFullYear();
				if(document.getElementById('pyear4').value > n)
				{
					document.getElementById('error4').innerHTML ="<font color='#F70938' size='2'>Invalid Year.</font>";
					document.getElementById('pyear4').value="";
					valid=false;
					return valid;
				}	
			}
		}
		document.getElementById('chkval4').value=0;		
	}
	function nxt2()
	{
		/* $('#nxt2').click(function() { */
		if(document.getElementById('chkval4').value =="0")
		{
			$('#ex').css('pointer-events','auto');
			$('#cssmenu').css('height','400');
			$('#ad').removeClass('active');
			$('#pr').removeClass('active'); 
			$('#fd').removeClass('active');
			$('#sd').removeClass('active');
			$('#eq').removeClass('active');
			$('#ex').addClass('active');			
			$('#perinfo').css('display','none');
			$('#edu').css('display','none');
			$('#exp').css('display','block');
			$('#admission').css('display','none');
			$('#feedet').css('display','none');
			$('#scholastic').css('display','none');	
			$('#substudied').css('display','none');
			$('#sstd').removeClass('active');			
			document.getElementById('chkval4').value=0;
			document.getElementById('error1').innerHTML="";
		}
		/* }); */
	}
	/********************************experience next button*****************************************************/
	function nxt3()
	{
		/* $('#nxt3').click(function() { */
			if(document.getElementById('chkval3').value ==0)
			{
				$('#sd').css('pointer-events','auto');
				$('#cssmenu').css('height','400');
				$('#ad').addClass('active');
				$('#pr').removeClass('active'); 
				$('#fd').removeClass('active');
				$('#sd').removeClass('active');
				$('#eq').removeClass('active');
				$('#ex').removeClass('active');
				$('#admission').css('display','block');
				$('#perinfo').css('display','none');
				$('#feedet').css('display','none');
				$('#scholastic').css('display','none');
				$('#edu').css('display','none');
				$('#exp').css('display','none');
				$('#substudied').css('display','none');
			$('#sstd').removeClass('active');
				document.getElementById('chkval3').value=0;
				document.getElementById('error2').innerHTML="";
			}
		/* }); */
	}
	/*************************************************** Admission field validatin**********************************************/
	function valadmission()
	{
		var valid;
		valid=true;	
		if (document.getElementById('doa').value == "")
		{
			document.getElementById('error1').innerHTML ="<font color='#F70938' size='2'>Please Enter Admission Date.</font>";
			document.getElementById('doa').value="";
			document.getElementById('doa').focus();
			document.getElementById('chkval1').value="1";valid=false;
			return valid;
		}
		/* if (document.getElementById('mentor').value == "")
		{
			document.getElementById('error1').innerHTML ="<font color='#F70938' size='2'>Please Enter Mentor Name</font>";
			document.getElementById('mentor').value="";
			document.getElementById('mentor').focus();
			document.getElementById('chkval1').value="1";valid=false;
			return valid;
		} */
		document.getElementById('chkval1').value=0;
	}
	function nxt4()
	{
		/* $('#nxt4').click(function() { */
		if(document.getElementById('chkval1').value==0)
		{
			$('#fd').css('pointer-events','auto');
			$('#cssmenu').css('height','400');
			$('#ad').removeClass('active');
			$('#pr').removeClass('active'); 
			$('#fd').addClass('active');
			$('#sd').removeClass('active');
			$('#eq').removeClass('active');
			$('#ex').removeClass('active');
			$('#admission').css('display','none');
			$('#perinfo').css('display','none');
			$('#feedet').css('display','block');
			$('#scholastic').css('display','none');
			$('#edu').css('display','none');
			$('#exp').css('display','none');
			$('#substudied').css('display','none');
			$('#sstd').removeClass('active');
			document.getElementById('chkval3').value=0;
			document.getElementById('error3').innerHTML="";
		}
		/* }); */
	}
	/*************************************************** Fee validation**********************************************/
	function valfee()
	{
		var valid;
		valid=true;	
		if (document.getElementById('fp').value == "")
		{
			document.getElementById('error2').innerHTML ="<font color='#F70938' size='2'>Please Enter Payable Fee.</font>";
			document.getElementById('fp').value="";
			document.getElementById('fp').focus();
			document.getElementById('chkval2').value="1";valid=false;
			return valid;
		}
		if(document.getElementById('fp').value!="")
		{
			str11=document.getElementById('fp').value;
			str12="0123456789.";
			lenth=str11.length;		
			var i =0;
			for(i = 0 ; i < lenth;i++)
			{
				str13=str11.slice(i,i+1);
				var id=str12.indexOf(str13);
				if(id == -1)
				{
					document.getElementById('error2').innerHTML ="<font color='#F70938' size='2'>Invalid Value, Please enter only digits 0-9.</font>";
					document.getElementById('fp').value="";
					document.getElementById('fp').focus();
					break;
					document.getElementById('chkval2').value="1";valid=false;
					return valid;
				}
			}		
		}
		
		if (document.getElementById('feepa').value == "")
		{
			document.getElementById('error2').innerHTML ="<font color='#F70938' size='2'>Please Enter Paid Fee.</font>";
			document.getElementById('feepa').value="";
			document.getElementById('feepa').focus();
			document.getElementById('chkval2').value="1";valid=false;
			return valid;
		}
		if(document.getElementById('feepa').value!="")
		{
			str11=document.getElementById('feepa').value;
			str12="0123456789.";
			lenth=str11.length;		
			var i =0;
			for(i = 0 ; i < lenth;i++)
			{
				str13=str11.slice(i,i+1);
				var id=str12.indexOf(str13);
				if(id == -1)
				{
					document.getElementById('error2').innerHTML ="<font color='#F70938' size='2'>Invalid Value, Please enter only digits 0-9.</font>";
					document.getElementById('feepa').value="";
					document.getElementById('feepa').focus();
					break;
					document.getElementById('chkval2').value="1";valid=false;
					return valid;
				}
			}		
		}
		if (document.getElementById('feepa').value != "" && document.getElementById('mop').value != "Cash" && document.getElementById('moddet').value == "")
		{
			document.getElementById('error2').innerHTML ="<font color='#F70938' size='2'>Please Enter Mode of pay detail</font>";
			document.getElementById('moddet').value="";
			document.getElementById('moddet').focus();
			document.getElementById('chkval2').value="1";valid=false;
			return valid;
		}
		document.getElementById('chkval2').value=0;		
	}
	
	function calbal()
	{
		if(document.getElementById('fp').value!="" && document.getElementById('feepa').value!="")
		{	
			if(parseInt(document.getElementById('fp').value) >= parseInt(document.getElementById('feepa').value))
			{
				if(document.getElementById('fp').value!="" && document.getElementById('feepa').value!="")
				{
					document.getElementById('balance').value =eval(document.getElementById('fp').value - document.getElementById('feepa').value);
				}
			}
			else
			{
				alert("Paid fee is greater than Payable fee");	
				document.getElementById('feepa').value="";
				document.getElementById('balance').value=""
				return false;
			}
		}
	}
	function chkbal()
	{
		if(parseInt(document.getElementById('feepa').value) <= parseInt(document.getElementById('prevbal').value))
		{
			if(document.getElementById('fp').value!="" && document.getElementById('feepa').value!="" && document.getElementById('prevbal').value!="")
			{
				document.getElementById('balance').value =eval(document.getElementById('prevbal').value - document.getElementById('feepa').value);
			}
		}
		else
		{
			alert("Paid fee is greater than balance amount");	
			document.getElementById('feepa').value="";
			document.getElementById('balance').value=""
			return false;
		}
	}
	function nxt5()
	{
		/* $('#nxt5').click(function() {	 */
		if(document.getElementById('chkval2').value==0)
		{
			$('#sd').css('pointer-events','auto');
			$('#cssmenu').css('height','400');
			$('#ad').removeClass('active');
			$('#pr').removeClass('active'); 
			$('#fd').removeClass('active');
			$('#sd').addClass('active');
			$('#eq').removeClass('active');
			$('#ex').removeClass('active');
			$('#admission').css('display','none');
			$('#perinfo').css('display','none');
			$('#feedet').css('display','none');
			$('#scholastic').css('display','block');
			$('#edu').css('display','none');
			$('#exp').css('display','none');
			$('#substudied').css('display','none');
			$('#sstd').removeClass('active');
			document.getElementById('chkval2').value=0;
			document.getElementById('error4').innerHTML="";
		}
		/* });	 */
	}
	/*************************************************** Scholastic validation**********************************************/
	function valtest()
	{
		var valid;
		valid=true;	
		if (document.getElementById('doe').value == "")
		{
			document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Please Enter Examination Date.</font>";
			document.getElementById('doe').value="";
			document.getElementById('doe').focus();
			valid=false;
			return valid;
		}
		if (document.getElementById('assign').value == "")
		{
			document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Please Enter Assignment Mark.</font>";
			document.getElementById('assign').value="";
			document.getElementById('assign').focus();
			valid=false;
			return valid;
		}
		if(document.getElementById('assign').value!="")
		{
			str11=document.getElementById('assign').value;
			str12="0123456789.";
			lenth=str11.length;		
			var i =0;
			for(i = 0 ; i < lenth;i++)
			{
				str13=str11.slice(i,i+1);
				var id=str12.indexOf(str13);
				if(id == -1)
				{
					document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Invalid Value, Please enter only digits 0-9.</font>";
					document.getElementById('assign').value="";
					document.getElementById('assign').focus();
					break;
					valid=false;
					return valid;
				}
			}		
		}	
		if (document.getElementById('casestudies').value == "")
		{
			document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Please Enter Case Studies Mark.</font>";
			document.getElementById('casestudies').value="";
			document.getElementById('casestudies').focus();
			valid=false;
			return valid;
		}
		if(document.getElementById('casestudies').value!="")
		{
			str11=document.getElementById('casestudies').value;
			str12="0123456789";
			lenth=str11.length;		
			var i =0;
			for(i = 0 ; i < lenth;i++)
			{
				str13=str11.slice(i,i+1);
				var id=str12.indexOf(str13);
				if(id == -1)
				{
					document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Invalid Value, Please enter only digits 0-9.</font>";
					document.getElementById('casestudies').value="";
					document.getElementById('casestudies').focus();
					break;
					valid=false;
					return valid;
				}
			}		
		}	
		if (document.getElementById('test').value == "")
		{
			document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Please Enter Test Mark.</font>";
			document.getElementById('test').value="";
			document.getElementById('test').focus();
			valid=false;
			return valid;
		}
		if(document.getElementById('test').value!="")
		{
			str11=document.getElementById('test').value;
			str12="0123456789";
			lenth=str11.length;		
			var i =0;
			for(i = 0 ; i < lenth;i++)
			{
				str13=str11.slice(i,i+1);
				var id=str12.indexOf(str13);
				if(id == -1)
				{
					document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Invalid Value, Please enter only digits 0-9.</font>";
					document.getElementById('test').value="";
					document.getElementById('test').focus();
					break;
					valid=false;
					return valid;
				}
			}		
		}	
		if (document.getElementById('exam').value == "")
		{
			document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Please Enter Exam Mark.</font>";
			document.getElementById('exam').value="";
			document.getElementById('exam').focus();
			valid=false;
			return valid;
		}
		if(document.getElementById('exam').value!="")
		{
			str11=document.getElementById('exam').value;
			str12="0123456789";
			lenth=str11.length;		
			var i =0;
			for(i = 0 ; i < lenth;i++)
			{
				str13=str11.slice(i,i+1);
				var id=str12.indexOf(str13);
				if(id == -1)
				{
					document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Invalid Value, Please enter only digits 0-9.</font>";
					document.getElementById('exam').value="";
					document.getElementById('exam').focus();
					break;
					valid=false;
					return valid;
				}
			}		
		}	
		document.getElementById('chkval3').value=0;			
	}
	function valtest1()
	{
		var valid;
		valid=true;	
		if(document.getElementById('assign').value!="" && document.getElementById('casestudies').value!="" && document.getElementById('test').value!="" && document.getElementById('exam').value!="" )
		{			
			if (document.getElementById('doe').value == "")
			{
				document.getElementById('error3').innerHTML ="<font color='#F70938' size='2'>Please Enter Examination Date.</font>";
				document.getElementById('doe').value="";
				document.getElementById('doe').focus();
				document.getElementById('chkval3').value=1;
				valid=false;
				return valid;
			}			
		}
		document.getElementById('chkval3').value=0;
	}
	function calmark()
	{
		if(document.getElementById('assign').value!="" && document.getElementById('casestudies').value!="" && document.getElementById('test').value!="" && document.getElementById('exam').value!="" )
		{
			if(parseInt(document.getElementById('assign').value) > 10)
			{
				alert("Invalid Mark");document.getElementById('assign').value="";
			}
			else if(parseInt(document.getElementById('casestudies').value) > 10)
			{
				alert("Invalid Mark");
				document.getElementById('casestudies').value="";
			}
			else if(parseInt(document.getElementById('test').value) > 10)
			{
				alert("Invalid Mark");document.getElementById('test').value="";
			}
			else if(parseInt(document.getElementById('exam').value) > 70)
			{	
				alert("Invalid Mark");document.getElementById('exam').value="";
			}
			else
			{
				document.getElementById('tot').value =eval(parseInt(document.getElementById('assign').value) + parseInt(document.getElementById('casestudies').value) + parseInt(document.getElementById('test').value) + parseInt(document.getElementById('exam').value));
				if(parseInt(document.getElementById('tot').value) >= 80)
				{
					document.getElementById('fresult').innerHTML="<font color='#1626f3' size='2'>PASSED WITH DISTINCTION</font>";
				}
				else if(parseInt(document.getElementById('tot').value) >=60 && parseInt(document.getElementById('tot').value) < 80)
				{
					document.getElementById('fresult').innerHTML="<font color='#009130' size='2'>PASSED</font>";
				}
				else
				{
					document.getElementById('fresult').innerHTML="<font color='#F70938' size='2'>FAIL</font>";
				}
			}
		}	
	}
	function nxt6()
	{
		/* $('#nxt5').click(function() {	 */
		if(document.getElementById('chkval3').value==0)
		{
			$('#sstd').css('pointer-events','auto');
			$('#cssmenu').css('height','400');
			$('#ad').removeClass('active');
			$('#pr').removeClass('active'); 
			$('#fd').removeClass('active');
			$('#sd').removeClass('active');
			$('#eq').removeClass('active');
			$('#ex').removeClass('active');
			$('#admission').css('display','none');
			$('#perinfo').css('display','none');
			$('#feedet').css('display','none');
			$('#scholastic').css('display','none');
			$('#edu').css('display','none');
			$('#exp').css('display','none');
			$('#substudied').css('display','block');
			$('#sstd').addClass('active');
			document.getElementById('chkval3').value=0;
			document.getElementById('error4').innerHTML="";
		}
		/* });	 */
	}
/******************************************************* Permanent address checkbox function************************************/	
	function chkaddr(checkbox)
	{
		if(document.getElementById('pa').value !="")
		{
			if(checkbox.checked==true)
			{		
				document.getElementById('pa1').disabled=true;
				document.getElementById('pline').disabled=true;
				document.getElementById('pline2').disabled=true;
				document.getElementById('pcity').disabled=true;
				document.getElementById('pstate').disabled=true;
				document.getElementById('ppin').disabled=true;
				document.getElementById('pa1').value=document.getElementById('pa').value;
				document.getElementById('pline').value=document.getElementById('line').value;
				document.getElementById('pline2').value=document.getElementById('line2').value;
				document.getElementById('pcity').value=document.getElementById('city').value;
				document.getElementById('pstate').value=document.getElementById('state').value;
				document.getElementById('ppin').value=document.getElementById('pin').value;
				
			}
			else
			{
				document.getElementById('pa1').disabled=false;
				document.getElementById('pline').disabled=false;
				document.getElementById('pline2').disabled=false;
				document.getElementById('pcity').disabled=false;
				document.getElementById('pstate').disabled=false;
				document.getElementById('ppin').disabled=false;
				document.getElementById('pa1').value='';
				document.getElementById('pline').value='';
				document.getElementById('pline2').value='';
				document.getElementById('pcity').value='';
				document.getElementById('pstate').value='';
				document.getElementById('ppin').value='';
			}
		}
		else
		{
			checkbox.checked=false;
			alert("First Enter the Present Address");
		}
	}	
/*********************************check passport issued date,admission date,completion date and certificate date**********************************/

	function chkdate()
	{
	
		var dat1=document.getElementById('doa').value;
		if(dat1!='')
		{
			var n=dat1.split("-");
			var mon=n[1];
			var dd=n[0];
			var y=n[2];
			dat1=y+"-"+mon+"-"+dd;
		}
		var dat2=document.getElementById('doc').value;
		 n=dat2.split("-");
		 mon=n[1];
		 dd=n[0];
		 y=n[2];
		dat2=y+"-"+mon+"-"+dd;
		
		if(dat1 !="" && dat1 !="Invalid Date")
		{
			if(dat2 <= dat1)
			{
				alert("Completion date must be greater than admission date");
				document.getElementById('doc').value="";
				return false;
			}
		}
		else
		{
			alert("First Enter Admission Date");
			document.getElementById('doc').value="";
		}
	}
	function chkdate1()
	{
		var dat1=document.getElementById('doc').value;
		if(dat1!='')
		{
			var n=dat1.split("-");
			var mon=n[1];
			var dd=n[0];
			var y=n[2];
			dat1=y+"-"+mon+"-"+dd;
		}
		
		var dat2=document.getElementById('certificate').value;	
		n=dat2.split("-");
		 mon=n[1];
		 dd=n[0];
		 y=n[2];
		dat2=y+"-"+mon+"-"+dd;
		
		if(dat1 !="" && dat1 !="Invalid Date")
		{
			if(dat2 < dat1)
			{
				alert("Certificate issued date must be greater than completion date");
				document.getElementById('certificate').value="";
				return false;
			}
		}
		else
		{
			alert("First Enter Completion Date");
			document.getElementById('certificate').value="";
		}
	}
	function chkpassdate()
	{	
		var dat1=document.getElementById('doi').value;
		if(dat1!='')
		{
			var n=dat1.split("-");		
			var mon=n[1];
			var dd=n[0];
			var y=n[2];
			dat1=y+"-"+mon+"-"+dd;
		}
		var dat2=document.getElementById('valupto').value;
		n=dat2.split("-");
		mon=n[1];
		dd=n[0];
		y=n[2];
		dat2=y+"-"+mon+"-"+dd;		
		if(dat1 !="" && dat1 !="Invalid Date" && dat1 !="undefined")
		{
			if(dat2 <= dat1)
			{
				alert("Valid upto date must be greater than issued date");
				document.getElementById('valupto').value="";
				return false;
			}
		}
		else
		{
			alert("First Enter Date of Issue");
			document.getElementById('valupto').value="";
		}
	}
	/************************************* create user validation ******************************************************/
	function valusr(val)
	{
		if (document.getElementById('usrname').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter User Name.</font>";
			document.getElementById('usrname').value="";
			document.getElementById('usrname').focus();
			valid=false;
			return valid;
		}
		if (document.getElementById('email').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter User Email.</font>";
			document.getElementById('email').value="";
			document.getElementById('email').focus();
			valid=false;
			return valid;
		}
		if(document.getElementById('email').value!="")
		{
			var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		   var college = document.getElementById('email').value;
		   if(reg.test(college) == false)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Invalid Email Address, Check '@' or '.' in the Email Address.</font>";
				document.getElementById('email').value="";
				document.getElementById('email').focus();
				valid=false;
				return valid;
			}
		}
		if(val !='edit')
		{
			if (document.getElementById('pswd').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Password.</font>";
				document.getElementById('pswd').value="";
				document.getElementById('pswd').focus();
				valid=false;
				return valid;
			}
		}
		if (document.getElementById('pswd').value != "")
		{
			if (document.getElementById('cpswd').value == "")
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Confirm Password.</font>";
				document.getElementById('cpswd').value="";
				document.getElementById('cpswd').focus();
				valid=false;
				return valid;
			}
		}
		if (document.getElementById('pswd').value != "" && document.getElementById('cpswd').value != "")
		{
			if (document.getElementById('pswd').value != document.getElementById('cpswd').value)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Password and Confirm Password not match</font>";
				document.getElementById('cpswd').value="";
				document.getElementById('cpswd').focus();
				valid=false;
				return valid;
			}
		}
		
	}
	function chgpswd()
	{
		
		if (document.getElementById('opswd').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Current Password.</font>";
			document.getElementById('opswd').value="";
			document.getElementById('opswd').focus();
			valid=false;
			return valid;
		}
		if (document.getElementById('pswd').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Password.</font>";
			document.getElementById('pswd').value="";
			document.getElementById('pswd').focus();
			valid=false;
			return valid;
		}
		if (document.getElementById('cpswd').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Confirm Password.</font>";
			document.getElementById('cpswd').value="";
			document.getElementById('cpswd').focus();
			valid=false;
			return valid;
		}
		if (document.getElementById('pswd').value != "" && document.getElementById('cpswd').value != "")
		{
			if (document.getElementById('pswd').value != document.getElementById('cpswd').value)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Password and Confirm Password not match</font>";
				document.getElementById('cpswd').value="";
				document.getElementById('cpswd').focus();
				valid=false;
				return valid;
			}
		}
	}
	function npswd()
	{	
		if (document.getElementById('pswd').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Password.</font>";
			document.getElementById('pswd').value="";
			document.getElementById('pswd').focus();
			valid=false;
			return valid;
		}
		if (document.getElementById('cpswd').value == "")
		{
			document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Please Enter Confirm Password.</font>";
			document.getElementById('cpswd').value="";
			document.getElementById('cpswd').focus();
			valid=false;
			return valid;
		}
		if (document.getElementById('pswd').value != "" && document.getElementById('cpswd').value != "")
		{
			if (document.getElementById('pswd').value != document.getElementById('cpswd').value)
			{
				document.getElementById('error').innerHTML ="<font color='#F70938' size='2'>Password and Confirm Password not match</font>";
				document.getElementById('cpswd').value="";
				document.getElementById('cpswd').focus();
				valid=false;
				return valid;
			}
		}
	}
</script>
<script type="text/javascript">
function printSelection(node){	
	var content=node.innerHTML
	var pwin=window.open('','print_content','width=880,height=900');
	pwin.document.open();
	pwin.document.write('<html><body onload="window.print()">'+content+'</body></html>');
	pwin.document.close(); 
	setTimeout(function(){pwin.close();},1000);	
}
function printSelection1(node){

	var nVer = navigator.appVersion;
	var nAgt = navigator.userAgent;
	var browserName  = navigator.appName;
	var fullVersion  = ''+parseFloat(navigator.appVersion); 
	var majorVersion = parseInt(navigator.appVersion,10);
	var nameOffset,verOffset,ix;

	// In Opera, the true version is after "Opera" or after "Version"
	if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
	 browserName = "Opera";
	 fullVersion = nAgt.substring(verOffset+6);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
	   fullVersion = nAgt.substring(verOffset+8);
	}
	// In MSIE, the true version is after "MSIE" in userAgent
	else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
	 browserName = "Microsoft Internet Explorer";
	 fullVersion = nAgt.substring(verOffset+5);
	}
	// In Chrome, the true version is after "Chrome" 
	else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
	 browserName = "Chrome";
	 fullVersion = nAgt.substring(verOffset+7);
	}
	// In Safari, the true version is after "Safari" or after "Version" 
	else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
	 browserName = "Safari";
	 fullVersion = nAgt.substring(verOffset+7);
	 if ((verOffset=nAgt.indexOf("Version"))!=-1) 
	   fullVersion = nAgt.substring(verOffset+8);
	}
	// In Firefox, the true version is after "Firefox" 
	else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
	 browserName = "Firefox";
	 fullVersion = nAgt.substring(verOffset+8);
	}
	// In most other browsers, "name/version" is at the end of userAgent 
	else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < 
			  (verOffset=nAgt.lastIndexOf('/')) ) 
	{
	 browserName = nAgt.substring(nameOffset,verOffset);
	 fullVersion = nAgt.substring(verOffset+1);
	 if (browserName.toLowerCase()==browserName.toUpperCase()) {
	  browserName = navigator.appName;
	 }
	}
	// trim the fullVersion string at semicolon/space if present
	if ((ix=fullVersion.indexOf(";"))!=-1)
	   fullVersion=fullVersion.substring(0,ix);
	if ((ix=fullVersion.indexOf(" "))!=-1)
	   fullVersion=fullVersion.substring(0,ix);

	majorVersion = parseInt(''+fullVersion,10);
	if (isNaN(majorVersion)) {
	 fullVersion  = ''+parseFloat(navigator.appVersion); 
	 majorVersion = parseInt(navigator.appVersion,10);
	}

	/* document.write(''
	 +'Browser name  = '+browserName+'<br>'
	 +'Full version  = '+fullVersion+'<br>'
	 +'Major version = '+majorVersion+'<br>'
	 +'navigator.appName = '+navigator.appName+'<br>'
	 +'navigator.userAgent = '+navigator.userAgent+'<br>'
	) */
	var URL='';
	var pg=document.getElementById('selprint').value;
	var ano=document.getElementById('padsrch').value;	
	if(pg==2)
	{
		URL="process/savereciept.php?ano="+ano;				
	}
	else if(pg==4)
	{
		URL="process/saveprov.php?ano="+ano;				
	}
	if(pg == 2 || pg == 4)
	{
		$.ajax({
		url:URL,
		success:function(data){
			if(data !='fail' && data !='issued')
			{
				if(browserName=="Firefox")
				{
					var divElements = document.getElementById('display').innerHTML;
					//Get the HTML of whole page
					var oldPage = document.body.innerHTML;
					//Reset the page's HTML with div's HTML only
					document.body.innerHTML = 
					  "<html><head><title></title></head><body>" + 
					  divElements + "</body>";
					//Print Page
					window.print();
					//Restore orignal HTML
					document.body.innerHTML = oldPage;
				}
				else
				{
					var pwin=window.open('','_blank','width=880,height=900');
					pwin.document.open();
					pwin.document.write($('#display').html());
					pwin.print();
					pwin.document.close(); 
					setTimeout(function(){pwin.close();},1000); 
				}
			}
			else if(data =='issued')
			{
				alert("Certificate already issued");
			}
			else
			{
				alert("Script Error Occured");
			}
		}});
	}
	else
	{
		var content=node.innerHTML
		var pwin=window.open('','print_content','width=880,height=900');
		pwin.document.open();
		pwin.document.write('<html><body onload="window.print()">'+content+'</body></html>');
		pwin.document.close(); 
		setTimeout(function(){pwin.close();},1000);
	}
}

/************************************************************ subject details **********************************************/
function getcourname(id)
{	
	var URL="process/getcourname.php?id="+id;
	$.ajax({	
	url:URL,
	success:function(result){		
		document.getElementById('courname').innerHTML=result;
	}});
}
function getcourdet(id,pid,cid)
{	
	var URL="process/getcourdet.php?sid="+id+"&pid="+pid+"&cid="+cid;	
	$.ajax({	
	url:URL,
	success:function(result){		
		document.getElementById('cordet').innerHTML=result;
	}});
}
function getprg(id)
{	
	var URL="process/getpname.php?id="+id;
	$.ajax({	
	url:URL,
	success:function(result){
		if(id == 2 || id == 4)
		{
			document.getElementById('currency1').innerHTML='USD<img src="" width="20" height="20" id="cur1" border="0" style="float:left;margin-top:5px;"/>';
			document.getElementById('currency2').innerHTML='USD<img src="" width="20" height="20" id="cur2" border="0" style="float:left;margin-top:5px;"/>';
			document.getElementById('currency3').innerHTML='USD<img src="" width="20" height="20" id="cur3" border="0" style="float:left;margin-top:5px;"/>';
		}
		else
		{
			document.getElementById('currency1').innerHTML='<img src="images/rs.png" width="20" height="20" border="0" id="cur1" style="float:left;margin-top:5px;"/>';
			document.getElementById('currency2').innerHTML='<img src="images/rs.png" width="20" height="20" border="0" id="cur2" style="float:left;margin-top:5px;"/>';
			document.getElementById('currency3').innerHTML='<img src="images/rs.png" width="20" height="20" id="cur3" border="0" style="float:left;margin-top:5px;"/>';
			/* document.getElementById('cur1').src='images/rs.png';
			document.getElementById('cur2').src='images/rs.png';
			document.getElementById('cur3').src='images/rs.png'; */
		}
		document.getElementById('prgn').innerHTML=result;
	}});
}
$('#cena').click(function()
	{	
		var URL="template/newattend.php";			
		$.ajax({	
		url:URL,
		success:function(result){			
			$("#snatmt").html(result);			
		}});
	});
function getpercent()
{
	if(document.getElementById('mobt').value !='' && document.getElementById('mxm').value !='')
	{
		if(parseInt(document.getElementById('mobt').value) <= parseInt(document.getElementById('mxm').value))
		{
			document.getElementById('percent').value = document.getElementById('mobt').value;
		}
		else
		{
			alert("Marks obtained is greater than maximum mark");
			document.getElementById('mobt').value='';
		}
	}
	
}
function valcor()
{
	if (document.getElementById('mobt').value == "")
	{
		document.getElementById('errors').innerHTML ="<font color='#F70938' size='2'>Please Enter Marks Obtained.</font>";
		document.getElementById('mobt').value="";
		document.getElementById('mobt').focus();
		document.getElementById('chkval').value =1;
		valid=false;
		return valid;
	}	
	if (document.getElementById('remarks').value == "")
	{
		document.getElementById('errors').innerHTML ="<font color='#F70938' size='2'>Please Select Remark.</font>";
		document.getElementById('remarks').value="";
		document.getElementById('remarks').focus();
		document.getElementById('chkval').value =1;
		valid=false;
		return valid;
	}
	document.getElementById('chkval').value =0;	
	document.getElementById('errors').innerHTML="";
}
/****************************************************************** reprint function ***********************************************/
function chkreprint(val)
{	
	if(val == 2)
	{
		$('#recip').css('display','block');
		$('#rprv').css('display','none');
	}
	else
	{
		$('#recip').css('display','none');
		$('#rprv').css('display','block');
	}
}
</script>