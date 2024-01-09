<?php

declare(strict_types=1);

return [
    'accepted'        => 'Ви повинні прийняти :attribute.',
    'accepted_if'     => 'Поле :attribute має бути прийнятним, коли :other є :value.',
    'active_url'      => 'Поле :attribute не є правильним URL.',
    'after'           => 'Поле :attribute має містити дату не раніше :date.',
    'after_or_equal'  => 'Поле :attribute має містити дату не раніше, або дорівнюватися :date.',
    'alpha'           => 'Поле :attribute має містити лише літери.',
    'alpha_dash'      => 'Поле :attribute має містити лише літери, цифри, тире та підкреслення.',
    'alpha_num'       => 'Поле :attribute має містити лише літери та цифри.',
    'array'           => 'Поле :attribute має бути масивом.',
    'ascii'           => 'Поле :attribute має містити лише однобайтові буквено-цифрові знаки та символи.',
    'before'          => 'Поле :attribute має містити дату не пізніше :date.',
    'before_or_equal' => 'Поле :attribute має містити дату не пізніше, або дорівнюватися :date.',
    'between'         => [
        'array'   => 'Поле :attribute має містити від :min до :max елементів.',
        'file'    => 'Розмір файлу у полі :attribute має бути не менше :min та не більше :max кілобайт.',
        'numeric' => 'Поле :attribute має бути між :min та :max.',
        'string'  => 'Текст у полі :attribute має бути не менше :min та не більше :max символів.',
    ],
    'boolean'           => 'Поле :attribute повинне містити логічний тип.',
    'can'               => 'Поле :attribute містить неавторизоване значення.',
    'confirmed'         => 'Поле :attribute не збігається з підтвердженням.',
    'current_password'  => 'Пароль неправильний.',
    'date'              => 'Поле :attribute не є датою.',
    'date_equals'       => 'Поле :attribute має бути датою рівною :date.',
    'date_format'       => 'Поле :attribute не відповідає формату :format.',
    'decimal'           => 'Поле :attribute має містити :decimal десяткових знаків.',
    'declined'          => 'Поле :attribute має бути відхилено.',
    'declined_if'       => 'Поле :attribute має бути відхилено, якщо :other є :value.',
    'different'         => 'Поля :attribute та :other повинні бути різними.',
    'digits'            => 'Довжина цифрового поля :attribute повинна дорівнювати :digits.',
    'digits_between'    => 'Довжина цифрового поля :attribute повинна бути від :min до :max.',
    'dimensions'        => 'Поле :attribute містить неприпустимі розміри зображення.',
    'distinct'          => 'Поле :attribute містить значення, яке дублюється.',
    'doesnt_end_with'   => 'Поле :attribute не може закінчуватися одним із таких: :values.',
    'doesnt_start_with' => 'Поле :attribute не може починатися з одного з наступного: :values.',
    'email'             => 'Поле :attribute повинне містити коректну електронну адресу.',
    'ends_with'         => 'Поле :attribute має закінчуватися одним з наступних значень: :values',
    'enum'              => 'Вибране для :attribute значення не коректне.',
    'exists'            => 'Вибране для :attribute значення не коректне.',
    'extensions'        => 'Файл у полі :attribute повинен мати одне з наступних розширень: :values.',
    'file'              => 'Поле :attribute має містити файл.',
    'filled'            => 'Поле :attribute є обов\'язковим для заповнення.',
    'gt'                => [
        'array'   => 'Поле :attribute має містити більше ніж :value елементів.',
        'file'    => 'Поле :attribute має бути більше ніж :value кілобайт.',
        'numeric' => 'Поле :attribute має бути більше ніж :value.',
        'string'  => 'Поле :attribute має бути більше ніж :value символів.',
    ],
    'gte' => [
        'array'   => 'Поле :attribute має містити :value чи більше елементів.',
        'file'    => 'Поле :attribute має дорівнювати чи бути більше ніж :value кілобайт.',
        'numeric' => 'Поле :attribute має дорівнювати чи бути більше ніж :value.',
        'string'  => 'Поле :attribute має дорівнювати чи бути більше ніж :value символів.',
    ],
    'hex_color' => 'Поле :attribute має мати дійсний шістнадцятковий колір.',
    'image'     => 'Поле :attribute має містити зображення.',
    'in'        => 'Вибране для :attribute значення не коректне.',
    'in_array'  => 'Значення поля :attribute не міститься в :other.',
    'integer'   => 'Поле :attribute має містити ціле число.',
    'ip'        => 'Поле :attribute має містити IP адресу.',
    'ipv4'      => 'Поле :attribute має містити IPv4 адресу.',
    'ipv6'      => 'Поле :attribute має містити IPv6 адресу.',
    'json'      => 'Дані поля :attribute мають бути у форматі JSON.',
    'lowercase' => 'Поле :attribute має бути рядком у нижньому регістрі',
    'lt'        => [
        'array'   => 'Поле :attribute має містити менше ніж :value items.',
        'file'    => 'Поле :attribute має бути менше ніж :value кілобайт.',
        'numeric' => 'Поле :attribute має бути менше ніж :value.',
        'string'  => 'Поле :attribute має бути менше ніж :value символів.',
    ],
    'lte' => [
        'array'   => 'Поле :attribute має містити не більше ніж :value елементів.',
        'file'    => 'Поле :attribute має дорівнювати чи бути менше ніж :value кілобайт.',
        'numeric' => 'Поле :attribute має дорівнювати чи бути менше ніж :value.',
        'string'  => 'Поле :attribute має дорівнювати чи бути менше ніж :value символів.',
    ],
    'mac_address' => 'Поле :attribute має містити MAC адресу.',
    'max'         => [
        'array'   => 'Поле :attribute повинне містити не більше :max елементів.',
        'file'    => 'Файл в полі :attribute має бути не більше :max кілобайт.',
        'numeric' => 'Поле :attribute має бути не більше :max.',
        'string'  => 'Текст в полі :attribute повинен мати довжину не більшу за :max.',
    ],
    'max_digits' => 'Поле :attribute не може містити більше :max цифр.',
    'mimes'      => 'Поле :attribute повинне містити файл одного з типів: :values.',
    'mimetypes'  => 'Поле :attribute повинне містити файл одного з типів: :values.',
    'min'        => [
        'array'   => 'Поле :attribute повинне містити не менше :min елементів.',
        'file'    => 'Розмір файлу у полі :attribute має бути не меншим :min кілобайт.',
        'numeric' => 'Поле :attribute повинне бути не менше :min.',
        'string'  => 'Текст у полі :attribute повинен містити не менше :min символів.',
    ],
    'min_digits'       => 'Поле :attribute має містити принаймні :min цифр.',
    'missing'          => 'Поле :attribute має бути відсутнім.',
    'missing_if'       => 'Поле :attribute має бути відсутнім, якщо :other дорівнює :value.',
    'missing_unless'   => 'Поле :attribute має бути відсутнім, якщо :other не є :value.',
    'missing_with'     => 'Поле :attribute повинно бути відсутнім, якщо присутнє :values.',
    'missing_with_all' => 'Поле :attribute повинно бути відсутнім, якщо присутні :values.',
    'multiple_of'      => 'Поле :attribute повинно бути кратним :value',
    'not_in'           => 'Вибране для :attribute значення не коректне.',
    'not_regex'        => 'Формат поля :attribute не вірний.',
    'numeric'          => 'Поле :attribute повинно містити число.',
    'password'         => [
        'letters'       => 'Поле :attribute має містити принаймні одну літеру.',
        'mixed'         => 'Поле :attribute має містити принаймні одну велику та одну малу літери.',
        'numbers'       => 'Поле :attribute має містити принаймні одне число.',
        'symbols'       => 'Поле :attribute має містити принаймні один символ.',
        'uncompromised' => 'Поле :attribute з\'явився під час витоку даних. Виберіть інший :attribute.',
    ],
    'present'              => 'Поле :attribute повинне бути присутнє.',
    'present_if'           => 'Поле :attribute має бути присутнім, коли :other дорівнює :value.',
    'present_unless'       => 'Поле :attribute повинно бути присутнім, якщо :other не є :value.',
    'present_with'         => 'Поле :attribute повинно бути присутнім, коли присутній :values.',
    'present_with_all'     => 'Поле :attribute повинно бути присутнім, якщо присутні :values.',
    'prohibited'           => 'Поле :attribute заборонено.',
    'prohibited_if'        => 'Поле :attribute заборонено, коли :other дорівнює :value.',
    'prohibited_unless'    => 'Поле :attribute заборонено, якщо тільки :other не знаходиться в :values.',
    'prohibits'            => 'Поле :attribute забороняє присутність :other.',
    'regex'                => 'Поле :attribute має хибний формат.',
    'required'             => 'Поле :attribute є обов\'язковим для заповнення.',
    'required_array_keys'  => 'Поле :attribute має містити записи для: :values.',
    'required_if'          => 'Поле :attribute є обов\'язковим для заповнення, коли :other є рівним :value.',
    'required_if_accepted' => 'Поле :attribute є обов\'язковим, якщо прийнято :other.',
    'required_unless'      => 'Поле :attribute є обов\'язковим для заповнення, коли :other відрізняється від :values',
    'required_with'        => 'Поле :attribute є обов\'язковим для заповнення, коли :values вказано.',
    'required_with_all'    => 'Поле :attribute є обов\'язковим для заповнення, коли :values вказано.',
    'required_without'     => 'Поле :attribute є обов\'язковим для заповнення, коли :values не вказано.',
    'required_without_all' => 'Поле :attribute є обов\'язковим для заповнення, коли :values не вказано.',
    'same'                 => 'Поля :attribute та :other мають збігатися.',
    'size'                 => [
        'array'   => 'Поле :attribute повинне містити :size елементів.',
        'file'    => 'Файл у полі :attribute має бути розміром :size кілобайт.',
        'numeric' => 'Поле :attribute має бути довжини :size.',
        'string'  => 'Текст у полі :attribute повинен містити :size символів.',
    ],
    'starts_with' => 'Поле :attribute повинне починатися з одного з наступних значень: :values',
    'string'      => 'Поле :attribute повинне містити текст.',
    'timezone'    => 'Поле :attribute повинне містити коректну часову зону.',
    'ulid'        => 'Поле :attribute має бути коректним ULID.',
    'unique'      => 'Вказане значення поля :attribute вже існує.',
    'uploaded'    => 'Завантаження :attribute не вдалося.',
    'uppercase'   => 'Поле :attribute має бути рядком у верхньому регістрі.',
    'url'         => 'Формат поля :attribute хибний.',
    'uuid'        => 'Поле :attribute має бути коректним UUID ідентифікатором.',
    'attributes'  => [
        'address'                  => 'адреса',
        'affiliate_url'            => 'афілійована URL-адреса',
        'age'                      => 'вік',
        'amount'                   => 'сума',
        'area'                     => 'область',
        'available'                => 'доступно',
        'birthday'                 => 'день народження',
        'body'                     => 'тіло',
        'city'                     => 'місто',
        'content'                  => 'контент',
        'country'                  => 'країна',
        'created_at'               => 'створено при',
        'creator'                  => 'творець',
        'currency'                 => 'валюта',
        'current_password'         => 'поточний пароль',
        'customer'                 => 'клієнт',
        'date'                     => 'дата',
        'date_of_birth'            => 'дата народження',
        'day'                      => 'день',
        'deleted_at'               => 'видалено о',
        'description'              => 'опис',
        'district'                 => 'район',
        'duration'                 => 'тривалість',
        'email'                    => 'e-mail адреса',
        'excerpt'                  => 'уривок',
        'filter'                   => 'фільтр',
        'first_name'               => 'ім\'я',
        'gender'                   => 'стать',
        'group'                    => 'група',
        'hour'                     => 'година',
        'image'                    => 'зображення',
        'is_subscribed'            => 'підписаний',
        'items'                    => 'елементи',
        'last_name'                => 'прізвище',
        'lesson'                   => 'урок',
        'line_address_1'           => 'адреса рядка 1',
        'line_address_2'           => 'адреса рядка 2',
        'message'                  => 'повідомлення',
        'middle_name'              => 'по батькові',
        'minute'                   => 'хвилина',
        'mobile'                   => 'моб. номер',
        'month'                    => 'місяць',
        'name'                     => 'ім\'я',
        'national_code'            => 'національний код',
        'number'                   => 'номер',
        'password'                 => 'пароль',
        'password_confirmation'    => 'підтвердження пароля',
        'phone'                    => 'телефон',
        'photo'                    => 'фото',
        'postal_code'              => 'Поштовий індекс',
        'preview'                  => 'попередній перегляд',
        'price'                    => 'ціна',
        'product_id'               => 'ID товару',
        'product_uid'              => 'UID товару',
        'product_uuid'             => 'UUID товару',
        'promo_code'               => 'промокод',
        'province'                 => 'провінція',
        'quantity'                 => 'кількість',
        'recaptcha_response_field' => 'поле відповіді recaptcha',
        'remember'                 => 'запам\'ятати',
        'restored_at'              => 'відновлено при',
        'result_text_under_image'  => 'текст результату під зображенням',
        'role'                     => 'роль',
        'second'                   => 'секунда',
        'sex'                      => 'стать',
        'shipment'                 => 'доставка',
        'short_text'               => 'короткий текст',
        'size'                     => 'розмір',
        'state'                    => 'стан',
        'street'                   => 'вулиця',
        'student'                  => 'студент',
        'subject'                  => 'тема',
        'teacher'                  => 'викладач',
        'terms'                    => 'умови',
        'test_description'         => 'опис тесту',
        'test_locale'              => 'тестова локаль',
        'test_name'                => 'назва тесту',
        'text'                     => 'текст',
        'time'                     => 'час',
        'title'                    => 'назва',
        'updated_at'               => 'оновлено о',
        'user'                     => 'користувач',
        'username'                 => 'нікнейм',
        'year'                     => 'рік',
    ],
];
