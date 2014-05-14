/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
// 	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	
	      CKEDITOR.config.extraPlugins = 'wpmore'; // Add 'WPMore' plugin - must be in plugins folder

      // Use <br> as break and not enclose text in <p> when pressing <Enter> or <Shift+Enter>
      CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
      CKEDITOR.config.shiftEnterMode = CKEDITOR.ENTER_BR;
      CKEDITOR.config.fillEmptyBlocks = false;    // Prevent filler nodes in all empty blocks

      // Remove all formatting when pasting text copied from websites or Microsoft Word
      CKEDITOR.config.forcePasteAsPlainText = true;
      CKEDITOR.config.pasteFromWordRemoveFontStyles = true;
      CKEDITOR.config.pasteFromWordRemoveStyles = true;
	
};
