$(document).ready(function(){
      
      $('.loginButton').on('click',null,function(event){
	    event.preventDefault();
	    var password = CryptoJS.SHA256($("#password").val()).toString();
	    $.ajax({type: "POST", url: "ajax/nanobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "logon", username: $("#username").val(), password: password, club: $("#clubSelect").val()} ,success: function(data){
		  if(data[0].status == 1){
			alert(fetchText("Wrong Username or Password"));
		  }else{
			location.reload();
		  }
	    }});
      });
      
      $('.navigation').on('click',null,function(event){
	    event.preventDefault();
	    $('#nextState').attr('value', event.target.id);
	    $('#mainForm').submit();
	    //alert(event.target.id);
      });
      
      $('#logout').on('click',null,function(event){
	    event.preventDefault();
	    $.ajax({type: "POST", url: "ajax/nanobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "logout" } ,success: function(data){
			
	    }});
	    document.location.reload(true);
      });
  
});

function changeState(newstate){

  document.mainForm.nextState.value = newstate;
  document.mainForm.submit();

}

function fetchText(string){
      var newtext;
      
      $.ajax({type: "POST", url: "ajax/nanobasket.ajax.common.php",async:false,dataType: "json",data:{ action: "fetchText", string: string } ,success: function(data){
	newtext = data[0].text;
	
      }});
      
      return newtext;
  
}