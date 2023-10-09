<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {

        $links = CommunityLink::where('approved', 1)->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();
        return view('community/index', compact('links', 'channels'));
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)

    {

        $this->validate($request, [

            'title' => 'required',

            'details' => 'required'

        ]);


        return back()->with('success', 'Item created successfully!');

        return redirect()->route('home')

        ->with('error','You have no permission for this page!');

        return redirect()->route('home')

        ->with('warning',"Don't Open this link");

        $this->validate($request,[

            'title' => 'required',
    
            'details' => 'required'
    
            ]);
    
    
    
        
    
    
    
        return back()->with('info','You added new items, follow next step!');

        $this->validate($request,[

            'title' => 'required',
    
            'details' => 'required'
    
            ]);
    
    
    
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // public function store(Request $request) {

        /*   EJERCICIOS ANTERIORES    */

        //return response('Respuesta', 200);  
        //dd($request);   
        //dd($request);   
        $approved = Auth::user()->trusted ? true : false;

        $data['approved'] = $approved;
        return $this->hasMany(CommunityLink::class)->where('approved', 1);




        request()->merge(['user_id' => Auth::id(), 'channel_id' => 1]);
        CommunityLink::create($request->all());
        $data = $request->validate([

            'title' => 'required|max:255',
            'link' => 'required|unique:community_links|url|max:255',
            'channel_id' => 'required|exists:channels,id'


        ]);

        $data['user_id'] = Auth::id();
        CommunityLink::create($data);


        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
