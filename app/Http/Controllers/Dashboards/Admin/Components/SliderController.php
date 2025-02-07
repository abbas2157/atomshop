<?php

namespace App\Http\Controllers\Dashboards\Admin\Components;

use Illuminate\Support\Facades\{File, Route};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::orderBy('id','desc');
        if(request()->has('q') && !empty(request()->q)) {
            $sliders->where('title', 'LIKE',  '%' . request()->q . '%');
        }

        if(request()->has('status') && !empty(request()->status)) {
            $sliders->where('status', request()->status);
        }

        $sliders = $sliders->paginate(10);
        return view('dashboards.admin.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_routes = Route::getRoutes();
        $routes = [];
        foreach ($all_routes as $route) {
            if ($route->methods()[0] === 'GET' && !empty($route->getName()) && str_starts_with('website.', $route->getName())) {
                $routes[] = $route->uri();
            }
        }
        return view('dashboards.admin.sliders.create', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:sliders',
            'picture' => 'required',
            'action' => 'required',
            'tagline' => 'required'
        ]);
    
        $slider = new Slider;
        $slider->title = $request->title;
        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))).'.'.$extension;
            $file->move(public_path('images/sliders'),$filename);
            $slider->picture = 'images/sliders/'.$filename;
        }
        $slider->tagline = $request->tagline;
        $slider->action = $request->action;
        $slider->status = $request->status;
        $slider->save();
    
        $validator['success'] = 'Slider created successfully';
        return back()->withErrors($validator);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::findOrFail($id);
        $all_routes = Route::getRoutes();
        $routes = [];
        foreach ($all_routes as $route) {
            if ($route->methods()[0] === 'GET' && !empty($route->getName()) && str_starts_with('website.', $route->getName())) {
                $routes[] = $route->uri();
            }
        }
        return view('dashboards.admin.sliders.edit',compact('slider', 'routes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:sliders,title,'.$id,
            'action' => 'required',
            'tagline' => 'required'
        ]);
        
        $slider = Slider::findOrFail($id);
        
        $slider->title = $request->title;
        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            $fileName  = pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
            $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $filename  = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title))).'.'.$extension;
            $file->move(public_path('images/sliders'),$filename);
            $slider->picture = 'images/sliders/'.$filename;
        }
        $slider->tagline = $request->tagline;
        $slider->action = $request->action;
        $slider->status = $request->status;
        $slider->save();

        $validator['success'] = 'Slider updated successfully';
        return back()->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        $picture = public_path('images/sliders/' . $slider->picture);
        if (File::exists($picture)) {
            File::delete($picture);
        }
        $slider->delete();

        $validator['success'] = 'Slider deleted successfully';
        return back()->withErrors($validator);
    }
}
