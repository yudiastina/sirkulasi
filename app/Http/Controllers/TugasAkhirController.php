<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Fpdi;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use App\Models\AksesTugasAkhir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TugasAkhirController extends Controller
{
    public function index()
    {
        return response()->view('tugas_akhir.index', [
            'tugasAkhirs' => TugasAkhir::filter(request([
                'search',
                'judul',
                'tahun',
                'kata_kunci',
                'abstrak',
                'pembimbing'
            ]))->paginate(20)->withQueryString()
        ]);
    }

    public function show(TugasAkhir $tugasAkhir)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            $data['tugas_akhir_id'] = $tugasAkhir->id;
            $data['user_id'] = auth()->user()->id;
            $data['nim'] = auth()->user()->NIM;
            $data['nama'] = auth()->user()->nama;
            $data['prodi'] = auth()->user()->prodi;
            $data['judul'] = $tugasAkhir->judul_final;

            AksesTugasAkhir::create($data);
        }
        return response()->view('tugas_akhir.show',[
            'tugasAkhir' => $tugasAkhir,
            'akses_user' => explode(',' , $tugasAkhir->akses_user),
        ]);
    }


    public function view_laporan_final_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('laporan_final', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_laporan_final);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf/';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path  . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
    public function view_artikel_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('artikel', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_artikel);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 170);
                $yyy_final = ($size['height'] - 230);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 170);
                $yyy_final = ($size['height'] - 230);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }

    public function view_pendahuluan_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('pendahuluan', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_pendahuluan);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }

    public function view_abstrak_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('abstrak', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_abstrak);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
    public function view_bab1_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('bab1', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_bab1);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
    public function view_bab2_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('bab2', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_bab2);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
    public function view_bab3_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('bab3', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_bab3);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
    public function view_bab4_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('bab4', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_bab4);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
    public function view_bab5_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('bab5', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_bab5);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
    public function view_daftar_pustaka_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('daftar_pustaka', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_daftar_pustaka);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
    public function view_lampiran_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('lampiran', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_lampiran);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
    public function view_biodata_pdf(TugasAkhir $tugasAkhir)
    {
        $this->authorize('biodata', $tugasAkhir);
        $file_name_part = explode("/", $tugasAkhir->link_biodata);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }

        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 
        

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $tugasAkhir->NIM . '/dokumen_final/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $tugasAkhir->NIM . '/dokumen_final/compatible-pdf';
        Storage::disk('public')->makeDirectory($path);
        $srcfile_new = 'storage/' . $path . $filename;
        // read pdf file first line because pdf first line contains pdf version information
        $filepdf = fopen($srcfile, "r");
        if ($filepdf) {
            $line_first = fgets($filepdf);
            fclose($filepdf);
        } else {
            echo "error opening the file.";
        }
        // extract number such as 1.4,1.5 from first read line of pdf file
        preg_match_all('!\d+!', $line_first, $matches);

        // save that number in a variable
        $pdfversion = implode('.', $matches[0]);

        // compare that number from 1.4(if greater than proceed with ghostscript)
        if ($pdfversion > "1.4") {
            // USE GHOSTSCRIPT IF PDF VERSION ABOVE 1.4 AND SAVE ANY PDF TO VERSION 1.4 , SAVE NEW PDF OF 1.4 VERSION TO NEW PATH
            shell_exec('gswin64c -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -sOutputFile="' . $srcfile_new . '" "' . $srcfile . '"');
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile_new);
            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        } else {
            // use FPDI if pdf version upto 1.4 no need for ghostscript 
            $pdf = new Fpdi();
            $pagecount = $pdf->setSourceFile($srcfile);

            // Add watermark image to PDF pages 
            for ($i = 1; $i <= $pagecount; $i++) {
                $tpl = $pdf->importPage($i);
                $size = $pdf->getTemplateSize($tpl);
                $pdf->addPage();
                $pdf->useTemplate($tpl, 1, 1, $size['width'], $size['height'], TRUE);
                //Put the watermark 
                $xxx_final = ($size['width'] - 135);
                $yyy_final = ($size['height'] - 165);

                $pdf->Image($text_image, $xxx_final,  $yyy_final, 125, 125, 'png');
            }
            return $pdf->Output();
        }
    }
}
