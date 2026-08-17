<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function blog()
    {
        $blog = DB::table('blogs')->get();
        return view('blog', compact('blog'));
    }

    public function about()
    {
        $name = "Aphatsara Khaemadan";
        $date = "08 พฤศจิกายน 2547";
        return view('about', compact('name', 'date'));
    }

    // แสดงฟอร์ม
    public function from()
    {
        return view('from');
    }

    // รับข้อมูลจากฟอร์ม
    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
        ],[
            'title.required' => 'กรุณากรอกชื่อบทความ',
            'title.max' => 'ชื่อบทความห้ามเกิน 50 ตัวอักษร',
            'content.required' => 'กรุณากรอกเนื้อหา',
        ]);

        DB::table('blogs')->insert([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'draft',
        ]);

        return redirect('/blog2')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function delete($id)
    {
        DB::table("blogs")->where('id', $id)->delete();
        return redirect('/blog2')->with('success', 'ลบบทความเรียบร้อยแล้ว');
    }
}