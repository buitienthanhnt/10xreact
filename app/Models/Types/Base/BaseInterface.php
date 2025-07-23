<?php

namespace App\Models\Types\Base;

interface BaseInterface{

	const TYPE_TEXT = 'text';
	const TYPE_EMAIL = 'email';
	const TYPE_PASSWORD = 'password';
	const TYPE_NUMBER = 'number';
	const TYPE_TEXTAREA = 'textarea';
	const TYPE_BOOL = 'boolean';
	const TYPE_SELECT = 'select';
	const TYPE_MULTIL_SELECT = 'multiselect';
	const TYPE_DROPDOWN = 'dropdown';
	const TYPE_CHECKBOX = 'checkbox';
	const TYPE_RADIO = 'radio';
}
