<?php

namespace Database\Seeders;

use App\Models\AltCategory;
use App\Models\AltCategoryTranslation;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'finance' => [['az' => 'Maliyyə', 'en' => 'Finance', 'ru' => 'Финансы'],
                [
                    ['az' => 'Kredit mütəxəssisi', 'en' => 'Credit Specialist', 'ru' => 'Кредитный специалист'],
                    ['az' => 'Sığorta', 'en' => 'Insurance', 'ru' => 'Страхование'],
                    ['az' => 'Audit', 'en' => 'Audit', 'ru' => 'Аудит'],
                    ['az' => 'Mühasibat', 'en' => 'Accounting', 'ru' => 'Бухгалтерия'],
                    ['az' => 'Maliyyə analiz', 'en' => 'Financial Analysis', 'ru' => 'Финансовый анализ'],
                    ['az' => 'Bank xidməti', 'en' => 'Banking Services', 'ru' => 'Банковское обслуживание'],
                    ['az' => 'Kassir', 'en' => 'Cashier', 'ru' => 'Кассир'],
                    ['az' => 'İqtisadçı', 'en' => 'Economist', 'ru' => 'Экономист'],
                    ['az' => 'Digər', 'en' => 'Other', 'ru' => 'Другое'],
                ]],
            'marketing' => [['az' => 'Marketinq', 'en' => 'Marketing', 'ru' => 'Маркетинг'],
                [
                    ['az' => 'Marketinq menecment', 'en' => 'Marketing Management', 'ru' => 'Маркетинг менеджмент'],
                    ['az' => 'İctimayətlə əlaqələr', 'en' => 'Public Relations', 'ru' => 'Связи с общественностью'],
                    ['az' => 'Reklam', 'en' => 'Advertising', 'ru' => 'Реклама'],
                    ['az' => 'Kopiraytinq', 'en' => 'Copywriting', 'ru' => 'Копирайтинг'],
                ]],
            'information-technology' => [['az' => 'İnformasiya texnologiyaları', 'en' => 'Information Technology', 'ru' => 'Информационные технологии'],
                [
                    ['az' => 'Sistem idarəetməsi', 'en' => 'System Administration', 'ru' => 'Системное администрирование'],
                    ['az' => 'Məlumat bazasının idarə edilməsi və inkişafı', 'en' => 'Database Development and Management', 'ru' => 'Разработка и управление базами данных'],
                    ['az' => 'İT mütəxəssisi / məsləhətçi', 'en' => 'IT Specialist / Consultant', 'ru' => 'IT специалист / консультант'],
                    ['az' => 'Proqramlaşdırma', 'en' => 'Programming', 'ru' => 'Программирование'],
                    ['az' => 'İT layihələrin idarə edilməsi', 'en' => 'IT Project Management', 'ru' => 'Управление IT проектами'],
                    ['az' => 'Texniki avadanlıq mütəxəssisi', 'en' => 'Hardware Specialist', 'ru' => 'Специалист по аппаратному обеспечению'],
                    ['az' => 'Digər', 'en' => 'Other', 'ru' => 'Другое'],
                ]],
            'admininstration-and-management' => [['az' => 'İnzibati', 'en' => 'Admininstration and management', 'ru' => 'Администрация и управление'],
                [
                    ['az' => 'İnzibati dəstək', 'en' => 'Administrative Support', 'ru' => 'Административная поддержка'],
                    ['az' => 'Menecment', 'en' => 'Management', 'ru' => 'Менеджмент'],
                    ['az' => 'Ofis menecmenti', 'en' => 'Office Management', 'ru' => 'Офис менеджмент'],
                    ['az' => 'Katibə / Resepşn', 'en' => 'Secretary / Receptionist', 'ru' => 'Секретарь / Ресепшн'],
                    ['az' => 'Heyətin idarəolunması', 'en' => 'Personnel Management', 'ru' => 'Управление персоналом'],
                    ['az' => 'Digər', 'en' => 'Other', 'ru' => 'Другое'],
                ]],
            'sales' => [['az' => 'Satış', 'en' => 'Sales', 'ru' => 'Продажи'],
                [
                    ['az' => 'Daşınmaz əmlak agenti / makler', 'en' => 'Real Estate Agent / Broker', 'ru' => 'Агент по недвижимости / маклер'],
                    ['az' => 'Satış üzrə mütəxəssis', 'en' => 'Sales Specialist', 'ru' => 'Специалист по продажам'],
                ]],
            'design' => [['az' => 'Dizayn', 'en' => 'Design', 'ru' => 'Дизайн'],
                [
                    ['az' => 'Veb-dizayn', 'en' => 'Web Design', 'ru' => 'Веб-дизайн'],
                    ['az' => 'Memar / İnteryer dizaynı', 'en' => 'Architect / Interior Design', 'ru' => 'Архитектор / дизайн интерьеров'],
                    ['az' => 'Geyim dizaynı', 'en' => 'Clothing Design', 'ru' => 'Дизайн одежды'],
                    ['az' => 'Rəssam', 'en' => 'Painter', 'ru' => 'Художник'],
                    ['az' => 'Digər', 'en' => 'Other', 'ru' => 'Другое'],
                ]],
            'legal' => [['az' => 'Hüquqşünaslıq', 'en' => 'Legal', 'ru' => 'Юриспруденция'],
                [
                    ['az' => 'Vəkil', 'en' => 'Lawyer', 'ru' => 'Адвокат'],
                    ['az' => 'Cinayət hüququ', 'en' => 'Criminal Law', 'ru' => 'Криминальное право'],
                    ['az' => 'Hüquqşünas', 'en' => 'Lawyer', 'ru' => 'Юрист'],
                    ['az' => 'Digər', 'en' => 'Other', 'ru' => 'Другое'],
                ]],
            'education-and-science' => [['az' => 'Təhsil və elm', 'en' => 'Education and Science', 'ru' => 'Образование и наука'],
                [
                    ['az' => 'Məktəb tədrisi', 'en' => 'Teaching in Schools', 'ru' => 'Преподавание в школах'],
                    ['az' => 'Universitet tədrisi', 'en' => 'Teaching at Universities', 'ru' => 'Преподавание в университетах'],
                    ['az' => 'Repetitor', 'en' => 'Tutoring', 'ru' => 'Репетиторство'],
                    ['az' => 'Xüsusi təhsil/ Təlim', 'en' => 'Special Education / Trainings', 'ru' => 'Специальное обучение / Тренинги'],
                    ['az' => 'Digər', 'en' => 'Other', 'ru' => 'Другое'],
                ]],
            'industry-and-agriculture' => [['az' => 'Sənaye və kənd təsərrüfatı', 'en' => 'Industry and Agriculture', 'ru' => 'Промышленность и сельское хозяйство'],
                [
                    ['az' => 'Avtomatlaşdırılmış idarəetmə', 'en' => 'Automated Construction', 'ru' => 'Автоматизированное проектирование'],
                    ['az' => 'Tikinti', 'en' => 'Construction', 'ru' => 'Строительство'],
                    ['az' => 'Kənd təsərrüfatı', 'en' => 'Agriculture', 'ru' => 'Сельское хозяйство'],
                    ['az' => 'Mühəndis', 'en' => 'Engineer', 'ru' => 'Инженерия'],
                    ['az' => 'Geologiya və ətraf mühit', 'en' => 'Geology and Environment', 'ru' => 'Геология и окружающая среда'],
                    ['az' => 'Digər', 'en' => 'Other', 'ru' => 'Другое'],
                ]],
            'services' => [['az' => 'Xidmət', 'en' => 'Services', 'ru' => 'Обслуживание'],
                [
                    ['az' => 'Kuryer', 'en' => 'Courier', 'ru' => 'Курьер'],
                    ['az' => 'SPA və gözəllik', 'en' => 'SPA and Beauty', 'ru' => 'СПА и красота'],
                    ['az' => 'Xadimə', 'en' => 'Cleaner', 'ru' => 'Уборщица'],
                    ['az' => 'Anbardar', 'en' => 'Warehouseman', 'ru' => 'Складчик'],
                    ['az' => 'Restoran işi', 'en' => 'Catering Trade', 'ru' => 'Ресторанное дело'],
                    ['az' => 'Sürücü', 'en' => 'Driver', 'ru' => 'Водитель'],
                    ['az' => 'Dayə', 'en' => 'Nanny', 'ru' => 'Няня'],
                    ['az' => 'Fəhlə', 'en' => 'Worker', 'ru' => 'Рабочий'],
                    ['az' => 'Turizm və mehmanxana işi', 'en' => 'Tourism and Hospitality Management', 'ru' => 'Туризм и гостиничное дело'],
                    ['az' => 'Tərcüməçi', 'en' => 'Translator / Interpreter', 'ru' => 'Переводчик'],
                    ['az' => 'Mühafizə xidməti', 'en' => 'Security Service', 'ru' => 'Охрана'],
                    ['az' => 'Digər', 'en' => 'Other', 'ru' => 'Другое'],
                ]],
            'medicine-and-pharmacy' => [['az' => 'Tibb və əczaçılıq', 'en' => 'Medicine and Pharmacy', 'ru' => 'Медицина и фармация'],
                [
                    ['az' => 'Həkim', 'en' => 'Medic', 'ru' => 'Врач'],
                    ['az' => 'Tibbi personal', 'en' => 'Medical Staff', 'ru' => 'Медицинский персонал'],
                    ['az' => 'Tibb təmsilçisi', 'en' => 'Medical Representative', 'ru' => 'Медицинский представитель'],
                ]],
            'other' => [['az' => 'Müxtəlif', 'en' => 'Other', 'ru' => 'Разное'],
                [
                    ['az' => 'Jurnalistika', 'en' => 'Journalism', 'ru' => 'Журналистика'],
                    ['az' => 'Tələbələr üçün', 'en' => 'For students', 'ru' => 'Для студентов'],
                ]],
        ];
        foreach ($categories as $keyCat => $category) {
            $newCategory = new Category();
            $newCategory->slug = $keyCat;
            $newCategory->status = 1;
            $newCategory->save();
            foreach ($category[0] as $catLangKey => $item) {
                $newCategoryTranslation = new CategoryTranslation();
                $newCategoryTranslation->locale = $catLangKey;
                $newCategoryTranslation->category_id = $newCategory->id;
                $newCategoryTranslation->name = $item;
                $newCategoryTranslation->save();
            }
            foreach ($category[1] as $altCategory) {
                $newAltCategory = new AltCategory();
                $newCategory->alt()->save($newAltCategory);
                foreach ($altCategory as $keyAltLang => $altCategoryTrans) {
                    $newAltCategoryTranslation = new AltCategoryTranslation();
                    $newAltCategoryTranslation->locale = $keyAltLang;
                    $newAltCategoryTranslation->alt_category_id = $newAltCategory->id;
                    $newAltCategoryTranslation->name = $altCategoryTrans;
                    $newAltCategoryTranslation->save();
                }
            }
        }
    }
}
