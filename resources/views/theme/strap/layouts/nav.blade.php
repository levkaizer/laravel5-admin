@if( strpos(\Route::getCurrentRoute()->getPath(), 'admin') === 0 )
<li>
<a href="/"><i class="fa fa-globe"></i> View Site</a>
</li>
@endif