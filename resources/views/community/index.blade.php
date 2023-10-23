@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- Left colum to show all the links in the DB --}}
            <div class="col-md-8">
                @php
                        $selectedChannel = request('channel.slug');
                    @endphp
                    <h1><a href="http://fakereddit.test/community">Community</a></h1>
                    @if ($selectedChannel)
                        <h1>Listado de Links de {{ $selectedChannel }}</h1>
                    @else
                        <h1>Listado de Links</h1>
                    @endif
                    
                @foreach ($links as $link)
                    <li>
                        <a href="{{ $link->link }}" target="_blank">
                            {{ $link->title }}
                        </a>
                        <small>Contributed by: {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}</small>
                        <span class="label label-default" style="background: {{ $link->channel->color }}">
                            <a class="text-decoration-none" href="/community/{{ $link->channel->slug }}">{{ $link->channel->title }}</a>
                            </span>
                    </li>
                    {{$link->users()->count()}} 
                @endforeach

            </div>
            {{-- Right colum to show the form to upload a link --}}
            <div class="col-md-4">
          @include('add-links')

            </div>
        </div>
        {{ $links->links() }}
    </div>





    
@stop
