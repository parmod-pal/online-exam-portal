		<footer>
			<hr>
			
		</footer>
	</div>
</div>
<script src="lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
	$("[rel=tooltip]").tooltip();
	
	$(function(){
		$('.demo-cancel-click').click(function(){return false;});	
		
		$('.delus').on('click',function(){		
			var id=$(this).attr('id');
			localStorage.setItem('urid',id);			
		});
		
		$('#dus').on('click',function(){		
			var qid=localStorage.getItem('urid').split('-');
			var URL='delus.php';			
			$.ajax({
				url:URL,
				type:'POST',
				data:'qid='+qid[1],
				success:function(data){
					if(data > 0)
					{
						window.location="users.php";
					}
				}
			});
		});
		$('#dnews').on('click',function(){		
			var qid=localStorage.getItem('urid').split('-');
			var URL='delnews.php';			
			$.ajax({
				url:URL,
				type:'POST',
				data:'qid='+qid[1]+'&im='+qid[2],
				success:function(data){
					if(data > 0)
					{
						window.location="viewnews.php";
					}
				}
			});
		});
		$('#dtesti').on('click',function(){		
			var qid=localStorage.getItem('urid').split('-');
			var URL='deltestimonial.php';			
			$.ajax({
				url:URL,
				type:'POST',
				data:'qid='+qid[1]+'&im='+qid[2],
				success:function(data){
					if(data > 0)
					{
						window.location="viewtestimonial.php";
					}
				}
			});
		});
		$('#dtut').on('click',function(){		
			var qid=localStorage.getItem('urid').split('-');
			var URL='deltutorial.php';			
			$.ajax({
				url:URL,
				type:'POST',
				data:'qid='+qid[1],
				success:function(data){
					if(data > 0)
					{
						window.location="viewtutorial.php";
					}
				}
			});
		});
		/* $('#dportfolio').on('click',function(){		
			var qid=localStorage.getItem('urid').split('-');
			var URL='delportfolio.php';			
			$.ajax({
				url:URL,
				type:'POST',
				data:'qid='+qid[1]+'&im='+qid[2],
				success:function(data){
					if(data > 0)
					{
						window.location="viewportfolio.php";
					}
				}
			});
		}); */
			$('#delcm').on('click',function(){		
			var qid=localStorage.getItem('urid').split('-');
			var URL='delcomments.php';			
			$.ajax({
				url:URL,
				type:'POST',
				data:'qid='+qid[1],
				success:function(data){
					if(data > 0)
					{
						window.location="viewcomments.php";
					}
				}
			});
		});
		$('.apprvcm').on('click',function(){	
		
			var qid=$(this).attr('id').split('-');		
			var URL='approvecomments.php';			
			$.ajax({
				url:URL,
				type:'POST',
				data:'qid='+qid[1]+'&u='+qid[2],
				success:function(data){
				
					if(data > 0)
					{
						window.location="viewcomments.php";
					}
				}
			});
		});
		$('.actv').on('click',function(e){
			e.preventDefault();
			var qid=$(this).attr('href').split('-');
			var URL='actquote.php';			
			$.ajax({
				url:URL,
				type:'POST',
				data:'st='+qid[0]+'&qid='+qid[1],
				success:function(data){
					if(data > 0)
					{
						window.location="<?php echo $_SERVER['PHP_SELF'].'?q=';?>"+qid[2]+"&page="+qid[3];
					}
				}
			});
		});
		$('#dcate').on('click',function(){		
			var qid=localStorage.getItem('urid').split('-');
			var URL='delcategory.php';			
			$.ajax({
				url:URL,
				type:'POST',
				data:'qid='+qid[1],
				success:function(data){
					if(data > 0)
					{
						window.location="viewcategory.php";
					}
				}
			});
		});
	});
</script>    
</body></html>