<!DOCTYPE html>
<html>

<head>
    <title>Live search in laravel using AJAX</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>

<body>
    <br />
    <div class="container box">
        <h3 align="center">Live search in laravel using AJAX</h3><br />
        <div class="row">
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Search Customer Data</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="Search Customer Data" />
                        </div>
                        <div class="table-responsive">
                            <h3 align="center">Total Data : <span id="total_records"></span></h3>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="datatable">
        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <table>
                    <tr>
                        <td>Name</td>
                        <td><span id="name"></span></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><span id="email"></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            fetch_data();

            function fetch_data(query) {
                $.ajax({
                    url: "{{ route('user.action') }}",
                    method: 'POST',
                    data: {
                        query: query,
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#datatable').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                })
            }

            $(document).on('keyup', '#search', function () {
                var query = $(this).val();
                fetch_data(query);
            });
        });

        function edit(name,email) {
            $('#name').html(name);
            $('#email').html(email);
        }

    </script>
</body>

</html>

