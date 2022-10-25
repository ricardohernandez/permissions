<?php

namespace App\Http\Controllers\Back_end\Users;

use PDF;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Leader;
use App\Mail\WelcomeMail;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Mail\WelcomeMarkMail;
use Illuminate\Support\Carbon;
use App\Models\Scopes\UserScope;
use App\Helpers\PaginationHelper;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\IndexUsersRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use Illuminate\Auth\Notifications\VerifyEmail;

class UserController extends Controller
{
   
    public function index(IndexUsersRequest $request)
    {
        /*\DB::enableQueryLog(); 
           dd(DB::getQueryLog()); */
        $this->authorize('view',Auth::user());
        $date_from = date('Y-m-d', strtotime('-100 year', strtotime(date("Y-m-d"))));
        $date_now = date('Y-m-d');

        if (Auth::user()->can('users_editor.index')) {

            return Inertia::render('Back_end/Users/UsersEditor/Index', [
                'users' => $this->getUserList(15),
                'leaders' => $this->leadersList(),
                'roles' => $this->rolesList(),
                'initialvalues' => array('date_from' => $date_from,'date_now' => $date_now,'no_verified' => false,'only_leaders' => false,'active' => "1"),
                'tbfilters' => request()->all(['search' , 'field' , 'direction' , 'role', 'leader', 'no_verified', 'only_leaders','active', 'date_from' ,'date_now'])
            ]);

        } else {
            abort(403);
        }
        
    }

    
    public function getUserList($paginate){
        $query = User::with(['permissions', 'roles','leader.user']);
        $user = Auth::user();
        
        if($user->isAdminUser()){
            $query->whereHas('roles', function ($query) {
                 $query->where('name','!=', 'super');
            });
        }

        if($user->isSupervisorUser()){
            $query->where('leader_id','=', $user->id);
            $query->orWhere('id','=', $user->id);
        }

        if($user->isNormalUser()){
            $query->where('id','=', $user->id);
        }

        if(request('search')){
            $query->where('name' , 'LIKE' ,'%'.request('search').'%');
        }

        if(request()->has(['field', 'direction'])){
            $query->orderBy(request('field'),request('direction'));
        }

        if(request('role')){
            $query->whereHas('roles', function ( $query ) { 
                $query->where('name', request('role'));
            });
        }

        if(request('leader')){
            $query->where('leader_id' , request('leader'));
        }

        if(request('no_verified')){
            if(request('no_verified')==true){
                $query->where( 'email_verified_at', '=' ,  null);
            }
        }

        if(!request()->has('active')){
            $query->active();
        } 

        if(request('active')=="1"){
            $query->active();
        }else if(request('active')=="2"){
            $query->Noactive();
        }
       
        if(request('date_from') && request('date_now')){
            $query->whereBetween('date_admission', [new Carbon(request('date_from')), new Carbon(request('date_now'))]);
        }
        
        if(request('only_leaders')){
            if(request('only_leaders')==true){
                $query2 = $query->get()->where('isleader', '=', true);
                $users = PaginationHelper::paginate($query2, $paginate)->withQueryString();
            }
        }else{
            $users = $query->paginate($paginate)->withQueryString();
        }

        return $users;
    }

    public function leadersList(){
        $query = Leader::with('user');
        $user = Auth::user();

        if($user->isAdminUser()){
            $query->whereHas('user', function ($query) {
                $query->where('name','!=', 'super');
            });
        }

        if($user->isSupervisorUser()){
            $query->where('user_id','=', $user->id);
        }

        if($user->isNormalUser()){
            $query->whereHas('user', function ($query) {
                $query->where('name','=', 'usuario');
            });
        }

        return $query->get();
    }

    public function rolesList(){
        $query = Role::orderBy('name','asc');
        $user = Auth::user();

        if($user->isAdminUser()){
            $query->where("name" , "<>" , "super");
        }

        if($user->isSupervisorUser()){
            $query->where("name" , "<>" , "admin");
            $query->where("name" , "<>" , "super");
        }

        if($user->isNormalUser()){
            $query->where("name" , "usuario");
        }
        return $query->get();
    }
    
    public function create(){
        $this->authorize('create',Auth::user());
        $roles = Role::all();
        
        if(!Auth::user()->isSuperUser()){
            $roles->whereNotIn('name', ['super']);
        }

        $leaders = Leader::with('user')->get();
        return Inertia::render('Back_end/Users/UsersEditor/Form',['roles' => $roles, 'leaders' => $leaders]);
    }

    public function store(StoreUserRequest $request, User $user){

        $this->authorize('create', $user);

        $data =  [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'date_admission' =>  $request->date,
            'active' =>  "1",
            'ultima_actualizacion' => date("Y-m-d G:i:s") . " | " . Auth::user()->name
        ];

        
        if (!empty($request->photo)) {
            if ($request->hasFile('photo')) {
                /* $image_path = $request->file('photo')->store('users_images', 'public'); */
                $url = Storage::put('users',$request->file('photo'));
            }
            $data['profile_photo_path'] = $url; 
        } 

        try {
            $user = User::create($data);
            event(new Registered($user->id));
            return redirect()->route('users')->with('message_success', __('save_ok'));
        } catch (Exception $exception) {
            return redirect()->route('users.create')->with('message_error',  __('save_error'));
        }

    }

    public function edit(User $user)
    {
        $user = User::with(['permissions', 'roles', 'leader'])->find($user->id);
        $this->authorize('update', $user);

        
        $roles = $this->rolesList();
        $leaders = Leader::with('user')->get();
        return Inertia::render('Back_end/Users/UsersEditor/Form', ['userdata' => $user , 'roles' => $roles , 'leaders' => $leaders]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update',Auth::user());

        if($request->isleader == true){
            $data = ["user_id" => $user->id];
            Leader::updateOrCreate(['user_id' => $user->id], $data);
        }else{
            $leader = Leader::where("user_id" , $user->id);
            $leader->delete();
        }
        
        $data =  [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'leader_id' => $request->leader_id,
            'date_admission' =>  $request->date,
            'active' =>  $request->active,
            'ultima_actualizacion' => date("Y-m-d G:i:s") . " | " . Auth::user()->name
        ];

        if (!empty($request->photo)) {
            if ($request->hasFile('photo')) {
                $url = Storage::put('users_images',$request->file('photo'));
                
                /* $image_path = $request->file('photo')->store('users_images', 'public'); */
            }
            $data['profile_photo_path'] = $url; 
        }

        try {
            $role = Role::find($request->role);
            $user->syncRoles($role);
            $user->update($data);
            return redirect()->route('users')->with('message_success', __('update_ok'));
        } catch (Exception $exception) {
            return redirect()->route('users.edit', $user->id)->with('message_error',  __('updated_error'));
        }
    }
    
    public function show(User $user)
    {
        $this->authorize('show', $user);
        return Inertia::render('Back_end/Users/UsersEditor/Show', ['userdata' => $user]);
    }
    
    public function destroy(User $user)
    {
        $this->authorize('delete',Auth::user());
        $user->delete();
        /* $user->forceDelete(); */
        return redirect()->route('users')->with('message_success', __('deleted_ok'));
    }

    

    public function export(IndexUsersRequest $request)
    {
        $this->authorize('export',Auth::user());
        
        $users = $this->getUserList(10000);
        $export = new UsersExport($users);
        return Excel::download($export, 'users.xlsx');
    }

    public function exportPdf(Request $request){
        $this->authorize('export',Auth::user());
        $users = $this->getUserList(10000);
        $data = [ 'title' => "Users", 'data' => $users];
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.users', $data);
        return $pdf->download('users.pdf');

        /* $pdf = PDF::loadHTML('<h1>Styde.net</h1>');
        return $pdf->download('mi-archivo.pdf'); */

        /* $content = PDF::loadView('pdf.users', $data)->output();
        Storage::disk('public')->put('mi-archivo.pdf', $content); */

        /* PDF::loadView('pdf.users', $data)->save(storage_path('app/public/') . 'users.pdf');
        
        $path = storage_path().'/'.'app'.'/public/users.pdf';
        if (file_exists($path)) {
            return Response::download($path);
        } */

    }
    
    public function sendEmail(Request $request){
        $this->authorize('send',Auth::user());
        $user = User::where('id',"=", $request->id)->with(['permissions', 'roles'])->first();
        Mail::to($user->email)->send(new WelcomeMarkMail($user));
        return response()->json(['res' => 'ok' , 'msg' => __('email_sending_ok')]);
    }

    
   

}
