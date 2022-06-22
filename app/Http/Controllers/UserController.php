<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserRepository;
use App\Events\SendEmailToUser;
use Notification;
use App\Notifications\EmailNotification;
 
class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * get all user data
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {

            return view('user.index', [
                'users' => $this->users->all() //call repository method
            ]);
            
        } catch(ModelNotFoundException $exception) {

            return view('exception.notfound');

        } catch(RelationNotFoundException $exception) { 

            return view('exception.relationnot');

        } catch(\Exception $exception){

            return view('exception.somethingwrong');

        }
        
    }

    /**
     * view the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        try {

            return view('user.profile', [
                'user' => $this->users->getUserById($id)
            ]);
            
        } catch(ModelNotFoundException $exception) {

            return view('exception.notfound');

        } catch(RelationNotFoundException $exception) { 

            return view('exception.relationnot');

        } catch(\Exception $exception){

            return view('exception.somethingwrong');

        }

    }

    /**
     * Add new User.
     *
     * @return \Illuminate\View\View
     */
    public function add(Request $request)
    {

        if($request->method() == 'POST'){

            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email:rfc',
                'date_of_birth' => 'required',  
                'profile_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'username' => 'required',
                'password' => 'required',

            ]);

            $users = new User;
            $users->name = $request->name;
            $users->email = $request->email;
            $users->username = $request->username;
            $users->date_of_birth = $request->date_of_birth;
            $users->gender = $request->gender;
            $users->about = $request->about;
            $users->rating = $request->rating;
            $users->role_id = $request->role_id;
            $users->password = Hash::make($request->password);
            $result = $users->save();

            if($request->hasFile('profile_picture')){

                //upload profile picture
                $imageName = $users->id.'_'.$request->profile_picture->getClientOriginalName();
                $request->profile_picture->storeAs('public/images/users', $imageName);
    
                $user_data = User::find($users->id);
                $user_data->profile_picture = $imageName;
                $result = $user_data->save();

            }

            event (new SendEmailToUser($users->id));

            if($result){

                Log::build([
                    'driver' => 'single',
                    'path' => storage_path('logs/custom.log'),
                ])->info('User Created: ' . $users->id);

                $request->session()->flash('success', 'User saved!!');
                return redirect()->route('user_index');

            } else {

                $request->session()->flash('error', 'User not saved. Please check!!');
                return redirect()->route('user_index');

            }

        } else {
            
            $roles = DB::table('roles')->get();
            return view('user.add', [
                'roles' => $roles
            ]);

        }

    }

    /**
     * Edit user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        if($request->method() == 'POST'){

            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email:rfc',
                'username' => 'required',
            ]);

            $users = User::find($id);
            $users->name = $request->name;
            $users->email = $request->email;
            $users->username = $request->username;
            $users->date_of_birth = $request->date_of_birth;
            $users->gender = $request->gender;
            $users->about = $request->about;
            $users->rating = $request->rating;
            $users->role_id = $request->role_id;
            $result = $users->save();

            if ($request->hasFile('profile_picture')) {

                //upload profile picture
                $imageName = $id . '_' . $request->profile_picture->getClientOriginalName();
                $request->profile_picture->storeAs('public/images/users', $imageName);

                $user_data = $this->users->getUserById($id);
                $user_data->profile_picture = $imageName;
                $result = $user_data->save();
            }
            
            if($result){

                $user = $this->users->getUserById($id);

                $message = [
                    'greeting' => 'Hi ' . $user->name . ',',
                    'body' => 'This is the edit notification.',
                    'thanks' => 'Thank you for register!! You just edited your profile. Kindly share your review to us!! Hope You like our App:)',
                    'actionText' => 'View Profile',
                    'actionURL' => url('/users/edit/'.$id),
                    'id' => $id
                ];

                Notification::send($user, new EmailNotification($message));

                $request->session()->flash('success', 'User updated!!');
                return redirect()->route('user_index');

            } else {

                $request->session()->flash('error', 'User not updated. Please check!!');
                return redirect()->route('user_index');

            }

        } else {
            
            $roles = DB::table('roles')->get();
         
            return view('user.edit', [
                'user' => User::findOrFail($id),
                'roles' => $roles,
            ]);

        }
        

    }

    /**
     * Delete User
     * @param $id integer
     * @return boolean
     */
    public function delete(Request $request, $id)
    {

        $users = $this->users->getUserById($id);
        $status = $users->delete();

        $request->session()->flash('success', 'User deleted!!');

        return redirect()->route('user_index');

    }

    /**
     * practice method for practice data.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function practice($name,Request $request)
    {
        $request->session()->put('practice', 'laravel'); //create session
        $sessionValue = $request->session()->pull('practice', 'php');
        return view('practice', [
            'users' => ['John', 'Peter', 'joanna'] ,
            'name' => $name,
            'sessionValue' => $sessionValue,
        ]);

    }
}