<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Permohonan Kerja Praktik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }

        .header {
            text-align: right;
        }

        .header img {
            width: 200px;
            margin-bottom: 20px;
        }

        .content {
            margin-top: 20px;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .content table,
        .content th,
        .content td {
            border: 1px solid black;
        }

        .content th,
        .content td {
            padding: 8px;
            text-align: left;
        }

        .footer {
            margin-top: 40px;
        }

        .footer img {
            width: 200px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="assets/images/smk4.jpeg" alt="SMKN 4 PAYAKUMBUH">
        <p>Payakumbuh, {{ date('d F Y') }}</p>
        <p>No. 0451/SMKN4PYK/PKA-K.1/VIII/2024</p>
    </div>

    <div class="content">
        <p>Kepada Yth.<br>
            Bapak/Ibu HR Manager<br>
            {{ $data->tempat_pkl }}<br>
            {{ $data->alamat }}<br>
            Payakumbuh
        </p>

        <p><strong>Perihal</strong>: Permohonan Praktik Kerja Lapangan</p>

        <p>Dengan hormat,</p>

        <p>Sehubungan dengan rencana pelaksanaan Praktik Kerja Lapangan bagi siswa/siswa SMKN 4 PAYAKUMBUH, maka kami mohon bantuan Bapak/Ibu memperkenankan siswa/siswi kami berikut ini:</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Program Studi</th>
                    <th>Bidang Kajian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $dataUser->name }}</td>
                    <td>{{ $dataUser->nisn }}</td>
                    <td>{{ $data->jurusan }}</td>
                    <td>{{ $data->bidang_kerja }}</td>
                </tr>
            </tbody>
        </table>

        <p style="text-align: justify;">untuk melaksanakan Kerja Praktik/Magang pada perusahaan yang Bapak/Ibu pimpin selama 4 bulan yaitu terhitung mulai tanggal {{ $data->tgl_mulai_pkl }} s.d {{ $data->tgl_selesai_pkl }}. Kami berharap Bapak/Ibu berkenan memberikan tempat dan bimbingan serta arahan kepada mahasiswa kami selama melaksanakan Kerja Praktik/Magang di perusahaan Bapak/Ibu. Kami tunggu konfirmasi melalui surat atau melalui email paling lambat tanggal 21 Oktober 2024 via email ke <a href="mailto:smkn4pyk@smkn4pyk.ac.id">smkn4pyk@smkn4pyk.ac.id</a> atau via telp. 08117574101.</p>

        <p style="text-align: justify;">Demikian Surat Permohonan Praktik Kerja Lapangan ini kami buat agar dapat dipergunakan sebagaimana mestinya. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
    </div>

    <div class="footer">
        <p>Hormat kami,</p>
        <br><br><br>
        <p><strong>Drs. AIZUR HEDI, MM</strong><br>
            Kepala Sekolah</p>
    </div>
</body>

</html>