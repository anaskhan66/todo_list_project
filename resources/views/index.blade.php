<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Php - Simple To Do List App</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Php - Simple To Do List App</h1>
                <br> <br>
                <div class="mb-3 d-flex">
                    <input type="text" class="form-control" style="width: 80%;margin-right:10px;" id="input" name="input">
                    <button type="button" onclick="saveTask();" class="btn btn-primary ml-2">Submit</button>

                </div>
                <br>
                <button type="button" onclick="getTaskList('');" class="btn btn-primary ml-2">Show All Task</button>
                <br> <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Task</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="bodytag">
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
        function saveTask() {
            var input = $("#input").val();
            if (input != '') {
                $.ajax({
                    type: "POST",
                    url: 'api/saveTask?input=' + input,
                    success: function(data) {
                        if (data.success == true) {
                            alert(data.msg);
                            getTaskList(0);
                            $("#input").val('');
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            }
        }

        function getTaskList(status) {
            $.ajax({
                type: "GET",
                url: 'api/getTask?status=' + status,
                success: function(data) {
                    console.log(data);
                    $("#bodytag").html(data);
                }
            });
        }

        $(document).ready(function() {
            getTaskList(0);
        });

        function deleteTask(id) {
            if (id != '') {
                let text = "Are u sure to delete this task ?";
                if (confirm(text) == true) {
                    $.ajax({
                        type: "GET",
                        url: 'api/deleteTask?id=' + id,
                        success: function(data) {
                            if (data.success == true) {
                                alert(data.msg);
                                getTaskList(0);
                            }
                        }
                    });
                }
            }
        }

        function markAsCompleted(id){
            if (id != '') {
                    $.ajax({
                        type: "GET",
                        url: 'api/markAsCompleted?id=' + id,
                        success: function(data) {
                            if (data.success == true) {
                                alert(data.msg);
                                getTaskList(0);
                            }
                        }
                    });
            }
        }
    </script>
</body>

</html>