<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Total Petugas</th>
            <th>Total User</th>
            <th>User baru 1 minggu terakhir</th>
            <th>pemesanan sukses 1 minggu terakhir</th>
            <th>Pemesanan gagal 1 minggu terakhir</th>
            <th>Total semua Pemesanan sukses</th>
            <th>Total semua pemesanan gagal</th>
            <th>Semua Pesanan</th>
            <th>Tiket terjual 1 minggu terakhir</th>
            <th>Tiket gagal terjual 1 minggu terakhir</th>
            <th>Total tiket terjual</th>
            <th>Total tiket gagal terjua</th>
            <th>semua tiket</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 1 @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $today }}</td>
            <td>{{ $petugas }}</td>
            <td>{{ $user }}</td>
            <td>{{ $user1 }}</td>
            <td>{{ $pems1 }}</td>
            <td>{{ $pemg1 }}</td>
            <td>{{ $pemst }}</td>
            <td>{{ $pemsg }}</td>
            <td>{{ $pems }}</td>
            <td>{{ $tik1 }}</td>
            <td>{{ $tikg1 }}</td>
            <td>{{ $tikt }}</td>
            <td>{{ $tikg }}</td>
            <td>{{ $tik }}</td>
        </tr>
    </tbody>
</table>