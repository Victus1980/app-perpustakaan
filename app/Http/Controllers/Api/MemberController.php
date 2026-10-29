<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Response;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return MemberResource::collection($members);
    }

    public function show($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json([
                'message' => 'Member not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return new MemberResource($member);
    }
}
