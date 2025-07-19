@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- <h1 class="text-2xl font-bold text-green-700 mb-6">Daftar Proposal</h1> -->

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Daftar Proposal</h2>
        <div class="flex gap-3">
            <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
                <option value="all">Semua Status</option>
                <option value="disetujui">Disetujui</option>
                <option value="tidak disetujui">Tidak disetujui</option>
            </select>
            <a href="{{ route('superadmin.proposal.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Proposal</a>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow">
        <table class="w-full table-auto text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">Instansi</th>
                    <th class="p-2 text-left">Disposisi</th>
                    <th class="p-2 text-left">Nilai Bantuan</th>
                    <th class="p-2 text-left">Tanggal</th>
                    <th class="p-2 text-left">Deskripsi</th>
                    <th class="p-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody id="proposalTable">
                @foreach($proposals as $proposal)
                <tr data-status="{{ $proposal->disposisi }}">
                    <td class="p-2">{{ $proposal->nama_instansi }}</td>
                    <td class="p-2 capitalize">{{ $proposal->disposisi }}</td>
                    <td class="p-2">Rp{{ number_format($proposal->nilai_bantuan, 0, ',', '.') }}</td>
                    <td class="p-2">{{ $proposal->tanggal_proposal }}</td>
                    <td class="p-2">{{ $proposal->deskripsi }}</td>
                    <td class="p-2 space-x-2">
                        <a href="{{ route('superadmin.proposal.edit', $proposal->id) }}"
                            class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('superadmin.proposal.delete', $proposal->id) }}"
                              method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus proposal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Script untuk filter --}}
<script>
    const filterSelect = document.getElementById('filterStatus');
    const rows = document.querySelectorAll('#proposalTable tr');

    filterSelect.addEventListener('change', () => {
        const filter = filterSelect.value;
        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            row.style.display = (filter === 'all' || filter === status) ? '' : 'none';
        });
    });
</script>
@endsection
