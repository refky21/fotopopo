@if($menu->url == '#')
<li class="nav-label">{!! $menu->title !!}</li>
@else
	@if(Auth::user()->hasRole('superadmin'))
		@if((count($menu->children) > 0) && ($menu->parent == 0))
			<li class="nav-item with-sub">
				<a href="" class="nav-link"><i data-feather="{!! $menu->class !!}"></i> <span>{!! $menu->title !!}</span></a>
				<ul>
					@foreach($menu->children as $menu)
						<li><a href="{{ url($menu->url) }}">{!! $menu->title !!}</a></li>
					@endforeach
				</ul>
			  </li>
		@else
		<li class="nav-item">
			<a href="{{ url($menu->url) }}" class="nav-link">
			<i data-feather="{!! $menu->class !!}"></i> <span>{!! $menu->title !!}</span></a>
		</li>
		@endif
	@endif
		
@endif