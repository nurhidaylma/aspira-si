<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Aspiration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementController extends Controller
{
    public function index(){
        $announcements = Announcement::getAnnouncementByIdUser(session(0)->id_entitas);
        $aspirasi = Aspiration::getAspirasiByIdEntitas(session(0)->id_entitas);
        return view('announcement.announcement',['announcements' => $announcements,'aspirasi'=>$aspirasi]);
    }

    public function getAllAnnouncement(){
        $announcements = Announcement::getAllData();
        return view('users.announcement',['announcements' => $announcements]);
    }

    public function destroy($id){
        $announcement = Announcement::find($id);
        $announcement->delete();
        return redirect(route('announcement'));
    }

    public function store(Request $request){
        $announcement = new Announcement();
        $aspirasi = new Aspiration();
        $announcement->id_entitas = $request->id_entitas;
        if (isset($request->judul_aspirasi)){
            $announcement->id_aspirasi = $request->judul_aspirasi;
        }
        if($request->hasfile('file_name'))
        {
            foreach($request->file('file_name') as $file)
            {
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/files/', $name);
                $data[] = $name;
            }
            $announcement->nama_file = json_encode($data);
        }
        $announcement->announcement_text = $request->announcement_text;                
        $announcement->save();    

        $id_aspirasi = $request->judul_aspirasi;
        DB::table('aspirasi')
            -> where('id_aspirasi', '=', $id_aspirasi)
            -> update(['status' => 'Done Resolved']);

        return redirect(route('announcement'));
    }

    public function edit($id){
        $announcement = Announcement::find($id);
        $aspirasi = Aspiration::getAspirasiByIdEntitas(session(0)->id_entitas);
        return view('announcement.editAnnouncement',['announcement' => $announcement,'aspirasi'=>$aspirasi]);
    }

    public function update(Request $request){
        $announcement = Announcement::find($request->id_announcement);
        if (isset($request->judul_aspirasi)){
            $announcement->id_aspirasi = $request->judul_aspirasi;
        }
        $announcement->announcement_text=$request->announcement_text;
        $announcement->save();
        return redirect(route('announcement'));

    }
}
