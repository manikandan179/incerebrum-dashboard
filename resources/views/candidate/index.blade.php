@include('temp-parts.header');

<div class="content-wrapper">
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Student List</h3>
                <a href="{{ route('candidates.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Add Student
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="student_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<!-- Include DataTables Scripts -->
<script src="{{ url('/') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(function () {
        $('#student_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("candidates.list") }}',
            columns: [
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                { data: 'created_at' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    });

    function deleteCandidate(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action is irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/candidates/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#student_table').DataTable().ajax.reload();
                        Swal.fire('Deleted!', response.message, 'success');
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    }
</script>

@include('temp-parts.footer'); 
