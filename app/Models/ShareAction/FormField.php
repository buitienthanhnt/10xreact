<?php

namespace App\Models\ShareAction;

trait FormField
{
	/**
	 * get form data for model
	 * support for create and edit form auto.
	 */
	public function formField(): array
	{
		$formData = $this->formFields;
		if ($this->getKey()) {
			foreach ($formData as $key => &$value) {
				$value['value'] = $this->{$key};
			}
		}
		return array_values($formData);
	}

	/**
	 * format data before fill to object
	 * thjs function not use now because laravel has mass-assignment(cho phép gán hàng loạt tự động)
	 * https://laravel.com/docs/12.x/eloquent#allowing-mass-assignment
	 * @param array $formInput
	 * @return array
	 */
	function fillData(array $formInput = []): array
	{
		/**
		 * format data for model factory by : FILLED_FILEDS và $data input:
		 * $key: FILLED_FILEDS = [self::TITLE, self::ACTIVE, self::ALIAS, self::IMAGE_PATH, self::DESCRIPTION, self::WRITER];
		 * $data:['TITLE' => 'view','ACTIVE' => '/detail/','ALIAS' => '','DESCRIPTION' => 'preview',]
		 */
		$modelData = array_intersect_key( // so sánh 2 mảng và trả về mảng có khóa chung
			$formInput,
			array_flip($this->fillable) // đảo ngược khóa và gía trị. trong mảng 1 chiều nó sẽ nhận giá trị là index số : 0,1,2,3
		);
		return $modelData;
	}
}
