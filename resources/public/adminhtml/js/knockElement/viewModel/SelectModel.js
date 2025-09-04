define([
	'require',
	'knockout',
	'text!knockElement/viewTemplate/select.html',
], function(require, ko, selectTemplate) {
	'use strict';

	function SelectModel(params) {
		let self = this;
		self.attr = params.attr;
		if (params.attr.key) {
			self.attr.name = params.attr.key;
		}
		self.options = ko.observableArray(params.attr.options);
		self.selectedOption = ko.observable(params.attr.value)
	}

	ko.components.register('select-option-com', {
		viewModel: SelectModel,
		template: selectTemplate
	});

	return SelectModel;
});