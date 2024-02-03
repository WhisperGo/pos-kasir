<?php

namespace App\Controllers;
use App\Models\M_detail_penjualan;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Detail_penjualan extends BaseController
{

    public function index($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_detail_penjualan();

            $on='detailpenjualan.PenjualanID = penjualan.PenjualanID';
            $on2='detailpenjualan.ProdukID = produk.ProdukID';
            $data['jojo'] = $model->join3id('detailpenjualan', 'penjualan', 'produk', $on, $on2, $id);

            $data['title'] = 'Detail Penjualan';
            $data['desc'] = 'Anda dapat melihat Detail Penjualan di Menu ini.';

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/detail_penjualan/view', $data);
            echo view('hopeui/partial/footer');
        } else {
            return redirect()->to('/');
        }
    }

    public function create($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_detail_penjualan();

            $data['title'] = 'Data Peminjaman';
            $data['desc'] = 'Anda dapat menambah Data Peminjaman di Menu ini.';  
            $data['subtitle'] = 'Tambah Peminjaman';

            $data['user'] = $model->tampil('user');
            $data['jojo2'] = $id;

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/peminjaman/create', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function aksi_create()
    { 
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $a = $this->request->getPost('jumlah_peminjaman');
            $b = $this->request->getPost('user_peminjam');
            $c = $this->request->getPost('tgl_pengembalian');
            $id = $this->request->getPost('id');

            // Data yang akan disimpan
            $data1 = array(
                'buku' => $id,
                'stok_buku' => $a,
                'user' => $b,
                'tgl_pengembalian' => $c
            );

            // Simpan data ke dalam database
            $model = new M_detail_penjualan();
            $model->simpan('peminjaman', $data1);

            return redirect()->to('peminjaman');
        } else {
            return redirect()->to('/');
        }
    }

    public function aksi_edit($id)
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {

            // Data yang akan disimpan
            $data1 = array(
                'status_peminjaman' => '2',
            );

            $where = array('id_peminjaman' => $id);
            $model = new M_detail_penjualan();

            $stok_keluar = $model->getBukuByIdPeminjaman($id);
            $id_buku = $stok_keluar->buku;

            $model->qedit('peminjaman', $data1, $where);

            return redirect()->to('peminjaman/menu_peminjaman/' . $id_buku);
        } else {
            return redirect()->to('/');
        }
    }

    public function delete($id)
    { 
        if(session()->get('level')== 1 || session()->get('level')== 2) {
            $model=new M_detail_penjualan();
            $model->deletee($id);
            return redirect()->to('penjualan');
        }else {
            return redirect()->to('/');
        }
    }


    // --------------------------------------- PRINT LAPORAN --------------------------------------

    public function menu_laporan()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model=new M_detail_penjualan();

            $data['title'] = 'Laporan Peminjaman';
            $data['desc'] = 'Anda dapat mengprint Data Peminjaman di Menu ini.';      
            $data['subtitle'] = 'Print Laporan Peminjaman';      

            echo view('hopeui/partial/header', $data);
            echo view('hopeui/partial/side_menu');
            echo view('hopeui/partial/top_menu');
            echo view('hopeui/laporan_peminjaman/menu_laporan', $data);
            echo view('hopeui/partial/footer');
        }else {
            return redirect()->to('/');
        }
    }

    public function export_windows()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_detail_penjualan();

            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');

            // Get data absensi kantor berdasarkan filter
            $data['peminjaman'] = $model->getAllPeminjamanInRange($awal, $akhir);
            
            // Hitung jumlah peminjaman berdasarkan status
            $data['jumlah_dipinjam'] = $model->countPeminjamanByStatus($awal, $akhir, 1); // Status Dipinjam
            $data['jumlah_dikembalikan'] = $model->countPeminjamanByStatus($awal, $akhir, 2); // Status Dikembalikan

            $data['title'] = 'Laporan Peminjaman Buku';
            echo view('hopeui/partial/header', $data);
            echo view('hopeui/laporan_peminjaman/print_windows_view', $data);
            echo view('hopeui/partial/footer_print');  
        } else {
            return redirect()->to('/');
        }
    }

    public function export_pdf()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_detail_penjualan();

            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');

            // Get data absensi kantor berdasarkan filter
            $data['peminjaman'] = $model->getAllPeminjamanInRange($awal, $akhir);
            $data['jumlah_dipinjam'] = $model->countPeminjamanByStatus($awal, $akhir, 1); 
            $data['jumlah_dikembalikan'] = $model->countPeminjamanByStatus($awal, $akhir, 2); 

            // Load the dompdf library
            $dompdf = new Dompdf();

            // Set the HTML content for the PDF
            $data['title'] = 'Laporan Peminjaman Buku';
            $dompdf->loadHtml(view('hopeui/laporan_peminjaman/print_pdf_view',$data));
            $dompdf->setPaper('A4','landscape');
            $dompdf->render();
            
            // Generate file name with start and end date
            $file_name = 'laporan_peminjaman_' . str_replace('-', '', $awal) . '_' . str_replace('-', '', $akhir) . '.pdf';

            // Output the generated PDF (inline or attachment)
            $dompdf->stream($file_name, ['Attachment' => 0]);

        } else {
            return redirect()->to('/');
        }
    }

    public function export_excel()
    {
        if (session()->get('level') == 1 || session()->get('level') == 2) {
            $model = new M_detail_penjualan();

            $awal = $this->request->getPost('awal');
            $akhir = $this->request->getPost('akhir');

            $peminjaman = $model->getAllPeminjamanInRange($awal, $akhir);
            $data['jumlah_dipinjam'] = $model->countPeminjamanByStatus($awal, $akhir, 1); 
            $data['jumlah_dikembalikan'] = $model->countPeminjamanByStatus($awal, $akhir, 2);

            $spreadsheet = new Spreadsheet();

            // Get the active worksheet and set the default row height for header row
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->getDefaultRowDimension()->setRowHeight(20);

            $sheet->mergeCells('A1:G1');
            $sheet->setCellValue('A1', 'Laporan Peminjaman Buku');

            $periode = date('d F Y', strtotime($awal)) . ' - ' . date('d F Y', strtotime($akhir));
            $sheet->mergeCells('A3:C5');
            $sheet->setCellValue('A3', 'Periode: ' . $periode);

            $sheet->setCellValue('G3', 'Jumlah peminjaman : ' . count($peminjaman));

            $sheet->setCellValue('G4', 'Jumlah dipinjam : ' . $data['jumlah_dipinjam']);

            $sheet->setCellValue('G5', 'Jumlah dikembalikan : ' . $data['jumlah_dikembalikan']);

            // Set the header row values
            $sheet->setCellValueByColumnAndRow(1, 7, 'No.');
            $sheet->setCellValueByColumnAndRow(2, 7, 'Judul Buku');
            $sheet->setCellValueByColumnAndRow(3, 7, 'Jumlah Pinjam');
            $sheet->setCellValueByColumnAndRow(4, 7, 'Peminjam');
            $sheet->setCellValueByColumnAndRow(5, 7, 'Tgl. Peminjaman');
            $sheet->setCellValueByColumnAndRow(6, 7, 'Tgl. Pengembalian');
            $sheet->setCellValueByColumnAndRow(7, 7, 'Status Peminjaman');

            // Fill the data into the worksheet
            $row = 8;
            $no = 1;
            foreach ($peminjaman as $riz) {
                $sheet->setCellValueByColumnAndRow(1, $row, $no++);
                $sheet->setCellValueByColumnAndRow(2, $row, $riz->judul_buku);
                $sheet->setCellValueByColumnAndRow(3, $row, $riz->stok_buku_peminjaman . ' buah');
                $sheet->setCellValueByColumnAndRow(4, $row, $riz->username);
                $sheet->setCellValueByColumnAndRow(5, $row, date('d F Y', strtotime($riz->tgl_peminjaman)));
                $sheet->setCellValueByColumnAndRow(6, $row, date('d F Y', strtotime($riz->tgl_pengembalian)));
                
                $status_peminjaman = '';

                if ($riz->status_peminjaman == 1) {
                    $status_peminjaman = 'Dipinjam';
                } elseif ($riz->status_peminjaman == 2) {
                    $status_peminjaman = 'Dikembalikan';
                }

                $sheet->setCellValueByColumnAndRow(7, $row, $status_peminjaman);

                // Apply background color based on the value of "Status_1"
                $status_1 = $riz->status_peminjaman;
                $color = '';
                switch ($status_1) {
                    case '2':
                    $color = '92D050'; // Green
                    break;
                    case '1':
                    $color = 'C00000'; // Yellow
                    break;
                }

                if (!empty($color)) {
                    $sheet->getStyle('G' . $row)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB($color);
                }

                $row++;
            }

        // Apply the Excel styling
            $sheet->getStyle('A1')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
            $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

            $sheet->getStyle('A3')->getFont()->setBold(true);
            $sheet->getStyle('A3')->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            $sheet->getStyle('A3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ];

        $lastRow = count($peminjaman) + 7; // Add 4 for the header rows
        $sheet->getStyle('A7:G' . $lastRow)->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

        // Generate file name with start and end date
        $file_name = 'laporan_peminjaman_' . str_replace('-', '', $awal) . '_' . str_replace('-', '', $akhir) . '.xlsx';

        // Create the Excel writer and save the file
        $writer = new Xlsx($spreadsheet);
        $filename = $file_name;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    } else {
        return redirect()->to('/');
    }
}

}