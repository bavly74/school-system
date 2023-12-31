<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface ZoomMeetingRepoInterface {
    public function index();
    public function create();
    public function store($request);
    public function createIndirectMeeting();
    public function destroy($request);
    public function storeIndirectMeeting($request);
}
