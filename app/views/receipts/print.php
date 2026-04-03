<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Receipt</title>
    <style>
        @media print {
            body { margin: 0; padding: 0; }
            .no-print { display: none; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #000; padding: 6px; text-align: left; vertical-align: top; }
            th { background-color: #f2f2f2; font-weight: bold; }
            .borderless td, .borderless th { border: none; }
            .field-table td { border: none; padding: 4px 0; }
            .print-footer { margin-top: 20px; font-size: 7pt; }
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        /* Header dengan border */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            border: 1px solid #000;
            vertical-align: middle;
            padding: 10px;
        }
        .logo-cell {
            width: 110px;
            text-align: center;
        }
        .logo-cell img {
            max-width: 80px;
            max-height: 60px;
        }
        .company-cell {
            text-align: center;
            font-size: 8pt;
            width: 250px;
        }
        .title-cell {
            text-align: center;
            font-weight: bold;
            font-size: 8pt;
            white-space: nowrap;
            width: 100px;
        }
        /* Field (No.PO, dll) dengan dua kolom */
        .field-table {
            width: 100%;
            margin-bottom: 20px;
            font-family: 'Arial MT', Arial, sans-serif;
            font-size: 10pt;
        }
        .field-table td {
            vertical-align: top;
            padding: 2px 0;
        }
        .field-label {
            width: 110px;
            /* font-weight: bold; */
            white-space: nowrap;
        }
        .colon {
            width: 3px;
            text-align: center;
        }
        .field-table td {
            padding: 1px 3px;
        }
        /* Tabel item */
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            text-align: center;
        }
        .item-table th {
            border: 1px solid #000;
            padding: 6px;
            font-size: 9pt;
            background-color: #f2f2f2;
        }
        .item-table td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 8pt;
        }
        /* Catatan */
        .notes {
            margin-top: 20px;
        }
        .notes-title {
            font-size: 11pt;
            /* font-weight: bold; */
        }
        .notes-list {
            font-size: 8pt;
            margin-top: 5px;
            line-height: 1.4;
        }
        .notes-list p {
            margin: 2px 0;
        }
        /* Tanda tangan - tanpa garis bawah, dengan jarak untuk tanda tangan */
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature-box {
            text-align: left;
            width: 45%;
        }
        .signature-box .title {
            font-size: 11pt;
            font-weight: normal;
            margin-bottom: 2px;
        }
        .signature-box .name {
            font-size: 11pt;
            font-weight: normal;
            margin-top: 0;
        }
        .signature-box .vendor {
            font-weight: normal;
            font-size: 10pt;
            margin-bottom: 80px;
        }
        .signature-box .vendor-name {
            font-weight: normal;
            font-size: 8pt;
            margin-top: 5px;
        }
        /* Footer */
        .print-footer {
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 7pt;
        }
        .print-footer td {
            padding: 2px 4px;
            border: none;
        }
        .pf-label {
            width: 50px;
            text-align: left;
            font-weight: normal;
        }
        .pf-colon {
            width: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Header dengan border -->
    <table class="header-table">
            <tr>
            <td class="logo-cell">
                <img src="/receipt/public/images/kcsi.png" alt="Logo Perusahaan">
              </td>
            <td class="company-cell">
                <strong>PT. Karya Cipta Solusi Internasional</strong><br><br>
                Jakarta, Indonesia<br>
                Jl. Jendral Sudirman Kav. 52-53, Kel Senayan, Kec. Kebayoran Baru 
                Kota Jakarta Selatan, DKI Jakarta 12190 
                Telp. 021-509 55767 FAX
              </td>
            <td class="title-cell">
                FORM PENERIMAAN BARANG/JASA
              </td>
          </tr>
      </table>

    <!-- Field dengan tabel dua kolom -->
    <table class="field-table">
          <tr>
            <td class="field-label">No.PO</td>
            <td class="colon">:</td>
            <td><?= htmlspecialchars($data['receipt']['no_po']) ?></td>
            <td class="field-label">NO. PAP</td>
            <td class="colon">:</td>
            <td><?= htmlspecialchars($data['receipt']['no_pap']) ?></td>
          </tr>
          <tr>
            <td class="field-label">No.SJ/BAPP</td>
            <td class="colon">:</td>
            <td><?= htmlspecialchars($data['receipt']['no_sj_bapp']) ?></td>
            <td class="field-label">Vendor/Supplier</td>
            <td class="colon">:</td>
            <td><?= htmlspecialchars($data['receipt']['vendor_supplier']) ?></td>
          </tr>
          <tr>
            <td class="field-label">No.Receipt PO</td>
            <td class="colon">:</td>
            <td><?= htmlspecialchars($data['receipt']['no_receipt_po']) ?></td>
            <td class="field-label">Tanggal Receipt PO</td>
            <td class="colon">:</td>
            <td><?= formatTanggalIndonesia($data['receipt']['tanggal_receipt_po']) ?></td>
          </tr>
      </table>

    <!-- Tabel item -->
    <table class="item-table">
        <thead>
             <tr>
                <th style="width:5%;">No</th>
                <th style="width:20%;">Kode Barang</th>
                <th style="width:40%;">Nama Barang/Jasa</th>
                <th style="width:10%;">Jumlah</th>
                <th style="width:10%;">Satuan</th>
                <th style="width:15%;">Keterangan</th>
             </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($data['items'] as $item): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($item['kode_barang']) ?></td>
                <td><?= htmlspecialchars($item['nama_barang'] . ' u/' . $item['nama_user']) ?></td>
                <td style="text-align:center;"><?= $item['jumlah'] ?></td>
                <td><?= htmlspecialchars($item['satuan']) ?></td>
                <td>&nbsp;</td>
              </tr>
            <?php endforeach; ?>
        </tbody>
      </table>

    <!-- Catatan -->
    <div class="notes">
        <div class="notes-title">Catatan :</div>
        <div class="notes-list">
            <p>- Form ini dihasilkan secara otomatis oleh komputer setelah melalui proses validasi dan approval yang berlaku di internal perusahaan.</p>
            <p>- Form ini dikirim secara otomatis pada tanggal Receipt PO di atas ke alamat email vendor/supplier sebagaimana email yang terdaftar dalam database perusahaan.</p>
            <p>- Form ini wajib diprint, ditandatangani dan distempel oleh PIC Keuangan dari vendor/supplier untuk kemudian dijadikan sebagai salah satu lampiran dokumen penagihan yang dilakukan selambat-lambatnya 7 (tujuh) hari kerja dari tanggal Receipt PO di atas.</p>
        </div>
    </div>

    <!-- Tanda tangan (tanpa garis bawah, dengan jarak untuk tanda tangan) -->
    <div class="signatures">
        <div class="signature-box">
            <div class="title">Received By</div>
            <div class="name">(Elita Ambari)</div>
        </div>
        <div class="signature-box">
            <div class="vendor">CV. LIGA INTI RAYA</div>
            <div class="vendor-name">(_____________________)<br>Lengkap nama, stempel & tanda tangan</div>
        </div>
    </div>

    <!-- Footer dengan dua baris, font 7pt -->
    <table class="print-footer">
         <tr>
            <td class="pf-label">Print Date</td>
            <td class="pf-colon">:</td>
            <td id="print-date"></td> <!-- diisi oleh JavaScript -->
         </tr>
         <tr>
            <td class="pf-label">Print By</td>
            <td class="pf-colon">:</td>
            <td>ICTSTF01</td>
         </tr>
    </table>

    <!-- Tombol cetak -->
    <div class="no-print" style="margin-top:20px; text-align:center;">
        <button onclick="window.print();" style="padding:8px 16px; background:#3b82f6; color:white; border:none; border-radius:4px;">Cetak</button>
        <button onclick="window.close();" style="padding:8px 16px; background:#6b7280; color:white; border:none; border-radius:4px;">Tutup</button>
    </div>

    <script>
        // Fungsi untuk memformat tanggal dengan bulan dalam bahasa Indonesia
        function formatPrintDateLocal() {
            const now = new Date();
            const months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            const day = String(now.getDate()).padStart(2, '0');
            const month = months[now.getMonth()];
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            return `${day}-${month}-${year} ${hours}:${minutes}`;
        }
        // Isi elemen dengan id "print-date"
        document.getElementById('print-date').textContent = formatPrintDateLocal();
    </script>
</body>
</html>

<?php
// Set zona waktu ke WIB (Asia/Jakarta) - hanya untuk fungsi formatTanggalIndonesia
date_default_timezone_set('Asia/Jakarta');

function formatTanggalIndonesia($tanggal) {
    if (empty($tanggal)) return '';
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $t = strtotime($tanggal);
    return date('d', $t) . ' ' . $bulan[(int)date('m', $t)] . ' ' . date('Y', $t);
}
?>