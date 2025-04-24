@empty($film)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
    <form action="{{ url('/film/' . $film->film_id . '/delete_ajax') }}" method="POST" id="form-konfirmasi">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Data Film</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Konfirmasi !!!</h5>
                        Apakah Anda yakin dengan data film ini?
                    </div>
                    <table class="table table-sm table-bordered table-striped">
                        <tr>
                            <th class="text-right col-3">Kode Film :</th>
                            <td class="col-9">{{ $film->film_kode }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Judul Film :</th>
                            <td class="col-9">{{ $film->film_nama }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Kategori :</th>
                            <td class="col-9">{{ $film->kategori->kategori_nama }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Harga Jual :</th>
                            <td class="col-9">{{ $film->harga_jual }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Konfirmasi</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-konfirmasi").validate({
                rules: {}, // Anda dapat menambahkan aturan validasi jika diperlukan
                submitHandler: function(form) {
                    event.preventDefault(); // Mencegah form submit biasa
                    $.ajax({
                        url: form.action,
                        type: 'DELETE',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal(
                                    'hide'); // Pastikan ID modal Anda adalah 'myModal'
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                }).then(() => {
                                    // Lakukan reload pada halaman atau tabel yang sesuai
                                    if (typeof dataFilm !== 'undefined') {
                                        dataFilm.ajax.reload();
                                    } else {
                                        window.location.reload();
                                    }

                                });

                            } else {
                                $('.error-text').text(''); //bersihkan pesan error
                                if (response.msgField) {
                                    $.each(response.msgField, function(prefix, val) {
                                        $('#error-' + prefix).text(val[0]);
                                    });
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false; // Mencegah form submit biasa
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
