@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('film/create_ajax') }}')"
                        class="btn btn-sm btn-success mt-1">Tambah Film
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <option value="">- Semua -</option>
                                @foreach($kategori as $item)
                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Kategori Film</small>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm" id="table_film">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Kode Film</th>
                    <th>Judul Film</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                </tbody> 
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog"
         data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true">
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        $(document).ready(function () {
            var dataFilm = $('#table_film').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('film/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d) {
                        d.kategori_id = $('#kategori_id').val();
                    }
                },
                columns: [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        // mengambil data kategori hasil dari ORM berelasi
                        data: "kategori.kategori_nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },{
                        data: "film_kode",
                        className: "",
                        // orderable : true , jika ingin kolom ini bisa diurutkan
                        orderable: true,
                        // searchable : true , jika ingin kolom ini bisa dicari
                        searchable: true
                    }, {
                        data: "film_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "harga_jual",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
            });

            $('#kategori_id').on('change', function () {
                dataFilm.ajax.reload();
            });
        });
    </script>
@endpush