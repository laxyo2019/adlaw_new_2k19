<?php

namespace App\Http\Controllers\Admin\ACL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
class PermissionController extends Controller
{
    public function index(){
    	$permissions = Permission::all();
   		return view('admin.dashboard.acl.permission.index',compact('permissions'));
   	}
   	public function create(){
   		return view('admin.dashboard.acl.permission.create');
   	}
   	public function store(Request $request){
   		$data = $request->validate([
   			'name' 			=> 'required|string|min:4|max:100',
   			'display_name' 	=> 'required|string|min:4|max:100',
   			'description'	=> 'required|string|min:6|max:150'
   		]);
   		Permission::create($data);
   		return redirect()->route('permission.index')->with('success','Permission Created Successfully');
   		
   	}
   	public function edit($id){
   		$permission = Permission::find($id);
   		return view('admin.dashboard.acl.permission.edit',compact('permission'));
   	}
   	public function update(Request $request,$id){

   		$data = $request->validate([
   			'name' 			=> 'required|string|min:4|max:100',
   			'display_name' 	=> 'required|string|min:4|max:100',
   			'description'	=> 'required|string|min:6|max:150'
   		]);
   		Permission::find($id)->update($data);
   		return redirect()->route('permission.index')->with('success','Permission Updated Successfully');
   	}

}
