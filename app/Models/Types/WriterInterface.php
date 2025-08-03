<?php

namespace App\Models\Types;

interface WriterInterface
{
	/**
	 * khai báo tên bảng trong database.
	 */
	const TABLE_NAME = 'writers';

	/**
	 * khai báo các thuộc tính đối tượng.
	 */
	const ID = 'id';
	const NAME = 'name';
	const EMAIL = 'email';
	const ACTIVE = 'active';
	const ALIAS = 'alias';
	const PHONE = 'phone';
	const ADDRESS = 'address';
	const IMAGE_PATH = 'image_path';
	const DESCRIPTION = 'description';
	const DATE_OF_BIRTH = 'date_of_birth';

	const _PAGES = 'pages';

	/**
	 * khai báo thuộc tính biểu mẫu để tạo 1 tác giả.
	 */
	const FROM_FIELDS = [
		['key' => self::NAME, 'type' => FormInterface::TYPE_TEXT, 'label' => 'tên tác giả'],
		['key' => self::EMAIL, 'type' => FormInterface::TYPE_EMAIL],
		['key' => self::ACTIVE, 'type' => FormInterface::TYPE_CHECKBOX],
		['key' => self::ALIAS, 'type' => FormInterface::TYPE_TEXT, 'label' => 'bút danh'],
		['key' => self::PHONE, 'type' => FormInterface::TYPE_PHONE, 'label' => 'sdt'],
		['key' => self::ADDRESS, 'type' => FormInterface::TYPE_TEXT, 'label' => 'địa chỉ'],
		['key' => self::IMAGE_PATH, 'type' => FormInterface::TYPE_FILE, 'label' => 'ảnh đại diện'],
		['key' => self::DESCRIPTION, 'type' => FormInterface::TYPE_TEXTAREA, 'label' => 'ghi chú'],
		['key' => self::DATE_OF_BIRTH, 'type' => FormInterface::TYPE_DATE, 'label' => 'ngày sinh']
	];
}
