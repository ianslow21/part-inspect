<?php

namespace App\Http\Controllers;
use App\Models\Parts;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$dataparts = Parts::all();
        //return view('index', ['parts' => $dataparts]);


        $dataparts = DB::table('parts')->orderBy('part_name', 'ASC')->get();;
        return view('index', ['parts' => $dataparts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form_tambah_parts');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Parts::create($request->all());
        if($request->hasFile('foto')) {
        $request->file('foto')->move('fotoparts/', $request->file('foto')->getClientOriginalName());
        $data->foto = $request->file('foto')->getClientOriginalName();
        $data->save();
        }

        return redirect()-> route('parts.index')->with('success','Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parts = Parts::where('id', $id)->first();
        return view('detail_parts', ['parts' => $parts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataparts = Parts::find($id);
        return view('form_ubah_parts', ['parts' => $dataparts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ubah = Parts::findOrFail($id);

        // Menyimpan nilai awal dari atribut 'foto', 'dimension', dan 'judgement'
        $awalFoto = $ubah->foto;
        $awalDimension = $ubah->dimension;
        $awalJudgement = $ubah->judgement;

        // Mengambil nama asli file yang diunggah (jika ada)
        if ($request->hasFile('foto')) {
            $namaFileBaru = $request->file('foto')->getClientOriginalName();

            // Path lengkap ke file foto lama
            $pathFotoLama = public_path('/fotoparts') . '/' . $awalFoto;

            // Hapus foto lama jika ada
            if (!is_null($awalFoto) && file_exists($pathFotoLama)) {
                unlink($pathFotoLama);
            }

            // Pindahkan file foto baru ke direktori 'public/fotoparts' dengan nama baru
            $request->file('foto')->move(public_path('/fotoparts'), $namaFileBaru);

            // Update atribut 'foto' dengan nama file baru
            $data['foto'] = $namaFileBaru;
        }

        // Update atribut 'dimension' dan 'judgement'
        // Pastikan user memiliki hak akses atau role tertentu untuk mengubah dimension dan judgement
        if (auth()->user()->can('isGeneral_User')) {
            $data['dimension'] = $request->input('dimension', $awalDimension);
            $data['judgement'] = $request->input('judgement', $awalJudgement);
        }

        // Lakukan update dengan data yang sudah disiapkan
        $ubah->update($data);

        return redirect()->route('parts.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Parts::findorfail($id);

        // Mendapatkan path lengkap ke file foto
        $file = public_path('/fotoparts/') . $hapus->foto;

        // Memeriksa apakah file foto ada
        if (File::exists($file)) {
            // Menghapus file foto
            File::delete($file);
        }

        // Menghapus data dari database
        $hapus->delete();

        return redirect()->route('parts.index')->with('success', 'Data Deleted Successfully');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("parts")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Data parts berhasil terhapus..."]);

    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $dataparts = Parts::where('part_name', 'like', "%" . $keyword . "%")->orWhere('supplier', 'like', "%" . $keyword . "%")->orWhere('part_number', 'like', "%" . $keyword . "%")->paginate(1000);
        return view('tableparts', ['parts' => $dataparts]);
    }

}
