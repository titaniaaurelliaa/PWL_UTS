<form action="{{ url('/film/ajax') }}" method="POST" id="form-tambah-film">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Film</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->kategori_id }}">{{ $kat->kategori_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kode Film</label>
                    <input value="" type="text" name="film_kode" id="film_kode" class="form-control" placeholder="Masukkan Kode Level" required>
                    <small id="error-film_kode" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Judul Film</label>
                    <input value="" type="text" name="film_nama" id="film_nama" class="form-control" placeholder="Masukkan Judul Film" required>
                    <small id="error-film_nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input value="" type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Masukkan Harga Film" required>
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
        $("#form-tambah-film").validate({
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
                                // Reload the DataTable, if it exists
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