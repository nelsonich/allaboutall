<?php

use App\Models\Category;
use App\Models\SearchTag;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $swimming = Category::create([
            'name' => 'Плавание',
            'parent_id' => null,
            'background' => 'swimming-9.jpg',
        ]);

        $football = Category::create([
            'name' => 'Футбол',
            'parent_id' => null,
            'background' => '7t30wgN.jpg',
        ]);

        $celebrities = Category::create([
            'name' => 'Знаменитости',
            'parent_id' => null,
            'background' => 'hollywood-wallpaper.jpg',
        ]);

        $myths = Category::create([
            'name' => 'Мифы',
            'parent_id' => null,
            'background' => '17494.jpg',
        ]);

        /* Swimming Childes */

        $item = Category::create([
            'name' => 'Родина Плавания',
            'parent_id' => $swimming->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Родина Плавания',
        ]);

        $item = Category::create([
            'name' => 'Марк Спитц',
            'parent_id' => $swimming->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Марк Спитц',
        ]);

        $item = Category::create([
            'name' => 'Майкл Фелпс',
            'parent_id' => $swimming->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Майкл Фелпс',
        ]);

        $item = Category::create([
            'name' => 'Ласло Чех',
            'parent_id' => $swimming->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Ласло Чех',
        ]);

        $item = Category::create([
            'name' => 'Иан Торп',
            'parent_id' => $swimming->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Иан Торп',
        ]);

        $item = Category::create([
            'name' => 'Райан Лохте',
            'parent_id' => $swimming->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Райан Лохте',
        ]);

        $item = Category::create([
            'name' => 'Юлия Ефимова',
            'parent_id' => $swimming->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Юлия Ефимова',
        ]);

        $item = Category::create([
            'name' => 'Самый лучший возраст для занятия',
            'parent_id' => $swimming->id,
            'background' => '17494.jpg',
        ]); // 12

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Самый лучший возраст для занятия',
        ]);

        /* Football Childes */

        $item = Category::create([
            'name' => 'Родина футбола',
            'parent_id' => $football->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Родина футбола',
        ]);

        $item = Category::create([
            'name' => 'Пеле',
            'parent_id' => $football->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Пеле',
        ]);

        $item = Category::create([
            'name' => 'Лионель Месси',
            'parent_id' => $football->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Лионель Месси',
        ]);

        $item = Category::create([
            'name' => 'Криштиану Роналду',
            'parent_id' => $football->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Криштиану Роналду',
        ]);

        $item = Category::create([
            'name' => 'Вратарь Лев Иванович Яшин',
            'parent_id' => $football->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Вратарь Лев Иванович Яшин',
        ]);

        $item = Category::create([
            'name' => 'Роналдиньо',
            'parent_id' => $football->id,
            'background' => '17494.jpg',
        ]); // 18

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Роналдиньо',
        ]);

        /* Myths Childes */

        $item = Category::create([
            'name' => 'Астрология (пять мифов об астрологии)',
            'parent_id' => $myths->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Астрология (пять мифов об астрологии)',
        ]);

        $item = Category::create([
            'name' => 'Мифы о плавании',
            'parent_id' => $myths->id,
            'background' => '17494.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Мифы о плавании',
        ]);

        $item = Category::create([
            'name' => 'Мифы про футбол',
            'parent_id' => $myths->id,
            'background' => '17494.jpg',
        ]); // 21

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Мифы про футбол',
        ]);

        /* Celebrities Childes */

        $item = Category::create([
            'name' => 'Селена Гомез',
            'parent_id' => $celebrities->id,
            'background' => 'hollywood-wallpaper.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Селена Гомез',
        ]);

        $item = Category::create([
            'name' => 'Зендая',
            'parent_id' => $celebrities->id,
            'background' => 'hollywood-wallpaper.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Зендая',
        ]);

        $item = Category::create([
            'name' => 'Шей Митчелл',
            'parent_id' => $celebrities->id,
            'background' => 'hollywood-wallpaper.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Шей Митчелл',
        ]);

        $item = Category::create([
            'name' => 'Лорен Грей',
            'parent_id' => $celebrities->id,
            'background' => 'hollywood-wallpaper.jpg',
        ]);

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Лорен Грей',
        ]);

        $item = Category::create([
            'name' => 'Настя Свон',
            'parent_id' => $celebrities->id,
            'background' => 'hollywood-wallpaper.jpg',
        ]); // 26

        SearchTag::create([
            'category_id' => $item->id,
            'value' => 'Настя Свон',
        ]);
    }
}
