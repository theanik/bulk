<?php

namespace Bulkly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Bulkly\BufferPosting;
use Bulkly\SocialPostGroups;
use Illuminate\Pagination\Paginator;
class HisotryController extends Controller
{
    public $groups;
    public function __construct()
    {
        $this->middleware('auth');
        $this->groups = DB::table('social_post_groups')
                ->select('type')
                ->distinct()
                ->get();
    }

    public function index()
    {   $groups = $this->groups;
        $bufferPosts = BufferPosting::latest()->paginate(15);
        return view('history.index',compact('bufferPosts','groups'));
    }

    public function search_by_date(Request $req){
        $groups = $this->groups;
        $data = $req->search_by_date;
        $bufferPosts = BufferPosting::where('sent_at','LIKE',"%$data%")->paginate(15);
        return view('history.index',compact('bufferPosts','groups'));
    }

    public function filter_by_group(Request $req){
        $groups = $this->groups;
        $fileds = $req->fileds;
        if($fileds == ""){
            $bufferPosts = BufferPosting::latest()->paginate(15);
            return view('history.index',compact('bufferPosts','groups'));
        }else{
            $bufferPosts_all = BufferPosting::all();
            $bufferPosts = [];
            foreach($bufferPosts_all as $bufferPost){
                if($bufferPost->groupInfo['type'] == $fileds){
                    array_push($bufferPosts,$bufferPost);
                }
            }
            // return $bufferPosts;
            $bufferPosts = new \Illuminate\Pagination\Paginator($bufferPosts, count($bufferPosts), 15);
            return view('history.index',compact('bufferPosts','groups'));
        }
        
    }

    public function search_data(Request $req)
    {
        $groups = $this->groups;
        $data = $req->search_data;
        $bufferPosts = BufferPosting::where('created_at','LIKE',"%$data%")
                                    ->orWhere('post_text','LIKE',"%$data%")->paginate(15);
        return view('history.index',compact('bufferPosts','groups'));
    }
}
