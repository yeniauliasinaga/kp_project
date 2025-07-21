<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\TiketPesawat;
use App\Models\Hotel;
use App\Models\CheckinMess;
use App\Models\DataMess;
use App\Models\PermintaanKendaraan;
use App\Models\Kendaraan;
use App\Models\Proposal;
use App\Models\Supir;
use App\Models\Unit;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        // Mobil yang tersedia (status: tersedia)
        $mobilTersedia = Kendaraan::where('status', 'tersedia')->count();
        $mobilList = Kendaraan::where('status', 'tersedia')->get();

        // Mess yang tersedia (status: tersedia)
        $messTersedia = DataMess::where('status', 'tersedia')->count();
        $messList = DataMess::where('status', 'tersedia')->orderBy('lokasi')->take(10)->get();

        // Kegiatan yang sedang berlangsung
        $acaraBerlangsung = Kegiatan::where('status', 'berlangsung')->count();
        $acaraList = Kegiatan::where('status', 'berlangsung')
            ->orderBy('waktu_mulai', 'desc')
            ->take(10)
            ->get();

        // Kegiatan yang akan datang
        $acaraBerikut = Kegiatan::where('status', 'akan_datang')->count();
        $kegiatanList = Kegiatan::where('status', 'akan_datang')
            ->orderBy('waktu_mulai', 'asc')
            ->take(10)
            ->get();

        // Tambahkan query untuk berita terbaru (misal 6 berita terbaru)
        $beritaList = Berita::orderBy('tanggal_publikasi', 'desc')->take(6)->get();

        return view('staff.dashboard', compact(
            'mobilTersedia', 'mobilList',
            'messTersedia', 'messList',
            'acaraBerlangsung','acaraBerikut', 'acaraList', 'kegiatanList',
            'beritaList'
        ));
    }

    // ================= BERITA =================
    public function berita()
    {
        $beritas = Berita::latest()->get();
        return view('staff.berita', compact('beritas'));
    }

    public function beritaCreate()
    {
        return view('staff.tambahBerita');
    }

    public function beritaStore(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'judul' => 'required|string|max:255',
            'sumber_media' => 'required|string|max:255',
            'link' => 'required|url',
            'jenis_berita' => 'required|in:positif,negatif',
            'tanggal_publikasi' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul', 'sumber_media', 'link', 'jenis_berita', 'tanggal_publikasi']);
        $data['created_by'] = Auth::id();

        // handle upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('asset/img/berita'), $filename);
            $data['gambar'] = $filename;
        }

        Berita::create($data);

        return redirect()->route('staff.berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('staff.tambahBerita', compact('berita'));
    }

    public function beritaUpdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'sumber_media' => 'required|string|max:255',
            'link' => 'required|url',
            'jenis_berita' => 'required|in:positif,negatif',
            'tanggal_publikasi' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $berita = Berita::findOrFail($id);
        $data = $request->only(['judul', 'sumber_media', 'link', 'jenis_berita', 'tanggal_publikasi']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('asset/img/berita'), $filename);

            // Hapus gambar lama jika ada
            $oldPath = public_path('asset/img/berita/' . $berita->gambar);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $data['gambar'] = $filename;
        } else {
            $data['gambar'] = $berita->gambar;
        }

        $berita->update($data);

        return redirect()->route('staff.berita')->with('success', 'Berita berhasil diperbarui.');
    }


    // ================= KEGIATAN =================
    public function kegiatan()
    {
        $kegiatan = Kegiatan::latest()->get();
        return view('staff.kegiatan', compact('kegiatan'));
    }

    public function kegiatanCreate()
    {
        return view('staff.tambahKegiatan');
    }

    public function kegiatanStore(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'biaya' => 'required|numeric',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            'status' => 'required|in:akan_datang,berlangsung,selesai',
        ]);

        $validated['created_by'] = Auth::id();

        Kegiatan::create($validated);

        return redirect()->route('staff.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
    }


    public function kegiatanEdit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('staff.tambahKegiatan', compact('kegiatan'));
    }

    public function kegiatanUpdate(Request $request, $id)
    {
         $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'biaya' => 'required|numeric',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            'status' => 'required|in:akan_datang,berlangsung,selesai',
        ]);

        $validated['created_by'] = Auth::id();
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($validated);

        return redirect()->route('staff.kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
    }


    // ================= TIKET PESAWAT =================
    public function tiketPesawat(Request $request)
    {
        // Ambil semua unit untuk dropdown filter
        $unitOptions = Unit::all();

        // Query dengan relasi pegawai dan unit
        $query = TiketPesawat::with('pegawai.unit');

        // Filter jika ada permintaan unit_id
        if ($request->filled('unit_id')) {
            $query->whereHas('pegawai', function ($q) use ($request) {
                $q->where('unit_id', $request->unit_id);
            });
        }

        return view('staff.tiketPesawat', [
            'tiketPesawat' => $query->latest()->get(),
            'unitOptions' => $unitOptions,
        ]);
    }


    public function tiketPesawatCreate()
    {
        $pegawai = Pegawai::all();
        return view('staff.tambahTiketPesawat', compact('pegawai'));
    }

    public function tiketPesawatStore(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'tujuan' => 'required',
            'tanggal' => 'required|date',
            'biaya' => 'required|numeric',
        ]);

        TiketPesawat::create([
            'pegawai_id' => $request->pegawai_id,
            'tujuan' => $request->tujuan,
            'tanggal' => $request->tanggal,
            'biaya' => $request->biaya,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('staff.tiketPesawat')->with('success', 'Data berhasil disimpan');
    }

    public function tiketPesawatUpdate(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'tujuan' => 'required',
            'tanggal' => 'required|date',
            'biaya' => 'required|numeric',
        ]);

        $tiket = TiketPesawat::findOrFail($id);
        $tiket->update([
            'pegawai_id' => $request->pegawai_id,
            'tujuan' => $request->tujuan,
            'tanggal' => $request->tanggal,
            'biaya' => $request->biaya,
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('staff.tiketPesawat')->with('success', 'Data berhasil diupdate');
    }

    public function tiketPesawatEdit($id)
    {
        $tiket = TiketPesawat::findOrFail($id);
        $pegawai = Pegawai::all();
        return view('staff.tambahTiketPesawat', compact('tiket', 'pegawai'));
    }

    // ================= CHECK-IN MESS =================
    public function checkinMess()
    {
        $checkins = CheckinMess::with('mess')->latest()->get();
        return view('staff.CheckinMess', compact('checkins'));
    }

    public function checkinMessCreate()
    {
        // Ambil semua kamar yang tersedia
        $dataMess = DataMess::where('status', 'tersedia')->get();
        return view('staff.tambahCheckin', compact('dataMess'));
    }

    public function checkinMessStore(Request $request)
    {
        $request->validate([
            'mess_id' => 'required|exists:data_mess,id',
            'nama_tamu' => 'required|string',
            'asal' => 'required|string',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_mulai',
            'biaya' => 'required|numeric',
        ]);

        CheckinMess::create([
            'mess_id' => $request->mess_id,
            'nama_tamu' => $request->nama_tamu,
            'asal' => $request->asal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'biaya' => $request->biaya,
            'created_by' => Auth::id(),
        ]);

        // Ubah status kamar jadi terpakai
        DataMess::where('id', $request->mess_id)->update(['status' => 'terpakai']);

        return redirect()->route('staff.checkinMess')->with('success', 'Check-in berhasil.');
    }

    public function checkinMessEdit($id)
    {
        $checkin = CheckinMess::with('mess')->findOrFail($id);
        $dataMess = DataMess::where('status', 'tersedia')->orWhere('id', $checkin->mess_id)->get();

        return view('staff.tambahCheckin', compact('checkin', 'dataMess'));
    }

    public function checkinMessUpdate(Request $request, $id)
    {
        $checkin = CheckinMess::findOrFail($id);
        $checkin->update($request->all());
        return redirect()->route('staff.checkinMess')->with('success', 'Check-in berhasil diperbarui.');
    }

    // ================= PERMINTAAN KENDARAAN =================
public function permintaanKendaraan()
{
    $permintaan = PermintaanKendaraan::latest()->get();
    return view('staff.permintaankendaraan', compact('permintaan'));
}

public function permintaanKendaraanCreate()
{
    $kendaraan = Kendaraan::where('status', 'tersedia')->get();
    $supir = Supir::where('status', 'tersedia')->get();
    return view('staff.tambahPermintaanKendaraan', compact('kendaraan', 'supir'));
}

public function permintaanKendaraanEdit($id)
{
    $permintaan = PermintaanKendaraan::findOrFail($id);
    
    // Ambil kendaraan yang tersedia ATAU kendaraan yang sedang dipilih
    $kendaraan = Kendaraan::where('status', 'tersedia')
                ->orWhere('no_polisi', $permintaan->no_polisi)
                ->get();
                
    // Ambil supir yang tersedia ATAU supir yang sedang dipilih
    $supir = Supir::where('status', 'tersedia')
            ->orWhere('id', $permintaan->supir_id)
            ->get();
            
    return view('staff.tambahPermintaanKendaraan', compact('permintaan', 'kendaraan', 'supir'));
}

public function permintaanKendaraanStore(Request $request)
{
    $data = $request->validate([
        'no_polisi' => 'required',
        'supir_id' => 'required',
        'status_kepemilikan' => 'required',
        'jadwal_berangkat' => 'required|date',
        'jadwal_pulang' => 'required|date|after_or_equal:jadwal_berangkat',
        'tujuan' => 'required',
    ]);

    // Cek apakah kendaraan dan supir masih tersedia
    $kendaraan = Kendaraan::where('no_polisi', $request->no_polisi)
                  ->where('status', 'tersedia')
                  ->firstOrFail();
                  
    $supir = Supir::where('id', $request->supir_id)
            ->where('status', 'tersedia')
            ->firstOrFail();

    // Simpan permintaan kendaraan
    $permintaan = PermintaanKendaraan::create($data);

    // Update status supir jadi "bertugas"
    $supir->update(['status' => 'bertugas']);

    // Update status kendaraan jadi "digunakan"
    $kendaraan->update(['status' => 'digunakan']);

    return redirect()->route('staff.permintaankendaraan')->with('success', 'Permintaan berhasil ditambahkan.');
}

public function permintaanKendaraanUpdate(Request $request, $id)
{
    $permintaan = PermintaanKendaraan::findOrFail($id);
    
    $data = $request->validate([
        'no_polisi' => 'required',
        'supir_id' => 'required',
        'status_kepemilikan' => 'required',
        'jadwal_berangkat' => 'required|date',
        'jadwal_pulang' => 'required|date|after_or_equal:jadwal_berangkat',
        'tujuan' => 'required',
    ]);
    
    // Jika no_polisi berubah
    if ($permintaan->no_polisi != $request->no_polisi) {
        // Kembalikan status kendaraan lama ke tersedia
        Kendaraan::where('no_polisi', $permintaan->no_polisi)
            ->update(['status' => 'tersedia']);
            
        // Update status kendaraan baru ke digunakan
        Kendaraan::where('no_polisi', $request->no_polisi)
            ->update(['status' => 'digunakan']);
    }
    
    // Jika supir berubah
    if ($permintaan->supir_id != $request->supir_id) {
        // Kembalikan status supir lama ke tersedia
        Supir::where('id', $permintaan->supir_id)
            ->update(['status' => 'tersedia']);
            
        // Update status supir baru ke bertugas
        Supir::where('id', $request->supir_id)
            ->update(['status' => 'bertugas']);
    }
    
    $permintaan->update($data);
    
    return redirect()->route('staff.permintaankendaraan')->with('success', 'Permintaan berhasil diperbarui.');
}

    // ================= HOTEL =================
   public function hotel()
    {
        $query = Hotel::with(['pegawai', 'unit']);

        if (request()->filled('unit')) {
            $query->where('unit_id', request()->unit);
        }

        $hotels = $query->latest()->get();
        $units = Unit::all();

        return view('staff.hotel', compact('hotels', 'units'));
    }

    public function hotelCreate()
    {
        $pegawais = Pegawai::all();
        $units = Unit::all();
        return view('staff.tambahHotel', compact('pegawais', 'units'));
    }

    public function hotelStore(Request $request)
    {
         $request->validate([
        'pegawai_id'     => 'required|exists:pegawai,id',
        'nama_hotel'     => 'required|string|max:255',
        'unit_id'        => 'required|exists:unit,id',
        'biaya'          => 'required|numeric',
        'tanggal_masuk'  => 'required|date',
        'tanggal_keluar' => 'nullable|date|after_or_equal:tanggal_masuk',
    ]);

    Hotel::create([
        'pegawai_id'     => $request->pegawai_id,
        'nama_hotel'     => $request->nama_hotel,
        'unit_id'        => $request->unit_id,
        'biaya'          => $request->biaya,
        'tanggal_masuk'  => $request->tanggal_masuk,
        'tanggal_keluar' => $request->tanggal_keluar,
        'created_by'     => Auth::id(), // ⬅️ Wajib untuk hindari error 1364
    ]);

    return redirect()->route('staff.hotel')->with('success', 'Data hotel berhasil disimpan.');

    }

    public function hotelEdit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $pegawais = Pegawai::all();
        $units = Unit::all();
        return view('staff.tambahHotel', compact('hotel', 'pegawais', 'units'));
    }


    public function hotelUpdate(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());
        return redirect()->route('staff.hotel')->with('success', 'Hotel berhasil diperbarui.');
    }

    // ================= PROPOSAL =================
    public function proposal()
    {
        $proposals = Proposal::latest()->get();
        return view('staff.proposal', compact('proposals'));
    }

    public function proposalCreate()
    {
        return view('staff.tambahProposal');
    }

    public function proposalStore(Request $request)
    {
        Proposal::create([
        'nama_instansi'     => $request->nama_instansi,
        'disposisi'         => $request->disposisi,
        'nilai_bantuan'     => $request->nilai_bantuan,
        'tanggal_proposal'  => $request->tanggal_proposal,
        'deskripsi'         => $request->deskripsi,
        'created_by'        => auth()->id(), 
    ]);

        return redirect()->route('staff.proposal')->with('success', 'Proposal berhasil ditambahkan.');
    }

    public function proposalEdit($id)
    {
        $proposal = Proposal::findOrFail($id);
        return view('staff.tambahProposal', compact('proposal'));
    }

    public function proposalUpdate(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->update($request->all());
        return redirect()->route('staff.proposal')->with('success', 'Proposal berhasil diperbarui.');
    }

}
