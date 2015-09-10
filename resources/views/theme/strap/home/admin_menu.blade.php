@foreach($links as $title => $l)
	<h3>{{{ $title }}}</h3>
	<ul>
	@foreach($l as $k => $v)
		<?php $title = array_keys($v)[0]; ?>
		<li><a href="{{{ $v[$title]['link'] }}}" 
			{{{ (isset($v[$title]['attributes']['id'])) ? ' class='.$v[$title]['attributes']['id'] : '' }}}
			{{{ (isset($v[$title]['attributes']['class'])) ? ' class='.$v[$title]['attributes']['class'] : '' }}}
			>{{{ $title }}}</a></li>
	@endforeach
	</ul>
@endforeach