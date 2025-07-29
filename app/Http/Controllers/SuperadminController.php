<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\TiketPesawat;
use App\Models\DataMess;
use App\Models\Kendaraan;
use App\Models\Hotel;
use App\Models\Proposal;
use App\Models\Pegawai;
use App\Models\Supir;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SuperadminController extends Controller
{
    // SuperadminController.php

    public function dashboard()
    {
        // Mobil
        $mobilTersedia = Kendaraan::where('status', 'tersedia')->count();
        $mobilList = Kendaraan::where('status', 'tersedia')->get();

        // Mess
        $messTersedia = DataMess::where('status', 'tersedia')->count();
        $messList = DataMess::where('status', 'tersedia')->orderBy('lokasi')->take(10)->get();

        // Kegiatan
        $acaraBerlangsung = Kegiatan::where('status', 'berlangsung')->count();
        $acaraList = Kegiatan::orderBy('waktu_mulai', 'desc')->take(10)->get();
        $acaraAkanDatang = Kegiatan::whereDate('waktu_mulai', '>', Carbon::now())
                                    ->orderBy('waktu_mulai', 'asc')
                                    ->take(5)->get();

        // Highlight Kegiatan (ambil yang punya gambar)
        $highlightKegiatan = Kegiatan::whereNotNull('gambar')
                                    ->orderBy('waktu_mulai', 'desc')
                                    ->take(5)->get();

        // Berita Terbaru
        $beritaList = Berita::orderBy('tanggal_publikasi', 'desc')->take(6)->get();

        // Proposal
        $jumlahProposalDisetujui = Proposal::where('disposisi', 'disetujui')->count();
        $jumlahProposalDitolak = Proposal::where('disposisi', 'tidak disetujui')->count();
        $proposalList = Proposal::orderBy('created_at', 'desc')->take(6)->get();

        // Tiket Pesawat
        $tiketPesawatList = TiketPesawat::with('pegawai')
                                        ->orderBy('tanggal', 'desc')
                                        ->take(6)->get();

        return view('superadmin.dashboard', compact(
            'mobilTersedia', 'mobilList',
            'messTersedia', 'messList',
            'acaraBerlangsung', 'acaraList',
            'beritaList',
            'jumlahProposalDisetujui', 'jumlahProposalDitolak',
            'highlightKegiatan',
            'proposalList',
            'acaraAkanDatang',
            'tiketPesawatList'
        ));
    }

    // ===================== BERITA =====================
    public function berita()
    {
        $berita = Berita::latest()->get();
        return view('superadmin.berita', compact('berita'));
    }

    public function beritaCreate()
    {
        return view('superadmin.tambahBerita');
    }

    public function beritaStore(Request $request)
    {
        $data = $request->only(['judul', 'sumber_media', 'link', 'jenis_berita', 'tanggal_publikasi']);
        // $data = $request->except('gambar'); // ambil semua input kecuali gambar
        $data['created_by'] = Auth::id();

        // handle gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('asset/img/berita'), $filename);
            $data['gambar'] = $filename;
        }

        Berita::create($data);
        return redirect()->route('superadmin.berita')->with('success', 'Berita berhasil ditambahkan.');
    }



    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('superadmin.tambahBerita', compact('berita'));
    }

    public function beritaUpdate(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $data = $request->only(['judul', 'sumber_media', 'link', 'jenis_berita', 'tanggal_publikasi']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('asset/img/berita'), $filename);

            // Hapus gambar lama
            $oldPath = public_path('asset/img/berita/' . $berita->gambar);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            $data['gambar'] = $filename;
        } else {
            $data['gambar'] = $berita->gambar;
        }

        $berita->update($data);
        return redirect()->route('superadmin.berita')->with('success', 'Berita berhasil diperbarui.');
    }



    public function beritaDestroy($id)
    {
        Berita::destroy($id);
        return back()->with('success', 'Berita berhasil dihapus.');
    }

    // ===================== KEGIATAN =====================
    public function kegiatan()
    {
         // Otomatis ubah status ke "selesai" jika waktunya sudah lewat
    Kegiatan::where('status', '!=', 'selesai')
        ->where('waktu_selesai', '<', Carbon::now())
        ->update(['status' => 'selesai']);

    // Ambil semua kegiatan, dan hitung status dinamis
    $kegiatan = Kegiatan::orderByDesc('waktu_mulai')->get()->map(function ($item) {
        $now = Carbon::now();
        $mulai = Carbon::parse($item->waktu_mulai);
        $selesai = Carbon::parse($item->waktu_selesai);

        if ($now->lt($mulai)) {
            $item->status_dinamis = 'akan_datang';
            $item->warna_status = 'blue';
        } elseif ($now->between($mulai, $selesai)) {
            $item->status_dinamis = 'berlangsung';
            $item->warna_status = 'green';
        } else {
            $item->status_dinamis = 'selesai';
            $item->warna_status = 'gray';
        }

        return $item;
    });

    return view('superadmin.kegiatan', compact('kegiatan'));
    }

    public function kegiatanCreate()
    {
        return view('superadmin.tambahKegiatan');
    }

    public function kegiatanStore(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required',
            'tempat' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'biaya' => 'required|numeric',
            'status' => 'required|in:akan_datang,berlangsung,selesai',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('asset/img/kegiatan'), $filename);
            $validated['gambar'] = $filename;
        }

        $validated['created_by'] = auth()->id();
        Kegiatan::create($validated);

        return redirect()->route('superadmin.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
    }


    public function kegiatanEdit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('superadmin.tambahKegiatan', compact('kegiatan'));
    }

    public function kegiatanUpdate(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $validated = $request->validate([
            'nama_kegiatan' => 'required',
            'tempat' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'biaya' => 'required|numeric',
            'status' => 'required|in:akan_datang,berlangsung,selesai',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('asset/img/kegiatan'), $filename);
            $validated['gambar'] = $filename;
        }

        $kegiatan->update($validated);

        return redirect()->route('superadmin.kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
    }


    public function kegiatanDestroy($id)
    {
        Kegiatan::destroy($id);
        return back()->with('success', 'Kegiatan berhasil dihapus.');
    }

    // ===================== KENDARAAN =====================
    public function kendaraan()
    {
        $kendaraans = Kendaraan::latest()->get();
        return view('superadmin.kendaraan', compact('kendaraans'));
    }

    public function kendaraanCreate()
    {
        return view('superadmin.tambahKendaraan');
    }

    public function kendaraanStore(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'no_polisi' => 'required|string|max:15|unique:kendaraan,no_polisi',
            'merek' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'bahan_bakar' => 'required|string|max:255',
            'status_kepemilikan' => 'required|in:milik perusahaan,sewa',
            'status' => 'required|in:tersedia,digunakan',
    ]);

    // Simpan data
    Kendaraan::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('superadmin.kendaraan')->with('success', 'Kendaraan berhasil ditambahkan.');
    }


    public function kendaraanEdit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('superadmin.tambahKendaraan', compact('kendaraan'));
    }

    public function kendaraanUpdate(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());
        return redirect()->route('superadmin.kendaraan')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function kendaraanDestroy($id)
    {
        Kendaraan::destroy($id);
        return back()->with('success', 'Kendaraan berhasil dihapus.');
    }

    // ===================== MESS =====================
    public function datamess()
    {
        $status = request('status');

        $mess = DataMess::when($status, function ($query, $status) {
        return $query->where('status', $status);

        })->get();

        return view('superadmin.mess', compact('mess'));
    }

    public function messCreate()
    {
        return view('superadmin.tambahMess');
    }

    public function messStore(Request $request)
    {
        DataMess::create($request->all());
        return redirect()->route('superadmin.datamess')->with('success', 'Mess berhasil ditambahkan.');
    }

    public function messEdit($id)
    {
        $mess = DataMess::findOrFail($id);
        return view('superadmin.tambahMess', compact('mess'));
    }

    public function messUpdate(Request $request, $id)
    {
        $mess = DataMess::findOrFail($id);
        $mess->update($request->all());
        return redirect()->route('superadmin.datamess')->with('success', 'Mess berhasil diperbarui.');
    }

    public function messDestroy($id)
    {
        DataMess::destroy($id);
        return back()->with('success', 'Mess berhasil dihapus.');
    }

    // ===================== TIKET PESAWAT =====================
    public function tiketPesawat(Request $request)
    {
        $unitId = $request->input('unit');

        $tiket = TiketPesawat::with('pegawai.unit')
            ->when($unitId, function ($query) use ($unitId) {
                $query->whereHas('pegawai', fn($q) => $q->where('unit_id', $unitId));
            })
            ->latest()
            ->get();

        $unitList = Unit::all();

        return view('superadmin.tiketPesawat', compact('tiket', 'unitList', 'unitId'));
    }

    public function tiketPesawatCreate()
    {
        $pegawai = Pegawai::all();
        return view('superadmin.tambahTiketPesawat', compact('pegawai'));
    }

    public function tiketPesawatStore(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'tujuan' => 'required|in:dalam wilayah,luar wilayah',
            'tanggal' => 'required|date',
            'biaya' => 'required|numeric',
        ]);

        TiketPesawat::create([
            'pegawai_id' => $request->pegawai_id,
            'tujuan' => $request->tujuan,
            'tanggal' => $request->tanggal,
            'biaya' => $request->biaya,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('superadmin.tiketpesawat')->with('success', 'Tiket berhasil ditambahkan');
    }

    public function tiketPesawatEdit(Request $request, $id)
    {
        $tiket = TiketPesawat::findOrFail($id);

        if ($request->isMethod('post')) {
            $request->validate([
                'pegawai_id' => 'required',
                'tujuan' => 'required|in:dalam wilayah,luar wilayah',
                'tanggal' => 'required|date',
                'biaya' => 'required|numeric',
            ]);

            $tiket->update([
                'pegawai_id' => $request->pegawai_id,
                'tujuan' => $request->tujuan,
                'tanggal' => $request->tanggal,
                'biaya' => $request->biaya,
            ]);

            return redirect()->route('superadmin.tiketpesawat')->with('success', 'Tiket berhasil diperbarui');
        }

        $pegawai = Pegawai::all();
        return view('superadmin.tambahTiketPesawat', compact('tiket', 'pegawai'));
    }

    public function tiketPesawatDestroy($id)
    {
        $tiket = TiketPesawat::find($id);

        if (!$tiket) {
            return back()->with('error', 'Tiket tidak ditemukan.');
        }

        $tiket->delete();

        return back()->with('success', 'Tiket pesawat berhasil dihapus.');
    }


    // ===================== HOTEL =====================
    public function hotel()
    {
        $hotels = Hotel::with(['pegawai', 'unit'])->latest()->get();
        return view('superadmin.hotel', compact('hotels'));
    }

    public function hotelCreate()
    {
        $pegawais = Pegawai::with('unit')->get();
        return view('superadmin.tambahHotel', compact('pegawais'));
    }

    public function hotelStore(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'nama_hotel' => 'required|string|max:255',
            'unit_id' => 'required|exists:unit,id',
            'biaya' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
            'bukti_resi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $hotel = new Hotel();
        $hotel->pegawai_id = $request->pegawai_id;
        $hotel->nama_hotel = $request->nama_hotel;
        $hotel->unit_id = $request->unit_id;
        $hotel->biaya = $request->biaya;
        $hotel->tanggal_masuk = $request->tanggal_masuk;
        $hotel->tanggal_keluar = $request->tanggal_keluar;
        $hotel->created_by = Auth::id();

        if ($request->hasFile('bukti_resi')) {
            $file = $request->file('bukti_resi');
            $filename = 'resi_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('asset/img/tiket'), $filename);
            $hotel->bukti_resi = $filename;
        }

        $hotel->save();

        return redirect()->route('superadmin.hotel')->with('success', 'Data hotel berhasil disimpan.');
    }


   public function hotelEdit($id)
    {
        $hotel = Hotel::findOrFail($id);
        $pegawais = Pegawai::with('unit')->get();
        return view('superadmin.tambahHotel', compact('hotel', 'pegawais'));
    }

    public function hotelUpdate(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'nama_hotel' => 'required|string|max:255',
            'unit_id' => 'required|exists:unit,id',
            'biaya' => 'required|numeric',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date|after_or_equal:tanggal_masuk',
            'bukti_resi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $hotel = Hotel::findOrFail($id);
        $hotel->pegawai_id = $request->pegawai_id;
        $hotel->nama_hotel = $request->nama_hotel;
        $hotel->unit_id = $request->unit_id;
        $hotel->biaya = $request->biaya;
        $hotel->tanggal_masuk = $request->tanggal_masuk;
        $hotel->tanggal_keluar = $request->tanggal_keluar;

        if ($request->hasFile('bukti_resi')) {
            // Hapus file lama jika ada
            if ($hotel->bukti_resi && file_exists(public_path('asset/img/tiket/' . $hotel->bukti_resi))) {
                unlink(public_path('asset/img/tiket/' . $hotel->bukti_resi));
            }

            $file = $request->file('bukti_resi');
            $filename = 'resi_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('asset/img/tiket'), $filename);
            $hotel->bukti_resi = $filename;
        }

        $hotel->save();

        return redirect()->route('superadmin.hotel')->with('success', 'Hotel berhasil diperbarui.');
    }

    public function hotelDestroy($id)
    {
        Hotel::destroy($id);
        return back()->with('success', 'Hotel berhasil dihapus.');
    }

    // ===================== PROPOSAL =====================
    public function proposal()
    {
         $proposals = Proposal::all();

        $years = Proposal::selectRaw('YEAR(tanggal_proposal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('superadmin.proposal', compact('proposals', 'years'));

    }

    public function proposalCreate()
    {
        return view('superadmin.tambahProposal');
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

        return redirect()->route('superadmin.proposal')->with('success', 'Proposal berhasil ditambahkan.');
    }

    public function proposalEdit($id)
    {
        $proposal = Proposal::findOrFail($id);
        return view('superadmin.tambahProposal', compact('proposal'));
    }

    public function proposalUpdate(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->update($request->all());
        return redirect()->route('superadmin.proposal')->with('success', 'Proposal berhasil diperbarui.');
    }

    public function proposalDestroy($id)
    {
        Proposal::destroy($id);
        return back()->with('success', 'Proposal berhasil dihapus.');
    }

    // ===================== PEGAWAI =====================
    public function pegawai()
    {
        $pegawai = Pegawai::latest()->with('user')->get();
        return view('superadmin.pegawai', compact('pegawai'));
    }

    public function pegawaiCreate()
    {
        $units = Unit::all(); // untuk dropdown unit
        return view('superadmin.tambahPegawai', compact('units'));
    }

   public function pegawaiStore(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nama' => 'required',
            'nip' => 'required|unique:pegawai,nip',
            'nrk' => 'required|unique:pegawai,nrk', // Validasi baru
            'jabatan' => 'required',
            'role' => 'required|in:staff,superadmin',
            'unit_id' => 'required|exists:unit,id',
            'alamat' => 'nullable',
        ]);

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        Pegawai::create([
            'user_id' => $user->id,
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'nrk' => $validated['nrk'], // simpan NRK
            'jabatan' => $validated['jabatan'],
            'role' => $validated['role'],
            'unit_id' => $validated['unit_id'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('superadmin.pegawai')->with('success', 'Pegawai berhasil ditambahkan.');
    }



    public function pegawaiEdit($id)
    {
        $pegawai = Pegawai::with('user')->findOrFail($id);
        $units = Unit::all();
        return view('superadmin.tambahPegawai', compact('pegawai', 'units'));
    }

    public function pegawaiUpdate(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:pegawai,nip,' . $pegawai->id,
            'nrk' => 'required|unique:pegawai,nrk,' . $pegawai->id, // validasi update NRK
            'jabatan' => 'required',
            'role' => 'required|in:staff,superadmin',
            'unit_id' => 'required|exists:unit,id',
            'alamat' => 'nullable',
        ]);

        $pegawai->update($validated);
        $pegawai->user->update(['name' => $validated['nama']]);

        return redirect()->route('superadmin.pegawai')->with('success', 'Pegawai berhasil diperbarui.');
    }



    public function pegawaiDestroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        // Hapus juga user yang terhubung (opsional, hati-hati jika share user)
        if ($pegawai->user) {
            $pegawai->user->delete();
        }

        return back()->with('success', 'Pegawai dan akun berhasil dihapus.');
    }

    // ===================== SUPIR =====================
    public function supir()
    {
        $supirs = Supir::latest()->get();
        return view('superadmin.supir', compact('supirs'));
    }

    public function supirCreate()
    {
        return view('superadmin.tambahSupir');
    }

    public function supirStore(Request $request)
    {
        Supir::create($request->all());
        return redirect()->route('superadmin.supir')->with('success', 'Supir berhasil ditambahkan.');
    }

    public function supirEdit($id)
    {
        $supir = Supir::findOrFail($id);
        return view('superadmin.tambahSupir', compact('supir'));
    }

    public function supirUpdate(Request $request, $id)
    {
        $supir = Supir::findOrFail($id);
        $supir->update($request->all());
        return redirect()->route('superadmin.supir')->with('success', 'Supir berhasil diperbarui.');
    }

    public function supirDestroy($id)
    {
        Supir::destroy($id);
        return back()->with('success', 'Supir berhasil dihapus.');
    }
}
