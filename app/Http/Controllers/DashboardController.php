<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Adhocmember;
use App\User;
use App\Expertise;
use App\Project;
use App\Publication;
use App\Discategory;
use App\Districtscord;
use App\Disdata;
use App\Slider;
use App\Strategy;
use App\Formmessage;
use App\Blog;
use App\Category;

use Carbon\Carbon;
use DB, Hash, Auth, Image, File, Session;
use Purifier;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'getPersonalPubs', 'createPersonalPub', 'storePersonalPub', 'getPersonalProfile', 'updatePersonalProfile', 'getPersonalBlogs', 'createBlog', 'storeBlog', 'editBlog', 'updateBlog', 'deleteBlog']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->activation_status == 0) {
            Session::flash('info', 'Your account is not activated yet, after successfull activation, you can do things.');
            return redirect()->route('index.index');
        } else {
            $member = User::find(Auth::user()->id);
            return view('dashboard.index')->withMember($member);
        }
    }

    public function getCommittee()
    {
        $adhocmembers = Adhocmember::orderBy('id', 'desc')->get();
        return view('dashboard.committee')->withAdhocmembers($adhocmembers);
    }

    public function storeCommittee(Request $request)
    {
        $this->validate($request,array(
            'name'                      => 'required|max:255',
            'email'                     => 'sometimes|email',
            'phone'                     => 'sometimes|numeric',
            'designation'               => 'required|max:255',
            'fb'                        => 'sometimes|max:255',
            'twitter'                   => 'sometimes|max:255',
            'gplus'                     => 'sometimes|max:255',
            'linkedin'                  => 'sometimes|max:255',
            'image'                     => 'sometimes|image|max:400'
        ));

        $adhocmember = new Adhocmember();
        $adhocmember->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        $adhocmember->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        $adhocmember->phone = htmlspecialchars(preg_replace("/\s+/", " ", $request->phone));
        $adhocmember->designation = htmlspecialchars(preg_replace("/\s+/", " ", $request->designation));
        $adhocmember->fb = htmlspecialchars(preg_replace("/\s+/", " ", $request->fb));
        $adhocmember->twitter = htmlspecialchars(preg_replace("/\s+/", " ", $request->twitter));
        $adhocmember->gplus = htmlspecialchars(preg_replace("/\s+/", " ", $request->gplus));
        $adhocmember->linkedin = htmlspecialchars(preg_replace("/\s+/", " ", $request->linkedin));

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/committee/adhoc/'. $filename);
            Image::make($image)->resize(400, 400)->save($location);
            $adhocmember->image = $filename;
        }

        $adhocmember->save();
        
        Session::flash('success', 'Saved Successfully!');
        return redirect()->route('dashboard.committee');
    }

    public function updateCommittee(Request $request, $id) {
        $this->validate($request,array(
            'name'                      => 'required|max:255',
            'email'                     => 'sometimes|email',
            'phone'                     => 'sometimes|numeric',
            'designation'               => 'required|max:255',
            'fb'                        => 'sometimes|max:255',
            'twitter'                   => 'sometimes|max:255',
            'gplus'                     => 'sometimes|max:255',
            'linkedin'                  => 'sometimes|max:255',
            'image'                     => 'sometimes|image|max:400'
        ));

        $adhocmember = Adhocmember::find($id);
        $adhocmember->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        $adhocmember->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        $adhocmember->phone = htmlspecialchars(preg_replace("/\s+/", " ", $request->phone));
        $adhocmember->designation = htmlspecialchars(preg_replace("/\s+/", " ", $request->designation));
        $adhocmember->fb = htmlspecialchars(preg_replace("/\s+/", " ", $request->fb));
        $adhocmember->twitter = htmlspecialchars(preg_replace("/\s+/", " ", $request->twitter));
        $adhocmember->gplus = htmlspecialchars(preg_replace("/\s+/", " ", $request->gplus));
        $adhocmember->linkedin = htmlspecialchars(preg_replace("/\s+/", " ", $request->linkedin));

        // image upload
        if($adhocmember->image == null) {
            if($request->hasFile('image')) {
                $image      = $request->file('image');
                $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
                $location   = public_path('/images/committee/adhoc/'. $filename);
                Image::make($image)->resize(400, 400)->save($location);
                $adhocmember->image = $filename;
            }
        } else {
            if($request->hasFile('image')) {
                $image_path = public_path('images/committee/adhoc/'. $adhocmember->image);
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                $image      = $request->file('image');
                $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
                $location   = public_path('/images/committee/adhoc/'. $filename);
                Image::make($image)->resize(400, 400)->save($location);
                $adhocmember->image = $filename;
            }
        }
            
        $adhocmember->save();
        
        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.committee');
    }

    public function deleteCommittee($id)
    {
        $adhocmember = Adhocmember::find($id);
        $image_path = public_path('images/committee/adhoc/'. $adhocmember->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $adhocmember->delete();

        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.committee');
    }

    public function getNews()
    {
        return view('dashboard.index');
    }

    public function getEvents()
    {
        return view('dashboard.index');
    }

    public function getGallery()
    {
        return view('dashboard.index');
    }

    public function getBlogs()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.blogs.index')->withBlogs($blogs);
    }

    public function createBlog()
    {
        $categories = Category::all();
        return view('dashboard.blogs.create')->withCategories($categories);
    }

    public function storeBlog(Request $request)
    {
        $this->validate($request,array(
            'title'          => 'required|max:255',
            'slug'           => 'required|max:255|unique:blogs,slug',
            'body'           => 'required',
            'category_id'    => 'required|integer',
            'featured_image' => 'sometimes|image|max:300'
        ));

        //store to DB
        $blog              = new Blog;
        $blog->title       = $request->title;
        $blog->user_id     = Auth::user()->id;
        $blog->slug        = str_replace(['?',':', '\\', '/', '*', ' '], '-', strtolower($request->slug)) . '-' .time();
        $blog->category_id = $request->category_id;
        $blog->body        = Purifier::clean($request->body, 'youtube');
        
        // image upload
        if($request->hasFile('featured_image')) {
            $image      = $request->file('featured_image');
            $filename   = str_replace(['?',':', '\\', '/', '*', ' '], '-', strtolower($request->slug)) . '-' .time() . '.' . $image->getClientOriginalExtension();
            $location   = public_path('images/blogs/'. $filename);
            // Image::make($image)->resize(600, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            Image::make($image)->fit(600, 315)->save($location);
            $blog->featured_image = $filename;
        }

        $blog->save();

        Session::flash('success', 'Article created successfully!');
        //redirect
        if(Auth::user()->role == 'admin') {
            return redirect()->route('dashboard.blogs');
        } else {
            return redirect()->route('dashboard.blogs.personal');
        }
    }

    public function editBlog($id)
    {
        if(Auth::user()->role == 'admin') {
            $categories = Category::all();
            $blog = Blog::findOrFail($id);
            return view('dashboard.blogs.edit')
                            ->withCategories($categories)
                            ->withBlog($blog);
        } else {
            $categories = Category::all();
            $blog = Blog::where('id', $id)
                        ->where('user_id', Auth::user()->id)
                        ->first();
            if(!empty($blog) || $blog != null) {
                return view('dashboard.blogs.edit')
                                ->withCategories($categories)
                                ->withBlog($blog);
            } else {
                Session::flash('warning', 'Don&#39;t be too clever!');
                return redirect()->route('dashboard.blogs.personal');
            }
        }
    }

    public function updateBlog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $this->validate($request,array(
            'title'          => 'required|max:255',
            'slug'           => 'required|max:255|unique:blogs,slug,'.$blog->id,
            'body'           => 'required',
            'category_id'    => 'required|integer',
            'featured_image' => 'sometimes|image|max:300'
        ));

        //update to DB
        $blog->title       = $request->title;
        // $blog->user_id     = Auth::user()->id;
        if($blog->slug == $request->slug) {

        } else {
            $blog->slug        = str_replace(['?',':', '\\', '/', '*', ' '], '-', strtolower($request->slug)) . '-' .time();
        }
        $blog->category_id = $request->category_id;
        $blog->body        = Purifier::clean($request->body, 'youtube');
        
        // image upload
        if($request->hasFile('featured_image')) {
            $image_path = public_path('images/blogs/'. $blog->featured_image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image      = $request->file('featured_image');
            $filename   = str_replace(['?',':', '\\', '/', '*', ' '], '-', strtolower($request->slug)) . '-' .time() . '.' . $image->getClientOriginalExtension();
            $location   = public_path('images/blogs/'. $filename);
            // Image::make($image)->resize(600, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            Image::make($image)->fit(600, 315)->save($location);
            $blog->featured_image = $filename;
        }

        $blog->save();

        Session::flash('success', 'Article updated successfully!');
        //redirect
        if(Auth::user()->role == 'admin') {
            return redirect()->route('dashboard.blogs');
        } else {
            return redirect()->route('dashboard.blogs.personal');
        }
        
    }

    public function deleteBlog($id)
    {
        $blog = Blog::findOrFail($id);

        $image_path = public_path('images/blogs/'. $blog->featured_image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $blog->delete();

        Session::flash('success', 'Deleted Successfully!');
        //redirect
        if(Auth::user()->role == 'admin') {
            return redirect()->route('dashboard.blogs');
        } else {
            return redirect()->route('dashboard.blogs.personal');
        }
    }

    public function getPersonalBlogs()
    {
        $blogs = Blog::where('user_id', Auth::user()->id)
                     ->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.blogs.index')->withBlogs($blogs);
    }

    public function getMembers()
    {
        $members = User::where('activation_status', 1)
                         ->orderBy('id', 'desc')->paginate(10);


        return view('dashboard.members')
                        ->withMembers($members);
    }

    public function createMember()
    {
        return view('dashboard.createmember');
    }

    public function storeMember(Request $request)
    {
        $this->validate($request,array(
            'name'                      => 'required|max:255',
            'email'                     => 'required|email|unique:users,email',
            'phone'                     => 'required|numeric',
            'designation'               => 'sometimes|max:255',
            'fb'                        => 'sometimes|max:255',
            'twitter'                   => 'sometimes|max:255',
            'linkedin'                  => 'sometimes|max:255',
            'image'                     => 'required|image|max:300',
            'bio'                       => 'required',
            'type'                      => 'required',
            'adminornot'                => 'required',
            'password'                  => 'required|min:8'
        ));

        $member = new User();
        $member->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        $member->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        $member->phone = htmlspecialchars(preg_replace("/\s+/", " ", $request->phone));
        
        $member->designation = htmlspecialchars(preg_replace("/\s+/", " ", $request->designation));
        $member->fb = htmlspecialchars(preg_replace("/\s+/", " ", $request->fb));
        $member->twitter = htmlspecialchars(preg_replace("/\s+/", " ", $request->twitter));
        $member->linkedin = htmlspecialchars(preg_replace("/\s+/", " ", $request->linkedin));

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/users/'. $filename);
            Image::make($image)->resize(250, 250)->save($location);
            $member->image = $filename;
        }

        $member->bio    = Purifier::clean($request->bio, 'youtube');
        $member->type = $request->type;
        if($request->adminornot == 0) {
            $member->role = 'member';
        } else {
            $member->role = 'admin';
        }
        $member->activation_status = 1;

        // generate unique_key
        $unique_key_length = 100;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $unique_key = substr(str_shuffle(str_repeat($pool, 100)), 0, $unique_key_length);
        // generate unique_key
        $member->unique_key = $unique_key;
        $member->password = Hash::make($request->password);
        $member->save();
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.members');
    }

    public function editMember($id)
    {
        $member = User::findOrFail($id);
        return view('dashboard.editmember')->withMember($member);
    }

    public function updateMember(Request $request, $id)
    {
        $member = User::findOrFail($id);
        $this->validate($request,array(
            'name'                      => 'required|max:255',
            'email'                     => 'required|email|unique:users,email,'.$member->id,
            'phone'                     => 'required|numeric',
            'designation'               => 'sometimes|max:255',
            'fb'                        => 'sometimes|max:255',
            'twitter'                   => 'sometimes|max:255',
            'linkedin'                  => 'sometimes|max:255',
            'image'                     => 'sometimes|image|max:300',
            'bio'                       => 'required',
            'type'                      => 'required',
            'adminornot'                => 'required',
            'password'                  => 'sometimes'
        ));

        $member = User::findOrFail($id);
        $member->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        $member->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        $member->phone = htmlspecialchars(preg_replace("/\s+/", " ", $request->phone));
        
        $member->designation = htmlspecialchars(preg_replace("/\s+/", " ", $request->designation));
        $member->fb = htmlspecialchars(preg_replace("/\s+/", " ", $request->fb));
        $member->twitter = htmlspecialchars(preg_replace("/\s+/", " ", $request->twitter));
        $member->linkedin = htmlspecialchars(preg_replace("/\s+/", " ", $request->linkedin));

        // image upload, if has any
        if($request->hasFile('image')) {
            // delete the previous one
            $image_path = public_path('images/users/'. $member->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image      = $request->file('image');
            $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/users/'. $filename);
            Image::make($image)->resize(250, 250)->save($location);
            $member->image = $filename;
        }
        if($request->password) {
            $member->password = Hash::make($request->password);
        }
        

        $member->bio    = Purifier::clean($request->bio, 'youtube');
        $member->type = $request->type;
        if($request->adminornot == 0) {
            $member->role = 'member';
        } else {
            $member->role = 'admin';
        }
        $member->save();
        
        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.members');
    }

    public function deleteMember($id)
    {
        //
    }

    public function getExpertises()
    {
        $expertises = Expertise::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.expertises')->withExpertises($expertises);
    }

    public function createExpertise()
    {
        return view('dashboard.createexpertise');
    }

    public function storeExpertise(Request $request)
    {
        $this->validate($request,array(
            'title'                    => 'required|max:255',
            'description'              => 'required',
            'image'                    => 'required|image|max:200'
        ));

        $expertise = new Expertise;
        $expertise->title = $request->title;
        $expertise->description = Purifier::clean($request->description, 'youtube');
        

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = random_string(5) . time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/expertises/'. $filename);
            Image::make($image)->resize(200, 200, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $expertise->image = $filename;
        }

        $expertise->slug = preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($request->title)).'-'.time();
        $expertise->save();
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.expertises');
    }

    public function editExpertise($id)
    {
        $expertise = Expertise::find($id);
        return view('dashboard.editexpertise')->withExpertise($expertise);
    }

    public function updateExpertise(Request $request, $id)
    {
        $this->validate($request,array(
            'title'                     => 'required|max:255',
            'description'               => 'required',
            'image'                     => 'sometimes|image|max:200'
        ));

        $expertise = Expertise::find($id);
        $expertise->title = $request->title;
        $expertise->description = Purifier::clean($request->description, 'youtube');
        

        // image upload
        if($request->hasFile('image')) {
            // delete the previous one
            $image_path = public_path('images/expertises/'. $expertise->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image      = $request->file('image');
            $filename   = random_string(5) . time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/expertises/'. $filename);
            Image::make($image)->resize(200, 200, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $expertise->image = $filename;
        }

        $expertise->slug = preg_replace('/[^A-Za-z0-9\-]/', '-', strtolower($request->title)).'-'.time();
        $expertise->save();
        
        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.expertises');
    }

    public function deleteExpertise($id)
    {
        $expertise = Expertise::find($id);

        $image_path = public_path('images/expertises/'. $expertise->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $expertise->delete();
        
        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.expertises');
    }

    public function getSliders()
    {
        $sliders = Slider::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.sliders')->withSliders($sliders);
    }

    public function storeSlider(Request $request)
    {
        $this->validate($request,array(
            'title'                     => 'required|max:255',
            'image'                     => 'required|image|max:500'
        ));

        $slider = new Slider();
        $slider->title = $request->title;
        

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = random_string(5) . time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/sliders/'. $filename);
            Image::make($image)->resize(1000, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $slider->image = $filename;
        }
        $slider->save();
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.sliders');
    }

    public function updateSlider(Request $request, $id)
    {
        $this->validate($request,array(
            'title'                     => 'required|max:255',
            'image'                     => 'required|image|max:500'
        ));

        $slider = Slider::find($id);
        $slider->title = $request->title;
        

        // image upload
        if($request->hasFile('image')) {
            // delete the previous one
            $image_path = public_path('images/sliders/'. $slider->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image      = $request->file('image');
            $filename   = random_string(5) . time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/sliders/'. $filename);
            Image::make($image)->resize(1000, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $slider->image = $filename;
        }
        $slider->save();
        
        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.sliders');
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);

        $image_path = public_path('images/sliders/'. $slider->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $slider->delete();
        
        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.sliders');
    }

    public function getStrategies()
    {
        $strategies = Strategy::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.strategies')->withStrategies($strategies);
    }

    public function storeStrategy(Request $request)
    {
        $this->validate($request,array(
            'title'                   => 'required|max:255',
            'description'             => 'required'
        ));

        $strategy = new Strategy();
        $strategy->title = $request->title;
        $strategy->description = Purifier::clean($request->description, 'youtube');
        $strategy->save();
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.strategies');
    }

    public function updateStrategy(Request $request, $id)
    {
        $this->validate($request,array(
            'title'                   => 'required|max:255',
            'description'             => 'required'
        ));

        $strategy = Strategy::find($id);
        $strategy->title = $request->title;
        $strategy->description = Purifier::clean($request->description, 'youtube');
        $strategy->save();

        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.strategies');
    }

    public function deleteStrategy($id)
    {
        $strategy = Strategy::find($id);
        $strategy->delete();
        
        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.strategies');
    }

    public function getProjects()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.projects')->withProjects($projects);
    }

    public function createProject()
    {
        return view('dashboard.createproject');
    }

    public function storeProject(Request $request)
    {
        $this->validate($request,array(
            'title'                   => 'required|max:255',
            'status'                  => 'required|max:255',
            'starts'                  => 'required|max:255',
            'ends'                    => 'required|max:255',
            'body'                    => 'required',
            'image'                   => 'required|image|max:500'
        ));

        $project = new Project();
        $project->title = $request->title;
        $project->status = $request->status;
        $project->starts = new Carbon($request->starts);
        $project->ends = new Carbon($request->ends);
        $project->body = Purifier::clean($request->body, 'youtube');

        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = preg_replace('/[^A-Za-z0-9\-]/', '', $request->title).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/projects/'. $filename);
            Image::make($image)->resize(700, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $project->image = $filename;
        }

        $project->slug = preg_replace('/[^A-Za-z0-9\-]/', '_', strtolower($request->title)).'_'.time();
        $project->save();
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.projects');
    }

    public function editProject($id)
    {
        $project = Project::find($id);
        return view('dashboard.editproject')->withProject($project);
    }

    public function updateProject(Request $request, $id)
    {
        $this->validate($request,array(
            'title'                   => 'required|max:255',
            'status'                  => 'required|max:255',
            'starts'                  => 'required|max:255',
            'ends'                    => 'required|max:255',
            'body'                    => 'required',
            'image'                   => 'sometimes|image|max:500'
        ));

        $project = Project::find($id);
        $project->title = $request->title;
        $project->status = $request->status;
        $project->starts = new Carbon($request->starts);
        $project->ends = new Carbon($request->ends);
        $project->body = Purifier::clean($request->body, 'youtube');
        

        // image upload
        if($request->hasFile('image')) {
            $image_path = public_path('images/projects/'. $project->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image      = $request->file('image');
            $filename   = preg_replace('/[^A-Za-z0-9\-]/', '', $request->title).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/projects/'. $filename);
            Image::make($image)->resize(700, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $project->image = $filename;
        }

        $project->slug = preg_replace('/[^A-Za-z0-9\-]/', '_', strtolower($request->title)).'_'.time();
        $project->save();
        
        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.projects');
    }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        $image_path = public_path('images/projects/'. $project->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $project->delete();

        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.projects');
    }

    public function getPendingPublications()
    {
        $publications = Publication::where('status', 0)->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.pendingpublications')->withPublications($publications);
    }

    public function getPublications()
    {
        $publications = Publication::where('status', 1)->orderBy('id', 'desc')->paginate(10);
        return view('dashboard.publications')->withPublications($publications);
    }

    public function createPublication()
    {
        $members = User::all();
        return view('dashboard.createpublication')->withMembers($members);
    }

    public function storePublication(Request $request)
    {
        $this->validate($request,array(
            'title'                   => 'required|max:255',
            'publishing_date'         => 'required|max:255',
            'member_ids'              => 'required|max:255',
            'body'                    => 'required',
            'image'                   => 'required|image|max:500',
            'attachment'              => 'required|mimes:doc,docx,ppt,pptx,png,jpeg,jpg,pdf,gif|max:5000'
        ));

        $publication = new Publication();
        $publication->status = 1; // published
        $publication->title = $request->title;
        $publication->code = random_string(10);
        $publication->publishing_date = new Carbon($request->publishing_date);

        // file upload
        if($request->hasFile('attachment')) {
            $newfile = $request->file('attachment');
            $filename   = $publication->code.'_file_'.time() .'.' . $newfile->getClientOriginalExtension();
            $location   = public_path('/files/');
            $newfile->move($location, $filename);
            $publication->file = $filename;
        }
        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = $publication->code.'_'.time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/publications/'. $filename);
            Image::make($image)->resize(150, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $publication->image = $filename;
        }
        $publication->body = Purifier::clean($request->body, 'youtube');
        $publication->submitted_by = Auth::user()->id;

        $publication->save();
        // associate members
        // foreach ($request->member_ids as $key => $value) {
        //     $publication->users()->attach($value);
        // }
        $publication->users()->sync($request->member_ids, false);

        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.publications');
    }

    public function editPublication($id)
    {
        $publication = Publication::find($id);
        $members = User::all();
        return view('dashboard.editpublication')
                            ->withPublication($publication)
                            ->withMembers($members);
    }

    public function updatePublication(Request $request, $id)
    {
        $this->validate($request,array(
            'title'                   => 'required|max:255',
            'publishing_date'         => 'required|max:255',
            'member_ids'              => 'required|max:255',
            'body'                    => 'required',
            'image'                   => 'sometimes|image|max:500',
            'attachment'              => 'sometimes|mimes:doc,docx,ppt,pptx,png,jpeg,jpg,pdf,gif|max:5000',
            'status'                  => 'required'
        ));

        $publication = Publication::find($id);
        $publication->status = $request->status;
        $publication->title = $request->title;
        // $publication->code = random_string(10);
        $publication->publishing_date = new Carbon($request->publishing_date);

        // file upload
        if($request->hasFile('attachment')) {
            $file_path = public_path('files/'. $publication->file);
            if(File::exists($file_path)) {
                File::delete($file_path);
            }
            $newfile = $request->file('attachment');
            $filename   = $publication->code.'_file_'.time() .'.' . $newfile->getClientOriginalExtension();
            $location   = public_path('/files/');
            $newfile->move($location, $filename);
            $publication->file = $filename;
        }
        // image upload
        if($request->hasFile('image')) {
            $image_path = public_path('images/publications/'. $publication->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image      = $request->file('image');
            $filename   = $publication->code.'_'.time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/publications/'. $filename);
            Image::make($image)->resize(150, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $publication->image = $filename;
        }
        $publication->body = Purifier::clean($request->body, 'youtube');

        $publication->save();
        // associate members
        // foreach ($request->member_ids as $key => $value) {
        //     $publication->users()->attach($value);
        // }
        $publication->users()->sync($request->member_ids, true);

        Session::flash('success', 'Updated Successfully!');
        if($publication->status == 0) {
            return redirect()->route('dashboard.publications.pending');
        } else {
            return redirect()->route('dashboard.publications');
        }
        
    }

    public function deletePublication($id)
    {
        $publication = Publication::find($id);
        $file_path = public_path('files/'. $publication->file);
        if(File::exists($file_path)) {
            File::delete($file_path);
        }
        $image_path = public_path('images/publications/'. $publication->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        foreach ($publication->users as $key => $value) {
            # code...
        }
        $publication->users()->sync([]);
        $publication->delete();

        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.publications');
    }

    public function getDisasterdatas()
    {
        $disasterdatas = Disdata::all();
        $discategories = Discategory::all();
        return view('dashboard.disasterdatas')
                            ->withDisasterdatas($disasterdatas)
                            ->withDiscategories($discategories);
    }

    public function storeDisasterCategory(Request $request)
    {
        $category = new Discategory();
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'Stored Successfully!');
        return redirect()->route('dashboard.disasterdatas');
    }

    public function updateDisasterCategory(Request $request, $id)
    {
        $category = Discategory::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.disasterdatas');
    }

    public function createDisasterData()
    {
        $discategories = Discategory::all();
        $districtscords = Districtscord::all();
        return view('dashboard.createdisaterdata')
                            ->withDiscategories($discategories)
                            ->withDistrictscords($districtscords);
    }

    public function storeDisasterdata(Request $request)
    {
        $this->validate($request,array(
            'title'               => 'required',
            'file'                => 'sometimes|sometimes|mimes:doc,docx,ppt,pptx,png,jpeg,jpg,pdf,gif,zip,xls,xlsx,csv,xml|max:2000',
            'discategory_id'      => 'required',
            'districtscord_id'    => 'required'
        ));

        // $disasterdata = Disdata::where('discategory_id', $request->discategory_id)
        //                        ->where('districtscord_id', $request->districtscord_id)
        //                        ->first();

        $disasterdata = new Disdata();
        $disasterdata->title = $request->title;
        // file upload
        if($request->hasFile('file')) {
            $newfile = $request->file('file');
            $filename   = 'disaster_data_'. random_string(4) .time() .'.' . $newfile->getClientOriginalExtension();
            $location   = public_path('/files/');
            $newfile->move($location, $filename);
            $disasterdata->file = $filename;
        }
        $disasterdata->discategory_id = $request->discategory_id;
        $disasterdata->districtscord_id = $request->districtscord_id;
        $disasterdata->save();
        
        Session::flash('success', 'Added Successfully!');
        return redirect()->route('dashboard.disasterdatas');
    }

    public function editDisasterdata($id)
    {
        $disasterdata = Disdata::findOrFail($id);
        $discategories = Discategory::all();
        $districtscords = Districtscord::all();

        return view('dashboard.editdisaterdata')
                            ->withDisasterdata($disasterdata)
                            ->withDiscategories($discategories)
                            ->withDistrictscords($districtscords);
    }

    public function updateDisasterdata(Request $request, $id)
    {
        $this->validate($request,array(
            'title'               => 'required',
            'file'                => 'sometimes|mimes:doc,docx,ppt,pptx,png,jpeg,jpg,pdf,gif,zip,xls,xlsx,csv,xml|max:2000',
            'discategory_id'      => 'required',
            'districtscord_id'    => 'required'
        ));

        $disasterdata = Disdata::find($id);
        $disasterdata->title = $request->title;
        // file upload
        if($request->hasFile('file')) {
            // delete the previous one
            $file_path = public_path('files/'. $disasterdata->file);
            if(File::exists($file_path)) {
                File::delete($file_path);
            }
            $newfile = $request->file('file');
            $filename   = 'disaster_data_'. random_string(4) .time() .'.' . $newfile->getClientOriginalExtension();
            $location   = public_path('/files/');
            $newfile->move($location, $filename);
            $disasterdata->file = $filename;
        }
        $disasterdata->discategory_id = $request->discategory_id;
        $disasterdata->districtscord_id = $request->districtscord_id;
        $disasterdata->save();

        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.disasterdatas');
    }

    public function deleteDisasterdata($id)
    {
        $disasterdata = Disdata::find($id);
        $file_path = public_path('files/'. $disasterdata->file);
        if(File::exists($file_path)) {
            File::delete($file_path);
        }
        $disasterdata->delete();

        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.disasterdatas');
    }

    public function getApplications()
    {
        $applications = User::where('activation_status', 0)
                            ->where('role', 'member')
                            ->paginate(20);
        return view('dashboard.applications')->withApplications($applications);
    }

    public function approveApplication(Request $request, $id)
    {

        $application = User::findOrFail($id);
        $application->activation_status = 1;
        $application->save();

        Session::flash('success', 'Approved Successfully!');
        return redirect()->route('dashboard.applications');
    }

    public function deleteApplication($id)
    {
        // $adhocmember = Adhocmember::find($id);
        // $image_path = public_path('images/committee/adhoc/'. $adhocmember->image);
        // if(File::exists($image_path)) {
        //     File::delete($image_path);
        // }
        // $adhocmember->delete();

        // Session::flash('success', 'Deleted Successfully!');
        // return redirect()->route('dashboard.committee');
    }


    public function getPersonalPubs()
    {
        if(Auth::user()->activation_status == 0) {
            Session::flash('info', 'Your account is not activated yet, after successfull activation, you can do things.');
            return redirect()->route('index.index');
        } else {
            $publications = Publication::where('submitted_by', Auth::user()->id)->paginate(10);
            return view('dashboard.personalpubs')->withPublications($publications);
        }
    }

    public function createPersonalPub()
    {
        $members = User::all();
        return view('dashboard.createpersonalpub')->withMembers($members);
    }

    public function storePersonalPub(Request $request)
    {
        $this->validate($request,array(
            'title'                   => 'required|max:255',
            'publishing_date'         => 'required|max:255',
            'member_ids'              => 'required|max:255',
            'body'                    => 'required',
            'image'                   => 'required|image|max:500',
            'attachment'              => 'required|mimes:doc,docx,ppt,pptx,png,jpeg,jpg,pdf,gif|max:5000'
        ));

        $publication = new Publication();
        $publication->status = 0; // as member is adding, it will be pending
        $publication->title = $request->title;
        $publication->code = random_string(10);
        $publication->publishing_date = new Carbon($request->publishing_date);

        // file upload
        if($request->hasFile('attachment')) {
            $newfile = $request->file('attachment');
            $filename   = $publication->code.'_file_'.time() .'.' . $newfile->getClientOriginalExtension();
            $location   = public_path('/files/');
            $newfile->move($location, $filename);
            $publication->file = $filename;
        }
        // image upload
        if($request->hasFile('image')) {
            $image      = $request->file('image');
            $filename   = $publication->code.'_'.time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/publications/'. $filename);
            Image::make($image)->resize(150, null, function ($constraint) { $constraint->aspectRatio(); })->save($location);
            $publication->image = $filename;
        }
        $publication->body = Purifier::clean($request->body, 'youtube');
        $publication->submitted_by = Auth::user()->id;

        $publication->save();
        // associate members
        // foreach ($request->member_ids as $key => $value) {
        //     $publication->users()->attach($value);
        // }
        $publication->users()->sync($request->member_ids, false);

        Session::flash('success', 'Added Successfully, our Admins will review it!');
        return redirect()->route('dashboard.personal.pubs');
    }

    public function getPersonalProfile()
    {
        if(Auth::user()->activation_status == 0) {
            Session::flash('info', 'Your account is not activated yet, after successfull activation, you can do things.');
            return redirect()->route('index.index');
        } else {
            $member = User::find(Auth::user()->id);
            return view('dashboard.personalprofile')->withMember($member);
        }
    }

    public function updatePersonalProfile(Request $request, $id)
    {
        $member = User::findOrFail($id);
        $this->validate($request,array(
            'name'                      => 'required|max:255',
            'email'                     => 'required|email|unique:users,email,'.$member->id,
            'phone'                     => 'required|numeric',
            'designation'               => 'sometimes|max:255',
            'fb'                        => 'sometimes|max:255',
            'twitter'                   => 'sometimes|max:255',
            'linkedin'                  => 'sometimes|max:255',
            'image'                     => 'sometimes|image|max:300',
            'bio'                       => 'required',
            'password'                  => 'sometimes'
        ));

        $member = User::findOrFail($id);
        $member->name = htmlspecialchars(preg_replace("/\s+/", " ", ucwords($request->name)));
        $member->email = htmlspecialchars(preg_replace("/\s+/", " ", $request->email));
        $member->phone = htmlspecialchars(preg_replace("/\s+/", " ", $request->phone));
        
        $member->designation = htmlspecialchars(preg_replace("/\s+/", " ", $request->designation));
        $member->fb = htmlspecialchars(preg_replace("/\s+/", " ", $request->fb));
        $member->twitter = htmlspecialchars(preg_replace("/\s+/", " ", $request->twitter));
        $member->linkedin = htmlspecialchars(preg_replace("/\s+/", " ", $request->linkedin));

        // image upload, if has any
        if($request->hasFile('image')) {
            // delete the previous one
            $image_path = public_path('images/users/'. $member->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $image      = $request->file('image');
            $filename   = str_replace(' ','',$request->name).time() .'.' . $image->getClientOriginalExtension();
            $location   = public_path('/images/users/'. $filename);
            Image::make($image)->resize(250, 250)->save($location);
            $member->image = $filename;
        }
        if($request->password) {
            $member->password = Hash::make($request->password);
        }
        

        $member->bio    = Purifier::clean($request->bio, 'youtube');
        $member->save();
        
        Session::flash('success', 'Updated Successfully!');
        return redirect()->route('dashboard.personal.profile');
    }

    public function getContactMessage() 
    {
        $messages = Formmessage::orderBy('id', 'desc')->paginate(15);
        return view('dashboard.contactmessages')->withMessages($messages);
    }

    public function deleteContactMessage($id)
    {
        $messages = Formmessage::find($id);
        $messages->delete();
        
        Session::flash('success', 'Deleted Successfully!');
        return redirect()->route('dashboard.contactmessages');
    }
}
