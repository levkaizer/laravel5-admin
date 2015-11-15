@foreach($links as $title => $l)
	<h3>{{{ $title }}}</h3>
	<ul>
	@foreach($l[0] as $k => $v)
		<li><a href="{{{ $v['link'] }}}" 
			{{{ (isset($v['attributes']['id'])) ? ' class='.$v['attributes']['id'] : '' }}}
			{{{ (isset($v[$k]['attributes']['class'])) ? ' class='.$v[$k]['attributes']['class'] : '' }}}
			>{{{ $k }}}</a></li>
	@endforeach
	</ul>
@endforeach