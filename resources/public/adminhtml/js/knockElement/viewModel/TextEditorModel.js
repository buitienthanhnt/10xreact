define([
	'require',
	'knockout',
	'text!knockElement/viewTemplate/textEditor.html',
], function(require, ko, textEditorTemplate) {
	'use strict';

	function TextEditorModel(params) {
		// console.log(params);
		let self = this;
		self.attr = {...params.attr, id: `id-${params.attr.name}`};
		if (params.attr.key) {
			self.attr.name = params.attr.key;
			self.attr.id = `id-${params.attr.key}`;
		}

		/**
		 * this function will be call after render this template of Model.
		 */
		self.koDescendantsComplete = function () {
			tinymce.init({
				selector: `#id-${self.attr.name}`,
				license_key: 'gpl' // gpl for open source, T8LK:... for commercial
			});
		}
	}

	ko.components.register('text-editor-com', {
		viewModel: TextEditorModel,
		template: textEditorTemplate
	});
	return TextEditorModel;
});