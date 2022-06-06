<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{
    /**
     * get all blog data
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $blogs = Blogs::with('user')->paginate(5);

        return view('blog.index', [
            'blogs' => $blogs
        ]);
      
    }

    /**
     * view details of blog
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {

        return view('blog.view', [
            'blog' => Blogs::with('user')->findOrFail($id)
        ]);
       
    }

    /**
     * Add new blog.
     *
     * @return \Illuminate\View\View
     */
    public function add(Request $request)
    {

        if ($request->method() == 'POST') {

            $validated = $request->validate([
                'user_id' => 'required',
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            ]);

            $blogs = new Blogs;
            $blogs->name = $request->name;
            $blogs->description = $request->description;
            $blogs->user_id = $request->user_id;
            $blogs->image = $_FILES['image']['name'];
            $result = $blogs->save();

            if ($request->hasFile('image')) {

                //upload profile picture
                $imageName = $blogs->id . '_' . $request->image->getClientOriginalName();
                $request->image->storeAs('public/images/blogs', $imageName);

                $blog_data = Blogs::find($blogs->id);
                $blog_data->image = $imageName;
                $result = $blog_data->save();
            }

            if ($result) {

                $request->session()->flash('success', 'Blog saved!!');
                return redirect()->route('blog_index');
            } else {

                $request->session()->flash('error', 'Blog not saved. Please check!!');
                return redirect()->route('blog_index');
            }
        } else {

            $users = DB::table('users')->get();
            return view('blog.add', [
                'users' => $users
            ]);
        }
    }

    /**
     * Edit blog.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        if ($request->method() == 'POST') {

            $validated = $request->validate([
                'user_id' => 'required',
                'name' => 'required|max:255',
                'description' => 'required|max:255',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            ]);

            $blogs = Blogs::find($id);
            $blogs->name = $request->name;
            $blogs->description = $request->description;
            $blogs->user_id = $request->user_id;
            $blogs->image = $_FILES['image']['name'];
            $result = $blogs->save();

            if ($request->hasFile('image')) {

                //upload profile picture
                $imageName = $id . '_' . $request->image->getClientOriginalName();
                $request->image->storeAs('public/images/blogs', $imageName);

                $blog_data = Blogs::find($id);
                $blog_data->image = $imageName;
                $result = $blog_data->save();
            }

            if ($result) {

                $request->session()->flash('success', 'Blog updated!!');
                return redirect()->route('blog_index');
            } else {

                $request->session()->flash('error', 'Blog not updated. Please check!!');
                return redirect()->route('blog_index');
            }
        } else {

            $users = DB::table('users')->get();

            return view('blog.edit', [
                'blog' => Blogs::findOrFail($id),
                'users' => $users,
            ]);
        }
    }

    /**
     * Delete blog
     * @param $id integer
     * @return boolean
     */
    public function delete(Request $request, $id)
    {

        $blogs = Blogs::find($id);
        $status = $blogs->delete();

        $request->session()->flash('success', 'Blog deleted!!');

        return redirect()->route('blog_index');
    }
}
