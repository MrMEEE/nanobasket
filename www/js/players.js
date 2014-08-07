$(document).ready(function(){
  
  $('#saveregisterplayers').on('click',null,function(event){
	    event.preventDefault();
	    
	    if($('#gyms').val() == -1){
	      
	      alert(fetchText("Please select a gym"));
	      
	    }else if($('#players').val() == -1){
	    
	      alert(fetchText("Select number of players"));
	      
	    }else{
	      
		  $.ajax({type: "POST", url: "ajax/nanobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "saveregisterplayers", gymid: $('#gyms').val(), userid: $('#userid').val(), players: $('#players').val() } ,success: function(data){
		    
		    if(data[0].status == "registered"){
			alert(fetchText("Number of players has been saved"));
		    	$('#gyms').val(-1);
			$('#players').val(-1);
		    }
		  }});
	    }
  });

  
});