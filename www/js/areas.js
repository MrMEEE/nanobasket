$(document).ready(function(){
  
  $('#savearea').on('click',null,function(event){
	    event.preventDefault();
	    
	    if($('#name').val() == ""){
	      
	      alert(fetchText("Please enter name of the Area"));
	    
	    }else{
	      
		  $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "savearea",  name: $('#name').val() } ,success: function(data){
		    
		    if(data[0].status == "exists"){
			alert(fetchText("Area already exists"));
		    }else{
			alert(fetchText("Area created"));
			$('#name').val("");
		    }
		  }});
	    }
  });
  
  $('#deletearea').on('click',null,function(event){
    
    event.preventDefault();
    
    if($('#area').val() != -1){
     
      var answer = confirm(fetchText("Delete area: ")+$('#areas').children("option").filter(":selected").text());
      
      if (answer == true) {
	
	$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "deletearea", id: $('#areas').val() } ,success: function(data){
	    $("#areas option[value='"+$('#areas').val()+"']").remove();
	    $("#areas").val("-1");
	}});
	
      }
      
    }
    
  });
  
  
});