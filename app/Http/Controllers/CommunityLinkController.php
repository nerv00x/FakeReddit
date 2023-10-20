<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommunityLinkForm;
use App\Models\Item;
use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Channel $channel = null)
     {
         // Si se proporciona un canal en la URL, filtra los enlaces por ese canal; de lo contrario, muestra todos los canales.
         if ($channel) {
             $links = CommunityLink::where('channel_id', $channel->id)->where('approved', 0)->latest('updated_at')->paginate(25);
         } else {
             $links = CommunityLink::where('approved', 0)->latest('updated_at')->paginate(25);
         }
     
         // Obtenemos la lista de todos los canales
         $channels = Channel::orderBy('title', 'asc')->get();
     
         return view('community/index', compact('links','channels'));
     }
     
    
     
     
     
     
    


    /**
     * Show the form for creating a new resource.
     */
    

    public function create(){

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
        $approved = Auth::user()->trusted ? true : false;
        $data['approved'] = $approved;
        $link = new CommunityLink();
        $link->user_id = Auth::id();




        request()->merge(['user_id' => Auth::id()]);

        $data = $request->validate([




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
