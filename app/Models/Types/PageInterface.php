<?php

namespace App\Models\Types;

use App\Models\Types\Base\TimestampInterface;

interface PageInterface extends TimestampInterface
{
	const TABLE_NAME = 'pages';

	const ID = 'id';
	const TITLE = 'title';
	const ACTIVE = 'active';
	const ALIAS = 'alias';
	const IMAGE_PATH = 'image_path';
	const DESCRIPTION = 'desciption';
	const CONTENT = 'content';

	const WRITER = 'writer';

	const FORM_FIELDS = [
		self::TITLE => ['key' => self::TITLE, 'type' => FormInterface::TYPE_TEXT, 'label' => 'tiêu đề '],
		self::ACTIVE => ['key' => self::ACTIVE, 'type' => FormInterface::TYPE_CHECKBOX],
		self::ALIAS => ['key' => self::ALIAS, 'type' => FormInterface::TYPE_TEXT, 'label' => 'đường dẫn'],
		self::IMAGE_PATH => ['key' => self::IMAGE_PATH, 'type' => FormInterface::TYPE_FILE, 'label' => 'ảnh đại diện'],
		self::DESCRIPTION => ['key' => self::DESCRIPTION, 'type' => FormInterface::TYPE_TEXTAREA, 'label' => 'mô tả'],
		self::CONTENT => ['key' => self::CONTENT, 'type' => FormInterface::TYPE_TEXTEDITOR, 'label' => 'noi dung']
	];
}
