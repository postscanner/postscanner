import requests
import lxml.html
import sys
import json

    

url = "http://www.garantpost.ru/tools/"
calc_types = ( "russia", "world", "moscowZone", "cargo")
services = (('express', 'op'), ('1', '2'), ('express', 'op'), ('term-term', 'term-door', 'door-term', 'door-door'))

russia_cities = {'Ярославль': '78401000', 'Крым респ.': '290000', 'Мордовия респ.': '89000000', 'Оренбург': '53401000', 'Калининградская обл.': '27000000', 'Смоленская обл.': '66000000', 'Пенза': '56401000', 'Рязанская обл.': '61000000', 'Алтай респ.': '84000000', 'Приморский край': '5000000', 'Камчатский край': '30000000', 'Удмуртская респ.': '94000000', 'Ставрополь': '7401000', 'Элиста': '85401000', 'Свердловская обл.': '65000000', 'Белгородская обл.': '14000000', 'Пермский край': '57000000', 'Иркутск': '25401000', 'Нижегородская обл.': '22000000', 'Ивановская обл.': '24000000', 'Кострома': '34401000', 'Чеченская респ.': '96000000', 'Вологда': '19401000', 'Владикавказ': '90401000', 'Ненецкий ао': '11100000', 'Псков': '58401000', 'Архангельская обл.': '11000000', 'Псковская обл.': '58000000', 'Ярославская обл.': '78000000', 'Тюменская обл.': '71000000', 'Самара': '36401000', 'Саратов': '63401000', 'Чувашская респ.': '97000000', 'Бурятия респ.': '81000000', 'Карелия респ.': '86000000', 'Екатеринбург': '65401000', 'Иркутская обл.': '25000000', 'Орловская обл.': '54000000', 'Хакасия респ.': '95000000', 'Владимирская обл.': '17000000', 'Тюмень': '71401000', 'Астрахань': '12401000', 'Петропавловск-Камчатский': '30401000', 'Ханты-Мансийск': '71131000', 'Северная Осетия-Алания респ.': '90000000', 'Красноярск': '4401000', 'Воронеж': '20401000', 'Пермь': '57401000', 'Адыгея респ.': '79000000', 'Рязань': '61401000', 'Омск': '52401000', 'Махачкала': '82401000', 'Орел': '54401000', 'Новосибирск': '50401000', 'Брянск': '15401000', 'Чукотский ао': '77000000', 'Благовещенск': '10401000', 'Коми респ.': '87000000', 'Кировская обл.': '33000000', 'Новосибирская обл.': '50000000', 'Улан-Удэ': '81401000', 'Чита': '76401000', 'Краснодар': '3401000', 'Костромская обл.': '34000000', 'Тула': '70401000', 'Белгород': '14401000', 'Ульяновск': '73401000', 'Магас': '26401000', 'Киров': '33401000', 'Архангельск': '11401000', 'Ставропольский край': '7000000', 'Курганская обл.': '37000000', 'Абакан': '95401000', 'Нальчик': '83401000', 'Забайкальский край': '76000000', 'Ростовская обл.': '60000000', 'Волгоград': '18401000', 'Йошкар-Ола': '88401000', 'Севастополь': '299000', 'Смоленск': '66401000', 'Курск': '38401000', 'Барнаул': '1401000', 'Пензенская обл.': '56000000', 'Владимир': '17401000', 'Тверь': '28401000', 'Тамбов': '68401000', 'Мурманская обл.': '47000000', 'Казань': '92401000', 'Карачаево-Черкесская респ.': '91000000', 'Саранск': '89401000', 'Волгоградская обл.': '18000000', 'Краснодарский край': '3000000', 'Амурская обл.': '10000000', 'Астраханская обл.': '12000000', 'Владивосток': '5401000', 'Брянская обл.': '15000000', 'Татарстан респ.': '92000000', 'Ростов-на-Дону': '60401000', 'Чебоксары': '97401000', 'Самарская обл.': '36000000', 'Курган': '37401000', 'Челябинск': '75401000', 'Тульская обл.': '70000000', 'Майкоп': '79401000', 'Новгородская обл.': '49000000', 'Кызыл': '93401000', 'Башкортостан респ.': '80000000', 'Сахалинская обл.': '64000000', 'Калужская обл.': '29000000', 'Омская обл.': '52000000', 'Горно-Алтайск': '84401000', 'Томская обл.': '69000000', 'Ленинградская обл.': '41000000', 'Хабаровск': '8401000', 'Ингушетия респ.': '26000000', 'Курская обл.': '38000000', 'Нижний Новгород': '22401000', 'Дагестан респ.': '82000000', 'Саратовская обл.': '63000000', 'Тыва респ.': '93000000', 'Калуга': '29401000', 'Ямало-Ненецкий ао': '71140000', 'Красноярский край': '4000000', 'Московская обл.': '46000000', 'Саха (Якутия) респ.': '98000000', 'Тамбовская обл.': '68000000', 'Вологодская обл.': '19000000', 'Еврейская аобл': '99000000', 'Калмыкия респ.': '85000000', 'Биробиджан': '99401000', 'Черкесск': '91401000', 'Иваново': '24401000', 'Москва': '45000000', 'Великий Новгород': '49401000', 'Алтайский край': '1000000', 'Калининград': '27401000', 'Симферополь': '295000', 'Магаданская обл.': '44000000', 'Петрозаводск': '86401000', 'Марий Эл респ.': '88000000', 'Якутск': '98401000', 'Южно-Сахалинск': '64401000', 'Хабаровский край': '8000000', 'Анадырь': '77401000', 'Салехард': '71171000', 'Кабардино-Балкарская респ.': '83000000', 'Сыктывкар': '87401000', 'Челябинская обл.': '75000000', 'Кемерово': '32401000', 'Воронежская обл.': '20000000', 'Магадан': '44401000', 'Мурманск': '47401000', 'Ханты-Мансийский ао': '71100000', 'Санкт-Петербург': '40000000', 'Грозный': '96401000', 'Кемеровская обл.': '32000000', 'Ульяновская обл.': '73000000', 'Тверская обл.': '28000000', 'Ижевск': '94401000', 'Липецкая обл.': '42000000', 'Липецк': '42401000', 'Томск': '69401000', 'Уфа': '80401000', 'Оренбургская обл.': '53000000', 'Нарьян-Мар': '11111000'}

countries = {'Иордания': '400', 'Непал': '524', 'Словения': '705', 'Гаити': '332', 'Исландия': '352', 'Антигуа и Барбуда': '28', 'Бутан': '64', 'Гана': '288', 'Монтсеррат': '500', 'Тувалу': '798', 'Намибия': '516', 'Япония': '392', 'Мадейра о-в': '905', 'Макао (Аомынь)': '446', 'Андорра': '20', 'Гвинея': '324', 'Кипр': '196', 'Израиль': '376', 'Литва': '440', 'Джерси о-в': '832', 'Саудовская Аравия': '682', 'Руанда': '646', 'Гренландия': '304', 'Ангола': '24', 'Панама': '591', 'Бахрейн': '48', 'Балеарские о-ва': '903', 'Иран': '364', 'Таиланд': '764', 'Сьерра-Леоне': '694', 'Эритрея': '232', 'Пуэрто-Рико': '630', 'Чехия': '203', 'Австрия': '40', 'Остров рождества': '162', 'Катар': '634', 'Сан-Томе и Принсипи': '678', 'Теркс и Кайкос': '796', 'Азербайджан': '31', 'Центральноафриканская Республика': '140', 'Узбекистан': '860', 'Соединенные Штаты Америки': '840', 'Испания': '724', 'Канада': '124', 'Джибути': '262', 'Палау': '585', 'Гонконг(Сянган)': '344', 'Лихтенштейн': '438', 'Колумбия': '170', 'Босния и Герцеговина': '70', 'Уганда': '800', 'Танзания': '834', 'Сент-Винсент и Гренадины': '670', 'Португалия': '620', 'Кения': '404', 'Никарагуа': '558', 'Польша': '616', 'Мартиника': '474', 'Шри-Ланка': '144', 'Мадагаскар': '450', 'Лаос': '418', 'Ватикан': '336', 'Сенегал': '686', 'Вьетнам': '704', 'Беларусь': '112', 'Нидерл. Карибы': '535', 'Оман': '512', 'Южно-Африканская Республика': '710', "Кот д 'Ивуар": '384', 'Греция': '300', 'Соломоновы острова': '90', 'Пакистан': '586', 'Майотта': '175', 'Белиз': '84', 'Перу': '604', 'Гренада': '308', 'Новая Зеландия': '554', 'Бруней': '96', 'Свазиленд': '748', 'Йемен': '887', 'Папуа - Новая Гвинея': '598', 'Сальвадор': '222', 'Мали': '466', 'Ливан': '422', 'Бурунди': '108', 'Кюрасао о-в': '531', 'Камбоджа': '116', 'Сомали': '706', 'Грузия': '268', 'Чили': '152', 'Чад': '149', 'Египет': '818', 'Тринидад и Тобаго': '780', 'Либерия': '430', 'Микронезия': '583', 'Албания': '8', 'Румыния': '642', 'Гуам': '316', 'Восточный Тимор': '626', 'Гамбия': '270', 'Мэн о-в': '833', 'Кыргызстан': '417', 'Эфиопия': '231', 'Коморские острова': '174', 'Норфолк': '574', 'Барбадос': '52', 'Суринам': '740', 'Уоллис и Футуна': '876', 'Нигер': '562', 'Северные Марианские острова': '580', 'Сент-Китс и Невис': '659', 'Финляндия': '246', 'Ботсвана': '72', 'Китай': '156', 'Швеция': '752', 'Бразилия': '76', 'Острова Кука': '184', 'Индонезия': '360', 'Норвегия': '578', 'Новая Каледония': '540', 'Замбия': '894', 'Франция': '250', 'Гавайи': '897', 'Ангилья': '660', 'Малайзия': '458', 'Гибралтар': '292', 'Судан': '736', 'Люксембург': '442', 'Маврикий': '480', 'Корея (Южная)': '410', 'Марокко': '504', 'Армения': '51', 'Мальта': '470', 'Черногория': '499', 'Гвинея - Бисау': '624', 'Фарерские острова': '234', 'Германия': '276', 'Аруба': '533', 'Объединенные Арабские Эмираты': '784', 'Дания': '208', 'Эквадор': '218', 'Фиджи': '242', 'Камерун': '120', 'Монголия': '496', 'Виргинские острова (брит.)': '92', 'Канарские о-ва': '904', 'Сан-Марино': '674', 'Сен-Бартелеми о-в': '652', 'Нигерия': '566', 'Австралия': '36', 'Мавритания': '478', 'Синт-Мартен о-в': '906', 'Болгария': '100', 'Боливия': '68', 'Парагвай': '600', 'Турция': '792', 'Венгрия': '348', 'Американское Самоа': '16', 'Буркина-Фасо': '854', 'Великобритания': '826', 'Сен-Пьер и Микелон': '666', 'Доминика': '212', 'Казахстан': '398', 'Алжир': '12', 'Филиппины': '608', 'Гайана': '328', 'Украина': '804', 'Кокосовые острова': '166', 'Гернси о-в': '831', 'Молдавия': '498', 'Бенин': '204', 'Сейшельские острова': '690', 'Хорватия': '191', 'Тунис': '788', 'Гватемала': '320', 'Словакия': '703', 'Габон': '266', 'Италия': '380', 'Науру': '520', 'Кувейт': '414', 'Мозамбик': '508', 'Малави': '454', 'Швейцария': '756', 'Палестинская территория': '275', 'Тонга': '776', 'Того': '768', 'Доминиканская республика': '214', 'Македония': '807', 'Ирак': '368', 'Конго': '178', 'Индия': '356', 'Маршалловы острова': '584', 'Таджикистан': '762', 'Бангладеш': '50', 'Нидерланды': '528', 'Ирландия': '372', 'Кабо-Верде': '132', 'Афганистан': '4', 'Уругвай': '858', 'Азорские о-ва': '901', 'Сингапур': '702', 'Венесуэла': '862', 'Мексика': '484', 'Гондурас': '340', 'Сербия': '688', 'Реюньон': '638', 'Зимбабве': '716', 'Коста-Рика': '188', 'Ливия': '434', 'Аргентина': '32', 'Самоа': '882', 'Бельгия': '56', 'Эстония': '233', 'Ямайка': '388', 'Сент-Люсия': '662', 'Бермудские острова (брит.)': '60', 'Латвия': '428', 'Багамские острова': '44', 'Монако': '492', 'Кирибати': '296', 'Мальдивы': '462', 'Вануату': '548', 'Кайман': '136', 'Лесото': '426', 'Виргинские острова (США)': '850', 'Куба': '192', 'Тайвань': '158'}


moscow_zone = {'Жуковский': '46425000', 'Серебряные Пруды': '46250551', 'Мытищинский р-н': '46234000', 'Лыткарино': '46441000', 'Котельники': '46444000', 'Талдомский р-н': '46254000', 'Приокск пгт': '46572000', 'Сергиево-Посадский р-н': '46215000', 'Павлово-Посадский р-н': '46245000', 'Дзержинский': '46231505', 'Краснознаменск': '46505000', 'Дмитров': '46415000', 'Серебряно-Прудский р-н': '46250000', 'Истра': '46433000', 'Озерский р-н': '46242000', 'Звенигород': '46430000', 'Химкинский р-н': '46255000', 'Люберецкий р-н': '46231000', 'Лобня': '46440000', 'Климовск': '46436000', 'Шаховской р-н': '46258000', 'Шатурский р-н': '46257000', 'Восход пгт': '46562000', 'Пушкино': '46461000', 'Фрязино': '46480000', 'Видное': '46407000', 'Красноармейск': '46443000', 'Чеховский р-н': '46256000', 'Серпухов': '46470000', 'Одинцовский р-н': '46241000', 'Молодежный пгт': '46560000', 'Руза': '46249501', 'Истринский р-н': '46218000', 'Рузский р-н': '46249000', 'Орехово-Зуевский р-н': '46243000', 'Можайский р-н': '46233000', 'Домодедово': '46417000', 'Черноголовка пгт': '46239568', 'Можайск': '46445000', 'Долгопрудный': '46416000', 'Кашира': '46435000', 'Юбилейный': '46493000', 'Ступинский р-н': '46253000', 'Солнечногорск': '46471000', 'Химки': '46482000', 'Орехово-Зуево': '46457000', 'Сергиев Посад': '46428000', 'Протвино': '46467000', 'Щелково': '46488000', 'Щелковский р-н': '46259000', 'Домодедовский р-н': '46209000', 'Волоколамский р-н': '46205000', 'Ленинский р-н': '46228000', 'Луховицы': '46230501', 'Одинцово': '46455000', 'Наро-Фоминский р-н': '46238000', 'Люберцы': '46442000', 'Наро-Фоминск': '46450000', 'Железнодорожный': '46424000', 'Бронницы': '46405000', 'Егорьевск': '46422000', 'Талдом': '46254501', 'Ивантеевка': '46432000', 'Волоколамск': '46408000', 'Чехов': '46484000', 'Егорьевский р-н': '46212000', 'Рошаль': '46465000', 'Пушкинский р-н': '46247000', 'Красногорск': '46439000', 'Раменское': '46463000', 'Лотошино пгт': '46229551', 'Лосино-Петровский': '46259503', 'Электросталь': '46490000', 'Дмитровский р-н': '46208000', 'Балашиха': '46404000', 'Королев': '46434000', 'Ступино': '46473000', 'Котельники пгт': '46231563', 'Коломенский р-н': '46222000', 'Серпуховский р-н': '46251000', 'Красногорский р-н': '46223000', 'Подольск': '46460000', 'Воскресенск': '46409000', 'Подольский р-н': '46246000', 'Зарайский р-н': '46216000', 'Коломна': '46438000', 'Троицк': '46475000', 'Павловский Посад': '46459000', 'Ногинск': '46451000', 'Клинский р-н': '46221000', 'Озеры': '46456000', 'Раменский р-н': '46248000', 'Солнечногорский р-н': '46252000', 'Шаховская пгт': '46258551', 'Балашихинский р-н': '46204000', 'Лотошинский р-н': '46229000', 'Электрогорск': '46245505', 'Реутов': '46464000', 'Дубна': '46418000', 'Мытищи': '46446000', 'Воскресенский р-н': '46206000', 'Пущино': '46462000', 'Каширский р-н': '46220000', 'Зарайск': '46429000', 'Ногинский р-н': '46239000', 'Клин': '46437000', 'Луховицкий р-н': '46230000', 'Шатура': '46486000', 'Щербинка': '46489000', 'Москва': '0'}

сargo = {'Екатеринбург': 'Екатеринбург авиа', 'Брянск': 'Брянск авто', 'Череповец': 'Череповец авто', 'Чебоксары': 'Чебоксары авто', 'Ижевск': 'Ижевск авто', 'Майкоп': 'Майкоп авто', 'Красноярск': 'Красноярск авто', 'Астана': 'Астана авиа', 'Барнаул': 'Барнаул авто', 'Ханты-Мансийск': 'Ханты-Мансийск авто', 'Барнаул': 'Барнаул авиа', 'Новосибирск': 'Новосибирск авто', 'Новокузнецк': 'Новокузнецк авто', 'Ростов-на-Дону': 'Ростов-на-Дону авто', 'Астрахань': 'Астрахань авиа', 'Пермь': 'Пермь авиа', 'Курск': 'Курск авто', 'Кемерово': 'Кемерово авто', 'Вологда': 'Вологда авто', 'Тула': 'Тула авто', 'Новокузнецк': 'Новокузнецк авиа', 'Нижневартовск': 'Нижневартовск авиа', 'Комсомольск-на-Амуре': 'Комсомольск-на-Амуре авиа', 'Магадан': 'Магадан авиа', 'Новый Уренгой': 'Новый Уренгой авиа', 'Ярославль': 'Ярославль авто', 'Киров': 'Киров авто', 'Астрахань': 'Астрахань авто', 'Улан-Удэ': 'Улан-Удэ авто', 'Рязань': 'Рязань авто', 'Мурманск': 'Мурманск авиа', 'Тамбов': 'Тамбов авто', 'Самара': 'Самара авто', 'Сургут': 'Сургут авто', 'Омск': 'Омск авто', 'Саратов': 'Саратов авто', 'Томск': 'Томск авиа', 'Сыктывкар': 'Сыктывкар авто', 'Белгород': 'Белгород авто', 'Анапа': 'Анапа авиа', 'Нижний Новгород': 'Нижний Новгород авто', 'Калининград': 'Калининград авиа', 'Самара': 'Самара авиа', 'Орел': 'Орел авто', 'Иваново': 'Иваново авто', 'Минеральные воды': 'Минеральные воды авиа', 'Архангельск': 'Архангельск авто', 'Тольятти': 'Тольятти авто', 'Южно-Сахалинск': 'Южно-Сахалинск авиа', 'Владивосток': 'Владивосток авиа', 'Калуга': 'Калуга авто', 'Пенза': 'Пенза авто', 'Нарьян-Мар': 'Нарьян-Мар авиа', 'Набережные челны': 'Набережные челны авто', 'Псков': 'Псков авто', 'Ханты-Мансийск': 'Ханты-Мансийск авиа', 'Екатеринбург': 'Екатеринбург авто', 'Уфа': 'Уфа авиа', 'Пятигорск': 'Пятигорск авто', 'Якутск': 'Якутск авиа', 'Краснодар': 'Краснодар авто', 'Тверь': 'Тверь авто', 'Йошкар-Ола': 'Йошкар-Ола авто', 'Владикавказ': 'Владикавказ авиа', 'Улан-Удэ': 'Улан-Удэ авиа', 'Новосибирск': 'Новосибирск авиа', 'Волгоград': 'Волгоград авто', 'Челябинск': 'Челябинск авиа', 'Новороссийск': 'Новороссийск авто', 'Пермь': 'Пермь авто', 'Красноярск': 'Красноярск авиа', 'Уфа': 'Уфа авто', 'Минск': 'Минск авиа', 'Новый Уренгой': 'Новый Уренгой авто', 'Липецк': 'Липецк авто', 'Великий Новгород': 'Великий Новгород авто', 'Магнитогорск': 'Магнитогорск авиа', 'Владимир': 'Владимир авто', 'Магнитогорск': 'Магнитогорск авто', 'Петропавловск-Камчатский': 'Петропавловск-Камчатский авиа', 'Кемерово': 'Кемерово авиа', 'Казань': 'Казань авто', 'Махачкала': 'Махачкала авиа', 'Ульяновск': 'Ульяновск авто', 'Минеральные воды': 'Минеральные воды авто', 'Нижневартовск': 'Нижневартовск авто', 'Алматы': 'Алматы авиа', 'Нижний Тагил': 'Нижний Тагил авто', 'Воронеж': 'Воронеж авто', 'Краснодар': 'Краснодар авиа', 'Ростов-на-Дону': 'Ростов-на-Дону авиа', 'Тюмень': 'Тюмень авиа', 'Сочи': 'Сочи авто', 'Архангельск': 'Архангельск авиа', 'Тюмень': 'Тюмень авто', 'Волгоград': 'Волгоград авиа', 'Сочи': 'Сочи авиа', 'Ставрополь': 'Ставрополь авто', 'Иркутск': 'Иркутск авиа', 'Старый Оскол': 'Старый Оскол авто', 'Ухта': 'Ухта авто', 'Иркутск': 'Иркутск авто', 'Санкт-Петербург': 'Санкт-Петербург авиа', 'Мурманск': 'Мурманск авто', 'Челябинск': 'Челябинск авто', 'Сургут': 'Сургут авиа', 'Томск': 'Томск авто', 'Сыктывкар': 'Сыктывкар авиа', 'Кострома': 'Кострома авто', 'Нефтеюганск': 'Нефтеюганск авто', 'Таганрог': 'Таганрог авто', 'Петрозаводск': 'Петрозаводск авто', 'Чита': 'Чита авиа', 'Хабаровск': 'Хабаровск авиа', 'Чита': 'Чита авто', 'Омск': 'Омск авиа', 'Абакан': 'Абакан авиа', 'Оренбург': 'Оренбург авто', 'Благовещенск': 'Благовещенск авиа', 'Москва': 'msk'}



delivery_dictionaries = (russia_cities, countries, moscow_zone, сargo)

originalCityName = sys.argv[1]
deliveryCityName = sys.argv[2]
weight = sys.argv[3]


def getCities(calc_type):
    payload = { "calc_type":calc_type}
    r = requests.post(url, data=payload).text
    r = lxml.html.fromstring(r).xpath("//select[@name='i_to_1']/option")
    if len(r) == 0:
        return
    cities = { }
    for city in r:
        cities[city.text.replace(' г.', '').strip('\n\r\t ')] = city.get("value")
    return cities
    
def sendRequestAndPrintPrice(calc_type):  
    global originalCityName, deliveryCityName
    if calc_type >= 2:
        if originalCityName != 'Москва' and deliveryCityName != 'Москва':
            return None
        elif deliveryCityName == 'Москва':
            originalCityName, deliveryCityName = deliveryCItyName, originalCityName
    
    originalID = delivery_dictionaries[calc_type].get(originalCityName)
    deliveryID = delivery_dictionaries[calc_type].get(deliveryCityName)
    
    if originalID == None or deliveryID == None:
        return
    
    for serviceType in services[calc_type]:
        payload = { "i_from_1":originalID,
                    "i_to_1":deliveryID,
                    "i_service_1":serviceType,
                    "i_weight_1":weight,
                    "i_tariff_1":"",
                    "x":"0",
                    "y":"0",
                    "calc_type": calc_types[calc_type]}
        data = "&".join(map(lambda x: x + "=" + payload[x], payload))
        try:
            r = requests.post(url, data=data.encode('windows-1251'));#utf-8 не понимает
            r = lxml.html.fromstring(r.text)
            price = r.xpath("//input[@name='i_tariff_1']")[0].get("value")
            if len(price) == 0 or price == "0":
                price = r.xpath("//td[@class='td_left']/div")[0].text.replace('руб.', '').strip('\n\r\t ')  
            if len(price) > 0 and price != "0":
                print(json.dumps({ "price": price,
                        "time": None,
                        "condition": None,
                        }))
        except:
            print(sys.exc_info(), file=sys.stderr)


for i in range(0, 4):
    sendRequestAndPrintPrice(i)