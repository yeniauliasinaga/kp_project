@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-green-700 mb-6">Daftar Proposal</h2>
        <div class="flex gap-3">
            <select id="filterYear" class="border p-2 rounded text-sm text-gray-700">
                <option value="all">Semua Tahun</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>

            <select id="filterStatus" class="border p-2 rounded text-sm text-gray-700">
                <option value="all">Semua Status</option>
                <option value="disetujui">Disetujui</option>
                <option value="tidak disetujui">Tidak disetujui</option>
            </select>

            <a href="{{ route('superadmin.proposal.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">+ Tambah Proposal</a>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow mb-6">
        <canvas id="bantuanChart" height="100"></canvas>
    </div>

    <div class="bg-white rounded-xl p-4 shadow">
        <table class="w-full table-auto text-sm">
            <thead class="bg-white-200">
                <tr>
                    <th class="p-2 text-left">Instansi</th>
                    <th class="p-2 text-left">Disposisi</th>
                    <th class="p-2 text-left">Nilai Bantuan</th>
                    <th class="p-2 text-left">Tanggal</th>
                    <th class="p-2 text-left">Deskripsi</th>
                    <th class="p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="proposalTable">
                @foreach($proposals as $proposal)
                <tr data-status="{{ $proposal->disposisi }}" data-year="{{ \Carbon\Carbon::parse($proposal->tanggal_proposal)->format('Y') }}">
                    <td class="p-2">{{ $proposal->nama_instansi }}</td>
                    <td class="p-2 text-{{ $proposal->disposisi == 'disetujui' ? 'green' : 'red' }}-600 capitalize">{{ $proposal->disposisi }}</td>
                    <td class="p-2">Rp{{ number_format($proposal->nilai_bantuan, 0, ',', '.') }}</td>
                    <td class="p-2">{{ $proposal->tanggal_proposal }}</td>
                    <td class="p-2">{{ $proposal->deskripsi }}</td>
                    <td class="p-2 space-x-2">
                        <a href="{{ route('superadmin.proposal.edit', $proposal->id) }}"
                            class="bg-yellow-400 text-white px-3 py-1 text-xs rounded hover:bg-yellow-500">Edit</a>
                        <form action="{{ route('superadmin.proposal.delete', $proposal->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus proposal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 text-xs rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- Script Filter dan Chart --}}
<script>
    const rows = document.querySelectorAll('#proposalTable tr');
    const filterStatus = document.getElementById('filterStatus');
    const filterYear = document.getElementById('filterYear');

    // Filter logic
    function applyFilter() {
        const status = filterStatus.value;
        const year = filterYear.value;

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const rowYear = row.getAttribute('data-year');
            const matchStatus = (status === 'all' || status === rowStatus);
            const matchYear = (year === 'all' || year === rowYear);
            row.style.display = (matchStatus && matchYear) ? '' : 'none';
        });

        updateChart(); // refresh chart setiap filter berubah
    }

    filterStatus.addEventListener('change', applyFilter);
    filterYear.addEventListener('change', applyFilter);

    // Chart Logic
    const chartCtx = document.getElementById('bantuanChart').getContext('2d');
    let bantuanChart;

    function updateChart() {
        let totalDisetujui = 0;
        let totalTidak = 0;

        rows.forEach(row => {
            if (row.style.display !== 'none') {
                const status = row.getAttribute('data-status');
                const nilai = row.children[2].innerText.replace(/[^\d]/g, ''); // ambil angka dari "Rpxxx"
                const jumlah = parseInt(nilai);
                if (status === 'disetujui') totalDisetujui += jumlah;
                if (status === 'tidak disetujui') totalTidak += jumlah;
            }
        });

        const data = {
            labels: ['Disetujui', 'Tidak Disetujui'],
            datasets: [{
                label: 'Total Nilai Bantuan',
                data: [totalDisetujui, totalTidak],
                backgroundColor: ['#16a34a', '#dc2626']
            }]
        };

        if (bantuanChart) bantuanChart.destroy();

        bantuanChart = new Chart(chartCtx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: value => 'Rp' + value.toLocaleString('id-ID')
                        }
                    }
                }
            }
        });
    }

    // Initial render
    updateChart();
</script>
@endsection
