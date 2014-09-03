$(document).ready(function(){
  
  $('#saveregisterplayers').on('click',null,function(event){
	    event.preventDefault();
	    
	    if($('#gyms').val() == -1){
	      
	      alert(fetchText("Please select a gym"));
	      
	    }else if($('#boys').val() == -1){
	    
	      alert(fetchText("Select number of boys"));
	      
	    }else if($('#girls').val() == -1){
	    
	      alert(fetchText("Select number of girls"));
	      
	    }else{
	      
		  $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "saveregisterplayers", gymid: $('#gyms').val(), userid: $('#userid').val(), boys: $('#boys').val(), girls: $('#girls').val(), year: $('#year').text(), month: $('#month').val(), day: $('#day').val() } ,success: function(data){
		    
		    if(data[0].status == "registered"){
			alert(fetchText("Number of players has been saved"));
		    	$('#gyms').val(-1);
			$('#boys').val(-1);
			$('#girls').val(-1);
			var d = new Date();
			$('#day').val(d.getDay());
			$('#month').val(d.getMonth()+1);
		    }
		  }});
	    }
  });

  
});