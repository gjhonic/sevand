<?php
/**
 * Наши правила:
 * 1) При добавлении перевода сперва пользуемся поиском Ctrl+F (Такая фраза мб уже есть)
 * 2) Не добавляем фразы, которые не будут использоваться
 * 3) Если все таки хотите добавить фразу, добавляем её в логическую группу
 *
 * В этом словаре фразы не больше 4-5 слов, Толстого не включаем
 */

return [
    //Стандартные слова
    "SEVAND" => "СЕВАНД",
    "Add" => "Добавить",
    "Save" => "Сохранить",
    "Update" => "Изменить",
    "Delete" => "Удалить",
    "Title" => "Название",
    "Short title" => "Короткое название",
    "Description" => "Описание",
    "Created at" => "Добавлен",
    "Updated at" => "Изменен",
    "Log in as a guest" => "Войти как гость",
    "Personal account" => "Личный кабинет",
    "Remember me" => "Запомни меня",
    "Go out" => "Выйти",
    "Stay" => "Остаться",
    "Show" => "Смотреть",
    "Edit" => "Редактировать",
    "Editing" => "Редактирование",
    "Active" => "Активный",
    "Not active" => "Не активный",
    "Archive" => "Архивный",
    "To archive" => "Архивировать",
    "Action column" => "Колонка действий",
    "Message" => "Сообщение",
    "Cancel" => "Отмена",
    "Go" => "Перейти",
    "Deactivate" => "Деактивировать",
    "Activate" => "Активировать",
    "Not set" => "Не задано",
    "In" => "В",
    "in" => "в",
    "From" => "От",
    "To" => "К",
    "Transfer" => "Перевод",
    "Transferred" => "Перевел",
    "For example" => "Например",

    //Меню
    "Menu" => "Меню",
    "Home page" => "Главная страница",
    "Main" => "Главная",
    "Profile" => "Профиль",
    "Create a raffle" => "Создать конкурс",
    "Settings" => "Настройки",
    "Sign out" => "Выход",
    "Admin panel" => "Админка",
    "Root panel" => "Root панель",
    "Sign in" => "Войти",
    "Dictionaries" => "Справочники",
    "Base" => "База",
    "Bases" => "Базы",
    "My group" => "Моя группа",

    //Базы
    "User base" => "База пользователей",
    "Count user" => "Количество пользователей",
    "Student base" => "База студентов",
    "Count students" => "Количество студентов",
    "Group base" => "База групп",
    "Count groups" => "Количество групп",
    "Watch groups" => "Смотреть группы",
    "Watch courses" => "Смотреть курсы",
    "Count courses" => "Количество курсов",
    "Watch disciplines" => "Смотреть дисциплины",
    "Discipline base" => "База дисциплин",
    "Count discipline" => "Количество дисциплин",
    "Direction base" => "База направлений",
    "Count direction" => "Количество направлений",
    "Watch directions" => "Смотреть направления",
    "Students Transfer Log" => "Журнал перевода студентов",


    //Сущности
    "University" => "Университет",
    "Universities" => "Университеты",
    "Department" => "Факультет",
    "Departments" => "Факультеты",
    "Direction" => "Направление",
    "Directions" => "Направления",
    "Course" => "Курс",
    "Courses" => "Курсы",
    "User" => "Пользователь",
    "Users" => "Пользователи",
    "Discipline" => "Дисциплина",
    "Disciplines" => "Дисциплины",
    "Group" => "Группа",
    "Groups" => "Группы",
    "Students" => "Студенты",
    "Module" => "Модуль",
    "Modules" => "Модули",
    "Log" => "Лог",
    "Logs" => "Логи",

    //Про Университет
    "Create University" => "Добавить университет",
    "Update University: {name}" => "Редактирование университета: {name}",

    //Про Факультет
    "Create Department" => "Добавить вакультет",
    "Update Department: {name}" => "Редактирование факультета: {name}",

    //Про Направление
    "Create Direction" => "Добавить направление",
    "Editing Direction: {name}" => "Редактирование направления: {name}",

    //Про Курс
    "Create Course" => "Добавить курс",
    "Update Course: {name}" => "Редактировать курс: {name}",

    //Про Дисциплину
    "Create Discipline" => "Добавить дисциплину",
    "Generate disciplines" => "Сгенерировать дисциплины",
    "Editing Discipline: {name}" => "Редактирование дисциплины: {name}",

    //Про пользователя
    "Create User" => "Добавить пользователя",
    "Update User: {name}" => "Редактировать пользователя: {name}",
    "Name" => "Имя",
    "Surname" => "Фамилия",
    "Patronymic" => "Отчество",
    "Username" => "Имя пользователя",
    "Login" => "Логин",
    "Password" => "Пароль",
    "Role" => "Роль",
    "Status" => "Статус",
    "Activity" => "Активность",
    "Full name" => "ФИО",
    "Gender" => "Пол",
    "Male" => "Мужской",
    "Female" => "Женский",

    //Статусы логов
    "info" => "информационный",
    "success" => "успех",
    "warning" => "внимание",
    "danger" => "опасность",
    "crazy" => "критично",

    //Про студента
    "Create Student" => "Добавить студента",
    "Update Student: {name}" => "Редактировать студента: {name}",
    "Transfer Student" => "Перевести студента",
    "Transfer from" => "Перевести из",

    //Про Группы
    "Create Group" => "Добавить группу",
    "Update Group: {name}" => "Редактировать группу: {name}",
    "Group From" => "Группа из",
    "Group To" => "Группа в",

    //Про историю переводов
    "View history transfer" => "Смотреть историю переводов",
    "View history transfer student" => "Смотреть историю перевода студента",

    //Роли
    "Root" => "Root",
    "Admin" => "Админ",
    "Moderator" => "Модератор",
    "Curator" => "Куратор",
    "Headman" => "Староста",
    "Student" => "Студент",

    //Языки
    "English" => "Английский",
    "Russian" => "Русский",

    "Message with translation" => "Соощение с переводом",
];