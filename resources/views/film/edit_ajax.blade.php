@empty($film)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/film') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/film/' . $film->film_id . '/update_ajax') }}" method="POST" id="form-edit-film">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Film</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->kategori_id }}" {{ $film->kategori_id == $kat->kategori_id ? 'selected' : '' }}>{{ $kat->kategori_nama }}</option>
                            @endforeach
                        </select>
                        <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Kode Film</label>
                        <input value="{{ $film->film_kode }}" type="text" name="film_kode" id="film_kode"
                            class="form-control" required>
                        <small id="error-film_kode" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Judul Film</label>
                        <input value="{{ $film->film_nama }}" type="text" name="film_nama" id="film_nama"
                            class="form-control" required>
                        <small id="error-film_nama" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Harga Jual</label>
                        <input value="{{ $film->harga_jual }}" type="number" name="harga_jual" id="harga_jual"
                            class="form-control" required>
                        <small id="error-harga_jual" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-edit-film").validate({
                rules: {
                    kategori_id: {
                        required: true,
                    },
                    film_kode: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    film_nama: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    harga_jual: {
                        required: true,
                        number: true,
                        min: 0
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                }).then(() => {
                                     if (typeof dataFilm !== 'undefined') {
                                        dataFilm.ajax.reload();
                                    } else {
                                         window.location.reload(); //fallback jika datatable tidak ada
                                    }
                                });
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty