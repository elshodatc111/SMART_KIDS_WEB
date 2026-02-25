<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\DeleteGroupRequest;
use App\Http\Requests\Group\DeleteGroupTarbiyachiRequest;
use App\Http\Requests\Group\StoreGroupKidRequest;
use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\StoreGroupTarbiyachiRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Group;
use App\Models\GroupKid;
use App\Models\GroupUser;
use App\Models\Kid;
use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller{

    public function groups(){
        $array = Group::where('status', 'active')->get();
        $groups = [];
        foreach ($array as $key => $group) {
            $groups[$key]['id'] = $group->id;
            $groups[$key]['group_name'] = $group->group_name;
            $groups[$key]['group_amount'] = $group->group_amount;
            $groups[$key]['kids_count'] = GroupKid::where('group_id', $group->id)->where('status', 'active')->count();
            $groups[$key]['emploes_count'] = GroupUser::where('group_id', $group->id)->where('status', 'active')->count();
            $groups[$key]['manager_name'] = $group->manager ? $group->manager->name : '-';
            $groups[$key]['created_at'] = $group->created_at;
        }
        return view('group.groups', compact('groups'));
    }

    public function GroupStore(StoreGroupRequest $request){
       $data = $request->validated();
       $data['meneger_id'] = auth()->id();
       $data['status'] = 'active';
       Group::create($data);
       return redirect()->route('groups')->with('success', __('groups.request_success'));
    }

    public function show($id){
        $group = Group::findOrFail($id); 
        $notes = Note::where('type', 'group')->where('type_id', $id)->orderBy('created_at', 'desc')->get();
        $noactive_tarbiyachilar = User::whereIn('type', ['kichik_tarbiyachi', 'katta_tarbiyachi'])
            ->where('status', 'active')->whereDoesntHave('group_users', function ($query) {
            $query->where('status', 'active');
        })->get(['id', 'name', 'type']);
        $group_tarbiyachilar = GroupUser::where('group_id', $id)->get();
        $groupAddChild = Kid::where('status', 'false')->orderby('child_full_name', 'asc')->get();
        $groupKids = GroupKid::where('group_id', $id)->get();
        return view('group.show', compact('group', 'notes', 'noactive_tarbiyachilar', 'group_tarbiyachilar', 'groupAddChild', 'groupKids')); 
    }

    public function createNote(Request $request){
        $request->validate([
            'id' => 'required|exists:groups,id',
            'text' => 'required|string|max:255',
        ]);
        Note::create([
            'type' => 'group',
            'type_id' => $request->id,
            'text' => $request->text,
            'admin_id' => auth()->id(),
        ]);
        return redirect()->route('groups_show', ['id' => $request->id])->with('success', __('groups.note_added_successfully'));
    }

    public function update(UpdateGroupRequest $request){
        $data = $request->validated();
        $group = Group::findOrFail($data['id']);
        $group->update($data);
        return redirect()->route('groups_show', ['id' => $data['id']])->with('success', __('groups.request_success_update'));
    }

    public function addTarbiyachi(StoreGroupTarbiyachiRequest $request){
        $validated = $request->validated();
        GroupUser::create([
            'group_id'       => $validated['id'],
            'user_id'        => $validated['user_id'],
            'status'         => 'active',
            'start_date'     => Carbon::now()->format('Y-m-d'),
            'start_admin_id' => auth()->id(),
        ]);
        return back()->with('success', __('groups.tarbiyachi_guruhga_qoshildi'));
    }
    public function deleteTarbiyachi(DeleteGroupTarbiyachiRequest $request){
        $groupUser = GroupUser::find($request->id);
        $groupUser->update([
            'status' => 'deleted',
            'end_date' => now()->format('Y-m-d'),
            'end_admin_id' => auth()->id(),
        ]);
        return back()->with('success', __('groups.tarbiyachi_guruhdan_ochirildi'));
    }

    public function addKid(StoreGroupKidRequest $request){
        $validated = $request->validated();
        GroupKid::create([
            'group_id'       => $validated['id'],
            'kid_id'         => $validated['kid_id'],
            'status'         => 'active',
            'start_date'     => Carbon::now()->format('Y-m-d'),
            'start_admin_id' => auth()->id(),
            'description'    => $validated['description'],
        ]);
        $kid = Kid::find($validated['kid_id']);
        $kid->update(['status' => 'true']);
        return back()->with('success', __('groups.bola_guruhga_qoshildi'));
    }

    public function deleteKid(Request $request){
        $request->validate([
            'id' => 'required|exists:group_kids,id',
        ]);
        $groupKid = GroupKid::find($request->id);
        $groupKid->update([
            'status' => 'deleted',
            'end_date' => now()->format('Y-m-d'),
            'end_admin_id' => auth()->id(),
        ]);
        $kid = Kid::find($groupKid->kid_id);
        $kid->update(['status' => 'false']);
        return back()->with('success', __('groups.guruhdan_bola_ochirildi'));
    }

    public function deleteGroup(DeleteGroupRequest $request){
        $validated = $request->validated();
        $groupId = $validated['id'];
        DB::transaction(function () use ($groupId) {
            $now = now()->format('Y-m-d');
            $adminId = auth()->id();
            $activeKidIds = GroupKid::where('group_id', $groupId)->where('status', 'active')->pluck('kid_id');
            if ($activeKidIds->isNotEmpty()) {
                Kid::whereIn('id', $activeKidIds)->update(['status' => 'false']);
            }
            GroupKid::where('group_id', $groupId)
                ->where('status', 'active')
                ->update([
                    'status' => 'deleted',
                    'end_date' => $now,
                    'end_admin_id' => $adminId,
                ]);
            GroupUser::where('group_id', $groupId)
                ->where('status', 'active')
                ->update([
                    'status' => 'deleted',
                    'end_date' => $now,
                    'end_admin_id' => $adminId,
                ]);
            Group::where('id', $groupId)->update(['status' => 'deleted']);
        });
        return redirect()->route('groups')->with('success', __('groups.guruh_ochirildi'));
    }

}
