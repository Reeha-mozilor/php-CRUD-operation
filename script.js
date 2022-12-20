jQuery.validator.addMethod("laxEmail", function(value, element) {
    return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
  }, 'Please enter a valid email address.');



    function openpop(id){
        id=id;
        document.getElementById('log').style.display='block';
        str="sample.php?id="+id;
        $.ajax({
            url:str,
            success:function(data){
                const dat=JSON.parse(data);
                $("#user").html(dat.user);
                $("#fname").val(dat.firstname);
                $("#lname").val(dat.lastname);
                $("#email").val(dat.email);
                $("#userid").val(dat.id);


            }
        });
    }
   
    
   








    

    

  
    function checkUsername() {
    
        jQuery.ajax({
        url: "useravail.php",
        data:'uname='+$("#uname").val(),
        type: "POST",
        success:function(data){
            $("#check-username").html(data);
        },
        error:function (){}
        });
    }

  

$("#log").validate({
        rules:{
            uname:"required",
            pass:
                "required"
        },
        messages:{
            uname:"Please enter your username",
            pass: "Please enter your password"
        }
    
 });

 $("#signup").validate({
    rules:{
        fname:"required",
        lname:"required",
        email:{ laxEmail:true,
                required: true
        },
        pass:{
            required:true,
            minlength:8
        }

    }   

});

$("#update").validate({
    rules:{
        fname:"required",
        lname:"required",
        email:{ laxEmail:true,
                required: true
        },
        pass:{
            required:true,
            minlength:8
        }

    }   

});

$(document).keydown(function(event) { 
    if (event.keyCode == 27) { 
      $('#log').hide();
    }
  });



