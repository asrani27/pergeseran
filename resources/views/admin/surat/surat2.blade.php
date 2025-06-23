<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table width="100%">
        <tr>
            <td style="text-align: center">
                <strong style="font-size: 16px">PEMERINTAH KOTA BANJARMASIN</strong><br />
                <strong style="font-size: 24px">{{strtoupper(Auth::user()->skpd->nama)}} </strong><br />
                Jl.Pramuka Komp.Tirta Dharma Telp.(0511) 4281348, Banjarmasin

            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
    </table>
    <h3 style="text-align: center">SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK</h3>

    <table width="100%" border=0 style="padding-left:110px">
        <tr>
            <td colspan=2> Saya yang bertanda tangan dibawah ini :</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: H. Muhammad Isa Ansari, SE., M.AP</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>: 19680111 199303 1 006</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: Kepala Dinas Koperasi, Usaha Mikro dan Tenaga Kerja</td>
        </tr>
    </table>
    <br />
    <table width="100%" border=0>
        <tr>
            <td width="15%"></td>
            <td colspan="2">Dengan ini menyatakan bahwa :<br /><br />

                1) Bertanggung jawab penuh terhadap usulan pergeseran anggaran yang telah disampaikan sesuai dengan
                surat Dinas Koperasi, Usaha Mikro dan Tenaga Kerja Nomor 400/372/Diskopumker-UM Tanggal 13 Juni 2023,
                serta pelaksanaan anggaran setelah proses pergeseran disetujui oleh pejabat yang berwenang.<br />
                2) Usulan Pergeseran Anggaran yang disampaikan telah sesuai dengan Peraturan Wali Kota Banjarmasin Nomor
                18 Tahun 2023 tentang Tata Cara Pergeseran Anggaran Pendapatan dan Belanja Daerah.<br />
                3) Usulan Pergeseran Anggaran telah diperhitungkan sampai dengan Objek/Rincian Objek/Sub Rincian Objek
                dan telah sesuai dengan kebutuhan pada Dinas Koperasi, Usaha Mikro dan Tenaga Kerja dan dibuktikan
                dengan matrik pergeseran anggaran yang telah kami sampaikan<br />
                4) Penggunaan Anggaran bertanggung jawab atas kebenaran formil dan materiil usulan pergeseran anggaran
                yang diajukan<br />
                5) Apabila dikemudian hari terbukti pernyataan ini tidak benar dan menimbulkan kerugian negara, saya
                bersedia menyetorkan kerugian negara tersebut di kas daerah<br />
                6) Dalam hal terjadi permasalahan hukum yang diakibatkan pergeseran anggaran ini menjadi tanggungjawab
                Pengguna Anggaran
                <br /><br />
                Demikian pernyataan ini dibuat dengan sesungguhnya dan sebenar-benarnya untuk digunakan sebagaimana
                mestinya.
            </td>

        </tr>
    </table>
    <table width="100%">
        <tr>
            <td></td>
            <td width="50%"></td>
            <td>Banjarmasin, {{\Carbon\Carbon::now()->format('d M Y')}}
                <br />Kepala Dinas,<br />
                Selaku Pengguna Anggaran
                ,<br /><br /><br /><br /><br />

                Dr.M.Ramadhan, SE.,ME.,Ak.,CA.<br />
                Pembina Utama Muda<br />
                NIP. 19691208 199803 1 003

            </td>
        </tr>
    </table>
</body>

</html>