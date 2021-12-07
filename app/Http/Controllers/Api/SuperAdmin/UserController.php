<?php

namespace App\Http\Controllers\Api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersCollection;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['position'])->orderBy('created_at', 'DESC')->team();
        if (request()->q != '') {
            $users = $users->where('name', 'LIKE', '%' . request()->q . '%');
        }
        $users = $users->paginate(12);
        return new UsersCollection($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:150',
            'position_id' => 'required|exists:positions,id',
            'parent_id' => 'nullable|exists:users,id',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|string',
            'gender' => 'required',
            'image' => 'required|image'
        ]);

        DB::beginTransaction();
        try {
            $name = NULL;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/teams', $name);
            }
            User::create([
                'name' => $request->name,
                'slug' => $request->name,
                'position_id' => $request->position_id,
                'parent_id' => $request->parent_id,
                'address' => $request->address,
                'phone' => $request->phone,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'gender' => $request->gender,
                'image' => $name,
                'role' => 2
            ]);
            DB::commit();
            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'data' => $e->getMessage()], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->with(['position'])->orderBy('created_at', 'DESC')->team();
        return $user->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = User::find($id);
        $this->validate($request, [
            'name' => 'required|string|max:150',
            'position_id' => 'required|exists:positions,id',
            'parent_id' => 'nullable|exists:users,id',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'username' => 'unique:users,username,'.$users->id,
            'email' => 'unique:users,email,'.$users->id,
            'password' => 'nullable|min:6|string',
            'gender' => 'required',
            'image' => 'nullable|image'
        ]);

        try {
            $user = User::find($id);
            $password = $request->password != '' ? bcrypt($request->password):$user->password;
            $filename = $user->image;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                File::delete(storage_path('app/public/teams/' . $filename));
                $filename = $request->email . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/teams', $filename);
            }

            $user->update([
                'name' => $request->name,
                'slug' => $request->name,
                'position_id' => $request->position_id,
                'parent_id' => $request->parent_id,
                'address' => $request->address,
                'phone' => $request->phone,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $password,
                'gender' => $request->gender,
                'image' => $filename,
                'role' => 2
            ]);
            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'data' => $e->getMessage()], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        File::delete(storage_path('app/public/teams/' . $user->image));
        $user->delete();
        return response()->json(['status' => 'success']);
    }

    public function getAdv()
    {
        $adv = User::where('position_id', '13')->with(['position', 'child'])->orderBy('name', 'ASC')->get();
        return new UsersCollection($adv);
    }
}
