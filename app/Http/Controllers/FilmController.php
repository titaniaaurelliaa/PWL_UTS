<?php

namespace App\Http\Controllers;

use App\Models\FilmModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class FilmController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data film',
            'list'  => ['Home', 'film']
        ];

        $page = (object) [
            'title' => 'Daftar film yang terdaftar dalam sistem'
        ];

        $activeMenu = 'film';

        $kategori = KategoriModel::all();

        return view('film.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function list(Request $request)
    {
        $products = FilmModel::select('film_id', 'kategori_id', 'film_kode', 'film_nama', 'harga_jual')->with('kategori');

        // Filter data film berdasarkan kategori_id
        if ($request->kategori_id) {
            $products->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($products)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($film) {
                // menambahkan kolom aksi
                // $btn = '<a href="' . url('/film/' . $film->film_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/film/' . $film->film_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/film/' . $film->film_id) . '">'
                //     . csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm"
                //     onclick="return confirm(\'Apakah Anda yakit menghapus data
                //     ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/film/' . $film->film_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/film/' . $film->film_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';

                $btn .= '<button onclick="modalAction(\'' . url('/film/' . $film->film_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah film',
            'list'  => ['Home', 'film', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah film baru'
        ];

        $kategori = KategoriModel::all();

        $activeMenu = 'film';

        return view('film.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Create ajax
    public function create_ajax()
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();

        return view('film.create_ajax')->with('kategori', $kategori);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'   => 'required|int',
            'film_kode'   => 'required|string|min:3|unique:m_film,film_kode',
            'film_nama'   => 'required|string|max:100',
            'harga_jual'    => 'required|integer'
        ]);

        FilmModel::create([
            'kategori_id'   => $request->kategori_id,
            'film_kode'   => $request->film_kode,
            'film_nama'   => $request->film_nama,
            'harga_jual'    => $request->harga_jual
        ]);

        return redirect('/film')->with('success', 'Data film berhasil disimpan');
    }

    // Store ajax
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson) {
            $rules = [
                'kategori_id' => 'required|int',
                'film_kode' => 'required|string|min:3|unique:m_film,film_kode',
                'film_nama' => 'required|string|max:100',
                'harga_jual' => 'required|integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            FilmModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data film berhasil disimpan',
            ]);
        }
        return redirect('/');
    }

    public function show(string $id)
    {
        $film = FilmModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail film',
            'list'  => ['Home', 'film', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail film'
        ];

        $activeMenu = 'film';

        return view('film.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'film' => $film]);
    }

    public function edit(string $id)
    {
        $film = FilmModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit film',
            'list'  => ['Home', 'film', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit film'
        ];

        $activeMenu = 'film';

        return view('film.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'film' => $film, 'kategori' => $kategori]);
    }

    // Edit ajax
    public function edit_ajax(string $id)
    {
        $film = FilmModel::find($id);
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();

        return view('film.edit_ajax', ['film' => $film, 'kategori' => $kategori]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_id'   => 'required|integer',
            'film_kode'   => 'required|string|min:3|unique:m_film,film_kode,' . $id . ',film_id',
            'film_nama'   => 'required|string|max:100',
            'harga_jual'    => 'required|integer'
        ]);

        FilmModel::find($id)->update([
            'kategori_id'   => $request->kategori_id,
            'film_kode'   => $request->film_kode,
            'film_nama'   => $request->film_nama,
            'harga_jual'    => $request->harga_jual
        ]);

        return redirect('/film')->with('success', 'Data film berhasil diubah');
    }

    // Update ajax
    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_id' => 'required|integer',
                'film_kode' => 'required|string|min:3|unique:m_film,film_kode,' . $id . ',film_id',
                'film_nama' => 'required|string|max:100',
                'harga_jual' => 'required|integer',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
            $check = FilmModel::find($id);
            if ($check) {
                $check->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data film berhasil diupdate',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data film tidak ditemukan',
                ]);
            }
        }
        return redirect('/');
    }

    // Confirm ajax
    public function confirm_ajax(string $id)
    {
        $film = FilmModel::find($id);

        return view('film.confirm_ajax', ['film' => $film]);
    }

    // Delete ajax
    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $film = FilmModel::find($id);

            if ($film) {
                $film->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data film berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data film tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function destroy(string $id)
    {
        $check = FilmModel::find($id);

        if (!$check) {
            return redirect('/film')->with('error', 'Data film tidak ditemukan');
        }

        try {
            FilmModel::destroy($id);

            return redirect('/film')->with('success', 'Data film berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/film')->with('error', 'Data film gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}