<?php

namespace App\Models\Types;

use App\Models\Types\Base\RouteInterface;

interface CategoryInterface extends RouteInterface
{
	const TABLE_NAME = 'categories';

	const ID = 'id';
	const NAME = 'name';
	const ALIAS = 'alias';
	const ACTIVE = 'active';
	const IMAGE_PATH = 'image_path';
	const DESCIPTION = 'content';

	const PARENT = 'parent';

	const FILLED_FILEDS = [
		self::NAME,
		self::ACTIVE,
		self::ALIAS,
		self::DESCIPTION,
		self::PARENT,
	];
	const FORM_FIELDS = [
		self::NAME => ['key' => self::NAME, 'type' => FormInterface::TYPE_TEXT, 'label' => 'teen', 'required' => true],
		self::ALIAS => ['key' => self::ALIAS, 'type' => FormInterface::TYPE_TEXT, 'label' => 'duong dan'],
		self::ACTIVE => ['key' => self::ACTIVE, 'type' => FormInterface::TYPE_CHECKBOX, 'label' => 'trang thai'],
		self::IMAGE_PATH => ['key' => self::IMAGE_PATH, 'type' => FormInterface::TYPE_FILE, 'label' => 'anh dai dien'],
		self::DESCIPTION => ['key' => self::DESCIPTION, 'type' => FormInterface::TYPE_TEXTAREA, 'label' => 'mo ta'],
		self::PARENT => ['key' => self::PARENT, 'type' => FormInterface::TYPE_SELECT, 'label' => 'danh muc cha', 'model' => \App\Models\Category::class],
	];

	const PREFIX = 'category';
	const ROUTE_PREFIX = ADMIN_PREFIX . '/' . self::PREFIX;
}
