
@include('temp-parts.header')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('/')}}/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Upskills</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Upskills</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upskill List</h3>
                </div>
                <div class="card-body">
                    <table id="upskill_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($upskills as $upskill)
                                <tr>
                                    <td>{{ $upskill->name }}</td>
                                    <td>{{ $upskill->email }}</td>
                                    <td>{{ $upskill->phone }}</td>
                                    <td>{{ $upskill->message }}</td>
                                    <td>{{ $upskill->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No records found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- jQuery -->
<script src="{{url('/')}}/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
@include('temp-parts.footer')