<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
<style>
    .dataTable th:after {
        content: "\f338";
        font-weight: 900;
        font-family: "Font Awesome 5 Free";
        position: absolute;
        right: 10px;
        border-right: 1px solid;
        padding-right: 10px;
    }
    .dataTable th {
        position: relative;
        cursor: pointer;
    }
    .dataTable {
        margin: 30px 0;
        width: 100% !important;
        display: block;
    }
    .dataTable tbody {
        display: block;
    }
    .dataTable thead, .dataTable tfoot {
        background: #a56798;
        padding: 10px 10px !important;
        color: #FFF;
        font-weight: 400 !important;
        border-radius: 5px !important;
        display: block;
    }
    .dataTable tr {
        width: 100% !important;
        display: block;
    }

    .dataTable th, .dataTable td {
        font-size: 14px;
        font-weight: 300;
        display: inline-block;
    }
    .dataTable th:nth-of-type(1), .dataTable td:nth-of-type(1) {
        width: 50% !important;
    }
    .dataTable th:nth-of-type(2), .dataTable td:nth-of-type(2) {
        width: 18% !important;
    }
    .dataTable th:nth-of-type(3), .dataTable td:nth-of-type(3) {
        width: 15% !important;
    }
    .dataTable th:nth-of-type(4), .dataTable td:nth-of-type(4) {
        width: 17% !important;
    }

    tbody tr {
        background: #FFF !important;
        margin: 15px 0;
        border: 1px solid #DADADA;
        border-radius: 5px;
        padding: 20px 15px;
    }

    tbody tr td:nth-of-type(1) {
        font-weight: 600;
        font-size: 18px;
        color: #494949;
        line-height: 109.4%;
    }

    .view__course {
        border: 1px solid #A87BA1;
        border-radius: 5px;
        padding: 10px 12px;
        font-weight: 600;
        font-size: 16px;
        line-height: 22px;
        color: #A87BA1;
        text-align: center;
        word-break: break-all;
    }
    .view__course:hover {
        background: #A87BA1 !important;
        color: #FFF !important;
    }
    .oneoff {
        border: 1px solid #ECB200;
        border-radius: 100px;
        color: #ECB200;
        padding: 6px 15px;
    }
    .book {
        border: 1px solid red;
        border-radius: 100px;
        color: red;
        padding: 6px 15px;
    }
    .subs {
        border: 1px solid #069e2b;
        border-radius: 100px;
        color: #069e2b;
        padding: 6px 15px;
    }
    .dataTables_info {
        font-size: 14px;
        font-style: italic;
        text-align: right;
    }

    .previous {
        position: absolute;
        left: 0;
    }

    .dataTables_paginate {
        position: relative;
        margin-top: 30px;
    }

    .next {
        position: absolute;
        right: 0;
    }

    .paginate_button {
        border: 1px solid #666263;
        border-radius: 5px;
        padding: 5px 7px;
        font-size: 10px;
        cursor: pointer;
        background: #FFF;
    }

    .dataTables_paginate>span {
        text-align: center;
        display: block;
    }

    .expired {
        color: red;
        position: relative;
    }

    .expired:after {
        content: 'ИЗТЕКЪЛ';
        position: absolute;
        top: -20px;
        right: -10px;
        background: red;
        border-radius: 5px;
        color: #FFF;
        font-size: 8px;
        padding: 4px;
    }
    .expired__td {
        opacity: 0.7;
    }
    .view__course {
        display: none;
    }
    .active__td .view__course {
        display: block;
    }
    .dataTables_length {
        width: 50%;
        float: left;
        display: inline-block;
        font-weight: 400;
        font-size: 16px;
        color: #777373;
    }

    .dataTables_filter {
        width: 50%;
        font-weight: 400;
        font-size: 16px;
        color: #777373;
        clear: both;
        display: inline-block;
    }

    .dataTables_filter input[type="search"] {
        border: 1px solid #777373;
        border-radius: 5px;
        padding: 0px 20px;
        height: 28px;
        margin-left: 20px;
    }

    .types__courses {
        margin-bottom: 20px;
        gap: 30px;
        border-bottom: 2px solid #DADADA;
    }

    .types__courses>a {
        border-bottom: 2px solid transparent;
        color: #777373;
        font-size: 16px;
        margin-bottom: -2px;
        cursor: pointer;
    }

    .tcsactive {
        color: #494949 !important;
        font-weight: 600 !important;
        border-color: #a56798 !important;
    }

    /** Phone  - 607px **/
    @media screen and (max-width: 607px) {
        tbody tr td:nth-of-type(1) {
            font-size: 10px;
        }
        .oneoff,.subs {
            font-size: 10px;
            padding: 3px 6px;
        }
        .dataTable th, .dataTable td {
            font-size: 11px;
        }
        .dataTable th:nth-of-type(1), .dataTable td:nth-of-type(1) {
            width: 25% !important;
        }
        .dataTable th:nth-of-type(2), .dataTable td:nth-of-type(2) {
            width: 30% !important;
        }
        .dataTable th:nth-of-type(3), .dataTable td:nth-of-type(3) {
            width: 20% !important;
        }
        .dataTable th:nth-of-type(4), .dataTable td:nth-of-type(4) {
            width: 25% !important;
        }
        .active__td .view__course {
            font-size: 11px;
            text-align: center;
        }
    }
</style>

<?php
//include('gotissue.php');
;?>

<p class="alert alert-danger" style="margin-bottom: 70px;
">
    ВАЖНО: Долната таблица показва всички ваши закупени достъпи за последните 12 месеца. Ако се нуждаете от справка за назад във времето, моля използвайте рефеернциите в "Поръчки".
</p>

<p class="today" unix="<?php echo strtotime( date( "d-M-Y" ) );?>"></p>

<div class="d-flex types__courses">
    <a class="types__courses__single tcsactive types__courses__single__all">Всички</a>
    <a class="types__courses__single types__courses__single__active">Активни</a>
    <a class="types__courses__single types__courses__single__expired">Изтекли</a>
    <a class="types__courses__single types__courses__single__subs">Абонамент</a>
    <a class="types__courses__single types__courses__single__boooks">Книги</a>
</div>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Име</th>
            <th>Вид</th>
            <th>Крайна дата</th>
            <th>Достъп</th>
        </tr>
    </thead>
</table>

<p class="alert alert-danger" style="margin-top: 70px;
">
    ВАЖНО: Горната таблица показва всички ваши закупени достъпи за последните 12 месеца. Ако се нуждаете от справка за назад във времето, моля използвайте рефеернциите в "Поръчки".
</p>