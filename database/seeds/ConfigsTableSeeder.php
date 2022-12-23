<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'name' => 'Відділ соціальної роботи',
            'description' => 'Соціальна допомога — це грошова допомога й допомога в натуральній формі, що здебільшого фінансується з бюджету та добровільних пожертвувань і сплачуються людям, які перебувають у нужді, як на основі перевірки їхнього доходу та засобів існування, так і за певними критеріями без перевірки доходу.',
            'keywords' => 'СумДУ, соціальна робота, волонтерство',
            'telephone' => '+380 (542) 687-817',
            'email' => 'example@gmail.com',
            'e_description' => 'Напиши нам листа на поштову скриньку, якщо в тебе є питання чи пропозиції для нас',
            'address' => 'Україна, м.Суми, вул. Римського-Корсакова,2, Сумський державний університет, Головний корпус, каб. Г-414',
            'instagram' => 'https://www.instagram.com/volunteersssu/',
            'i_description' => 'Підпишись на наш Інстаграм, бо тут ми ділимось враженнями від того, що робимо разом',
            'facebook' => 'https://www.facebook.com/groups/131466024151019/',
            'f_description' => 'На сторінці у Фейсбук ти зможеш бути в курсі всіх новин та спілкуватися з нашими волонтерами',
            'youtube' => 'https://www.youtube.com/channel/UCu0N4iltGcUtjJ0-gmnET6A',
        ]);
    }
}
