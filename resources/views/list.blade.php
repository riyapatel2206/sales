<!DOCTYPE html>
<html>
<head>
	<title>Sales List Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css"  />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" ></script>
    <link  href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">Sales List</h2>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-info" onclick="addRecords();"> Add Dummy Records</button>
                        <button class="btn btn-info" onclick="importProduct();"> Import Product</button>
            <table class="table table-striped table-bordered table-hover table-checkable order-column full-width mt-2" id="data-table">
                <thead>
                    <th>No.</th>
                    <th>Customer Name</th>
                    <th>Grand Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
		</div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Import Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('product-import')}}"  enctype="multipart/form-data">
                            @csrf
                            <label class="form-lable">select file</label>
                            <input type="file" name="file" class="form-control">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    jQuery.noConflict();
    var list_table_one;
        $(document).ready(function() {
            if($('#data-table').length > 0){
                list_table_one = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,

                    // "pageLength": 10,
                    // "iDisplayLength": 10,
                    "responsive": true,
                    "aaSorting": [],
                    // "order": [], //Initial no order.
                    //     "aLengthMenu": [
                    //     [5, 10, 25, 50, 100, -1],
                    //     [5, 10, 25, 50, 100, "All"]
                    // ],
                    
                    // "scrollX": true,
                    // "scrollY": '',
                    // "scrollCollapse": false,
                    // scrollCollapse: true,
                    
                    "ajax":{
                        "url": "{{ route('sales-list-fetch') }}",
                        "type": "POST",
                        "dataType": "json",
                        "data":{
                            _token: "{{csrf_token()}}"
                        }
                    },
                    "columnDefs": [{
                            "targets": [0, 4], //first column / numbering column
                            "orderable": true, //set not orderable
                        },
                    ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'customer_name',
                            name: 'customer_name',
                        },
                        {
                            data: 'grand_total',
                            name: 'grand_total',
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                        },
                    ]
                });
            }
        });

        function change_status(a_object){
            var status = $(a_object).data("status");
            var id = $(a_object).data("id");
            $.ajax({
                "url": "{!! route('sales-change-status') !!}",
                "dataType": "json",
                "type": "POST",
                "data":{
                    id: id,
                    status: status,
                    _token: "{{csrf_token()}}"
                },
                success: function (response){
                    if (response.code == 200){
                        list_table_one.ajax.reload(null, false); //reload datatable ajax
                        // toastr.success('Status Change Successfully', 'Success');
                    }else{
                        // toastr.error('Failed to update Status', 'Error');
                    }
                }
            });
        }
	function addRecords()
    {
       $.ajax({
                "url": "{!! route('sale.dummy.record') !!}",
                "dataType": "json",
                "type": "POST",
                "data":{
                    _token: "{{csrf_token()}}"
                },
                success: function (response){
                    if (response.code == "200"){
                        list_table_one.ajax.reload(null, false);
                        // toastr.success(response.message, 'Success');
                        // location.reload();
                    }else{
                        // toastr.error('Record Can not add', 'Error');
                    }
                }
            });
    }
    function importProduct()
    {
        $("#myModal").modal('show');
    }
</script>
</html>