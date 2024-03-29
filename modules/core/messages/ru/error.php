<?php
/**
 * Наши правила:
 * 1) При добавлении перевода сперва пользуемся поиском Ctrl+F (Такая фраза мб уже есть)
 * 2) Не добавляем фразы, которые не будут использоваться
 * 3) Если все таки хотите добавить фразу, добавляем её в логическую группу
 *
 * В этом словаре фразы ошибок валидации, сообщения для исключений
 */

return [
    "The requested page does not exist." => "Запрашиваемая страница не существует.",
    "The user is not associated with a student." => "Пользователь не привязан к студенту.",

    //UserError
    "Error validation" => "Ошибка валидации",
    "User creation error" => "Ошибка создания пользователя",

    //StudentError
    "Student creation error" => "Ошибка создания студента",
    "Student not enabled" => "Студент не активирован",
    "Student not disable" => "Студент не заархивирован",

    //DisciplineError
    "Discipline creation error" => "Ошибка создания дисциплины",
    "Discipline not enabled" => "Дисциплина не активирована",
    "Discipline not disable" => "Дисциплина не заархивирована",

    //DirectionError
    "Direction creation error" => "Ошибка создания направления",
    "Direction not updated" => "Направление не изменено",
    "Direction not enabled" => "Направление не активировано",
    "Direction not disable" => "Направление не заархивировано",
    "Direction not deleted" => "Направление не удалено",



    //API ERROR
    "Student id parameter not specified" => "Id студента не передано",
    "Student not found" => "Студент не найден",
];