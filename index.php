<?php
    include 'Crud.php';
    $obj = new Crud();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax CRUD Ops</title>
    <!-- Bootstrap 4 Style Sheet -->
    <link rel="stylesheet" href="assets/styles/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <!-- Font awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
</head>

<body>
    <!-- Header -->
    <div class="container box">
            <h3 class="text-center">AJAX CRUD Operation Using OOP - Fetch Data</h3><br><br>
        </div>
    <!-- MAIN -->
    <main>
        <div class="container">
            <div class="card-header">
                <button type="button" name="add" class="btn btn-outline-primary" data-toggle="collapse" data-target="#user_collapse"><i class="fas fa-plus"></i></button>
                <br><br>
                <div id="user_collapse" class="collpase">
                    <form id="user_form" method="POST" class="form">
                    <div class="form-group">
                    <label for="first_name">First Name</label>
                      <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Eg. Muhammad Ali">
                      <small class="text-muted">Enter your first name here</small>
                    </div>
                    <br>
                    <div class="form-group">
                    <label for="last_name">Last Name</label>
                      <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Eg. Modi">
                      <small class="text-muted">Enter your last name here</small>
                    </div>
                    <br>
                    <div class="form-group">
                    <label for="user_image">Image</label>
                      <input type="file" name="user_image" id="user_image" class="form-control" />
                      <input type="hidden" name="hidden_user_image" id="hidden_user_image" />
                      <span id="uploaded_image"></span>
                      <small class="text-muted">Select your image</small>
                    </div>
                    <div align="center">
                        <input type="hidden" name="action" id="action">
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="submit" name="button_action" id="button_action" value="Insert" class="btn btn-outline-danger" />
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <!-- FETCH DATA -->
        <div id="user_table" class="table-responsive">
        </div>
    </main>
    <script src="assets/scripts/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function(){
            load_data();
            $('#action').val("Insert");
            function load_data()
            {
                var action = "Load";
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data:{action:action},
                    success: function(data)
                    {
                        $('#user_table').html(data);
                    }
                });
            }

            $('#user_form').on('submit' ,function(event)
            {
                event.preventDefault();
                var firstName   = $('#first_name').val();
                var lastName    = $('#last_name').val();
                var extension   = $('#user_image').val().split('.').pop().toLowerCase();
                if(extension != '') 
                {
                    if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
                    {
                        Swal.fire(
                        {
                            title: 'Error!',
                            text: 'Invalid Image File',
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        });
                        $('#user_image').val('');
                        return false;
                    }
                }
                if(firstName != '' || lastName != '')
                {
                    $.ajax({
                        url: 'action.php',
                        method: 'POST',
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {
                            Swal.fire(
                        {
                            title: 'Success',
                            text: data,
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        });
                        $('#user_form')[0].reset();
                        load_data();
                        }
                    })
                }
                else 
                {
                    Swal.fire(
                        {
                            title: 'Error!',
                            text: 'Both fields are required',
                            icon: 'error',
                            confirmButtonText: 'Okay'
                        });
                }
            });

            $(document).on('click', '.update', function(){
                var user_id = $(this).attr('id');
                var action = "Fetch Single Data";
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data:{user_id:user_id, action:action},
                    dataType: "json",
                    success:function(data)
                    {
                        $('.collapse').collapse("show");
                        $('#first_name').val(data.first_name);
                        $('#last_name').val(data.last_name);
                        $('#last_name').val(data.last_name);
                        $('#uploaded_image').val(data.image);
                        $('#hidden_user_image').val(data.user_image);
                        $('#button_action').val("Edit");
                        $('#action').val("Edit");
                        $('#user_id').val(user_id);
                        console.log(data);
                    }
                })
            })
        });
    </script>
</body>
</html>