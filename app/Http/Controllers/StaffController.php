<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\TiketPesawat;
use App\Models\Hotel;
use App\Models\CheckinMess;
use App\Models\PermintaanKendaraan;
use App\Models\Proposal;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('staff.dashboard');
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
        Berita::create($request->all());
        return redirect()->route('staff.berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('staff.tambahBerita', compact('berita'));
    }

    public function beritaUpdate(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $berita->update($request->all());
        return redirect()->route('staff.berita')->with('success', 'Berita berhasil diperbarui.');
    }

    // ================= KEGIATAN =================
    public function kegiatan()
    {
        $kegiatans = Kegiatan::latest()->get();
        return view('staff.kegiatan', compact('kegiatans'));
    }

    public function kegiatanCreate()
    {
        return view('staff.tambahKegiatan');
    }

    public function kegiatanStore(Request $request)
    {
        Kegiatan::create($request->all());
        return redirect()->route('staff.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function kegiatanEdit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('staff.tambahKegiatan', compact('kegiatan'));
    }

    public function kegiatanUpdate(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($request->all());
        return redirect()->route('staff.kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    // ================= TIKET PESAWAT =================
    public function tiketPesawat()
    {
        $tiket = TiketPesawat::latest()->get();
        return view('staff.tiketPesawat', compact('tiket'));
    }

    public function tiketPesawatCreate()
    {
        return view('staff.tambahTiketPesawat');
    }

    public function tiketPesawatStore(Request $request)
    {
        TiketPesawat::create($request->all());
        return redirect()->route('staff.tiketPesawat')->with('success', 'Tiket pesawat berhasil ditambahkan.');
    }

    public function tiketPesawatEdit($id)
    {
        $tiket = TiketPesawat::findOrFail($id);
        return view('staff.tambahTiketPesawat', compact('tiket'));
    }

    public function tiketPesawatUpdate(Request $request, $id)
    {
        $tiket = TiketPesawat::findOrFail($id);
        $tiket->update($request->all());
        return redirect()->route('staff.tiketPesawat')->with('success', 'Tiket pesawat berhasil diperbarui.');
    }

    // ================= CHECK-IN MESS =================
    public function checkinMess()
    {
        $checkins = CheckinMess::latest()->get();
        return view('staff.CheckinMess', compact('checkins'));
    }

    public function checkinMessCreate()
    {
        return view('staff.tambahCheckin');
    }

    public function checkinMessStore(Request $request)
    {
        CheckinMess::create($request->all());
        return redirect()->route('staff.checkinMess')->with('success', 'Check-in berhasil ditambahkan.');
    }

    public function checkinMessEdit($id)
    {
        $checkin = CheckinMess::findOrFail($id);
        return view('staff.tambahCheckin', compact('checkin'));
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
        return view('staff.tambahPermintaanKendaraan');
    }

    public function permintaanKendaraanStore(Request $request)
    {
        PermintaanKendaraan::create($request->all());
        return redirect()->route('staff.permintaankendaraan')->with('success', 'Permintaan kendaraan berhasil ditambahkan.');
    }

    public function permintaanKendaraanEdit($id)
    {
        $permintaan = PermintaanKendaraan::findOrFail($id);
        return view('staff.tambahPermintaanKendaraan', compact('permintaan'));
    }

    public function permintaanKendaraanUpdate(Request $request, $id)
    {
        $permintaan = PermintaanKendaraan::findOrFail($id);
        $permintaan->update($request->all());
        return redirect()->route('staff.permintaankendaraan')->with('success', 'Permintaan berhasil diperbarui.');
    }

    // ================= HOTEL =================
    public function hotel()
    {
        $hotels = Hotel::latest()->get();
        return view('staff.hotel', compact('hotels'));
    }

    public function hotelCreate()
    {
        return view('staff.tambahHotel');
    }

    public function hotelStore(Request $request)
    {
        Hotel::create($request->all());
        return redirect()->route('staff.hotel')->with('success', 'Hotel berhasil ditambahkan.');
    }

    public function hotelEdit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('staff.tambahHotel', compact('hotel'));
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
        Proposal::create($request->all());
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
