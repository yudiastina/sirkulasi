<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Fpdi;
use App\Models\KerjaPraktek;
use Illuminate\Http\Request;
use App\Models\AksesKerjaPraktek;
use Illuminate\Support\Facades\Storage;

class KerjaPraktekController extends Controller
{
    public function index()
    {
        return response()->view('kerja_praktek.index', [
            'kerjaPrakteks' => KerjaPraktek::filter(request([
                'search',
                'judul',
                'tahun',
                'pembimbing',
            ]))->paginate(20)->withQueryString()
        ]);
    }

    public function show(KerjaPraktek $kerjaPraktek)
    {
        if (auth()->check() && auth()->user()->role !== 'admin') {
            $data['kerja_praktek_id'] = $kerjaPraktek->id;
            $data['user_id'] = auth()->user()->id;
            $data['nim'] = auth()->user()->NIM;
            $data['nama'] = auth()->user()->nama;
            $data['prodi'] = auth()->user()->prodi;
            $data['judul'] = $kerjaPraktek->judul_final;
            AksesKerjaPraktek::create($data);
        }
        return response()->view('kerja_praktek.show', [
            'kerjaPraktek' =>$kerjaPraktek,
            'akses_user' =>explode(',' , $kerjaPraktek->akses_user),
        ]);
    }


    public function view_laporan_final_pdf(KerjaPraktek $kerjaPraktek)
    {
        $this->authorize('laporan_final', $kerjaPraktek);
        $file_name_part = explode("/", $kerjaPraktek->link_laporan_final);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $kerjaPraktek->nim . '/dokumen_final_kp/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $kerjaPraktek->nim . '/dokumen_final_kp/compatible-pdf';
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

    public function view_pendahuluan_pdf(KerjaPraktek $kerjaPraktek)
    {
        $this->authorize('pendahuluan', $kerjaPraktek);
        $file_name_part = explode("/", $kerjaPraktek->link_pendahuluan);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $kerjaPraktek->nim . '/dokumen_final_kp/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $kerjaPraktek->nim . '/dokumen_final_kp/compatible-pdf';
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
    public function view_bab1_pdf(KerjaPraktek $kerjaPraktek)
    {
        $this->authorize('bab1', $kerjaPraktek);
        $file_name_part = explode("/", $kerjaPraktek->link_bab1);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $kerjaPraktek->nim . '/dokumen_final_kp/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $kerjaPraktek->nim . '/dokumen_final_kp/compatible-pdf';
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
    public function view_bab2_pdf(KerjaPraktek $kerjaPraktek)
    {
        $this->authorize('bab2', $kerjaPraktek);
        $file_name_part = explode("/", $kerjaPraktek->link_bab2);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $kerjaPraktek->nim . '/dokumen_final_kp/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $kerjaPraktek->nim . '/dokumen_final_kp/compatible-pdf';
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
    public function view_bab3_pdf(KerjaPraktek $kerjaPraktek)
    {
        $this->authorize('bab3', $kerjaPraktek);
        $file_name_part = explode("/", $kerjaPraktek->link_bab3);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $kerjaPraktek->nim . '/dokumen_final_kp/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $kerjaPraktek->nim . '/dokumen_final_kp/compatible-pdf';
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
    public function view_bab4_pdf(KerjaPraktek $kerjaPraktek)
    {
        $this->authorize('bab4', $kerjaPraktek);
        $file_name_part = explode("/", $kerjaPraktek->link_bab4);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $kerjaPraktek->nim . '/dokumen_final_kp/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $kerjaPraktek->nim . '/dokumen_final_kp/compatible-pdf';
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
    public function view_bab5_pdf(KerjaPraktek $kerjaPraktek)
    {
        $this->authorize('bab5', $kerjaPraktek);
        $file_name_part = explode("/", $kerjaPraktek->link_bab5);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $kerjaPraktek->nim . '/dokumen_final_kp/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $kerjaPraktek->nim . '/dokumen_final_kp/compatible-pdf';
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
    public function view_bab6_pdf(KerjaPraktek $kerjaPraktek)
    {
        $this->authorize('bab6', $kerjaPraktek);
        $file_name_part = explode("/", $kerjaPraktek->link_bab6);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $kerjaPraktek->nim . '/dokumen_final_kp/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $kerjaPraktek->nim . '/dokumen_final_kp/compatible-pdf';
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
    public function view_daftar_pustaka_pdf(KerjaPraktek $kerjaPraktek)
    {
        $this->authorize('daftar_pustaka', $kerjaPraktek);
        $file_name_part = explode("/", $kerjaPraktek->link_daftar_pustaka);
        if (count($file_name_part) > 0) {
            $filename = $file_name_part[count($file_name_part) - 1];
        }
        $text_image = 'Vertical-Logo-op35.png';
        // get pdf file name, send name from ajax on other side and received here 

        // compete path of pdf file including directory name
        $srcfile = 'storage/' . $kerjaPraktek->nim . '/dokumen_final_kp/' . $filename;
        // new path of new pdf file created by ghostscript if file above 1.4
        $path = $kerjaPraktek->nim . '/dokumen_final_kp/compatible-pdf';
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
