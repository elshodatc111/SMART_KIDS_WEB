<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\StoreGroupRequest;
use App\Http\Requests\Group\UpdateGroupRequest;
use App\Models\Group;
use App\Models\Note;
use Illuminate\Http\Request;

class GroupController extends Controller{

    public function groups(){
        $groups = Group::where('status', 'active')->get();
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
        return view('group.show', compact('group', 'notes'));
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

}
