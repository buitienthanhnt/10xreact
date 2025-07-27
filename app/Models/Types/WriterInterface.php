<?php

namespace App\Models\Types;

interface WriterInterface{

	const TABLE_NAME = 'writers';

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

}