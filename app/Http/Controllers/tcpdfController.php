<?php

namespace App\Http\Controllers;

use PDF2;

class tcpdfController extends Controller
{
    public function index()
    {
        PDF2::SetCreator(PDF_CREATOR);
        PDF2::SetAuthor(PDF_AUTHOR);
        PDF2::SetTitle('Rapor Siswa');
        PDF2::SetSubject('TCPDF Tutorial');
        PDF2::SetKeywords('SabanaCode');

// set default header data
        PDF2::SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
        PDF2::setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        PDF2::setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        PDF2::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        // PDF2::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        // PDF2::SetHeaderMargin(PDF_MARGIN_HEADER);
        // PDF2::SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        PDF2::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
        PDF2::setImageScale(PDF_IMAGE_SCALE_RATIO);
//-------------------------------------------------------

// set font
        PDF2::AddPage();
        PDF2::SetFont('times', 'B', 12);
        PDF2::Cell(0, 2, 'RAPOR', 0, 1, 'C');
        PDF2::Cell(0, 2, 'SEKOLAH MENENGAH PERTAMA', 0, 1, 'C');
        PDF2::Cell(0, 2, '(SMP)', 0, 1, 'C');

        PDF2::Image('assets/img/logo.png', '55', '65', 40, 40, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        PDF2::Ln(60);
        PDF2::SetFont('times', 'B', 9);

        PDF2::Cell(0, 5, 'NAMA PESERTA DIDIK', 0, 1, 'C');
        PDF2::SetFont('times', 'B', 11);

        PDF2::Cell(0, 2, 'SIVLESTER', 0, 1, 'C');
        PDF2::Ln(5);
        PDF2::SetFont('times', 'B', 9);

        PDF2::Cell(0, 5, 'NIS', 0, 1, 'C');
        PDF2::SetFont('times', 'B', 11);

        PDF2::Cell(0, 2, '923874283', 0, 1, 'C');

        PDF2::Ln(30);
        PDF2::SetFont('times', 'B', 9);
        PDF2::Cell(0, 5, 'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN', 0, 1, 'C');

// Start First Page Group
        PDF2::startPageGroup();

// add a page

// add second page

        PDF2::AddPage();
        PDF2::SetFont('times', 'B', 11);
        PDF2::Cell(0, 2, 'RAPOR', 0, 1, 'C');
        PDF2::SetFont('times', 'B', 10);
        PDF2::Cell(0, 2, 'SEKOLAH MENENGAH PERTAMAN', 0, 1, 'C');
        PDF2::Cell(0, 3, '(SMP)', 0, 1, 'C');
        PDF2::Ln(5); //  enter 5 baris
        // create columns content
        // create columns content
        PDF2::SetFont('times', '', 10);

        $tbl = '
<table cellspacing="0" cellpadding="5" border="0.2">
    <tr>
        <th>Nama Sekolah</th>
        <td>SMP SANTO YOSEPH DENPASAR</td>
    </tr>
    <tr>
        <th>NIPSIN</th>
        <td>50103175</td>
    </tr>
     <tr>
        <th>NIPSIN/N55/NDS</th>
        <td>304220400010</td>
    </tr>
     <tr>
        <th>Alamat Sekolah</th>
        <td></td>
    </tr>
     <tr>
        <th>Desa/Kelurahan</th>
        <td>Panjer</td>
    </tr>
     <tr>
        <th>Kecamatan</th>
        <td>Denpasar Selatan</td>
    </tr>
     <tr>
        <th>Kota/Kabupaten</th>
        <td>Denpasar</td>
    </tr>
     <tr>
        <th>Provinsi</th>
        <td>Bali</td>
    </tr>
     <tr>
        <th>Web</th>
        <td></td>
    </tr>
     <tr>
        <th>Email</th>
        <td></td>
    </tr>


</table>
';

        PDF2::writeHTML($tbl, true, false, false, false, '');

        PDF2::lastPage();
//
        PDF2::startPageGroup();
// Start Second Page Group

        PDF2::AddPage();
        PDF2::SetFont('times', 'B', 10);
        PDF2::Cell(0, 2, 'IDENTITAS PESERTA DIDIK', 0, 1, 'C');
        PDF2::Ln(5); //  enter 5 baris
        // create columns content
        // create columns content
        PDF2::SetFont('times', '', 10);

        $tbl = '
<table cellspacing="0" cellpadding="2" border="0.2">
    <tr>
        <td width="5%">1</td>
        <th width="40%" >Nama Lengkap Peserta Didik</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">2</td>
        <th width="40%" >Nomor Induk/NISN</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">3</td>
        <th width="40%" >Tempat,Tanggal Lahir</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">4</td>
        <th width="40%" >Jenis Kelamin</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">5</td>
        <th width="40%" >Agama</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">6</td>
        <th width="40%" >Status Dalam Keluarga</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">7</td>
        <th width="40%" >Anak ke</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">8</td>
        <th width="40%" >ALamat Peserta Didik</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">9</td>
        <th width="40%" >Nomor Telepone Rumah</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">10</td>
        <th width="40%" >Sekolah Asah (SMP/MTs)</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%">11</td>
        <th width="40%" >Orang Tua</th>
        <td width="55%"></td>
    </tr>
    <tr>
        <td width="5%"></td>
        <th width="40%" >a.Nama Ayah</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%"></td>
        <th width="40%" >b.Nama Ibu</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%"></td>
        <th width="40%" >c.Alamat</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%"></td>
        <th width="40%" >d.Nomor Telephone HP</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%">12</td>
        <th width="40%" >Pekerjaan Orang Tuan</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%"></td>
        <th width="40%" >a. Ayah</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%"></td>
        <th width="40%" >b.Ibu</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%">13</td>
        <th width="40%" >Wali Peserta Didik</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%"></td>
        <th width="40%" >a.Nama Wali</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%"></td>
        <th width="40%" >b.Nomor Telp Wali</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%"></td>
        <th width="40%" >c.Alamat</th>
        <td width="55%"></td>
    </tr>
     <tr>
        <td width="5%"></td>
        <th width="40%" >d.Pekerjaan</th>
        <td width="55%"></td>
    </tr>



</table>';

        PDF2::writeHTML($tbl, true, false, false, false, '');
        PDF2::SetFont('times', '', 8);
        PDF2::Cell(0, 1, 'Denpasar,' . date('d F Y'), 0, 1, 'R');
        PDF2::Cell(0, 1, 'Kepala Sekolah', 0, 1, 'R');

        PDF2::Cell(0, 30, '(____________)', 0, 1, 'R');

        PDF2::lastPage();

// Start Second Page Group
        PDF2::startPageGroup();

// add some pages
        PDF2::AddPage();

        $tableHeader = '
<table cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td>NIS/NISN</td>
        <td>35387465</td>
        <td>Kelas</td>
        <td></td>
    </tr>
      <tr>
        <td>Nama Lengkap</td>
        <td>35387465</td>
        <td>Semester</td>
        <td></td>
    </tr>
      <tr>
        <td>Nam Sekolah</td>
        <td></td>
        <td>Tahun aJaran</td>
        <td></td>
    </tr>
</table>
';

        PDF2::writeHTML($tableHeader, true, false, false, false, '');

        PDF2::Ln(2);

        $tbl = '
<table cellspacing="0" cellpadding="1" border="1">
        <tr>
                <td  align="center" width="5%" rowspan="2">No</td>
                <td  align="center" width="30%" rowspan="2">Mata Pelajaran</td>
                <td  align="center" width="30%" colspan="3">Pengetahuan</td>
                <td  align="center" width="30%" colspan="3">Keterampilan</td>
                <td  align="center" width="5%" ></td>

        </tr>
         <tr>

                <td width="10%"  align="center">Nilai</td>
                <td width="10%" align="center">Predikat</td>
                <td  width="10%" align="center">Deskripsi</td>
                <td width="10%"  align="center">Nilai</td>
                <td width="10%" align="center">Predikat</td>
                <td  width="10%" align="center">Deskripsi</td>
                <td  width="5%" align="center">Rata-Rata</td>
        </tr>
        <tr>
                <td  align="center" width="5%" >1</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
        <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  align="center" width="5%" >2</td>
                <td  width="30%">Matematika</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="10%" >100</td>
                <td  align="center" width="5%" >100</td>
        </tr>
          <tr>
                <td  colspan="8" align="right"  >Rata-Rata Seluruh</td>

                <td  align="center" >100</td>
        </tr>

</table>';

        PDF2::writeHTML($tbl, true, false, false, false, '');
        PDF2::Ln(1);
        PDF2::Cell(0, 2, 'Absensi Semester', 0, 1, 'L');
        $tableAbsensi = '
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td align="center">Apha</td>
        <td  align="center">sakit</td>
        <td  align="center">Ijin</td>
        <td >Keterangan</td>
    </tr>
     <tr>
        <td  align="center"></td>
        <td  align="center"></td>
        <td align="center"></td>
        <td></td>
    </tr>
</table>';

        PDF2::writeHTML($tableAbsensi, true, false, false, false, '');

        PDF2::Ln(1);
        PDF2::Cell(0, 2, 'Kegiatan Extrakurikuler', 0, 1, 'L');
        $tableAbsensi = '
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td  align="center" width="5%">No</td>
        <td  align="center" width="45%">Nama kegiatan</td>
        <td align="center" width="50%">Keterangan</td>
    </tr>
     <tr>
        <td  align="center" width="5%"></td>
        <td  align="center"></td>
        <td></td>
    </tr>
</table>';

        PDF2::writeHTML($tableAbsensi, true, false, false, false, '');
        PDF2::SetFont('times', '', 8);
        PDF2::Cell(0, 1, 'Denpasar,' . date('d F Y'), 0, 1, 'R');
        PDF2::Cell(0, 1, 'Wali Kelas', 0, 1, 'R');

        PDF2::Cell(0, 30, '(____________)', 0, 1, 'R');

        PDF2::lastPage();
        PDF2::Output('printMandiriRaport.pdf');

    }
}
