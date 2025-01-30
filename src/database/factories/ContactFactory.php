<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Contact::class;
    public function definition()
    {
        $phone = $this->faker->phoneNumber();
        $tell = implode(explode("-", $phone), "");
        return [
            // 姓名が逆になっているので要確認
            'first_name' => $this->faker->lastName,
            'last_name' => $this->faker->firstName,
            'gender' => $gender = $this->faker->randomElement([1,2,3]),
            'email' => $this->faker->unique()->safeEmail,
            // 電話番号にハイフンが入るのでハイフン無しでDBに保存
            'tell' => $tell,
            'address' => $this->faker->city().$this->faker->streetAddress,
            'building' => $this->faker->secondaryAddress,
            'category_id' => $this->faker->numberBetween(1, 5),
            'detail' => $this->faker->text(120),
        ];
    }
}
