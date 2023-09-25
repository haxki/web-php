<?php
    class HobbiesModel {
        public function getData() {
            return [
                [
                    'img_src' => "../../public/assets/img/film.jpg", 
                    'img_alt' => "Фильмы",
                    'img_title' => "Breaking Bad",
                    'header_id' => "films",
                    'header_content' => "Фильмы и сериалы",
                    'description' => 'Смотрели "Во все тяжкие"? А "Лучше звоните Солу"? Нет? Ну и ладно...'
                ],
                [
                    'img_src' => "../../public/assets/img/game.jpg", 
                    'img_alt' => "Игры",
                    'img_title' => "God of War",
                    'header_id' => "games",
                    'header_content' => "Компьютерные игры",
                    'description' => "Играть все любят, а я так вообще. Устраиваю фотосессии игровых косплеев по четвергам."
                ],
                [
                    'img_src' => "../../public/assets/img/music.jpg", 
                    'img_alt' => "Музыка",
                    'img_title' => "Dying Fetus",
                    'header_id' => "music",
                    'header_content' => "Музыка",
                    'description' => "Дрынькаю на гитаре в свободное время."
                ]
            ];
        }
    }