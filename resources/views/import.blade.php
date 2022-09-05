<!DOCTYPE html>

<html>

<head>
    <title>PHPSpreadsheet in Laravel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
</head>

<body>
    <div class="container">
        <div class="card-header bg-secondary dark bgsize-darken-4 white card-header">
            <h4 class="text-white">Handling Excel Data using PHPSpreadsheet in Laravel</h4>
        </div>

        <div class="row justify-content-centre" style="margin-top: 4%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bgsize-primary-4 white card-header">
                        <h4 class="card-title">Import Excel Data</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <label>
                                    Select File to Upload
                                    <small class="warning text-muted">
                                        {{ __('Please upload only Excel (.xlsx or .xls) files') }}
                                    </small>
                                </label>
                                <div class="input-group">
                                    <input
                                        accept=".csv, .tsv, .xls, .xlsx"
                                        type="file" required class="form-control"
                                        name="uploaded_file" id="uploaded_file"
                                    >
                                    @error('uploaded_file')
                                        <p class="text-right mb-0">
                                            <small
                                                class="danger text-muted"
                                                id="file-error"
                                            >
                                                {{ $message }}
                                            </small>
                                        </p>
                                    @enderror
                                    <div class="input-group-append" id="button-addon2">
                                        <button class="btn btn-primary square" type="submit"><i
                                                class="ft-upload mr-1"></i> Upload</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-left">
            <div class="col-md-12">
                <br />
                <div class="card">
                    <div class="card-header bgsize-primary-4 white card-header">
                        <h4 class="card-title">Form Data Table</h4>
                    </div>
                    <div class="card-body">
                        <div class="pull-right">
                            <a href="{{ url('export') }}" class="btn btn-primary" style="margin-left:85%">
                                Export Excel Data
                            </a>
                        </div>
                        <div class=" card-content table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Type</th>
                                    <th>Start time</th>
                                    <th>End time</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if (!empty($data) && $data->count())
                                        @foreach ($data as $form)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $form->user_id }}</td>
                                                <td>{{ $form->m_type_form_id }}</td>
                                                <td>{{ $form->start_time }}</td>
                                                <td>{{ $form->end_time }}</td>
                                                <td>{{ $form->reason }}</td>
                                                <td>{{ $form->status }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
</body>

</html>
