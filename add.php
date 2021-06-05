	<script>
$(document).ready(function() {
	 $("#comp_name").keyup(function(event){
				var comp_name = $(this).val();
			if(comp_name!=""){	
			$.ajax( {
				 url:'ajax_search.php',
				  data: {
					c_na:comp_name,
					},
				type:"GET",
                  success:function(data) {
                    $('#div_search').fadeIn();
                     $('#div_search').html(data);
                  }
			
               });
	 }
	 else
	 {
		 $('#div_search').fadeOut();
         $('#div_search').html();
	 }
			});
	$(document).on('click','li',function(){
		$('#comp_name').val($(this).text()); 
		$('#div_search').fadeOut();
		});
	});
</script>	
     


  <br />
  <div class="wrapper">
   
  
  
  <div class="input-group">
                <div class="input-box">
                    <input type="text" name="comp_name" id="comp_name" placeholder="Company Name" class="name" value="<?php echo $comp_name;?>">
                    <i class="fa fa-search icon"></i>
					
                </div><div id="div_search"></div> <button type="submit" value="submit">Search</button>
</div>

 
</div>
				

 