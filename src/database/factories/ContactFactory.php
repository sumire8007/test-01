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
        $gender = $this->faker->randomElement(['男性', '女性', 'その他']);
        $phone = $this->faker->phoneNumber();
        $tel = implode(explode("-", $phone), "");
        return [
            // 姓名が逆になっているので要確認
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $gender,
            'email' => $this->faker->unique()->safeEmail,
            // 電話番号にハイフンが入るのでハイフン無しでDBに保存
            'tel' => $tel,
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'category_id' => $this->faker->numberBetween(1, 5),
            'detail' => $this->faker->text,
        ];
    }
}
