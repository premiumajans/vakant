<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CityTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['az' => 'Ağcabədi', 'en' => 'Aghjabadi', 'ru' => 'Агджабеди'],
            ['az' => 'Ağdam', 'en' => 'Aghdam', 'ru' => 'Агдам'],
            ['az' => 'Ağdaş', 'en' => 'Agdash', 'ru' => 'Агдаш'],
            ['az' => 'Ağdərə', 'en' => 'Agdere', 'ru' => 'Агдере'],
            ['az' => 'Ağstafa', 'en' => 'Agstafa', 'ru' => 'Агстафа'],
            ['az' => 'Ağsu', 'en' => 'Agsu', 'ru' => 'Агсу'],
            ['az' => 'Astara', 'en' => 'Astara', 'ru' => 'Астара'],
            ['az' => 'Bakı', 'en' => 'Baku', 'ru' => 'Баку'],
            ['az' => 'Balakən', 'en' => 'Balakan', 'ru' => 'Белоканы'],
            ['az' => 'Beyləqan', 'en' => 'Beylagan', 'ru' => 'Бейлаган'],
            ['az' => 'Bərdə', 'en' => 'Barda', 'ru' => 'Барда'],
            ['az' => 'Biləsuvar', 'en' => 'Bilasuvar', 'ru' => 'Билясувар'],
            ['az' => 'Cəbrayıl', 'en' => 'Jabrayil', 'ru' => 'Джабраил'],
            ['az' => 'Cəlilabad', 'en' => 'Jalilabad', 'ru' => 'Джалилабад'],
            ['az' => 'Culfa', 'en' => 'Julfa', 'ru' => 'Джульфа'],
            ['az' => 'Daşkəsən', 'en' => 'Dashkesan', 'ru' => 'Дашкесан'],
            ['az' => 'Əli-Bayramlı', 'en' => 'Ali-Bayramli', 'ru' => 'Али - Байрамлы'],
            ['az' => 'Füzuli', 'en' => 'Fizuli', 'ru' => 'Физули'],
            ['az' => 'Gədəbəy', 'en' => 'Gadabay', 'ru' => 'Гедабек'],
            ['az' => 'Gəncə', 'en' => 'Ganja', 'ru' => 'Гянджа'],
            ['az' => 'Goranboy', 'en' => 'Goranboy', 'ru' => 'Геранбой'],
            ['az' => 'Göyçay', 'en' => 'Goychay', 'ru' => 'Гойчай'],
            ['az' => 'Göygöl', 'en' => 'Goygol', 'ru' => 'Гёйгёль'],
            ['az' => 'Göytəpə', 'en' => 'Goytepe', 'ru' => 'Гёйтепе'],
            ['az' => 'Hacıqabul', 'en' => 'Hajiqabul', 'ru' => 'Гаджигабул'],
            ['az' => 'İmişli', 'en' => 'Imishli', 'ru' => 'Имишли'],
            ['az' => 'İsmayıllı', 'en' => 'Ismayilli', 'ru' => 'Исмаиллы'],
            ['az' => 'Kəlbəcər', 'en' => 'Kalbajar', 'ru' => 'Кельбаджар'],
            ['az' => 'Kürdəmir', 'en' => 'Kurdamir', 'ru' => 'Кюрдамир'],
            ['az' => 'Laçın', 'en' => 'Lachin', 'ru' => 'Лачын'],
            ['az' => 'Lerik', 'en' => 'Lerik', 'ru' => 'Лерик'],
            ['az' => 'Lənkəran', 'en' => 'Lankaran', 'ru' => 'Ленкорань'],
            ['az' => 'Masallı', 'en' => 'Masally', 'ru' => 'Масаллы'],
            ['az' => 'Mingəçevir', 'en' => 'Mingachevir', 'ru' => 'Мингячевир'],
            ['az' => 'Naftalan', 'en' => 'Naftalan', 'ru' => 'Нафталан'],
            ['az' => 'Naxçıvan', 'en' => 'Nakhchivan', 'ru' => 'Нахчыван'],
            ['az' => 'Neftçala', 'en' => 'Neftchala', 'ru' => 'Нефтечала'],
            ['az' => 'Oğuz', 'en' => 'Oghuz', 'ru' => 'Огуз'],
            ['az' => 'Ordubad', 'en' => 'Ordubad', 'ru' => 'Ордубад'],
            ['az' => 'Qaradağ', 'en' => 'Garadagh', 'ru' => 'Карадаг'],
            ['az' => 'Qax', 'en' => 'Gakh', 'ru' => 'Ках'],
            ['az' => 'Qazax', 'en' => 'Gazakh', 'ru' => 'Газах'],
            ['az' => 'Qəbələ', 'en' => 'Gabala', 'ru' => 'Габала'],
            ['az' => 'Qobustan', 'en' => 'Gobustan', 'ru' => 'Гобустан'],
            ['az' => 'Quba', 'en' => 'Guba', 'ru' => 'Губа'],
            ['az' => 'Qubadlı', 'en' => 'Gubadly', 'ru' => 'Губадлы'],
            ['az' => 'Qusar', 'en' => 'Gusar', 'ru' => 'Гусар'],
            ['az' => 'Saatlı', 'en' => 'Saatly', 'ru' => 'Саатлы'],
            ['az' => 'Sabirabad', 'en' => 'Sabirabad', 'ru' => 'Сабирабад'],
            ['az' => 'Şabran', 'en' => 'Shabran', 'ru' => 'Шабран'],
            ['az' => 'Şahbuz', 'en' => 'Shakhbuz', 'ru' => 'Шахбуз'],
            ['az' => 'Salyan', 'en' => 'Salyan', 'ru' => 'Сальян'],
            ['az' => 'Şamaxı', 'en' => 'Shamakhi', 'ru' => 'Шамахы'],
            ['az' => 'Samux', 'en' => 'Samukh', 'ru' => 'Самух'],
            ['az' => 'Şəki', 'en' => 'Shaki', 'ru' => 'Шеки'],
            ['az' => 'Şəmkir', 'en' => 'Shamkir', 'ru' => 'Шамкир'],
            ['az' => 'Şərur', 'en' => 'Sharur', 'ru' => 'Шарур'],
            ['az' => 'Şirvan', 'en' => 'Shirvan', 'ru' => 'Ширван'],
            ['az' => 'Siyəzən', 'en' => 'Siyazan', 'ru' => 'Сиазань'],
            ['az' => 'Sumqayıt', 'en' => 'Sumgayit', 'ru' => 'Сумгайыт'],
            ['az' => 'Şuşa', 'en' => 'Shusha', 'ru' => 'Шуша'],
            ['az' => 'Tərtər', 'en' => 'Tartar', 'ru' => 'Тертер'],
            ['az' => 'Tovuz', 'en' => 'Tovuz', 'ru' => 'Товуз'],
            ['az' => 'Ucar', 'en' => 'Ujar', 'ru' => 'Уджар'],
            ['az' => 'Xaçmaz', 'en' => 'Khachmaz', 'ru' => 'Хачмаз'],
            ['az' => 'Xankəndi', 'en' => 'Khankendi', 'ru' => 'Ханкенди'],
            ['az' => 'Xırdalan', 'en' => 'Khirdalan', 'ru' => 'Хырдалан'],
            ['az' => 'Xızı', 'en' => 'Khizi', 'ru' => 'Хызы'],
            ['az' => 'Xocalı', 'en' => 'Khojaly', 'ru' => 'Ходжалы'],
            ['az' => 'Xocavənd', 'en' => 'Khojavend', 'ru' => 'Ходжаве́нд'],
            ['az' => 'Xudat', 'en' => 'Khudat', 'ru' => 'Худат'],
            ['az' => 'Yardımlı', 'en' => 'Yardimli', 'ru' => 'Ярдымлы'],
            ['az' => 'Yevlax', 'en' => 'Yevlakh', 'ru' => 'Евлах'],
            ['az' => 'Zaqatala', 'en' => 'Zaqatala', 'ru' => 'Загатала'],
            ['az' => 'Zəngilan', 'en' => 'Zangilan', 'ru' => 'Зангелан'],
            ['az' => 'Zərdab', 'en' => 'Zardab', 'ru' => 'Зардаб'],
        ];
        foreach ($cities as $city) {
            $c = new City();
            $c->save();
            foreach ($city as $key => $lang) {
                $translation = new CityTranslation();
                $translation->locale = $key;
                $translation->city_id = $c->id;
                $translation->name = $lang;
                $translation->save();
            }
        }
    }
}
