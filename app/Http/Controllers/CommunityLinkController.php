<?php

namespace App\Http\Controllers;


namespace App\Http\Controllers;

use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Channel;
use App\Http\Requests\CommunityLinkForm;
use App\Queries\CommunityLinksQuery;



class CommunityLinkController extends Controller
{
    public function index(Channel $channel = null)
    {
        $query = new CommunityLinksQuery();
        if ($channel != null) {
            if (request()->exists('popular')) {
                $links = $query->getByChannelPopular($channel);
            }else {
                $links = $query->getByChannel($channel);
            }
        }else if (request()->exists('popular')) {
            $links = $query->getMostPopular();
        }else if(request()->exists('search')){
            $links = $query->getBySearch(trim(request()->get('search')));
        }else{
            $links = $query->getAll();
        }
        $channels = Channel::orderBy('title','asc')->get();
        return view('community/index', compact('links','channels', 'channel'));
    

}










    /**
     * Show the form for creating a new resource.
     */


    public function create()
    {
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityLinkForm $request)
    {
        // public function store(Request $request) {

        /*   EJERCICIOS ANTERIORES    */

        //return response('Respuesta', 200);  
        //dd($request);   
        //dd($request); 
        $data = $request->validated();
        $approved = Auth::user()->trusted ? true : false;
        $data['approved'] = $approved;
        $link = new CommunityLink();
        $link->user_id = Auth::id();

        $data['user_id'] = Auth::id();
        dd($data);
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
