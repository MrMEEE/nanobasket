$(document).ready(function(){
  
  $('#saveuser').on('click',null,function(event){
	    event.preventDefault();
	    
	    if($('#newuser').val() == ""){
	      
	      alert(fetchText("Please enter username"));
	    
	    }else if($('#name').val() == ""){
	      
	      alert(fetchText("Please enter Name"));
	    
	    }else if($('#password1').val() == ""){
	      
	      alert(fetchText("Please enter password"));
	      
	    }else if($('#password2').val() == ""){
	      
	      alert(fetchText("Please repeat password"));
	      
	    }else if($('#password2').val() != $('#password1').val()){
	      
	      alert(fetchText("Passwords are not the same"));
	      
	    }else{
		  var password = CryptoJS.SHA256($("#password1").val()).toString();
		  
		  $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "saveuser", newuser: $('#newuser').val(), newpassword: password, email: $('#email').val(), name: $('#name').val(), usertype: $('#usertype').val() } ,success: function(data){
		    
		    if(data[0].status == "exists"){
			alert(fetchText("User already exists"));
		    }else{
			alert(fetchText("User created"));
			$('#newuser').val("");
			$('#name').val("");
			$('#password1').val("");
			$('#password2').val("");
			$('#email').val("");
		    }
		  }});
	    }
  });

  $('#users').on('change',null,function(event){
    //$('#name').html($('#users').val());
    if($('#users').val() != -1){
    $.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "getuser", id: $('#users').val() } ,success: function(data){
		    
		    $('#username').html(data[0].username);
		    $('#name').val(data[0].name);
		    $('#email').val(data[0].email);
		    $('#usertype').val(data[0].access);
    }});
  }else{
    
    $('#username').html("");  
    $('#name').val("");
    $('#email').val("");
    
  }
  });
  
  $('#edituser').on('click',null,function(event){
    
    event.preventDefault();
    
    if($('#users').val() != -1){
     
      if($('#name').val() == ""){
	      
	alert(fetchText("Please enter Name"));
	      
      }else if($('#password2').val() != $('#password1').val()){
	      
	alert(fetchText("Passwords are not the same"));
    
      }else{
	
	if($("#password1").val() == ""){
	  
	    var password = "";
	  
	}else{
	  
	    var password = CryptoJS.SHA256($("#password1").val()).toString();
	  
	}
	
	$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "edituser", id: $('#users').val(), newpassword: password, email: $('#email').val(), name: $('#name').val(), usertype: $('#usertype').val() } ,success: function(data){
			$('#name').val("");
			$('#password1').val("");
			$('#password2').val("");
			$('#email').val("");
			$("#users").val("-1");
	}});
	
      }
    }
    
  });
  
  $('#deleteuser').on('click',null,function(event){
    
    event.preventDefault();
    
    if($('#users').val() != -1){
     
      var answer = confirm(fetchText("Delete user: ")+$('#username').html());
      
      if (answer == true) {
	
	$.ajax({type: "POST", url: "ajax/sfobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "deleteuser", id: $('#users').val() } ,success: function(data){
	    $("#users option[value='"+$('#users').val()+"']").remove();
	    $("#users").val("-1");
	    $('#username').html("");  
	    $('#name').val("");
	    $('#email').val("");
	    $('#password1').val("");
	    $('#password2').val("");
	    
	}});
	
      }
      
    }
    
  });
});