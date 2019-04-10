<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Send E-Mail</title>
</head>
<body>

<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-lg-start">
            <div class="col-lg-6">
                <div class="email-icon">
                    <img src="images/email.png" alt="No Email Found" class="img-fluid">
                </div>
                <div class="email-box text-white">
                    <form method="POST" id="formdata" autocomplete="off">
                        <div class="form-group">
                            <label >To Email</label>
                            <input type="email" class="form-control" id="toemail" name="toemail"
                                placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label >Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                placeholder="Write Subject">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" id="send_mail" name="submit" class="btn btn-outline-light w-100" value="Send Email">
                            <div class="spinner-border mt-3" style="width: 2rem; height: 2rem;" role="status" ></div>
                        </div>

                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>   

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Email Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3 id="font_msg" class="text-center"></h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script type="text/javascript">

$(document).ready(function (){

    $('.spinner-border').hide();

    $.validator.addMethod("regex", function(value, element, regexp){
		var re = new RegExp(regexp);
		return this.optional(element) || re.test(value);
    }, "Please Check Your Input" );

    $('#formdata').validate({
        rules : {
            toemail : {
                required : true,
                minlength : 5,
                regex : /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            },
            subject : {
                required : {
                    depends: function () {
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                maxlength : 250
            },
            message : {
                required : {
                    depends: function () {
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                maxlength : 3000
            }
        },
        messages : {
            toemail : {
                required : "Enter Receiver Email Address",
                minlength : "Enter Valid Email Address",
                regex : "Enter Valid Email Address"
            },
            subject : {
                required : "Enter Email Subject",
                maxlength : "Only 250 Charater Allow"
            },
            message : {
                required : "Enter Email Message",
                maxlength : "Only 3000 Charater Allow"
            }
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        },

        submitHandler: function () {

            $.ajax({
                type: "POST",
                url: "ajax/email-send.php",
                data: $('#formdata').serialize(),
                beforeSend: function() {
                    $('.spinner-border').show();
                    $('#send_mail').prop('disabled', true).addClass('disable-icon');
                },
                complete: function() {
                    $('.spinner-border').hide();
                    $('#send_mail').prop('disabled', false).removeClass('disable-icon');
                },
                success: function (response) {
                    var data_res = JSON.parse(response);
                    if(data_res.status == 400){
                        $('#myModal').modal('show');
                        $('#font_msg').text(data_res.data);
                        $('#formdata').trigger("reset");
                        console.log(data_res.data);
                    }
                    else{
                        $('#myModal').modal('show');
                        $('#font_msg').text(data_res.data); 
                        console.log(data_res.data);
                    }
                }

            });
            
           return false;
        }
        
    })


});

</script>

</body>
</html>