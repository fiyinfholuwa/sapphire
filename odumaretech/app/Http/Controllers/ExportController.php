<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportController extends Controller
{
    public function ExportExcelUser($data){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="student.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    public  function export_users(){
        $data = DB::table('users')->where('user_type', '=', 0)->get();
        $data_array [] = array("SN","Last Name","First Name","Student ID", "Email", "Date Created");
        $i=0;
       
        foreach($data as $data_item)
        {
            $i++;
            $data_array[] = array(
                'SN' => $i,
                'Last Name' => $data_item->last_name,
                'First Name' => $data_item->first_name,
                'Student ID' => $data_item->student_id,
                'Email' => $data_item->email,
                'Date Created' => $data_item->created_at
            );
        }
        $this->ExportExcelUser($data_array);
    }


    public function ExportExcelInstructor($data){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="instructor.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    public  function export_instructor(){
        $data = DB::table('users')->where('user_type', '=', 0)->get();
        $data_array [] = array("SN","Last Name","First Name","Instructor ID", "Email", "Date Created");
        $i=0;
       
        foreach($data as $data_item)
        {
            $i++;
            $data_array[] = array(
                'SN' => $i,
                'Last Name' => $data_item->last_name,
                'First Name' => $data_item->first_name,
                'Instructor ID' => $data_item->student_id,
                'Email' => $data_item->email,
                'Date Created' => $data_item->created_at
            );
        }
        $this->ExportExcelInstructor($data_array);
    }


    public function ExportExcelMasterClass($data){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="masterclass.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    public  function export_masterclass(){
        $data = DB::table('master_classes')->get();
        $data_array [] = array("SN","Last Name","First Name", "Email", "Intrested In Learning", "Gender", "Level", "Location",  "Date Created");
        $i=0;
       
        foreach($data as $data_item)
        {
            $i++;
            $data_array[] = array(
                'SN' => $i,
                'Last Name' => $data_item->last_name,
                'First Name' => $data_item->first_name,
                'Email' => $data_item->email,
                'Intrested In Learning' => $data_item->intrested_in,
                'Gender' => $data_item->gender,
                'Level' => $data_item->career,
                'Location' => $data_item->location,
                'Date Created' => $data_item->created_at
            );
        }
        $this->ExportExcelMasterClass($data_array);
    }


    public function ExportExcelCompanyExport($data){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($data);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="company_traning.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    public  function export_company_training(){
        $data = DB::table('company_trainings')->get();
        $data_array [] = array("SN","Company Name","Email", "Phone Number", "Training Focus", "Level", "Location",  "Date Created");
        $i=0;
       
        foreach($data as $data_item)
        {
            $i++;
            $data_array[] = array(
                'SN' => $i,
                'Company Name' => $data_item->name,
                'Email' => $data_item->email,
                'Phone Number' => $data_item->phone,
                'Traning Focus' => $data_item->intrested_in,
                'Level' => $data_item->career,
                'Location' => $data_item->location,
                'Date Created' => $data_item->created_at
            );
        }
        $this->ExportExcelCompanyExport($data_array);
    }

}
