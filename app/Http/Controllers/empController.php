<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\employee;
use Session;

class empController extends Controller
{
    
    function add(Request $Request){
        $Request->validate([
            "emp_name" => "required", 
            "emp_email" => "required | email | min:3 | max:120 | unique:employees,emp_email", 
            "emp_phone" => "required | min:10 | max:10 | unique:employees,emp_phone", 
            "emp_type" => "required", 
            "emp_sal" => "required", 
            "emp_pass" => "required",      
        ],[],[
            
            "emp_name" => "Employee Name" ,
            "emp_email" => "Employee Email" ,
            "emp_phone" => "Employee Phone" ,
            "emp_type" => "Employee Type/Role",
            "emp_sal" => "Employee Salary" ,
            "emp_pass" => "Employee Password",
        ]);

        employee::insert([
            "emp_name" =>       $Request->emp_name, 
            "emp_email" =>      $Request->emp_email, 
            "emp_phone" =>      $Request->emp_phone, 
            "role" =>           $Request->emp_type,
            "emp_salary" =>     $Request->emp_sal,    
            "emp_pass" =>       sha1(md5(crc32($Request->emp_pass))),
        ]);

        return redirect('/admin/employees');
    }

    function update(Request $Request){
        $emp_id = $Request->emp_id;
        $Request->validate([
            "emp_id" => "required",
            "emp_name" => "required", 
            "emp_email" => "required | email | min:3 | max:120 | unique:employees,emp_email,${emp_id},emp_id", 
            "emp_phone" => "required | min:10 | max:10 | unique:employees,emp_phone,${emp_id},emp_id", 
            "emp_type" => "required", 
            "emp_sal" => "required", 
                
        ],[],[
            "emp_id" => "Employee ID" ,
            "emp_name" => "Employee Name" ,
            "emp_email" => "Employee Email" ,
            "emp_phone" => "Employee Phone" ,
            "emp_type" => "Employee Type/Role",
            "emp_sal" => "Employee Salary" ,
          
        ]);

        employee::where('emp_id',$Request->emp_id)->update([
            "emp_name" =>       $Request->emp_name, 
            "emp_email" =>      $Request->emp_email, 
            "emp_phone" =>      $Request->emp_phone, 
            "role" =>           $Request->emp_type,
            "emp_salary" =>     $Request->emp_sal,    
           
            'verified_document' => "Not Verified",

        ]);

        return redirect('/admin/employees?search='.$Request->emp_id);
    }



    function updatePassword(Request $Request){
        
        $Request->validate([
            "emp_id" => "required", 
            "emp_pass" => "required",   
        ],[],[
            "emp_id" => "Employee ID", 
            "emp_pass" => "Employee Password",  
        ]);

        employee::where('emp_id',$Request->emp_id)->update([
            "emp_pass" =>       sha1(md5(crc32($Request->emp_pass))),

        ]);

        return redirect('/admin/employees?search='.$Request->emp_id);
    }

    













    function blockEmployee(Request $Request){
        $Request->validate([
            "emp_id" => "required",    
        ]);

        employee::where('emp_id',$Request->emp_id)->update([
            'acc_status' => "0"
        ]);

        return redirect('/admin/employees?search='.$Request->emp_id);
    }

    function unBlockEmployee(Request $Request){
        $Request->validate([
            "emp_id" => "required",    
        ]);

        employee::where('emp_id',$Request->emp_id)->update([
            'acc_status' => "1"
        ]);

        return redirect('/admin/employees?search='.$Request->emp_id);
    }

    function deleteEmployee(Request $Request){
        $Request->validate([
            "emp_id" => "required",    
        ]);

        employee::where('emp_id',$Request->emp_id)->delete();

        return redirect('/admin/employees');
    }



    function verifyEmployee(Request $Request){
        $Request->validate([
            "emp_id" => "required",
            "doc_type" => "required", 
            "doc_id" => "required",       
        ],[],[
            "emp_id" => "Employee Id",
            "doc_type" => "Document Type", 
            "doc_id" => "Document Number", 
        ]);

        employee::where('emp_id',$Request->emp_id)->update([
            "verified_document" => $Request->doc_type."|".base64_encode($Request->doc_id),
        ]);

        return redirect('/admin/employees?search='.$Request->emp_id);
    }

    function DeleteVerificationRecordOfEmployee(Request $Request){
        $Request->validate([
            "emp_id" => "required",    
        ]);

        employee::where('emp_id',$Request->emp_id)->update([
            'verified_document' => "Not Verified",
        ]);

        return redirect('/admin/employees?search='.$Request->emp_id);
    }


    
}
