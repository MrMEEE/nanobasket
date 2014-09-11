$(document).ready(function(){
  
  $('#savegym').on('click',null,function(event){
	    event.preventDefault();
	    
	    if($('#name').val() == ""){
	      
	      alert(fetchText("Please enter name of the Gym"));
	      
	    }else if($('#areas').val() == -1){
	    
	      alert(fetchText("Please select an Area"));
	      
	    }else{
	      
		  $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "savegym",  name: $('#name').val(), address: $('#address').val(), area: $('#areas').val()} ,success: function(data){
		    
		    if(data[0].status == "exists"){
			alert(fetchText("Gym already exists"));
		    }else{
			alert(fetchText("Gym created"));
			$('#name').val("");
			$('#address').val("");
			$('#areas').val("-1")
		    }
		  }});
	    }
  });

  $('#gyms').on('change',null,function(event){
    
    if($('#gyms').val() != -1){
    $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getgym", id: $('#gyms').val() } ,success: function(data){
		    $('#name').html(data[0].name);
		    $('#address').val(data[0].address);
		    $('#coaches').html(data[0].users.replace(/¤/g, "<br>"))
    }});
    
  }else{
    
    $('#name').html("");
    $('#address').val("");
    $('#coaches').html("");
    
  }
  });
  
  $('#areas').on('change',null,function(event){
    
    $('#gyms')
	.find('option')
	.remove()
	.end()
	.append('<option value="-1">'+fetchText("Select Gym")+'</option>')
	.val('-1');
    
    if($('#areas').val() != -1){
      $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getgyms", id: $('#areas').val() } ,success: function(data){
		    $.each(data, function(index) {
			  $('#gyms').append('<option value="'+ data[index].id +'">'+ data[index].name +'</option>');
		    });
    }});
    }else{
	
      $('#name').html("");
      $('#address').val("");
      $('#coaches').html("");
     
    }
    
  });
  
  $('#editgym').on('click',null,function(event){
    
    event.preventDefault();
    
    if($('#gyms').val() != -1){
	$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "editgym", id: $('#gyms').val(), address: $('#address').val() } ,success: function(data){
			$('#address').val("");
			$('#name').html("");
			$("#gyms").val("-1");
			$('#coaches').html("");
	}});

    }
    
  });
  
  $('#deletegym').on('click',null,function(event){
    
    event.preventDefault();
    
    if($('#gym').val() != -1){
     
      var answer = confirm(fetchText("Delete gym: ")+$('#name').html());
      
      if (answer == true) {
	
	$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "deletegym", id: $('#gyms').val() } ,success: function(data){
	    $("#gyms option[value='"+$('#gyms').val()+"']").remove();
	    $("#gyms").val("-1");
	    $('#name').html("");  
	    $('#address').val("");
	    $('#coaches').html("");
	}});
	
      }
      
    }
    
  });
  
  $('#addcoach').on('click',null,function(event){
  
    event.preventDefault();
    
	$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "addcoach", gymid: $('#gyms').val(), userid: $('#users').val()} ,success: function(data){
	    
	    if(data[0].status == "added"){
	      
		$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getgym", id: $('#gyms').val() } ,success: function(data){
		    $('#coaches').html(data[0].users.replace(/¤/g, "<br>"))
		}});
	      
	    }
	}});
    
  });
  
  $('#remcoach').on('click',null,function(event){
  
    event.preventDefault();
    
	$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "remcoach", gymid: $('#gyms').val(), userid: $('#users').val()} ,success: function(data){
	    
	    if(data[0].status == "removed"){
	      
		$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getgym", id: $('#gyms').val() } ,success: function(data){
		    $('#coaches').html(data[0].users.replace(/¤/g, "<br>"))
		}});
	      
	    }
	}});
    
  });
  
});