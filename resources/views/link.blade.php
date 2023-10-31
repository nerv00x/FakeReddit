<header>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/post.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</header>



@if(count($links) == 0)
<p>Aún no hay contribuciones aprobadas</p>
@endif
<ul class="nav">
    <li class="nav-item">
        <a class="nav-link {{request()->exists('popular') ? '' : 'disabled' }}" href="{{request()->url()}}">Most recent</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->exists('popular') ? 'disabled' : '' }}" href="?popular">Most popular</a>
    </li>
</ul>
@foreach ($links as $link)
<li>
    <a href="{{ $link->link }}" target="_blank">
        {{ $link->title }}
    </a>
    <span class="label label-default" style="background: {{ $link->channel->color }}">
        <a class="text-decoration-none" href="/community/{{ $link->channel->slug }}"> {{ $link->channel->title }}</a>
    </span>
    <form method="POST" action="/votes/{{ $link->id }}">
        {{ csrf_field() }}
        <button type="submit" class="btn {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-secondary' }}" {{ Auth::guest() ? 'disabled' : '' }}>
            <i class="fa-solid fa-thumbs-up"></i> {{$link->users()->count()}}
        </button>
    </form>
    <small>Contributed by: {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}</small>

</li>
@endforeach