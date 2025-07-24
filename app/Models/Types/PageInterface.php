<?php
namespace App\Models\Types;

use App\Models\Types\Base\TimestampInterface;

interface PageInterface extends TimestampInterface{
	const TABLE_NAME = 'pages';

	const ID = 'id';
	const TITLE = 'title';
	const ACTIVE = 'active';
	const ALIAS = 'alias';
	const IMAGE_PATH = 'image_path';
	const DESCRIPTION = 'desciption';

}