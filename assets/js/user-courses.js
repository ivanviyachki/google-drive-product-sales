jQuery(document).ready(function() {
    var table = jQuery('#example').DataTable( {
        "columns": [
            { "data": "name" },
            { "data": "type" },
            { "data": "end_time" },
            { "data": "view_url" }
        ],
        pageLength: 50,
        fixedHeader: true,
        responsive: true,
        language: {
            "emptyTable": "Вашите курсове се зареждат, моля изчакайте... ",
            "processing": "Обработка на резултатите...",
            "lengthMenu": "Показване на _MENU_ резултата",
            "zeroRecords": "Няма намерени резултати",
            "info": "Показване на резултати от _START_ до _END_ от общо _TOTAL_",
            "infoEmpty": "Показване на резултати от 0 до 0 от общо 0",
            "infoFiltered": "(филтрирани от общо _MAX_ резултата)",
            "search": "Търсене:",
            "paginate": {
                "first": "Първа",
                "previous": "Предишна",
                "next": "Следваща",
                "last": "Последна"
            },
            "aria": {
                "sortAscending": "сортирай възходящо",
                "sortDescending": "сортирай низходящо"
            },
            "autoFill": {
                "cancel": "Oткажи",
                "fill": "Попълни всички клетки с <i>%d<i><\/i><\/i>",
                "fillHorizontal": "Попълни хоризонтални клетки",
                "fillVertical": "Попълни вертикални клетки"
            },
            "searchBuilder": {
                "add": "Добави",
                "deleteTitle": "Изтрий критериите за търсене",
                "clearAll": "Изчисти всичко",
                "condition": "Правило",
                "conditions": {
                    "array": {
                        "contains": "Съдържа",
                        "empty": "Празно",
                        "equals": "Еднакво с",
                        "not": "Различно от",
                        "notEmpty": "Не е празно",
                        "without": "Без"
                    },
                    "date": {
                        "after": "След",
                        "before": "Преди",
                        "between": "Между",
                        "empty": "Празно",
                        "equals": "Равна на",
                        "not": "Различна от",
                        "notBetween": "Не е между",
                        "notEmpty": "Не е празно"
                    },
                    "number": {
                        "between": "Между",
                        "empty": "Празно",
                        "equals": "Равно",
                        "gt": "Над",
                        "gte": "Над или равно",
                        "lt": "Под",
                        "lte": "Под или равно",
                        "not": "Различно от",
                        "notBetween": "Не е между",
                        "notEmpty": "Не е празно"
                    },
                    "string": {
                        "contains": "Съдържа",
                        "empty": "Празно",
                        "endsWith": "Завършва с",
                        "equals": "Еднакво с",
                        "not": "Различно от",
                        "notEmpty": "Не е празно",
                        "startsWith": "Започва с"
                    }
                },
                "data": "Поле",
                "logicAnd": "И",
                "logicOr": "Или",
                "value": "Стойност"
            },
            "searchPanes": {
                "clearMessage": "Изтрий всички",
                "emptyPanes": "Няма SearchPanes",
                "loadMessage": "Зареждане...",
                "title": "Активни филтри - %d"
            },
            "buttons": {
                "collection": "Колекция",
                "colvis": "Показване\/Скриване на колони",
                "colvisRestore": "Показване на всички колони",
                "copy": "Копиране",
                "copyKeys": "Натисни <i>ctrl или u2318 + C за да копираш данните от таблицата.<br \/> За да отмените, щракнете върху това съобщение или натиснете <i>escape<\/i>.<\/i>",
                "copySuccess": {
                    "_": "Копирани %ds реда",
                    "1": "Копиран един ред"
                },
                "copyTitle": "Копиране в буфера",
                "pageLength": {
                    "_": "Покажи %d реда",
                    "-1": "Покажи всички редове"
                },
                "print": "Принтиране"
            },
            "datetime": {
                "hours": "Часове",
                "minutes": "Минути",
                "months": {
                    "0": "Януари",
                    "1": "Февруари",
                    "10": "Ноември",
                    "11": "Декември",
                    "2": "Март",
                    "3": "Април",
                    "4": "Май",
                    "5": "Юни",
                    "6": "Юли",
                    "7": "Август",
                    "8": "Септември",
                    "9": "Октомври"
                },
                "next": "Напред",
                "previous": "Назад",
                "seconds": "Секунди",
                "weekdays": [
                    "Нед",
                    "Пон",
                    "Вт",
                    "Ср",
                    "Четв",
                    "Пет",
                    "Съб"
                ]
            },
            "editor": {
                "close": "Затвори",
                "create": {
                    "button": "Нов запис",
                    "submit": "Създай",
                    "title": "Създай нов запис"
                },
                "edit": {
                    "button": "Промени",
                    "submit": "Промени",
                    "title": "Промени запис"
                },
                "error": {
                    "system": "Грешка в системата!"
                },
                "multi": {
                    "info": "Избраните елементи съдържат различни стойности за това поле. За да редактирате и зададете всички елементи за това поле на една и съща стойност, щракнете или докоснете тук, в противен случай те ще запазят своите индивидуални стойности.",
                    "noMulti": "Това полеможе да се редактира индивидуално, но не е част от група.",
                    "restore": "Отмяна на промените",
                    "title": "Множество стойности"
                },
                "remove": {
                    "button": "Изтрий",
                    "confirm": {
                        "_": "Сигурни ли сте, че искате да изтриете %d реда?",
                        "1": "Сигурни ли сте, че искате да изтриете 1 ред?"
                    },
                    "submit": "Изтрий",
                    "title": "Изтрий запис"
                }
            },
            "loadingRecords": "Зареждане...",
            "select": {
                "cells": {
                    "_": "%d избрани клетки",
                    "1": "%d избрана клетка"
                },
                "columns": {
                    "_": "%d избрани колони",
                    "1": "%d избрана колона"
                },
                "rows": {
                    "_": "%d избрани реда",
                    "1": "%d избран ред"
                }
            }
 
        }
    } );

    jQuery.ajax({
        url: restData.rest_url,
        dataType: '',
        type: "GET",
        success: function(json){
            table.rows.add(json.data).draw();

            todayDate = jQuery('.today').attr('unix');
            
            jQuery(".datata").each(function(){
               Datte = jQuery(this).attr('unix');

               if(Datte < todayDate){
                   jQuery(this).addClass("expired");
                   jQuery(this).parent().parent().addClass("expired__td");
                   jQuery(this).parent().parent().find(".view__course").remove();
               } else {
                   jQuery(this).parent().parent().addClass("active__td");
               }
            });

            jQuery(".subs").each(function(){
                jQuery(this).parent().parent().addClass("subscribe__access");
            });
            jQuery(".oneoff").each(function(){
                jQuery(this).parent().parent().addClass("oneoff__access");
            });

        }
    });
    jQuery(document).on('click','.paginate_button',function(){
        todayDate = jQuery('.today').attr('unix');
        jQuery(".datata").each(function(){
           Datte = jQuery(this).attr('unix');
           if(Datte < todayDate){
               jQuery(this).addClass("expired");
               jQuery(this).parent().parent().addClass("expired__td");
               jQuery(this).parent().parent().find(".view__course").remove();
           } else {
               jQuery(this).parent().parent().addClass("active__td");
           }
        });
        jQuery(".subs").each(function(){
            jQuery(this).parent().parent().addClass("subscribe__access");
        });
        jQuery(".oneoff").each(function(){
            jQuery(this).parent().parent().addClass("oneoff__access");
        });
        jQuery(".book").each(function(){
            jQuery(this).parent().parent().addClass("boooks__access");
        });
        
    });
    
    jQuery('.dataTables_filter input[type="search"]').change(function() {
        todayDate = jQuery('.today').attr('unix');
        jQuery(".datata").each(function(){
           Datte = jQuery(this).attr('unix');
           if(Datte < todayDate){
               jQuery(this).addClass("expired");
               jQuery(this).parent().parent().addClass("expired__td");
               jQuery(this).parent().parent().find(".view__course").remove();
           } else {
               jQuery(this).parent().parent().addClass("active__td");
           }
        });
        jQuery(".subs").each(function(){
            jQuery(this).parent().parent().addClass("subscribe__access");
        });
        jQuery(".oneoff").each(function(){
            jQuery(this).parent().parent().addClass("oneoff__access");
        });
        jQuery(".book").each(function(){
            jQuery(this).parent().parent().addClass("boooks__access");
        });
    });
    
    
    jQuery(document).on('click','.types__courses__single__active',function(){
        jQuery("#example tbody>tr").hide();
        jQuery(".active__td.oneoff__access").show();
        jQuery('.types__courses__single').removeClass('tcsactive');
        jQuery(this).addClass('tcsactive');
    });
    jQuery(document).on('click','.types__courses__single__expired',function(){
        jQuery("#example tbody>tr").hide();
        jQuery(".expired__td.oneoff__access").show();
        jQuery('.types__courses__single').removeClass('tcsactive');
        jQuery(this).addClass('tcsactive');
    });
    jQuery(document).on('click','.types__courses__single__subs',function(){
        jQuery("#example tbody>tr").hide();
        jQuery(".subscribe__access").show();
        jQuery('.types__courses__single').removeClass('tcsactive');
        jQuery(this).addClass('tcsactive');
    });
    jQuery(document).on('click','.types__courses__single__boooks',function(){
        jQuery(".book").each(function(){
            jQuery(this).parent().parent().addClass("boooks__access");
        });
        jQuery("#example tbody>tr").hide();
        jQuery(".boooks__access").show();
        jQuery('.types__courses__single').removeClass('tcsactive');
        jQuery(this).addClass('tcsactive');
    });
    jQuery(document).on('click','.types__courses__single__all',function(){
        jQuery("#example tbody>tr").show();
        jQuery('.types__courses__single').removeClass('tcsactive');
        jQuery(this).addClass('tcsactive');
    });
} );