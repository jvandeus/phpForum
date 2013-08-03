/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.format_p = { margin: '0', padding: '0' };
	config.resize_dir = 'vertical';
	config.resize_maxHeight = 500px;
	config.tabSpaces = 4;
	config.toolbar = [
	    [ 'Bold', 'Italic', '-', 'Link', 'Unlink' ]
	];
};
