define([
	'require',
	'knockout',
	'text!knockElement/viewTemplate/timeline.html',
], function(require, ko, timelineTemplate) {
	'use strict';
	
	function TimelineModel(params) {
		let self = this;
		self.name = params.attr.name;
		self.timelines = params.attr?.options || [];
		// self.timelines = [
		// 	{
		// 		label: 'thoi su',
		// 		value: 'thoi-su',
		// 	},
		// 	{
		// 		label: 'quoc te',
		// 		value: 'quoc-te',
		// 	},
		// 	{
		// 		label: 'giai tri',
		// 		value: 'giai-tri',
		// 	},
		// ];
		self.selected = ko.observable(null);
		self.time = ko.observable(null);

		self.dataText = ko.computed(function(){
			if (!self.selected() || !self.time()) {
				return '';
			}
			return JSON.stringify({
				typeValue: self.selected(),
				timeValue: self.time(),
			});
		})


		/**
		 * this function will be call after render this template of Model.
		 */
		self.koDescendantsComplete = function () {
			/**
			 * init for set default data field load from server.
			 */
			if (params.attr.value) {
				const data = JSON.parse(params.attr.value);
				self.selected(data.typeValue);
				self.time(data.timeValue);
			}
			// $('#timepicker').timepicker();   https://gijgo.com/timepicker
			$("#timepicker").datetimepicker({
				datepicker: {
					showOtherMonths: true,
					calendarWeeks: true,
					todayHighlight: true
				},
				footer: true,
				modal: true,
				header: true,
				value: self.time(),
				format: 'yyyy-mm-dd HH:MM:ss',
			});
		}
	}

	ko.components.register('timeline-com', {
		viewModel: TimelineModel,
		template: timelineTemplate
	});

	return TimelineModel;
});