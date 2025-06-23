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
    <h3 style="text-align: center">SURAT KETERANGAN</h3>

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
            <td colspan="2"><br />

                Menerangkan dengan sesungguhnya bahwa belanja yang diusulkan dalam surat permohonan persetujuan
                pergeseran anggaran Nomor 400/ 372/Diskopumker-UM Tanggal 13 Juni 2023, merupakan belanja yang belum
                dilakukan proses penerbitan Surat Perintah Pembayaran Langsung (SPP-LS) atau penggunaan Uang
                Persediaan/Uang Ganti Persediaan yang Bukti Pertanggungjawabannya telah dijurnal/ dicatat dalam
                transaksi Buku Kas Umum (BKU).<br /><br />

                Demikian surat keterangan ini dibuat dengan sesungguhnya dan sebenar-benarnya untuk digunakan
                sebagaimana mestinya.

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