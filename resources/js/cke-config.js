CKEDITOR.editorConfig = function( config ) {
    config.language = 'uk';
	config.extraPlugins = 'justify';
    config.toolbar =
	[
	    {name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates']},
	    {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
	    {name: 'edit', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'SpellChecker', 'Scayt']},
	    {name: 'forms', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']},
	    '/',
	    {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
	    {name: 'абзац', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
	    {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
	    {name: 'insert', items: ['Table', 'HorizontalRule', 'SpecialChar', 'PageBreak']},
	    '/',
	    {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
	    {name: 'colors', items: ['TextColor', 'BGColor']},
		{name: 'tools', items: ['Maximize', 'ShowBlocks', '-']},
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		
	];
};

