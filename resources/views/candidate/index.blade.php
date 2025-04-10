@include('temp-parts.header')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Students</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div class="d-flex justify-content-end">
                <a href="{{url('candidates/create') }}" class="btn btn-primary mr-3">
                    <i class="fas fa-plus"></i> Add Student
                </a>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body table-responsive">
                        <table id="candidate_table" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="{{ url('/') }}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    //  DataTable init
    $(document).ready(function () {
        $('#candidate_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ url("/get-candidates") }}',
            columns: [
                { data: 'name' , orderable: false},
                { data: 'email' , orderable: false},
                { data: 'phone' , orderable: false},
                { data: 'created_at', orderable: false },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
        
        // Show toast if success message is present in session
        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session("success") }}'
            });
        @endif
    });

    // Delete student function
    function deleteCandidate(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will delete this student!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/candidates/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#candidate_table').DataTable().ajax.reload();
                        Toast.fire({
                            icon: 'success',
                            title: 'Deleted successfully!'
                        });
                    },
                    error: function () {
                        Toast.fire({
                            icon: 'error',
                            title: 'Error deleting student.'
                        });
                    }
                });
            }
        });
    }
</script>

@include('temp-parts.footer')
