<script>
var fullOptions = {
	removeformatPasted: true,
	resetCss: true,
	autogrow: true,
	btnsDef: {
		// Customizables dropdowns
		image: {
			dropdown: ['insertImage', 'upload'],
			ico: 'insertImage'
		}
	},
	btns: ['viewHTML',
		'|', 'formatting',
		'|', 'btnGrp-design',
		'|', 'link',
		'|', 'image',
		'|', 'btnGrp-justify',
		'|', 'btnGrp-lists',
		'|', 'horizontalRule',
		'|', 'foreColor', 'backColor']
};
jQuery(function($){
	$('#content').trumbowyg(fullOptions);
});
</script>