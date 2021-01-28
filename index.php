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
        <div id="user_table" class="table-responsive">

        </div>
    </main>
    <!-- Bootstrap 4 Java Script -->
    <script src="assets/scripts/bootstrap.min.js"></script>
    <!-- jQuery Scripts -->
    <script src="assets/scripts/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            load_data();
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
        });
    </script>
</body>
</html>