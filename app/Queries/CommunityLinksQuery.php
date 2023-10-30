<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinksQuery
{
    public function getByChannel(Channel $channel)
    {
        $links = CommunityLink::where('channel_id', $channel->id)->where('approved', 0)->latest('updated_at')->paginate(25);
    }

    public function getAll()
    {
        $links = CommunityLink::where('approved', 0)->latest('updated_at')->paginate(25);
        return $links;
    }

    public function getMostPopular()
    {

        $links = CommunityLink::where('approved', 0)->withCount("users")->orderBy("users_count", "desc")->paginate(25);
        return $links;
    }
}
