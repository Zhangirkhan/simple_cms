'use strict';

// Модуль приложения
var app = (function ($) {

    // Инициализируем нужные переменные
    var ajaxUrl = 'ajax.php',
        ui = {
            $categories: $('#categories'),
            $goods: $('#goods')
        };

    // Инициализация дерева категорий с помощью jstree
    function _initTree(data) {
        var category;
        ui.$categories.jstree({
            core: {
                check_callback: true,
                multiple: false,
                data: data
            },
            plugins: ['dnd']
        });
    }


    // Загрузка категорий с сервера
    function _loadData() {

        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            action: 2222222,
            success: function (resp) {
                // Инициализируем дерево категорий
                console.log(resp);
                // if (resp.code === 'success') {
                //     _initTree(resp.result);
                // } else {
                //     console.error('Ошибка получения данных с сервера: ', resp.message);
                // }
            },
            error: function (error) {
                console.error('Ошибка: ', error);
            }
        });

        jQuery.post(
            "ajax.php", {
            type: "html-request",
            action: 2222222,
            method: 'POST',
        },
            on_loadData()
        );
    }

    function on_loadData(data) {
        if (data.code === 'success') {
            _initTree(data.result);
        } else {
            console.error('Ошибка получения данных с сервера: ', data.message);
        }
    }

    // Инициализация приложения
    function init() {
        _loadData();
    }

    // Экспортируем наружу
    return {
        init: init
    }

})(jQuery);

jQuery(document).ready(app.init);
