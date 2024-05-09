-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 10 2024 г., 02:07
-- Версия сервера: 5.7.44-log
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `course`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id_articles` int(11) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text_articles` text NOT NULL COMMENT 'текст статьи',
  `status` tinyint(4) NOT NULL,
  `date_articles` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата публикации',
  `view` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Статьи';

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id_articles`, `id_category`, `id_user`, `img`, `title`, `text_articles`, `status`, `date_articles`, `view`) VALUES
(82, 3, 57, '1672835053_image_8.jpg', 'Как вручную скачать и установить Java для компьютера под управлением Windows?', '<p>Загрузка и установка Рекомендуется перед началом установки через Интернет отключить брандмауэр. В некоторых случаях настройки брандмауэра по умолчанию запрещают любые автоматические установки или установки через Интернет (такие как установка Java через Интернет). Если брандмауэр не настроен соответствующим образом, он в некоторых случаях может заблокировать скачивание/установку Java. Инструкции по отключению брандмауэра см. в документации брандмауэра. Перейдите на страницу скачивания вручную Нажмите кнопку Windows Online (Windows Установка из сети) Откроется диалоговое окно (Загрузка файла), где предлагается выполнить или сохранить загружаемый файл.&nbsp; Чтобы запустить программу установки, нажмите кнопку Run (Запустить). Чтобы сохранить файл для установки, которую необходимо выполнить позднее, щелкните Сохранить.&nbsp; Выберите местоположение папки и сохраните файл в локальной системе.&nbsp; Подсказка. Сохраните файл на компьютере, например, на рабочем столе. Чтобы запустить процесс установки, дважды щелкните на сохраненном файле. Начнется процесс установки. Нажмите кнопку Install (Установить), чтобы принять условия лицензионного соглашения и продолжить установку. &nbsp; Компания Oracle сотрудничает компаниями, предлагающими различные продукты. Во время установки Java может быть предложено установить такие программы. Проверьте, что нужные программы выбраны, и нажмите кнопку Next (Далее) для продолжения установки. Появятся несколько диалоговых окон с запросами подтверждения последних этапов установки; в последнем диалоговом окне нажмите кнопку Close (Закрыть). Процедура установки Java завершена.</p>', 1, '2023-01-02 22:20:12', 33),
(83, 1, 57, '1672835037_image_5.jpg', 'Создание виртуальной машины с помощью Hyper-V в среде Windows 10 Creators Update', '<p>Виртуальные машины представляют собой эмуляцию устройств на другом устройстве или, в контексте этой статьи и упрощенно, позволяют запускать виртуальный компьютер (как обычную программу) с нужной операционной системой на вашем компьютере с той же или отличающейся ОС. Например, имея на своем компьютере Windows, вы можете запустить Linux или другую версию Windows в виртуальной машине и работать с ними как с обычным компьютером.</p><p>В этой инструкции для начинающих подробно о том, как создать и настроить виртуальную машину VirtualBox (полностью бесплатное ПО для работы с виртуальными машинами в Windows, MacOS и Linux), а также некоторые нюансы по использованию VirtualBox, которые могут оказаться полезными. Кстати, в Windows 10 Pro и Enterprise есть встроенные средства для работы с виртуальными машинами, см. <a href=\"https://remontka.pro/hyper-v-windows-10/\">Виртуальные машины Hyper-V в Windows 10</a>. Примечание: если на компьютере установлены компоненты Hyper-V, то VirtualBox будет сообщать об ошибке&nbsp;Не удалось открыть сессию для виртуальной машины, о том как это обойти: <a href=\"https://remontka.pro/virtualbox-hyperv-same-system/\">Запуск VirtualBox и Hyper-V на одной системе</a>.</p><p>Для чего это может потребоваться? Чаще всего, виртуальные машины используют для запуска серверов или для тестирования работы программ в различных ОС. Для начинающего пользователя такая возможность может быть полезна как для того, чтобы попробовать в работе незнакомую систему или, например, для запуска сомнительных программ без опасности получить вирусы на своем компьютере.</p>', 1, '2023-01-02 22:22:16', 4),
(84, 1, 57, '1672689580_image_1.jpg', 'Тестовая запись', '<p>123456789</p>', 1, '2023-01-02 22:59:40', 0),
(88, 5, 57, '1673269669_UX.jpg', 'Все о профессии UI/UX дизайнера', '<p><strong>UI/UX дизайнер</strong> — это креативный специалист, который проектирует пользовательские интерфейсы. UI и UX — это два разных профиля дизайна, но чаще всего задачи по обоим направлениям тесно связаны между собой, а потому их делает один универсальный специалист.&nbsp;</p><p>&nbsp; &nbsp; Такая профессия имеет долгую историю. Любую настройку внешнего вида товара (упаковка, эргономичность, наружная реклама) можно назвать UI/UX-дизайном, ведь с его помощью конечный продукт становился удобным для покупателя. Разница только в одном — современные UI/UX дизайнеры используют современные инструменты. Как правило, UI-дизайнер работает в дуэте с UX-ом, но по последним тенденциям обязанности обоих сотрудников стал выполнять один человек — UI/UX дизайнер. UI («User Interface») — «пользовательский интерфейс», а UX («user experience») — это «пользовательский опыт».&nbsp;</p><p>&nbsp; &nbsp; UI-дизайнер отвечает за визуализацию приложения, делая его удобным и функциональным. Дабы продукт с комфортом воспринимался глазами пользователя, специалист UI отвечает за подбор форм, цветов и других параметров. Что касается UX-дизайнера, он в большей степени ответственен за функциональность дизайна. В итоге: приложением легко и удобно пользоваться.<br>&nbsp;</p><p><strong>UI-дизайн</strong> — это работа над графической частью интерфейса. Сюда относятся анимации, фотографии, иллюстрации, кнопки, меню, шрифты, слайдеры.</p><p>Главная задача UI-дизайнера — помочь типичному пользователю быстро и легко понять, как пользоваться продуктом. Это может быть сайт, приложение, платежный терминал, пульт от телевизора, духовка. В любом продукте интерфейс должен быть выполнен на основе требований и правил, общих для каждого типа гаджетов.</p><p>UI-дизайнер “дирижирует” объектами в интерфейсе и проверяет:&nbsp;</p><ul><li>правильно ли работает выпадающее меню&nbsp;</li><li>удобно ли нажимать «Заказать»&nbsp;</li><li>хорошо ли читается текст со смартфона&nbsp;</li><li>легко ли заполнять форму&nbsp;</li><li>верное ли сообщение выдает сайт при действии<br><br>&nbsp;</li></ul>', 1, '2023-01-09 16:07:49', 6),
(90, 3, 57, '1677512695_ricardo.png', 'Как правильно флексить', '<p><strong>123123123</strong></p>', 1, '2023-01-10 18:35:00', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `text` text NOT NULL,
  `id_send` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `id_users`, `text`, `id_send`, `date`) VALUES
(1, 85, 'Купил сегодня курс по программированию, кто поможет мне, пройти 3 задание', NULL, '2023-02-27 23:56:57'),
(37, 86, 'как тебе курс по программированию?', 1, '2023-03-02 22:32:30'),
(38, 85, 'д в целом очень даже нечего', 37, '2023-03-02 22:33:06'),
(39, 85, 'Тестовый комментарий', NULL, '2023-03-02 22:38:57'),
(40, 85, 'Можно просто начать гасить мальстремовцев, как только зашел на фабрику. Как раз там турели неплохие при входе. Оторвал, да пошел их в фарш нашинковывать. Фабрика мяса все-таки.', NULL, '2023-03-02 22:40:57'),
(45, 72, 'тест 1', 39, '2023-03-03 00:22:11'),
(46, 72, 'тест 2', 45, '2023-03-03 00:22:16'),
(54, 70, 'как дела?', NULL, '2023-03-03 20:08:14'),
(66, 84, 'Тестовое сообщение', NULL, '2023-03-16 12:25:56'),
(67, 86, '123', 66, '2023-03-16 12:35:24'),
(68, 89, '1234567', NULL, '2023-06-04 14:22:18'),
(69, 89, '', NULL, '2023-06-04 14:23:15');

-- --------------------------------------------------------

--
-- Структура таблицы `chat_content_course`
--

CREATE TABLE `chat_content_course` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `text` text NOT NULL,
  `id_send` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_content` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat_content_course`
--

INSERT INTO `chat_content_course` (`id`, `id_users`, `text`, `id_send`, `date`, `id_content`) VALUES
(6, 89, '123456789', NULL, '2023-06-04 16:00:47', 35),
(8, 89, 'Все очень понятно и доступно', NULL, '2023-06-04 17:33:18', 31),
(23, 94, 'Текстовое сообщение', NULL, '2023-06-08 01:22:28', 31),
(24, 94, 'привет test, как тебе данный курс?', 8, '2023-06-08 01:34:49', 31);

-- --------------------------------------------------------

--
-- Структура таблицы `comments_articles`
--

CREATE TABLE `comments_articles` (
  `id_comments_articles` int(12) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `page` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comments_articles`
--

INSERT INTO `comments_articles` (`id_comments_articles`, `status`, `page`, `email`, `comment`, `created_date`) VALUES
(42, 1, 84, '123@123', '<p>Крутой и познавательный пост</p>', '2023-01-03 14:55:57'),
(106, 1, 82, '1234@1234', '123456789', '2023-01-08 23:36:30'),
(107, 1, 83, '1234@1234', '1234567890', '2023-01-08 23:36:59'),
(110, 1, 82, '1234@1234', 'все хорошо', '2023-01-10 13:38:51'),
(111, 1, 83, '1234@1234', '<p>Самый лучший пост&nbsp;</p>', '2023-01-10 18:25:00');

-- --------------------------------------------------------

--
-- Структура таблицы `content_course`
--

CREATE TABLE `content_course` (
  `id_content_course` int(11) NOT NULL COMMENT 'ID пункта курса',
  `name_item_course` varchar(255) NOT NULL,
  `id_courses` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Содержание курса';

--
-- Дамп данных таблицы `content_course`
--

INSERT INTO `content_course` (`id_content_course`, `name_item_course`, `id_courses`, `number`, `content`) VALUES
(3, 'Содержание', 30, NULL, NULL),
(4, 'Итоговый проект: веб-вёрстка', 30, NULL, NULL),
(5, 'Итоговый проект: Система управления контактами', 30, NULL, NULL),
(6, 'Итоговый проект: Интернет-магазин', 30, NULL, NULL),
(7, 'Содержание', 32, NULL, NULL),
(8, 'Итоговая работа:Создать игру', 32, NULL, NULL),
(16, 'Лекции 28ч', 28, NULL, NULL),
(17, 'Практика 60ч', 28, NULL, NULL),
(18, 'Верстка каталога в InDesign', 28, NULL, NULL),
(19, 'Плакат PRO: создание постера для музыкального агентства', 28, NULL, NULL),
(20, 'Айдентика: разбор особенностей логотипа и фирменного стиля', 28, NULL, NULL),
(21, 'Создание айдентики для пекарни', 28, NULL, NULL),
(22, 'Введение в UX-дизайн', 31, NULL, NULL),
(23, 'UX-проектирование. Паттерны и психология', 31, NULL, NULL),
(24, 'UI/Визуальная концепция', 31, NULL, NULL),
(25, 'Дизайн на основе данных', 31, NULL, NULL),
(26, 'Успешная презентация', 31, NULL, NULL),
(31, 'Арифметические операции', 27, 1, '<p>На базовом уровне компьютеры оперируют только числами. Даже в прикладных программах на высокоуровневых языках внутри много чисел и операций над ними. К счастью, для старта достаточно знать обычную арифметику &mdash; с нее и начнем.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img src=\"https://cdn2.hexlet.io/store/derivatives/original/b15bc8e03ae129a8368b44fdc944a054.png\" style=\"height:380px; width:850px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">Для сложения двух чисел в математике мы пишем, например, <code>3 + 4</code>. В программировании &mdash; то же самое. Вот программа, складывающая два числа:</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\"><code><em><span style=\"color:#95a5a6\">// Не забываем точку с запятой в конце,<br />\r\n// так как каждая строчка в коде &ndash; инструкция</span></em><br />\r\n<span style=\"color:#1abc9c\">3 + 4</span>;</code></div>\r\n\r\n<p style=\"text-align:justify\">Инструкция <code><span style=\"color:#e74c3c\">3 + 4</span>;</code> заставит компьютер сложить числа и узнать результат. Если запустить эту программу, то ничего не произойдет. А если быть точными, то компьютер вычислит сумму, но на этом все. Результат сложения никак не используется, и такая программа не представляет никакого интереса. Нам нужно попросить компьютер сложить<span style=\"color:#e74c3c\"> <code>3 + 4</code></span> <strong>и</strong> дать команду сделать что-то с результатом. Например, вывести его на экран:</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\"><code><span style=\"color:#95a5a6\"><em>// Сначала вычисляется сумма,<br />\r\n// затем она передается в функцию печати</em></span><br />\r\nconsole.log(<span style=\"color:#3498db\">3 + 4</span>); <em><strong><span style=\"color:#95a5a6\">// =&gt; &#39;7&#39;</span></strong></em></code></div>\r\n\r\n<p style=\"text-align:justify\">Всегда отбивайте арифметические операторы пробелами от самих чисел (операндов) &ndash; это хороший стиль программирования. Поэтому в наших примерах <span style=\"color:#e74c3c\"><code>console.log(3 + 4)</code></span>, а не <span style=\"color:#e74c3c\"><code>console.log(3+4)</code></span>.</p>\r\n\r\n<p>Кроме сложения, доступны следующие операции:</p>\r\n\r\n<ul>\r\n	<li><span style=\"color:#e74c3c\"><code>*</code></span> &mdash; умножение</li>\r\n	<li><span style=\"color:#e74c3c\"><code>/</code></span> &mdash; деление</li>\r\n	<li><span style=\"color:#e74c3c\"><code>-</code></span> &mdash; вычитание</li>\r\n	<li><span style=\"color:#e74c3c\"><code>%</code></span> &mdash; <a href=\"https://ru.wikipedia.org/wiki/%D0%94%D0%B5%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5_%D1%81_%D0%BE%D1%81%D1%82%D0%B0%D1%82%D0%BA%D0%BE%D0%BC\" rel=\"nofollow\" target=\"_blank\">остаток от деления</a></li>\r\n	<li><span style=\"color:#e74c3c\"><code>**</code></span> &mdash; возведение в степень</li>\r\n</ul>\r\n\r\n<p>Теперь давайте выведем на экран результат деления, а потом результат возведения в степень:</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\"><code>console.log(<span style=\"color:#1abc9c\">8</span> / <span style=\"color:#1abc9c\">2</span>);&nbsp; <em><span style=\"color:#95a5a6\">// =&gt; 4</span></em><br />\r\nconsole.log(<span style=\"color:#1abc9c\">3</span> ** <span style=\"color:#1abc9c\">2</span>); <em><span style=\"color:#95a5a6\">// =&gt; 9</span></em></code></div>\r\n\r\n<p>Первая инструкция выведет на экран <code>4</code> (потому что 8 / 2 это 4), а вторая инструкция выведет на экран 9 (потому что 3<sup>2</sup> это 9).</p>\r\n\r\n<h2><span style=\"font-size:20px\"><strong>Операторы</strong></span></h2>\r\n\r\n<p style=\"text-align:justify\">Перед тем, как двигаться дальше, разберем базовую терминологию. Знак операции, такой как <code>+</code>, называют <strong>оператором</strong>. Операторы выполняют операции над определенными значениями, которые называются <strong>операндами</strong>. Сами операторы обычно представлены одним или несколькими символами. Реже словом. Подавляющее большинство операторов соответствуют математическим операциям.</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#1abc9c\">8 </span>+<span style=\"color:#1abc9c\"> 2</span>);\r\n</code></pre>\r\n\r\n<p style=\"text-align:justify\">В этом примере <span style=\"color:#e74c3c\"><code>+</code></span> &mdash; это <strong>оператор</strong>, а числа <span style=\"color:#e74c3c\"><code>8</code></span> и <span style=\"color:#e74c3c\"><code>2</code></span> &mdash; это <strong>операнды</strong>.</p>\r\n\r\n<p style=\"text-align:justify\">В случае сложения у нас есть два операнда: один слева, другой справа от знака <span style=\"color:#e74c3c\"><code>+</code></span>. Операции, которые требуют наличия двух операндов, называются <strong>бинарными</strong>. Если пропустить хотя бы один операнд, например, <code><span style=\"color:#e74c3c\">3 +</span> ;</code>, то программа завершится с синтаксической ошибкой.</p>\r\n\r\n<p style=\"text-align:justify\">Операции (не операторы) бывают не только бинарными, но и унарными (с одним операндом), и даже тернарными (с тремя операндами)! Причем операторы могут выглядеть одинаково, но обозначать разные операции.</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\"><code>console.log(-<span style=\"color:#1abc9c\">3</span>); <em><span style=\"color:#95a5a6\">// =&gt; -3</span></em></code></div>\r\n\r\n<p style=\"text-align:justify\">Выше пример применения унарной операции к числу <code>3</code>. Оператор минус перед тройкой говорит интерпретатору взять число <code>3</code> и найти противоположное, то есть<span style=\"color:#e74c3c\"> <code>-3</code></span>.</p>\r\n\r\n<p style=\"text-align:justify\">Это немного может сбить с толку, потому что<span style=\"color:#e74c3c\"> <code>-3</code></span> &mdash; это одновременно и число само по себе, и оператор с операндом, но у языков программирования такая структура.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><span style=\"font-size:20px\"><strong>Коммутативная операция</strong></span></h2>\r\n\r\n<p style=\"text-align:justify\">Мы все помним со школы: &laquo;от перемены мест слагаемых сумма не меняется&raquo;. Это один из базовых и интуитивно понятных законов арифметики, он называется <strong>коммутативным законом</strong>.</p>\r\n\r\n<p style=\"text-align:justify\">Бинарная операция считается коммутативной, если поменяв местами операнды, вы получаете тот же самый результат. Очевидно, что сложение &mdash; коммутативная операция: <span style=\"font-size:14px\"><em>3 + 2 = 2 + 3</em>.</span></p>\r\n\r\n<p style=\"text-align:justify\">А вот является ли коммутативной операция вычитания? Конечно, нет: <span style=\"font-size:14px\"><em>2 - 3 &ne; 3 - 2</em></span>. В программировании этот закон работает точно так же, как в арифметике.</p>\r\n\r\n<p style=\"text-align:justify\">Более того, большинство операций, с которыми мы будем сталкиваться в реальной жизни, не являются коммутативными. Отсюда вывод: всегда обращайте внимание на порядок того, с чем работаете.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><span style=\"font-size:20px\"><strong>Композиция операций</strong></span></h2>\r\n\r\n<p style=\"text-align:justify\">А что, если понадобится вычислить такое выражение: <span style=\"color:#e74c3c\"><code>3 * 5 - 2</code></span>? Именно так мы и запишем:</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\"><code>console.log(<span style=\"color:#1abc9c\">3</span> * <span style=\"color:#1abc9c\">5</span> - <span style=\"color:#1abc9c\">2</span>); <span style=\"color:#95a5a6\"><em>// =&gt; 13</em></span></code></div>\r\n\r\n<p style=\"text-align:justify\">Обратите внимание, что интерпретатор производит арифметические вычисления в правильном порядке: сначала деление и умножение, потом сложение и вычитание. Иногда этот порядок нужно изменить &mdash; об этом поговорим дальше. Или другой пример:</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\"><code>console.log(<span style=\"color:#1abc9c\">2</span> *<span style=\"color:#1abc9c\"> 4</span> * <span style=\"color:#1abc9c\">5</span> * <span style=\"color:#1abc9c\">10</span>);</code></div>\r\n\r\n<p style=\"text-align:justify\">Как видно, операции можно соединять друг с другом, получая возможность вычислять все более сложные составные выражения. Чтобы представить себе то, как происходят вычисления внутри интерпретатора, давайте разберем пример: <span style=\"color:#e74c3c\"><code>2 * 4 * 5 * 10</code></span>.</p>\r\n\r\n<ol>\r\n	<li style=\"text-align:justify\">Сначала вычисляется <span style=\"color:#e74c3c\"><code>2 * 4</code></span> и получается выражение<span style=\"color:#e74c3c\"> <code>8 * 5 * 10</code></span>.</li>\r\n	<li style=\"text-align:justify\">Затем <span style=\"color:#e74c3c\"><code>8 * 5</code></span>. В итоге имеем <span style=\"color:#e74c3c\"><code>40 * 10</code></span>.</li>\r\n	<li style=\"text-align:justify\">В конце концов происходит последнее умножение, и получается результат <span style=\"color:#e74c3c\"><code>400</code></span>.</li>\r\n</ol>\r\n\r\n<p style=\"text-align:justify\">Таким образом, интерпретатор соединяет сложные составные выражения, последовательно выполняя заложенные в них арифметические действия, по умолчанию соблюдая правильный порядок: сначала умножение и деление, затем &mdash; сложение и вычитание.</p>\r\n\r\n<h2><span style=\"font-size:20px\"><strong>Приоритет операций</strong></span></h2>\r\n\r\n<p style=\"text-align:justify\">Посмотрите внимательно на выражение <span style=\"color:#e74c3c\"><code>2 + 2 * 2</code> </span>и посчитайте в уме ответ.</p>\r\n\r\n<p style=\"text-align:justify\">Правильный ответ: <span style=\"color:#e74c3c\"><code>6</code></span>. Если у вас получилось <span style=\"color:#e74c3c\"><code>8</code></span>, то этот раздел для вас. В школьной математике мы изучали понятие &laquo;приоритет операции&raquo;. Приоритет определяет то, в какой последовательности должны выполняться операции. Например, умножение и деление имеют больший приоритет, чем сложение и вычитание, а приоритет возведения в степень выше всех остальных арифметических операций: <span style=\"color:#e74c3c\"><code>2 ** 3 * 2</code></span> вычислится в <span style=\"color:#e74c3c\"><code>16</code></span>.</p>\r\n\r\n<p style=\"text-align:justify\">Но нередко вычисления должны происходить в порядке, отличном от стандартного приоритета. В сложных ситуациях приоритет можно (и нужно) задавать круглыми скобками, точно так же, как в школе, например: <span style=\"color:#e74c3c\"><code>(2 + 2) * 2</code></span>.</p>\r\n\r\n<p style=\"text-align:justify\">Скобки можно ставить вокруг любой операции. Они могут вкладываться друг в друга сколько угодно раз. Вот пара примеров:</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\"><code>console.log(<span style=\"color:#1abc9c\">3</span> ** (<span style=\"color:#1abc9c\">4</span> - <span style=\"color:#1abc9c\">2</span>)); <span style=\"color:#95a5a6\"><em>// =&gt; 9</em></span><br />\r\nconsole.log(<span style=\"color:#1abc9c\">7</span> * <span style=\"color:#1abc9c\">3</span> + (<span style=\"color:#1abc9c\">4</span> / <span style=\"color:#1abc9c\">2</span>) - (<span style=\"color:#1abc9c\">8</span> + (<span style=\"color:#1abc9c\">2</span> - <span style=\"color:#1abc9c\">1</span>))); <span style=\"color:#95a5a6\"><em>// =&gt; 14</em></span></code></div>\r\n\r\n<p style=\"text-align:justify\">Иногда выражение сложно воспринимать визуально. Тогда можно расставить скобки, не повлияв на приоритет. Например:</p>\r\n\r\n<p>Было:</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\"><code>console.log(<span style=\"color:#1abc9c\">8</span> / <span style=\"color:#1abc9c\">2</span> + <span style=\"color:#1abc9c\">5</span> - -<span style=\"color:#1abc9c\">3</span> / <span style=\"color:#1abc9c\">2</span>); <span style=\"color:#95a5a6\"><em>// =&gt; 10.5</em></span></code></div>\r\n\r\n<p>Стало:</p>\r\n\r\n<div style=\"background:#eeeeee; border:1px solid #cccccc; padding:5px 10px\"><code>console.log(((<span style=\"color:#1abc9c\">8</span> / <span style=\"color:#1abc9c\">2</span>) + <span style=\"color:#1abc9c\">5</span>) - (-<span style=\"color:#1abc9c\">3</span> / <span style=\"color:#1abc9c\">2</span>)); <span style=\"color:#95a5a6\"><em>// =&gt; 10.5</em></span></code></div>\r\n\r\n<p style=\"text-align:justify\">Запомните: код пишется для людей, потому что код будут читать люди, а машины будут только исполнять его. Для машин код &mdash; или корректный, или не корректный, для них нет &laquo;более&raquo; понятного или &laquo;менее&raquo; понятного кода.&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><iframe frameborder=\"0\" height=\"360\" allowfullscreen=\"\" src=\"https://www.youtube.com/embed/oSO_StIWaXM\" width=\"640\"></iframe></p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"font-size:24px\">Задание</span></strong></p>\r\n\r\n<p>Напишите программу, которая считает и выводит на экран последовательно (по одному значению в каждой строке) значения следующих математических выражений:</p>\r\n\r\n<ul>\r\n	<li>3 в степени 5</li>\r\n	<li>-8 разделить на -4</li>\r\n	<li>остаток от деления 100 на 3</li>\r\n	<li>сумму трёх предыдущих выражений</li>\r\n</ul>\r\n\r\n<h2><span style=\"font-size:18px\">Подсказки</span></h2>\r\n\r\n<p>Число, обернутое в кавычки, не является числом. Например, <span style=\"color:#e74c3c\"><code>&#39;42&#39;</code></span> &mdash; это строка. Используйте в решении числа, не строки.</p>'),
(32, 'Строки и переменные', 27, 2, '<h1><strong>Строки</strong></h1>\r\n\r\n<p><img alt=\"Строки\" fetchpriority=\"high\" loading=\"eager\" src=\"https://cdn2.hexlet.io/derivations/image/original/eyJpZCI6ImExNjYwZTNhMzcyZjc0YmU5YmQ1MzU3ZTFiNjRjNWJhLnBuZyIsInN0b3JhZ2UiOiJjYWNoZSJ9?signature=d932dcc8b87e8a4ea4b95d4eac862779fd076f0dc1e5816c7015b85bd8b5731e\" style=\"height:418px; width:750px\" title=\"\" /></p>\r\n\r\n<p>Какие из этих пяти вариантов &mdash; строки?</p>\r\n\r\n<pre>\r\n<code><span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Hello</span><span style=\"color:#dd1144\">&#39;</span>\r\n<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Goodbye</span><span style=\"color:#dd1144\">&#39;</span>\r\n<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">G</span><span style=\"color:#dd1144\">&#39;</span>\r\n<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\"> </span><span style=\"color:#dd1144\">&#39;</span>\r\n<span style=\"color:#dd1144\">&#39;&#39;</span>\r\n</code></pre>\r\n\r\n<h2>Кавычки</h2>\r\n\r\n<p>С первыми двумя все понятно, это точно строки, мы уже работали с подобными конструкциями и говорили, что строки &ndash; это наборы символов.</p>\r\n\r\n<p>Любой одиночный символ в кавычках &mdash; это строка. Пустая строка <code>&#39;&#39;</code> &mdash; это тоже строка. То есть строкой мы считаем все, что находится внутри кавычек, даже если это пробел, один символ или вообще отсутствие символов.</p>\r\n\r\n<p>Ранее в уроках мы записывали строки в одинарных кавычках, но это не единственный способ. Можно использовать и двойные:</p>\r\n\r\n<pre>\r\n<code><em>// Стандарт кодирования airbnb, рекомендует</em>\r\n<em>// использовать, по возможности, одинарные</em>\r\nconsole.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Dracarys!</span><span style=\"color:#dd1144\">&#39;</span>);\r\n</code></pre>\r\n\r\n<p>Представьте, что вы хотите напечатать строчку <em>Dragon&#39;s mother</em>. Апостроф перед буквой <strong>s</strong> &mdash; это такой же символ, как одинарная кавычка. Попробуем:</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Dragon</span><span style=\"color:#dd1144\">&#39;</span>s mother<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">);\r\n// Uncaught SyntaxError: missing ) after argument list\r\n</span></code></pre>\r\n\r\n<p>Такая программа не будет работать. С точки зрения JavaScript, строка началась с одинарной кавычки, а потом закончилась после буквы <strong>n</strong>. Дальше были символы <code>s mother</code> без кавычек &mdash; значит, это не строка. А потом была одна открывающая строку кавычка, которая так и не закрылась: <code>&#39;);</code>. Этот код синтаксически некорректен (это видно даже по тому, как подсвечен код).</p>\r\n\r\n<p>Здесь нам помогут двойные кавычки. Такой вариант программы отработает корректно:</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">Dragon&#39;s mother</span><span style=\"color:#dd1144\">&quot;</span>);\r\n</code></pre>\r\n\r\n<p>Теперь интерпретатор знает, что строка началась с двойной кавычки &mdash; значит, и закончиться должна на двойной кавычке. А одинарная кавычка внутри стала частью строки.</p>\r\n\r\n<p>Верно и обратное. Если внутри строки мы хотим использовать двойные кавычки, то саму строку надо делать в одинарных. Причем количество кавычек внутри самой строки не важно.</p>\r\n\r\n<p>А что, если мы хотим создать такую строку:</p>\r\n\r\n<pre>\r\n<code>Dragon&#39;s mother said &quot;No&quot;\r\n</code></pre>\r\n\r\n<p>В ней есть и одинарные и двойные кавычки. Как быть в этой ситуации? Нужно каким-то образом сказать интерпретатору считать каждую кавычку частью строки, а не началом или концом строки.</p>\r\n\r\n<p>Для этого <strong>экранируют</strong> специальные символы. В нашем случае тот символ, который является признаком конца и начала строки, это либо одинарная кавычка, либо двойная, в зависимости от ситуации. Для экранирования используется обратный слеш .</p>\r\n\r\n<pre>\r\n<code><em>// Экранируется только &quot;, так как в этой ситуации</em>\r\n<em>// двойные кавычки имеют специальное значение</em>\r\nconsole.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">Dragon&#39;s mother said </span><span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">No</span><span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">&quot;</span>);\r\n<em>// =&gt; Dragon&#39;s mother said &quot;No&quot;</em>\r\n</code></pre>\r\n\r\n<p>Посмотрите внимательно: нам нужно было добавить для двойных кавычек, но не для одинарной (апостроф), потому что сама строка создана с двойными кавычками. Если бы строка создавалась с одинарными кавычками, то символ экранирования нужен был бы перед апострофом, но не перед двойными кавычками.</p>\r\n\r\n<pre>\r\n<code><em>//  не выводится, если после него идет обычный,</em>\r\n<em>// а не специальный символ</em>\r\nconsole.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">Death is </span><span style=\"color:#dd1144\">so terribly final</span><span style=\"color:#dd1144\">&quot;</span>);\r\n<em>// =&gt; Death is so terribly final</em>\r\n</code></pre>\r\n\r\n<p>А что, если нужно вывести сам обратный слеш? Точно так же, как и любой другой специальный символ, его надо экранировать самим собой.</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">&quot;</span>);\r\n<em>// =&gt; </em>\r\n</code></pre>\r\n\r\n<p>Вопрос на самопроверку, что выведет этот код?</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\"> </span><span style=\"color:#dd1144\"> </span><span style=\"color:#dd1144\"></span><span style=\"color:#dd1144\"> </span><span style=\"color:#dd1144\"> </span><span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">&quot;</span>);\r\n</code></pre>\r\n\r\n<h2>Экранирующие последовательности</h2>\r\n\r\n<p>Мы хотим показать диалог Матери Драконов со своим ребенком:</p>\r\n\r\n<pre>\r\n<code>- Are you hungry?\r\n- Aaaarrrgh!\r\n</code></pre>\r\n\r\n<p>Если вывести на экран строку с таким текстом:</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">- Are you hungry?- Aaaarrrgh!</span><span style=\"color:#dd1144\">&#39;</span>);\r\n</code></pre>\r\n\r\n<p>то получится так:</p>\r\n\r\n<pre>\r\n<code>- Are you hungry?- Aaaarrrgh!\r\n</code></pre>\r\n\r\n<p>Не то, что мы хотели. Строки расположены друг за другом, а не одна ниже другой. Нам нужно как-то сказать интерпретатору &laquo;нажать на энтер&raquo; &mdash; сделать перевод строки после вопросительного знака. Это можно сделать, используя символ перевода строки: <code> </code>.</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">- Are you hungry?</span><span style=\"color:#dd1144\">\r\n</span><span style=\"color:#dd1144\">- Aaaarrrgh!</span><span style=\"color:#dd1144\">&#39;</span>);\r\n</code></pre>\r\n\r\n<p>результат:</p>\r\n\r\n<pre>\r\n<code>- Are you hungry?\r\n- Aaaarrrgh!\r\n</code></pre>\r\n\r\n<p>&mdash; это специальный символ. В литературе его часто обозначают как <em>LF</em> (Line Feed). Возможно вы сейчас подумали, что это опечатка, ведь здесь мы видим два символа и <code>n</code>, но это не так. С точки зрения компьютера &mdash; это один невидимый символ перевода строки. Доказательство:</p>\r\n\r\n<pre>\r\n<code><em>// Мы это не изучали, но вы должны знать правду</em>\r\n<em>// Ниже код, который возвращает длину строки</em>\r\n<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">a</span><span style=\"color:#dd1144\">&#39;</span>.length;    <em>// 1</em>\r\n<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">\r\n</span><span style=\"color:#dd1144\">&#39;</span>.length;   <em>// 1 !!!</em>\r\n<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">\r\n\r\n</span><span style=\"color:#dd1144\">&#39;</span>.length; <em>// 2 !!!</em>\r\n</code></pre>\r\n\r\n<p>Почему так сделано? <code> </code> &mdash; всего лишь способ записать символ перевода строки, но сам перевод строки по своему смыслу &ndash; это один символ, правда, невидимый. Именно поэтому и возникла такая задача. Нужно было как-то представить его на клавиатуре. А поскольку количество знаков на клавиатуре ограничено и отдано под самые важные, то все специальные символы реализуются в виде таких обозначений.</p>\r\n\r\n<p>Символ перевода строки не является чем-то специфичным для программирования. Все, кто хоть раз печатал на компьютере, использовал перевод строки, нажимая на Enter. Во многих редакторах есть опция, позволяющая включить отображение невидимых символов &mdash; с ее помощью можно понять, где они находятся (хотя это всего лишь схематичное отображение, у этих символов нет графического представления, они невидимые):</p>\r\n\r\n<pre>\r\n<code>- Привет!&para;\r\n- О, привет!&para;\r\n- Как дела?\r\n</code></pre>\r\n\r\n<p>Устройство, которое выводит соответствующий текст, учитывает этот символ. Например, принтер при встрече с LF протаскивает бумагу вверх на одну строку, а текстовый редактор переносит весь последующий текст ниже, также на одну строку.</p>\r\n\r\n<p>&mdash; это пример <strong>экранирующей последовательности</strong> (escape sequence). Их еще называют управляющими конструкциями. Хотя таких символов не один десяток, в программировании часто встречаются всего несколько. Кроме перевода строки, к таким символам относятся табуляция (разрыв, получаемый при нажатии на кнопку Tab) и возврат каретки (только в Windows). Нам, программистам, часто нужно использовать перевод строки <code> </code> для правильного форматирования текста.</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Gregor Clegane</span><span style=\"color:#dd1144\">\r\n</span><span style=\"color:#dd1144\">Dunsen</span><span style=\"color:#dd1144\">\r\n</span><span style=\"color:#dd1144\">Polliver</span><span style=\"color:#dd1144\">\r\n</span><span style=\"color:#dd1144\">Chiswyck</span><span style=\"color:#dd1144\">&#39;</span>);\r\n</code></pre>\r\n\r\n<p>На экран выведется:</p>\r\n\r\n<pre>\r\n<code>Gregor Clegane\r\nDunsen\r\nPolliver\r\nChiswyck\r\n</code></pre>\r\n\r\n<p>Обратите внимание на следующие моменты:</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Не имеет значения, что стоит перед или после <code> </code>: символ или пустая строка. Перевод будет обнаружен и выполнен в любом случае.</p>\r\n	</li>\r\n	<li>\r\n	<p>Помните, что строка может содержать один символ или вообще ноль символов. А еще строка может содержать только <code> </code>. Проанализируйте следующий пример:</p>\r\n\r\n	<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">\r\n</span><span style=\"color:#dd1144\">&#39;</span>);\r\nconsole.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Dunsen</span><span style=\"color:#dd1144\">&#39;</span>);\r\n<em>// =&gt;</em>\r\n<em>// =&gt;</em>\r\n<em>// =&gt; Dunsen</em>\r\n</code></pre>\r\n\r\n	<p>Здесь мы сначала выводим строку &laquo;перевод строки&raquo;, а потом делаем вывод обыкновенной строки.</p>\r\n\r\n	<p>Почему перед строкой <em>Dunsen</em> появилось две пустые строки, а не одна? Дело в том, что <code>console.log()</code> при выводе значения автоматически добавляет в конец символ перевода строки. Таким образом, один перевод строки мы указали явно, передав этот символ экранирующей последовательности аргументом в функцию, а второй перевод строки добавлен самой функцией автоматически.</p>\r\n\r\n	<p>Еще пример кода:</p>\r\n\r\n	<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Polliver</span><span style=\"color:#dd1144\">&#39;</span>);\r\nconsole.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Gregor Clegane</span><span style=\"color:#dd1144\">&#39;</span>);\r\nconsole.log();\r\nconsole.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Chiswyck</span><span style=\"color:#dd1144\">&#39;</span>);\r\nconsole.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">\r\n</span><span style=\"color:#dd1144\">&#39;</span>);\r\nconsole.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Dunsen</span><span style=\"color:#dd1144\">&#39;</span>);\r\n<em>// =&gt; Polliver</em>\r\n<em>// =&gt; Gregor Clegane</em>\r\n<em>// =&gt;</em>\r\n<em>// =&gt; Chiswyck</em>\r\n<em>// =&gt;</em>\r\n<em>// =&gt;</em>\r\n<em>// =&gt; Dunsen</em>\r\n</code></pre>\r\n\r\n	<p>Сейчас у вас достаточно знаний, чтобы самостоятельно разобраться и понять, почему вывод сформировался именно таким образом.</p>\r\n	</li>\r\n	<li>\r\n	<p>Если нам понадобится вывести <code> </code> именно как текст (два отдельных печатных символа), то можно воспользоваться уже известным нам способом экранирования, добавив еще один в начале. То есть последовательность <code> </code> отобразится как символы и <code>n</code>, идущие друг за другом.</p>\r\n\r\n	<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Joffrey loves using </span><span style=\"color:#dd1144\">n</span><span style=\"color:#dd1144\">&#39;</span>);\r\n<em>// =&gt; Joffrey loves using \r\n</em>\r\n</code></pre>\r\n	</li>\r\n</ol>\r\n\r\n<p>Небольшое, но важное замечание про Windows. В Windows для перевода строк по умолчанию используется <code> </code>. Такая комбинация хорошо работает только в Windows, но создает проблемы при переносе в другие системы (например, когда в команде разработчиков есть пользователи как Windows, так и Linux). Дело в том, что последовательность <code> </code> имеет разную трактовку в зависимости от выбранной кодировки (рассматривается позже). По этой причине, в среде разработчиков принято всегда использовать <code> </code> без <code> </code>, так как LF всегда трактуется одинаково и отлично работает в любой системе. Не забудьте настроить ваш редактор на использование <code> </code>.</p>\r\n\r\n<h2>Конкатенация</h2>\r\n\r\n<p>В веб-разработке программы постоянно оперируют строками. Все, что мы видим на сайтах, так или иначе представлено в виде текста. Этот текст чаще всего динамический, то есть полученный из разных частей, которые соединяются вместе. Операция соединения строк в программировании называется <strong>конкатенацией</strong>.</p>\r\n\r\n<pre>\r\n<code><em>// Оператор такой же, как и при сложении чисел</em>\r\n<em>// но здесь он имеет другой смысл (семантику)</em>\r\nconsole.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Dragon</span><span style=\"color:#dd1144\">&#39;</span> <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">stone</span><span style=\"color:#dd1144\">&#39;</span>);\r\n<em>// =&gt; Dragonstone</em>\r\n</code></pre>\r\n\r\n<p>Склеивание строк всегда происходит в том же порядке, в котором записаны операнды. Левый операнд становится левой частью строки, а правый &mdash; правой.</p>\r\n\r\n<p>Вот еще несколько примеров:</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Kings</span><span style=\"color:#dd1144\">&#39;</span> <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">wood</span><span style=\"color:#dd1144\">&#39;</span>);     <em>// =&gt; Kingswood</em>\r\n\r\n<em>// Обратный порядок слов</em>\r\nconsole.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">road</span><span style=\"color:#dd1144\">&#39;</span> <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Kings</span><span style=\"color:#dd1144\">&#39;</span>);     <em>// =&gt; roadKings</em>\r\n\r\n<em>// Конкатенировать можно абсолютно любые строки</em>\r\nconsole.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">King&#39;s</span><span style=\"color:#dd1144\">&quot;</span> <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Landing</span><span style=\"color:#dd1144\">&#39;</span>); <em>// =&gt; King&#39;sLanding</em>\r\n</code></pre>\r\n\r\n<p>Как видите, строки можно склеивать, даже если они записаны с разными кавычками.</p>\r\n\r\n<p>В последнем примере название города получилось с ошибкой: <em>King&#39;s Landing</em> нужно писать через пробел. Но в наших начальных строках не было пробелов, а пробелы в самом коде слева и справа от символа <code>+</code> не имеют значения, потому что они не являются частью строк.</p>\r\n\r\n<p>Выхода из этой ситуации два:</p>\r\n\r\n<pre>\r\n<code><em>// Оба способа равнозначны</em>\r\n\r\n<em>// Ставим пробел в левой части</em>\r\nconsole.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">King&#39;s </span><span style=\"color:#dd1144\">&quot;</span> <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Landing</span><span style=\"color:#dd1144\">&#39;</span>); <em>//  =&gt; King&#39;s Landing</em>\r\n<em>// Ставим пробел в правой части</em>\r\nconsole.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">King&#39;s</span><span style=\"color:#dd1144\">&quot;</span> <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\"> Landing</span><span style=\"color:#dd1144\">&#39;</span>); <em>//  =&gt; King&#39;s Landing</em>\r\n</code></pre>\r\n\r\n<p>Пробел &mdash; такой же символ, как и другие. Чем больше пробелов, тем шире отступы:</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">King&#39;s </span><span style=\"color:#dd1144\">&quot;</span> <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\"> Landing</span><span style=\"color:#dd1144\">&#39;</span>);   <em>// =&gt; King&#39;s  Landing</em>\r\n\r\nconsole.log(<span style=\"color:#dd1144\">&quot;</span><span style=\"color:#dd1144\">King&#39;s  </span><span style=\"color:#dd1144\">&quot;</span> <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">  Landing</span><span style=\"color:#dd1144\">&#39;</span>); <em>// =&gt; King&#39;s    Landing</em>\r\n</code></pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1><code>Переменные</code></h1>\r\n\r\n<p>Представьте себе задачу: нам нужно напечатать на экран фразу <em>Father!</em> два раза или даже пять раз. Эту задачу можно решить в лоб:</p>\r\n\r\n<pre>\r\n<code>console.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Father!</span><span style=\"color:#dd1144\">&#39;</span>); <em>// =&gt; Father!</em>\r\nconsole.log(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Father!</span><span style=\"color:#dd1144\">&#39;</span>); <em>// =&gt; Father!</em>\r\n</code></pre>\r\n\r\n<p>В простейшем случае так и стоит поступить, но если фраза <em>Father!</em> начнет использоваться чаще, да еще и в разных частях программы, то придется ее везде повторять. Проблемы с таким подходом начнутся тогда, когда понадобится изменить нашу фразу, а такое происходит довольно часто. Нам придется найти все места, где использовалась фраза <em>Father!</em>, и выполнить необходимую замену. А можно поступить по-другому. Вместо копирования нашего выражения достаточно создать (объявить) переменную с этой фразой.</p>\r\n\r\n<pre>\r\n<code><em>// greeting &ndash; переводится как приветствие</em>\r\n<strong>let</strong> greeting <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Father!</span><span style=\"color:#dd1144\">&#39;</span>;\r\nconsole.log(greeting); <em>// =&gt; Father!</em>\r\nconsole.log(greeting); <em>// =&gt; Father!</em>\r\n</code></pre>\r\n\r\n<p><img alt=\"Определение переменной\" class=\"img-fluid px-2 px-lg-4 px-md-3 px-xl-5\" loading=\"lazy\" src=\"https://cdn2.hexlet.io/derivations/image/original/eyJpZCI6IjI5NGE2ZjZkZTlhZjU3ZGUxYmNiZDkyYThiZjgxNmRhLnBuZyIsInN0b3JhZ2UiOiJjYWNoZSJ9?signature=a5c593d6616350797a1f3adb06c9c5e58a79f1fb04aa9285775a69bbcc75edaa\" style=\"height:225px; width:750px\" title=\"\" /></p>\r\n\r\n<p>Переменная указывает на данные, которые были в нее записаны. Благодаря этому, данные можно использовать многократно без необходимости их постоянно дублировать. Сама переменная создается и наполняется данными (инициализируется) с помощью инструкции <code>let greeting = &#39;Father!&#39;</code>.</p>\r\n\r\n<p>Для имени переменной используется любой набор допустимых символов, к которым относятся буквы английского алфавита, цифры, а также знаки <em>_</em> и <em>$</em>. При этом цифру нельзя ставить в начале. Имена переменных регистрозависимы, то есть имя <code>hello</code> и имя <code>heLLo</code> &ndash; это два разных имени, а значит и две переменные. Регистр в JavaScript имеет важное значение, никогда не забывайте про него.</p>\r\n\r\n<p>Переменную не обязательно инициализировать данными во время объявления. Иногда бывает нужно ее создать, а наполняться она будет потом:</p>\r\n\r\n<pre>\r\n<code><strong>let</strong> greeting;\r\n\r\n<em>// Использование</em>\r\nconsole.log(greeting); <em>// undefined</em>\r\n\r\n<em>// Изменение переменной в следующем уроке</em>\r\n</code></pre>\r\n\r\n<p>Объявленная, но не инициализированная переменная, содержит внутри себя значение <code>undefined</code>. Это специальное значение, используемое тогда, когда ничего не определено.</p>\r\n\r\n<p>Количество создаваемых переменных ничем не ограничено, большие программы содержат десятки и сотни тысяч имен переменных:</p>\r\n\r\n<pre>\r\n<code><strong>let</strong> greeting1 <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Father!</span><span style=\"color:#dd1144\">&#39;</span>;\r\nconsole.log(greeting1); <em>// =&gt; Father!</em>\r\nconsole.log(greeting1); <em>// =&gt; Father!</em>\r\n\r\n<strong>let</strong> greeting2 <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Mother!</span><span style=\"color:#dd1144\">&#39;</span>;\r\nconsole.log(greeting2); <em>// =&gt; Mother!</em>\r\nconsole.log(greeting2); <em>// =&gt; Mother!</em>\r\n</code></pre>\r\n\r\n<p>Для удобства анализа программы, переменные принято создавать как можно ближе к тому месту, где они используются.</p>\r\n\r\n<h2>Изменение переменной</h2>\r\n\r\n<p>Само слово &laquo;переменная&raquo; говорит, что ее можно менять. И действительно, с течением времени внутри программы значения переменных могут изменяться.</p>\r\n\r\n<pre>\r\n<code><strong>let</strong> greeting <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Father!</span><span style=\"color:#dd1144\">&#39;</span>;\r\nconsole.log(greeting); <em>// =&gt; Father!</em>\r\nconsole.log(greeting); <em>// =&gt; Father!</em>\r\n\r\ngreeting <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Mother!</span><span style=\"color:#dd1144\">&#39;</span>;\r\nconsole.log(greeting); <em>// =&gt; Mother!</em>\r\nconsole.log(greeting); <em>// =&gt; Mother!</em>\r\n</code></pre>\r\n\r\n<p>Имя осталось тем же, но внутри другие данные. Обратите внимание на ключевое различие между объявлением переменной и ее изменением. Ключевое слово <code>let</code> ставится только при создании переменной, но при изменении оно уже не используется.</p>\r\n\r\n<h2>Ошибки при работе с переменными</h2>\r\n\r\n<p>Порядок следования инструкций в коде с переменными имеет огромное значение. Переменная должна быть определена до того, как будет использована. Ниже пример ошибки, которую очень часто допускают новички:</p>\r\n\r\n<pre>\r\n<code><em>// Uncaught ReferenceError: greeting is not defined</em>\r\nconsole.log(greeting);\r\n<strong>let</strong> greeting <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Father!</span><span style=\"color:#dd1144\">&#39;</span>;\r\n</code></pre>\r\n\r\n<p>Запуск программы с примера выше завершается ошибкой <em>ReferenceError: greeting is not defined</em>. <em>ReferenceError</em> &ndash; это ошибка обращения, она означает, что в коде используется имя (говорят идентификатор), которое не определено. Причем в самой ошибке об этом говорят прямо: <em>greeting is not defined</em>, что переводится как <em>greeting не определен</em>. Кроме неправильного порядка определения, в JavaScript встречаются банальные опечатки &mdash; как при использовании переменной, так и при ее объявлении.</p>\r\n\r\n<p>Количество подобных ошибок уменьшается за счет использования правильно настроенного редактора. Такой редактор подсвечивает имена, которые используются без объявления, и предупреждает о возможных проблемах.</p>\r\n\r\n<p>Еще одна распространенная ошибка &mdash; попытаться объявить уже объявленную переменную:</p>\r\n\r\n<pre>\r\n<code><strong>let</strong> greeting <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Father!</span><span style=\"color:#dd1144\">&#39;</span>;\r\n<strong>let</strong> greeting <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Father!</span><span style=\"color:#dd1144\">&#39;</span>;\r\n</code></pre>\r\n\r\n<p>Так делать нельзя. Придется создать новую переменную.</p>\r\n\r\n<h2>Константы</h2>\r\n\r\n<p>Во всем модуле подавляющее большинство примеров кода использовало переменные в качестве имен (псевдонимы) конкретных значений, а не как переменные, которые меняют свое значение со временем.</p>\r\n\r\n<pre>\r\n<code><strong>let</strong> dollarsInEuro <strong>=</strong> <span style=\"color:#009999\">1.25</span>;\r\n<strong>let</strong> rublesInDollar <strong>=</strong> <span style=\"color:#009999\">60</span>;\r\n\r\n<strong>let</strong> dollarsCount <strong>=</strong> <span style=\"color:#009999\">50</span> <strong>*</strong> dollarsInEuro; <em>// 62.5</em>\r\n<strong>let</strong> rublesCount <strong>=</strong> dollarsCount <strong>*</strong> rublesInDollar; <em>// 3750</em>\r\n\r\nconsole.log(rublesCount); <em>// =&gt; 3750</em>\r\n</code></pre>\r\n\r\n<p>В программировании принято называть такие имена константами, и многие языки поддерживают константы как конструкцию. JavaScript, как раз, относится к таким языкам, и его стандарты кодирования <a href=\"https://eslint.org/docs/rules/prefer-const\" rel=\"nofollow\" target=\"_blank\">говорят прямо</a> &mdash; если значение не меняется, то мы имеем дело с константой. Перепишем пример выше с использованием констант:</p>\r\n\r\n<pre>\r\n<code><strong>const</strong> dollarsInEuro <strong>=</strong> <span style=\"color:#009999\">1.25</span>;\r\n<strong>const</strong> rublesInDollar <strong>=</strong> <span style=\"color:#009999\">60</span>;\r\n\r\n<strong>const</strong> euros <strong>=</strong> <span style=\"color:#009999\">1000</span>;\r\n<strong>const</strong> dollars <strong>=</strong> euros <strong>*</strong> dollarsInEuro;    <em>// 1250</em>\r\n<strong>const</strong> rubles <strong>=</strong> dollars <strong>*</strong> rublesInDollar; <em>// 75000</em>\r\n\r\nconsole.log(rubles); <em>// =&gt; 75000</em>\r\n</code></pre>\r\n\r\n<p><a href=\"https://replit.com/@hexlet/js-basics-variables\" target=\"_blank\">https://replit.com/@hexlet/js-basics-variables</a></p>\r\n\r\n<p>Единственное изменение заключается в том, что ключевое слово <code>let</code> заменилось на <code>const</code>, но это только синтаксис. Теперь, если попытаться изменить любую константу, то мы получим сообщение об ошибке. В остальном они используются точно так же, как и переменные.</p>\r\n\r\n<pre>\r\n<code><strong>const</strong> pi <strong>=</strong> <span style=\"color:#009999\">3.14</span>;\r\npi <strong>=</strong> <span style=\"color:#009999\">5</span>; <em>// TypeError: Assignment to constant variable.</em>\r\n</code></pre>\r\n\r\n<p>Зачем такие сложности? Почему бы не оставить только переменные? Даже если бы мы оставили только переменные, то это не отменяет того факта, что они часто использовались бы как константы, более того, код на JavaScript можно и идиоматично писать без использования переменных вообще. Посмотрите на пример из <a href=\"https://github.com/Hexlet/hexlet-exercise-kit/blob/main/import-documentation/index.js\" rel=\"nofollow\" target=\"_blank\">реального кода Хекслета</a>. На текущем этапе вы его вряд ли поймете, но попробуйте посчитать количество констант и переменных внутри него, вы увидите, что здесь ровно одна переменная, и целая куча констант.</p>\r\n\r\n<p>Константы значительно проще для анализа, когда мы видим константу в коде, то нам сразу понятно, что ее значение всегда остается прежним. При использовании констант отсутствует понятие времени. С переменными все не так, мы не можем быть уверены в их значении, приходится анализировать весь код, чтобы понять, как они могли измениться.</p>\r\n\r\n<p>Переменные жизненно необходимы только в одном случае (во всех остальных гарантированно можно обойтись без них) &ndash; при работе с циклами, до которых мы еще дойдем.</p>\r\n\r\n<p>В дальнейшем мы будем предпочитать константы и использовать переменные только тогда, когда без них никак.</p>');
INSERT INTO `content_course` (`id_content_course`, `name_item_course`, `id_courses`, `number`, `content`) VALUES
(33, 'Интерполяция и типы данных', 27, 3, '<p>&nbsp;</p>\r\n\r\n<div class=\"d-inline-block mb-4 position-relative\">\r\n<h1>Интерполяция</h1>\r\n</div>\r\n\r\n<p>Представим, что перед нами стоит задача создать заголовок письма из двух констант и знаков препинания. Скорее всего, мы бы решили задачу так:</p>\r\n\r\n<pre>\r\n<code><strong>const</strong> firstName <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Joffrey</span><span style=\"color:#dd1144\">&#39;</span>;\r\n<strong>const</strong> greeting <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Hello</span><span style=\"color:#dd1144\">&#39;</span>;\r\n\r\nconsole.log(greeting <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">, </span><span style=\"color:#dd1144\">&#39;</span> <strong>+</strong> firstName <strong>+</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">!</span><span style=\"color:#dd1144\">&#39;</span>);\r\n<em>// =&gt; Hello, Joffrey!</em>\r\n</code></pre>\r\n\r\n<p>Это довольно простой случай, но даже здесь нужно приложить усилия, чтобы увидеть, какая в итоге получится строка. Нужно следить за несколькими кавычками и пробелами, и без вглядывания не понять, где что начинается и кончается.</p>\r\n\r\n<p>Есть другой, более удобный и изящный способ решения той же задачи &mdash; <strong>интерполяция</strong>. Вот, как это выглядит:</p>\r\n\r\n<pre>\r\n<code><strong>const</strong> firstName <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Joffrey</span><span style=\"color:#dd1144\">&#39;</span>;\r\n<strong>const</strong> greeting <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Hello</span><span style=\"color:#dd1144\">&#39;</span>;\r\n\r\n<em>// Обратите внимание на ограничители строки, это бектики</em>\r\n<em>// Интерполяция не работает с одинарными и двойными кавычками</em>\r\nconsole.log(<span style=\"color:#dd1144\">`</span>${greeting}<span style=\"color:#dd1144\">, </span>${firstName}<span style=\"color:#dd1144\">!`</span>);\r\n<em>// =&gt; Hello, Joffrey!</em>\r\n</code></pre>\r\n\r\n<p><a href=\"https://replit.com/@hexlet/js-basics-interpolation\" target=\"_blank\">https://replit.com/@hexlet/js-basics-interpolation</a></p>\r\n\r\n<p>Мы просто создали одну строку и &laquo;вставили&raquo; в нее в нужные места константы с помощью знака доллара и фигурных скобок <code>${ }</code>. Получился как будто бланк, куда внесены нужные значения. И нам не нужно больше заботиться об отдельных строках для знаков препинания и пробелов &mdash; все эти символы просто записаны в этой строке-шаблоне. В одной строке можно делать сколько угодно подобных блоков.</p>\r\n\r\n<p>Интерполяция работает только со строками в <a href=\"https://ru.wikipedia.org/wiki/%D0%9C%D0%B0%D1%88%D0%B8%D0%BD%D0%BE%D0%BF%D0%B8%D1%81%D0%BD%D1%8B%D0%B9_%D0%BE%D0%B1%D1%80%D0%B0%D1%82%D0%BD%D1%8B%D0%B9_%D0%B0%D0%BF%D0%BE%D1%81%D1%82%D1%80%D0%BE%D1%84\" rel=\"nofollow\" target=\"_blank\">бектиках</a>. Это символ `.</p>\r\n\r\n<p>Почти во всех языках интерполяция предпочтительнее конкатенации для объединения строк. Строка при этом получается склеенная, и внутри нее хорошо просматриваются пробелы и другие символы. Во-первых, интерполяция позволяет не путать строки с числами (из-за знака +), а во-вторых, так гораздо проще (после некоторой практики) понимать строку целиком.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div class=\"d-inline-block mb-4 position-relative\">\r\n<h1>Типы данных</h1>\r\n</div>\r\n\r\n<p><img alt=\"Число в виде строки\" class=\"img-fluid px-2 px-lg-4 px-md-3 px-xl-5\" fetchpriority=\"high\" loading=\"eager\" src=\"https://cdn2.hexlet.io/derivations/image/original/eyJpZCI6ImRiNTA0YTM3NTgxZTlmZThhYmI1YmM3ZGMwMTI0OTQzLnBuZyIsInN0b3JhZ2UiOiJjYWNoZSJ9?signature=5405762db2598882bb8e7a5d8f2ac94cc5cbe1f54fad95111eee67c15d5399f3\" style=\"height:362px; width:750px\" title=\"\" /></p>\r\n\r\n<p>Что произойдет, если мы попробуем умножить число на строку? JavaScript вернет <code>NaN</code> (не число) &mdash; то самое значение. Оно возникает там, где вместе используются несовместимые значения. В данном случае число и строка:</p>\r\n\r\n<pre>\r\n<code><span style=\"color:#009999\">3</span> <strong>*</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Dracarys</span><span style=\"color:#dd1144\">&#39;</span>; <em>// NaN</em>\r\n</code></pre>\r\n\r\n<p>Внутри высокоуровневых языков программирования данные разделяются по типам. Любая строка относится к типу String, а числа &mdash; к типу Number и BigInt (очень большие числа). Зачем нужны типы? Для защиты программы от трудноуловимых ошибок. Типы определяют две вещи:</p>\r\n\r\n<ul>\r\n	<li>Возможные (допустимые) значения. Например, числа в JavaScript делятся на два типа: Number и BigInt. Первые &mdash; это все числа ниже определенного порога (его можно посмотреть), вторые &mdash; выше. Такое разделение связано с техническими особенностями работы аппаратуры.</li>\r\n	<li>Набор операций, которые можно выполнять над этим типом. Например, операция умножения имеет смысл для типа &laquo;целые числа&raquo;. Но не имеет смысла для типа &laquo;строки&raquo;: умножать слово &laquo;мама&raquo; на слово &laquo;блокнот&raquo; &mdash; бессмыслица.</li>\r\n</ul>\r\n\r\n<p>JavaScript ведет себя двояко, когда встречается с нарушениями. В некоторых ситуациях он ругается на недопустимость операции и завершается с ошибкой. В других &mdash; программа продолжает работать. В этом случае недопустимая операция возвращает что-то похожее на <code>NaN</code>, как в примере выше.</p>\r\n\r\n<p>Каким образом JavaScript понимает, что за тип данных перед ним? Достаточно просто. Любое значение где-то инициализируется и, в зависимости от способа инициализации, становится понятно, что перед нами. Например, числа &mdash; это просто числа без дополнительных символов, кроме точки для рациональных чисел. А вот строки всегда ограничены специальными символами (в JavaScript три разных варианта). Например, такое значение <code>&#39;234&#39;</code> &ndash; строка, несмотря на то, что внутри нее записаны цифры.</p>\r\n\r\n<p>JavaScript позволяет узнать тип данных с помощью оператора <code>typeof</code>:</p>\r\n\r\n<pre>\r\n<code><strong>typeof</strong> <span style=\"color:#009999\">3</span>;      <em>// number</em>\r\n<strong>typeof</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Game</span><span style=\"color:#dd1144\">&#39;</span>; <em>// string</em>\r\n</code></pre>\r\n\r\n<p>Типы данных Number, BigInt и String &mdash; это <em>примитивные</em> типы. Но есть и другие. В JavaScript встроен составной тип Object (а на его базе массивы, даты и другие). С его помощью можно объединять данные разных типов в одно значение, например, мы можем создать пользователя, добавив к нему имя и возраст:</p>\r\n\r\n<pre>\r\n<code><em>// Этот синтаксис изучается далее на Хекслете</em>\r\n<strong>const</strong> user <strong>=</strong> { <span style=\"color:#008080\">name</span>: <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Toto</span><span style=\"color:#dd1144\">&#39;</span>, <span style=\"color:#008080\">age</span>: <span style=\"color:#009999\">33</span> };\r\n</code></pre>\r\n\r\n<p>По-английски строки в программировании называются &quot;strings&quot;, а строчки текстовых файлов &mdash; &quot;lines&quot;. Например, в коде выше есть две строчки (lines), но только одна строка (string). В русском иногда может быть путаница, поэтому во всех уроках мы будем говорить <strong>строка</strong> для обозначения типа данных &laquo;строка&raquo;, и <strong>строчка</strong> для обозначения строчек (lines) в файлах.</p>\r\n\r\n<h3>undefined</h3>\r\n\r\n<p>Объявление переменных возможно и без указания конкретного значения. Что будет выведено на экран, если ее распечатать:</p>\r\n\r\n<pre>\r\n<code><strong>let</strong> name;\r\nconsole.log(name); <em>// ?</em>\r\n</code></pre>\r\n\r\n<p>На экране появится <code>undefined</code>, специальное значение особого типа, которое означает отсутствие значения. Undefined активно используется самим JavaScript в самых разных ситуациях, например, при обращении к несуществующему символу строки:</p>\r\n\r\n<pre>\r\n<code><strong>const</strong> name <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">Arya</span><span style=\"color:#dd1144\">&#39;</span>;\r\nconsole.log(name[<span style=\"color:#009999\">8</span>]);\r\n</code></pre>\r\n\r\n<p>Смысл (семантика) значения <code>undefined</code> именно в том, что значения нет. Однако, ничто не мешает написать такой код:</p>\r\n\r\n<pre>\r\n<code><strong>let</strong> key <strong>=</strong> <strong>undefined</strong>;\r\n</code></pre>\r\n\r\n<p>И хотя интерпретатор позволяет такое сделать, это нарушение семантики значения <code>undefined</code>, ведь в этом коде выполняется присваивание, а значит &mdash; подставляется значение.</p>\r\n\r\n<p>JavaScript &mdash; один из немногих языков, в которых в явном виде присутствует понятие <code>undefined</code>. В остальных языках его функцию выполняет значение <code>null</code>, которое, кстати, тоже есть в JavaScript.</p>\r\n\r\n<p><em>Вопрос на самопроверку. Почему нельзя объявить константу без указания значения?</em></p>\r\n\r\n<h3>Числа с плавающей точкой</h3>\r\n\r\n<p>В математике существуют разные виды чисел, например, натуральные &ndash; это целые числа от одного и больше, или рациональные &ndash; это числа с точкой, например 0.5. С точки зрения устройства компьютеров, между этими видами чисел &ndash; пропасть. Попробуйте ответить на простой вопрос, сколько будет <em>0.2 + 0.1</em>? А теперь посмотрим, что на это скажет JavaScript:</p>\r\n\r\n<pre>\r\n<code><span style=\"color:#009999\">0.2</span> <strong>+</strong> <span style=\"color:#009999\">0.1</span> <em>// 0.30000000000000004</em>\r\n</code></pre>\r\n\r\n<p>Операция сложения двух рациональных чисел внезапно привела к неточному вычислению результата. Тот же самый результат выдадут и другие языки программирования. Такое поведение обуславливается ограничениями вычислительных мощностей. Объем памяти, в отличие от чисел, конечен (бесконечное количество чисел требует бесконечного количества памяти для своего хранения).</p>\r\n\r\n<p>Рациональные числа не выстроены в непрерывную цепочку, между <em>0.1</em> и <em>0.2</em> бесконечное множество чисел. Соответственно возникает серьезная проблема, а как хранить рациональные числа? Это интересный вопрос сам по себе. В интернете множество статей, посвященных организации памяти в таких случаях. Более того, существует стандарт, в котором описано, как это делать правильно, и подавляющее число языков на него опирается.</p>\r\n\r\n<p>Для нас, как для разработчиков, важно понимать, что операции с плавающими числами неточны (эту точность можно регулировать), а значит при решении задач, связанных с подобными числами, необходимо прибегать к специальным трюкам, которые позволяют добиться необходимой точности.</p>\r\n\r\n<h3>Явное преобразование типов</h3>\r\n\r\n<p>В программировании регулярно встречаются задачи, когда один тип данных нужно преобразовать в другой &mdash; например, при работе с формами на сайтах. Данные формы всегда приходят в текстовом виде, даже если значение &mdash; число. Вот как его можно преобразовать:</p>\r\n\r\n<pre>\r\n<code><strong>const</strong> number <strong>=</strong> <span style=\"color:#0086b3\">parseInt</span>(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">345</span><span style=\"color:#dd1144\">&#39;</span>);\r\nconsole.log(number); <em>// =&gt; 345</em>\r\n</code></pre>\r\n\r\n<p><code>parseInt()</code> &mdash; это функция, в которую передается значение, чтобы его преобразовать. Функция ведет себя подобно арифметическим операциям, но делает особые действия. Вот еще несколько примеров:</p>\r\n\r\n<pre>\r\n<code><strong>const</strong> value <strong>=</strong> <span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">0</span><span style=\"color:#dd1144\">&#39;</span>;\r\n<em>// Внутри скобок можно указывать переменную</em>\r\n<strong>const</strong> number1 <strong>=</strong> <span style=\"color:#0086b3\">parseInt</span>(value);\r\nconsole.log(number1); <em>// =&gt; 0</em>\r\n\r\n<em>// Или конкретное значение</em>\r\n<strong>const</strong> number2 <strong>=</strong> <span style=\"color:#0086b3\">parseInt</span>(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">10</span><span style=\"color:#dd1144\">&#39;</span>);\r\nconsole.log(number2); <em>// =&gt; 10</em>\r\n\r\n<em>// Если преобразуется число с плавающей точкой</em>\r\n<em>// то отбрасывается вся дробная часть</em>\r\n<strong>const</strong> number5 <strong>=</strong> <span style=\"color:#0086b3\">parseInt</span>(<span style=\"color:#009999\">3.5</span>);\r\nconsole.log(number5); <em>// =&gt; 3</em>\r\n</code></pre>\r\n\r\n<p>Точно так же можно преобразовать строку в число с плавающей точкой с помощью <code>parseFloat()</code>:</p>\r\n\r\n<pre>\r\n<code>\r\n<strong>const</strong> value3 <strong>=</strong> <span style=\"color:#0086b3\">parseFloat</span>(<span style=\"color:#dd1144\">&#39;</span><span style=\"color:#dd1144\">0.5</span><span style=\"color:#dd1144\">&#39;</span>);\r\nconsole.log(value3); <em>// 0.5</em>\r\n</code></pre>'),
(34, 'Функции и их вызовы', 27, 4, NULL),
(35, 'Свойства и методы', 27, 5, NULL),
(36, 'Определение функций и возврат значения', 27, 6, NULL),
(37, 'Логика и логические операторы', 27, 7, NULL),
(38, 'Цикл While и For', 27, 8, NULL),
(39, 'Модули', 27, 9, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id_courses` int(11) NOT NULL,
  `hours` float NOT NULL,
  `price` float NOT NULL,
  `name_courses` varchar(100) NOT NULL,
  `id_articles` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Курсы';

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id_courses`, `hours`, `price`, `name_courses`, `id_articles`, `description`, `img`, `status`, `view`) VALUES
(27, 68, 100, 'Курс Java-разработчик', 82, '<p>Вы&nbsp;научитесь писать код и&nbsp;создавать сайты на&nbsp;самом популярном языке программирования. Разработаете блог, добавите сильный проект в&nbsp;портфолио и&nbsp;станете Java-программистом, которому рады в&nbsp;любой студии разработки.&nbsp;</p>', '1672995890_java.png', 1, 66),
(28, 65, 110, 'Профессия Графический дизайнер', 82, '<p>Вы&nbsp;узнаете, как создавать айдентику бренда в&nbsp;вебе и&nbsp;для печати. Научитесь работать в&nbsp;Illustrator, Photoshop, InDesign и&nbsp;Figma. Добавите в&nbsp;портфолио плакаты, логотипы, дизайн мерча и&nbsp;другие сильные проекты. Начнёте карьеру в&nbsp;студии или на&nbsp;фрилансе.&nbsp;</p>', '1672997095_graphic.png', 1, 14),
(29, 40, 80, 'Профессия 1С-разработчик', 83, '<p>Вы&nbsp;научитесь решать кадровые, бухгалтерские и&nbsp;бизнес-задачи с&nbsp;помощью разработки. Сможете работать в&nbsp;самой популярной программе для автоматизации бизнеса&nbsp;— «1С:Предприятии».</p>', '1672997248_1C.png', 1, 6),
(30, 68, 99, 'Профессия Веб-разработчик', 82, '<p>Веб-разработчик создаёт сайты, сервисы и&nbsp;приложения, которыми мы&nbsp;ежедневно пользуемся. Он&nbsp;разрабатывает интернет-магазины, онлайн-банки, поисковики, карты и&nbsp;почтовые клиенты. Веб-разработчик проектирует внешний вид сайта&nbsp;— фронтенд и&nbsp;программирует сервисную часть&nbsp;— бэкенд.&nbsp;</p>', '1673271551_html.png', 1, 16),
(31, 58, 89, 'Профессия UX/UI-дизайнер', 88, '<p>Вы&nbsp;научитесь разрабатывать удобные сайты и&nbsp;приложения и&nbsp;адаптировать их&nbsp;под разные устройства. Поймёте, как создавать сильные продукты. Освоите востребованную специальность и&nbsp;сможете увеличить свой доход.&nbsp;</p>', '1673269715_uxui.webp', 1, 6),
(32, 71, 99, 'Профессия Разработчик на C++', 83, '<p>Программисты на C++ создают сложные программы и&nbsp;сервисы. Они разрабатывают высоконагруженные сетевые приложения, игры, графические движки, компоненты для операционных систем и&nbsp;железа. На&nbsp;этом языке написаны Windows, Linux и&nbsp;macOS, Android, Chrome, Counter-Strike, StarCraft и&nbsp;Diablo.</p>', '1672998038_c++.webp', 1, 4),
(33, 60, 55, 'Профессия Data Scientist', 88, '<p>Освойте Data Science с&nbsp;нуля. Вы&nbsp;попробуете силы в&nbsp;аналитике данных, машинном обучении, дата-инженерии и&nbsp;подробно изучите направление, которое нравится вам больше. Отточите навыки на&nbsp;реальных проектах и&nbsp;станете востребованным специалистом.&nbsp;</p>', '1672998210_datascientist.webp', 1, 4),
(39, 123, 121, '234567896543', 83, '<p>qwergfhjgfdswq</p>', '1673271729_c++.webp', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `like_dislike_comments`
--

CREATE TABLE `like_dislike_comments` (
  `id_like_dislike_comments` int(11) NOT NULL,
  `id_comments` int(11) NOT NULL,
  `like_` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_content` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `like_dislike_comments`
--

INSERT INTO `like_dislike_comments` (`id_like_dislike_comments`, `id_comments`, `like_`, `id_users`, `id_content`) VALUES
(18, 1, 0, 85, NULL),
(19, 1, 1, 87, NULL),
(21, 1, 1, 84, NULL),
(23, 1, -1, 70, NULL),
(25, 1, 0, 85, NULL),
(26, 1, 0, 85, NULL),
(27, 1, 0, 85, NULL),
(28, 1, 0, 85, NULL),
(29, 1, 0, 85, NULL),
(30, 1, 0, 85, NULL),
(31, 1, 0, 85, NULL),
(32, 1, 0, 85, NULL),
(33, 1, 0, 85, NULL),
(35, 38, 0, 85, NULL),
(36, 40, 0, 85, NULL),
(37, 39, 1, 85, NULL),
(38, 37, -1, 85, NULL),
(39, 39, 1, 87, NULL),
(40, 39, 1, 88, NULL),
(41, 39, 1, 72, NULL),
(42, 1, 1, 72, NULL),
(43, 49, 1, 86, NULL),
(44, 1, 0, 86, NULL),
(45, 51, 1, 85, NULL),
(46, 50, 1, 85, NULL),
(47, 54, 1, 70, NULL),
(48, 55, -1, 84, NULL),
(49, 66, -1, 84, NULL),
(50, 40, 1, 89, NULL),
(51, 3, 0, 89, 31),
(52, 5, 1, 89, 31),
(53, 6, -1, 89, 35),
(54, 1, 1, 89, 31),
(55, 8, 1, 89, 31),
(56, 23, 0, 94, 31),
(57, 8, -1, 94, 31);

-- --------------------------------------------------------

--
-- Структура таблицы `name_category`
--

CREATE TABLE `name_category` (
  `id_name_category` int(11) NOT NULL,
  `name_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Название категории';

--
-- Дамп данных таблицы `name_category`
--

INSERT INTO `name_category` (`id_name_category`, `name_category`) VALUES
(1, 'Top Topics'),
(9, 'Бэкенд-разработка'),
(2, 'Веб-разработчик'),
(7, 'Графика и анимация'),
(5, 'Дизайн'),
(6, 'Маркетинг'),
(3, 'Разработчик игр');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(11) NOT NULL,
  `id_courses` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Заказы';

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_orders`, `id_courses`, `id_users`, `date`) VALUES
(10, 30, 68, '2023-01-09 01:15:08'),
(11, 27, 68, '2023-01-09 01:28:24'),
(12, 33, 68, '2023-01-09 01:35:29'),
(13, 27, 70, '2023-01-09 12:02:59'),
(14, 30, 70, '2023-01-09 15:08:54'),
(15, 28, 68, '2023-01-09 15:18:24'),
(16, 28, 70, '2023-01-09 21:39:37'),
(17, 32, 68, '2023-01-10 13:31:16'),
(18, 32, 72, '2023-01-10 18:29:57'),
(19, 28, 70, '2023-01-10 17:42:35'),
(20, 33, 70, '2023-01-10 18:03:51'),
(21, 27, 84, '2023-01-10 18:05:40'),
(22, 29, 84, '2022-08-01 18:07:37'),
(23, 33, 84, '2023-01-10 18:12:36'),
(24, 31, 84, '2023-01-10 18:13:34'),
(25, 30, 84, '2022-11-10 18:15:43'),
(26, 29, 84, '2022-11-10 18:17:20'),
(27, 27, 84, '2022-11-10 18:54:49'),
(28, 28, 84, '2022-11-10 18:55:37'),
(29, 32, 84, '2022-12-10 18:56:17'),
(30, 27, 84, '2022-12-10 18:56:31'),
(31, 32, 84, '2022-12-10 18:57:53'),
(32, 29, 84, '2022-12-10 18:59:16'),
(33, 28, 84, '2022-12-10 19:03:19'),
(34, 27, 84, '2022-12-10 19:03:34'),
(35, 30, 84, '2023-01-10 19:04:45'),
(36, 31, 84, '2023-01-10 19:05:05'),
(37, 28, 84, '2023-01-10 19:05:22'),
(38, 29, 84, '2022-09-10 19:06:06'),
(39, 33, 84, '2022-09-10 19:14:09'),
(40, 32, 84, '2023-01-10 19:14:40'),
(41, 27, 84, '2023-01-10 19:17:40'),
(42, 28, 84, '2023-01-10 19:17:43'),
(43, 29, 84, '2023-01-10 19:18:21'),
(44, 28, 84, '2023-01-10 19:25:11'),
(45, 27, 84, '2023-01-10 19:29:10'),
(46, 28, 84, '2022-09-10 19:30:43'),
(47, 29, 84, '2023-01-10 19:31:22'),
(48, 29, 84, '2022-09-10 19:34:36'),
(49, 28, 84, '2023-01-10 19:38:58'),
(50, 28, 84, '2022-09-10 19:39:51'),
(51, 28, 70, '2022-09-10 19:40:15'),
(52, 29, 70, '2023-01-10 19:41:49'),
(53, 28, 70, '2022-09-10 19:43:47'),
(54, 31, 70, '2022-09-10 19:46:16'),
(55, 27, 84, '2022-09-10 19:47:16'),
(56, 28, 84, '2022-09-10 19:51:37'),
(57, 28, 84, '2022-09-10 19:52:16'),
(58, 28, 84, '2022-09-10 19:53:36'),
(59, 28, 84, '2022-09-10 19:55:12'),
(60, 27, 84, '2023-02-10 19:58:31'),
(61, 28, 86, '2023-02-10 20:47:14'),
(62, 27, 86, '2023-02-10 21:06:21'),
(63, 27, 85, '2023-02-27 21:00:56'),
(64, 27, 86, '2023-03-15 12:28:25'),
(65, 29, 85, '2023-03-23 11:49:21'),
(66, 33, 85, '2023-03-23 20:24:06'),
(67, 28, 85, '2023-03-23 20:24:07'),
(68, 27, 89, '2022-10-13 13:07:41'),
(69, 28, 89, '2022-10-04 13:07:43'),
(70, 29, 89, '2022-10-04 13:07:45'),
(71, 30, 89, '2022-10-04 13:07:47'),
(72, 31, 89, '2022-10-04 13:07:49'),
(73, 33, 90, '2022-08-11 13:13:56'),
(74, 29, 90, '2022-08-12 13:16:20'),
(75, 31, 90, '2022-08-13 13:16:41'),
(76, 32, 90, '2022-08-09 13:17:22'),
(77, 28, 90, '2022-08-10 13:21:01'),
(78, 32, 90, '2022-08-11 13:21:19'),
(79, 33, 90, '2022-08-04 13:21:32'),
(80, 29, 90, '2022-08-09 13:25:02'),
(81, 27, 90, '2022-08-07 13:25:04'),
(82, 27, 86, '2023-04-04 13:32:23'),
(83, 28, 86, '2023-04-04 13:32:26'),
(84, 29, 86, '2023-04-04 13:33:15'),
(85, 32, 86, '2022-01-04 13:34:01'),
(86, 32, 72, '2022-09-16 13:34:55'),
(87, 28, 72, '2022-09-04 13:34:55'),
(88, 30, 72, '2022-09-04 13:34:56'),
(89, 31, 72, '2022-09-04 13:34:56'),
(90, 27, 72, '2022-09-04 13:34:57'),
(91, 27, 87, '2022-07-15 13:48:17'),
(92, 28, 87, '2022-07-16 13:48:23'),
(93, 29, 87, '2022-07-10 13:48:25'),
(94, 32, 87, '2022-07-11 13:48:26'),
(95, 31, 87, '2022-07-04 13:48:28'),
(96, 30, 87, '2022-07-04 13:48:29'),
(97, 33, 87, '2022-07-04 13:48:31'),
(98, 27, 87, '2022-07-04 13:48:55'),
(99, 28, 87, '2022-07-04 13:48:57'),
(100, 29, 87, '2022-07-04 13:48:58'),
(101, 32, 87, '2022-07-04 13:49:00'),
(102, 31, 87, '2022-07-04 13:49:01'),
(103, 30, 87, '2022-07-04 13:49:03'),
(104, 33, 87, '2022-07-04 13:49:04'),
(105, 27, 90, '2022-07-04 13:53:20'),
(106, 28, 90, '2022-07-04 13:53:21'),
(107, 29, 90, '2022-07-04 13:53:21'),
(108, 30, 90, '2022-07-04 13:53:22'),
(109, 31, 90, '2022-07-04 13:53:23'),
(110, 32, 90, '2022-05-11 13:53:23'),
(111, 33, 90, '2022-05-04 13:53:24'),
(112, 27, 90, '2022-05-04 13:54:47'),
(113, 28, 90, '2022-05-04 13:54:48'),
(114, 29, 90, '2022-05-04 13:54:48'),
(115, 32, 90, '2022-05-04 13:54:49'),
(116, 31, 90, '2022-05-04 13:54:50'),
(117, 30, 90, '2022-05-04 13:54:50'),
(118, 33, 90, '2022-05-04 13:54:51'),
(119, 27, 90, '2022-05-04 13:57:18'),
(120, 28, 90, '2022-05-04 13:57:18'),
(121, 29, 90, '2022-05-04 13:57:19'),
(122, 30, 90, '2022-05-04 13:57:20'),
(123, 31, 90, '2022-05-04 13:57:20'),
(124, 32, 90, '2022-05-04 13:57:21'),
(125, 33, 90, '2022-04-04 13:57:21'),
(126, 27, 86, '2022-04-04 14:05:03'),
(127, 31, 86, '2022-04-04 14:05:04'),
(128, 30, 86, '2022-04-04 14:05:04'),
(129, 33, 86, '2022-04-04 14:05:07'),
(130, 27, 91, '2022-04-13 12:43:08'),
(131, 28, 91, '2022-04-13 12:43:09'),
(132, 29, 91, '2022-04-13 12:43:10'),
(133, 30, 91, '2022-04-13 12:43:10'),
(134, 31, 91, '2022-04-13 12:43:11'),
(135, 32, 91, '2022-03-01 12:43:13'),
(136, 27, 91, '2022-03-10 12:44:13'),
(137, 31, 91, '2022-03-11 12:44:15'),
(138, 29, 91, '2022-03-21 12:44:16'),
(139, 32, 91, '2022-03-25 12:44:17'),
(140, 27, 91, '2022-02-01 12:45:38'),
(141, 28, 91, '2022-02-06 12:45:39'),
(142, 32, 91, '2022-02-13 12:45:41'),
(143, 33, 91, '2022-02-25 12:45:42'),
(144, 30, 91, '2022-02-28 12:45:43'),
(145, 27, 92, '2022-01-01 12:50:25'),
(146, 28, 92, '2022-01-02 12:50:25'),
(147, 32, 92, '2022-01-07 12:50:27'),
(148, 30, 92, '2022-01-08 12:50:28'),
(149, 31, 92, '2022-01-09 12:50:29'),
(150, 29, 92, '2022-01-13 12:50:30'),
(151, 33, 91, '2022-02-13 13:51:18'),
(152, 31, 91, '2022-11-13 13:51:19'),
(153, 28, 91, '2022-11-13 13:51:21'),
(154, 29, 91, '2022-06-11 13:51:22'),
(155, 32, 91, '2022-06-13 13:51:24'),
(156, 27, 91, '2022-06-20 13:51:25'),
(157, 30, 91, '2022-06-16 13:51:27'),
(158, 29, 92, '2023-04-13 14:28:31'),
(159, 28, 92, '2023-04-13 14:28:32'),
(160, 27, 92, '2023-04-13 14:28:32'),
(161, 30, 92, '2023-04-13 14:28:33'),
(162, 31, 92, '2023-04-13 14:28:33'),
(163, 32, 92, '2023-04-13 14:28:34'),
(164, 27, 89, '2023-05-31 17:41:01'),
(165, 27, 57, '2023-06-04 02:00:58'),
(166, 27, 93, '2023-06-07 23:42:37'),
(167, 27, 94, '2023-06-08 00:49:57');

-- --------------------------------------------------------

--
-- Структура таблицы `progress_course`
--

CREATE TABLE `progress_course` (
  `id_progress_course` int(11) NOT NULL,
  `id_content_course` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_courses` int(11) NOT NULL,
  `progress` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `progress_course`
--

INSERT INTO `progress_course` (`id_progress_course`, `id_content_course`, `id_users`, `id_courses`, `progress`) VALUES
(551, 31, 89, 27, 1),
(552, 32, 89, 27, 1),
(553, 33, 89, 27, 1),
(554, 34, 89, 27, 0),
(555, 35, 89, 27, 0),
(556, 36, 89, 27, 0),
(557, 37, 89, 27, 0),
(558, 38, 89, 27, 0),
(559, 39, 89, 27, 1),
(560, 31, 57, 27, 0),
(561, 32, 57, 27, 0),
(562, 33, 57, 27, 0),
(563, 34, 57, 27, 0),
(564, 35, 57, 27, 0),
(565, 36, 57, 27, 0),
(566, 37, 57, 27, 0),
(567, 38, 57, 27, 0),
(568, 39, 57, 27, 0),
(569, 31, 93, 27, 0),
(570, 32, 93, 27, 0),
(571, 33, 93, 27, 0),
(572, 34, 93, 27, 0),
(573, 35, 93, 27, 0),
(574, 36, 93, 27, 0),
(575, 37, 93, 27, 0),
(576, 38, 93, 27, 0),
(577, 39, 93, 27, 0),
(578, 31, 94, 27, 1),
(579, 32, 94, 27, 0),
(580, 33, 94, 27, 0),
(581, 34, 94, 27, 0),
(582, 35, 94, 27, 0),
(583, 36, 94, 27, 0),
(584, 37, 94, 27, 0),
(585, 38, 94, 27, 0),
(586, 39, 94, 27, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `rassylka`
--

CREATE TABLE `rassylka` (
  `id_rassylka` int(11) NOT NULL,
  `name_rassylka` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rassylka`
--

INSERT INTO `rassylka` (`id_rassylka`, `name_rassylka`) VALUES
(1, 'Скидки на курсы'),
(2, 'Пополнение курсов'),
(3, 'Новый пост');

-- --------------------------------------------------------

--
-- Структура таблицы `rassylka_sub`
--

CREATE TABLE `rassylka_sub` (
  `id` int(11) NOT NULL,
  `id_rassylka` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `reward` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rassylka_sub`
--

INSERT INTO `rassylka_sub` (`id`, `id_rassylka`, `id_users`, `reward`) VALUES
(1, 1, 86, 1),
(2, 2, 86, 1),
(3, 3, 86, 1),
(4, 1, 71, 1),
(5, 2, 71, 1),
(6, 3, 71, 1),
(7, 1, 57, 0),
(8, 2, 57, 0),
(9, 3, 57, 0),
(10, 1, 87, 1),
(11, 2, 87, 0),
(12, 3, 87, 0),
(13, 1, 88, 1),
(14, 2, 88, 1),
(15, 3, 88, 0),
(16, 1, 85, 1),
(17, 2, 85, 1),
(18, 3, 85, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id_reviews` int(11) NOT NULL,
  `text_review` text NOT NULL,
  `rate` float NOT NULL,
  `id_users` int(11) NOT NULL,
  `date_review` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_courses` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Отзывы';

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id_reviews`, `text_review`, `rate`, `id_users`, `date_review`, `id_courses`, `status`) VALUES
(7, 'Курсом полностью доволен', 5, 68, '2023-01-09 02:40:49', 30, 1),
(19, 'Нравится возможность обучаться в любое время, структурированность курса и\r\nпереработанный контент программы, хорошая подача материала на видео и время отклика\r\nкуратора — не более одного дня.\r\n\r\nПри этом хотелось бы иметь возможность сдавать сразу несколько работ в рамках одного\r\nблока.', 5, 68, '2023-01-09 11:55:22', 27, 1),
(27, 'Понравилось что в курсе много практики. Сразу знакомишься с Git', 4.5, 70, '2023-01-09 12:03:50', 27, 1),
(29, 'Не все модули как следует проработаны в плане подачи материала. Например, по брейкпоинтам адаптивной вёрстки в разделе «Базовый уровень вёрстки» очень сумбурно показана практическая часть.', 4, 70, '2023-01-09 15:10:57', 30, 1),
(30, 'Качественные материалы — максимум пользы за минимум времени. Хорошо подобраны практические задания — действительно заставляют усвоить и закрепить знания.', 4.5, 68, '2023-01-09 15:19:34', 28, 1),
(32, 'test1234', 4, 68, '2023-01-09 20:57:00', 30, 1),
(34, 'спасибо большое за курс, создал свою визуальную эро-новеллу', 5, 72, '2023-01-10 18:31:22', 32, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `send_email`
--

CREATE TABLE `send_email` (
  `id_users` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `send_email`
--

INSERT INTO `send_email` (`id_users`, `date`, `text`, `id`) VALUES
(2, '2023-02-10 02:34:48', '1111111111111111111', 1),
(4, '2023-02-10 02:34:48', '1111111111111111111', 2),
(5, '2023-02-10 02:34:50', '1111111111111111111', 3),
(65, '2023-02-10 02:34:50', '1111111111111111111', 4),
(80, '2023-02-10 02:34:51', '1111111111111111111', 5),
(83, '2023-02-10 02:34:49', '1111111111111111111', 6),
(4, '2023-02-10 20:23:11', 'saddsaddadsds', 7),
(2, '2023-02-10 20:23:12', 'saddsaddadsds', 8),
(85, '2023-02-10 20:23:13', 'saddsaddadsds', 9),
(84, '2023-02-10 20:23:14', 'saddsaddadsds', 10),
(65, '2023-02-10 20:23:15', 'saddsaddadsds', 11),
(5, '2023-02-10 20:23:15', 'saddsaddadsds', 12),
(80, '2023-02-10 20:23:16', 'saddsaddadsds', 13),
(4, '2023-02-10 20:31:08', 'qeweqweweq', 14),
(2, '2023-02-10 20:31:08', 'qeweqweweq', 15),
(85, '2023-02-10 20:31:09', 'qeweqweweq', 16),
(84, '2023-02-10 20:31:10', 'qeweqweweq', 17),
(65, '2023-02-10 20:31:11', 'qeweqweweq', 18),
(5, '2023-02-10 20:31:12', 'qeweqweweq', 19),
(80, '2023-02-10 20:31:12', 'qeweqweweq', 20),
(4, '2023-02-10 20:31:57', '324678654321345678', 21),
(2, '2023-02-10 20:31:58', '324678654321345678', 22),
(85, '2023-02-10 20:31:59', '324678654321345678', 23),
(84, '2023-02-10 20:32:00', '324678654321345678', 24),
(65, '2023-02-10 20:32:01', '324678654321345678', 25),
(5, '2023-02-10 20:32:01', '324678654321345678', 26),
(80, '2023-02-10 20:32:02', '324678654321345678', 27),
(85, '2023-02-10 20:37:15', 'fsdfdsfsdfdsff', 28),
(85, '2023-02-10 20:37:32', 'adsfhjgfdsafghjk', 29),
(86, '2023-02-10 20:40:44', '1234567890', 30),
(4, '2023-02-10 20:45:43', 'тестовый123', 31),
(2, '2023-02-10 20:45:44', 'тестовый123', 32),
(85, '2023-02-10 20:45:45', 'тестовый123', 33),
(84, '2023-02-10 20:45:46', 'тестовый123', 34),
(65, '2023-02-10 20:45:47', 'тестовый123', 35),
(86, '2023-02-10 20:45:47', 'тестовый123', 36),
(5, '2023-02-10 20:45:48', 'тестовый123', 37),
(80, '2023-02-10 20:45:49', 'тестовый123', 38),
(4, '2023-02-10 21:05:21', 'покупайте', 39),
(2, '2023-02-10 21:05:22', 'покупайте', 40),
(85, '2023-02-10 21:05:23', 'покупайте', 41),
(84, '2023-02-10 21:05:23', 'покупайте', 42),
(65, '2023-02-10 21:05:24', 'покупайте', 43),
(86, '2023-02-10 21:05:25', 'покупайте', 44),
(5, '2023-02-10 21:05:26', 'покупайте', 45),
(80, '2023-02-10 21:05:27', 'покупайте', 46),
(86, '2023-02-10 21:05:57', 'вввввввввввввввввв', 47),
(86, '2023-02-21 13:34:01', 'asfdkjl;jghfdsadfghjkl', 48),
(86, '2023-02-21 16:40:31', 'ыцвапр', 49),
(65, '2023-03-15 12:24:34', '123', 50);

-- --------------------------------------------------------

--
-- Структура таблицы `send_email_rassylka`
--

CREATE TABLE `send_email_rassylka` (
  `id` int(11) NOT NULL,
  `id_rassylka` int(100) NOT NULL,
  `text` text NOT NULL,
  `id_users` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `send_email_rassylka`
--

INSERT INTO `send_email_rassylka` (`id`, `id_rassylka`, `text`, `id_users`, `date`) VALUES
(13, 2, 'qwertyuiop[', 71, '2023-02-21 17:15:25'),
(14, 1, '12346789', 71, '2023-02-21 17:27:45'),
(15, 1, '12346789', 86, '2023-02-21 17:27:46'),
(16, 1, '12346789', 71, '2023-02-21 17:31:49'),
(17, 1, '12346789', 86, '2023-02-21 17:31:50'),
(18, 1, '12346789', 71, '2023-02-21 17:33:02'),
(19, 1, '12346789', 86, '2023-02-21 17:33:03'),
(20, 3, '32456789', 71, '2023-02-21 17:40:33'),
(21, 1, '123', 71, '2023-02-21 19:13:20'),
(22, 1, '123', 86, '2023-02-21 19:13:21'),
(23, 1, '123', 87, '2023-02-21 19:13:21'),
(24, 1, '123', 71, '2023-02-21 19:16:50'),
(25, 1, '123', 86, '2023-02-21 19:16:51'),
(26, 1, '123', 87, '2023-02-21 19:16:52'),
(27, 1, 'wewewwewew', 71, '2023-02-21 19:19:10'),
(28, 1, 'wewewwewew', 86, '2023-02-21 19:19:11'),
(29, 1, 'wewewwewew', 87, '2023-02-21 19:19:11'),
(30, 2, '2345678', 71, '2023-02-21 19:27:16'),
(31, 1, 'скидки на курсы ..', 71, '2023-02-21 19:56:48'),
(32, 1, 'скидки на курсы ..', 86, '2023-02-21 19:56:49'),
(33, 1, 'скидки на курсы ..', 87, '2023-02-21 19:56:50'),
(34, 1, '123456789', 71, '2023-02-21 19:59:04'),
(35, 1, '123456789', 86, '2023-02-21 19:59:05'),
(36, 1, '123456789', 87, '2023-02-21 19:59:06'),
(37, 1, '123456789', 88, '2023-02-21 19:59:07'),
(38, 15, '123123', 88, '2023-02-21 20:00:51'),
(39, 1, 'Тестовое сообщение', 71, '2023-03-16 12:09:35'),
(40, 1, 'Тестовое сообщение', 85, '2023-03-16 12:09:36'),
(41, 1, 'Тестовое сообщение', 86, '2023-03-16 12:09:36'),
(42, 1, 'Тестовое сообщение', 87, '2023-03-16 12:09:37'),
(43, 1, 'Тестовое сообщение', 88, '2023-03-16 12:09:38');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL COMMENT 'ID пользователя',
  `FIO_users` varchar(100) NOT NULL COMMENT 'ФИО пользователя',
  `login` varchar(50) NOT NULL COMMENT 'Логин',
  `password` varchar(256) NOT NULL COMMENT 'Пароль',
  `email` varchar(50) NOT NULL COMMENT 'Эл.Почта',
  `admin` tinyint(4) NOT NULL,
  `sportsman` tinyint(4) NOT NULL,
  `organizer` tinyint(4) NOT NULL,
  `date_users` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_users`, `FIO_users`, `login`, `password`, `email`, `admin`, `sportsman`, `organizer`, `date_users`) VALUES
(1, 'Узбенко Михаил Петрович123', 'petrovich123', 'mixan123', 'yzbenkoM@mail.ru', 1, 0, 0, '2022-09-01 10:27:44'),
(2, 'Уильям Глен Херрингтон', 'BillyGym', 'herrington5645', 'billyher@gmail.com', 0, 0, 0, '2022-12-29 23:31:44'),
(3, 'Зверев Артем Евгеньевич', 'artemZ', '1337', 'artemWolf', 0, 0, 0, '2022-11-09 11:11:44'),
(4, 'Андреев Родион Семёнович', 'andreyR', 'Dngro14iOkd', 'AnRodion@mail.ru', 0, 0, 0, '2023-02-04 17:31:44'),
(5, 'Волкова Мария Артёмовна', 'volkayf', 'ioormew99', 'mariawolf@gmail.com', 0, 0, 0, '2023-01-04 17:31:44'),
(57, 'Шеметов', 'shemetov', '$2y$10$7mLHQhvCbafXo9tWsKOZGuF9IgRwaJdxJU/W9bszxYf3vKSoauBhe', '123@123', 1, 0, 0, '2023-01-02 16:15:31'),
(65, 'Шеметов', 'shemetov', '$2y$10$sfkbsrCgSvoDrzHEu2gwlueFnJ0.p2h2iTU.e5Qmnls4yy5Iq.qge', 'i-shemetov@mail.ru', 0, 0, 0, '2022-11-03 17:31:44'),
(66, 'TestUser', 'Test123', '$2y$10$Bm8YEhQIVekMjvHWoBJub.eZrE02Ti8MHmvMck4WCWLOLQGjzPI7e', 'test@test', 0, 0, 0, '2023-03-22 19:51:11'),
(67, 'Шеметов', 'shemetov@mail.ru', '1234', 'I-shemetov@123', 0, 0, 0, '2022-12-12 17:31:44'),
(68, 'Шеметов123', 'Use234567890', '$2y$10$cNygN2265LREAzNwSjXCF.KmFCrbndlVt99hXHoPYJeB4kOe38DBa', '1234@1234', 0, 0, 0, '2023-01-01 17:31:44'),
(70, 'Шеметов', 'Ilya1', '$2y$10$zIDVSFKFCTbKobjysOnOA.KLPkFfOsQFL4oePGpz.UbnSY2XGxV5W', '12345@12345', 0, 0, 0, '2022-05-04 17:31:44'),
(71, 'Шеметов Илья Александрович', 'shemetov88', '$2y$10$pozuQj2t9rxzKzZVyorFd.EmCHzj8hRhOvim04z5DphaWYcFJ5Vl.', 'sanya.chuchayev@mail.ru', 0, 0, 0, '2022-08-22 17:31:44'),
(72, 'Петров Сергей Юрьевич', 'pazhiloyPavuk', '$2y$10$eBhvot7tOPhiUTobLWj21e47kfyxKdm2x8CnSqb0VSljegIQLd8A6', 'pavuk@123', 0, 0, 0, '2023-10-29 23:31:44'),
(73, '3214567890765432', '34567865432', '$2y$10$pLi7C04SClz.srFZlTeaO.4EgxHtwGujSFtfhscnLNUcZmbjrR6nG', '324234233@2345', 0, 0, 0, '2022-09-07 17:31:44'),
(80, 'СерГей Петр', 'pazhiloyPavuk228', '$2y$10$nJ7OUzlo2qggBOgt.jiAKuctEYY/3pmWwZzB.M3hWMHJJjzxQoAZW', 'pazhiloypuk@gmail.com', 0, 0, 0, '2022-05-04 17:31:44'),
(84, 'Узбенко Михаил Петрович', 'User12345', '$2y$10$mKTC2PjQJInmi7SozSjlEO0RVkOZa34.4EeuhWMnBQOKkp.8JLhJu', 'girahiv997@mustbeit.com', 0, 0, 0, '2023-01-01 17:31:44'),
(85, 'Юра Второф', 'YuraF123', '$2y$10$Q6GGguG72y/ttGHsJ2KBKewB2lfEmUJNMUU3KP.7wiVNmKK1juO6u', 'Dogoodajf@gmail.com', 0, 0, 0, '2022-12-04 17:31:44'),
(86, 'Шеметов', 'Shemetov', '$2y$10$LpJdCJiC9IS3n0bbsd3eAOpXy7r.8E.i9j6yDpqQMVss.QaesGgSi', 'ilyashemetov88@gmail.com', 0, 0, 0, '2023-03-18 17:31:44'),
(87, 'Мазелов123', 'mzlff123', '$2y$10$aAT8rUszFO6CAooKWPqHhuEh2pTyz5D6abm4qdoZ780aGBUZ04BK6', 'tayedi6984@mirtox.com', 0, 0, 0, '2022-09-04 17:31:44'),
(88, '12113213232', '123123123вфывыф', '$2y$10$PaBKbMUSsDORMocBOUGLaOrlqArC3rhqqeV/9wMaKdw7EKfcFdoOi', 'jacihek241@aosod.com', 0, 0, 0, '2022-10-14 17:31:44'),
(89, 'test101234567', 'test101234567', '$2y$10$y2RsXbOI8dBGv.iRdY/8JOTTUfozuCq622sv5Y6SOTOSsn8eNCKcK', 'bidok54897@jthoven.com', 0, 0, 0, '2022-09-04 17:31:44'),
(90, 'Test13google', 'Googlecom', '$2y$10$AimDv1PTlxUWJW27cML68u5/jM6Z3bNRsPDfvR/LxkQwhrRcoDpBi', 'nokami3352@djpich.com', 0, 0, 0, '2022-06-01 17:31:44'),
(91, 'Тимаги', 'timagi', '$2y$10$dCAl7i5.oU8rOjpnJCvID.yNm6ks1o/YJWRTJDTu4WnXiMQFxfCJ6', 'timagi2642@lieboe.com', 0, 0, 0, '2023-04-13 12:42:45'),
(92, 'keyig74956', 'keyig74956', '$2y$10$0MxrTi7Qxcg9Kl.jpZjYMe4/qGjRh/hxk.bCSsCOAhR5QQmQPbU8S', 'keyig74956@ippals.com', 0, 0, 0, '2023-04-13 12:49:39'),
(93, 'Макаров', 'Qwerty1', '$2y$10$Vuqz9OrKzYauRVlp0XUVcerOYNdZVyMjUI8vgP1h3LNZoxYBatIS6', 'cokolas411@vaband.com', 0, 0, 1, '2023-06-07 23:42:09'),
(94, 'Шеметов Илья Александрович', 'test_course', '$2y$10$9sNCS7.nCHcP/hw75bxbe.cMh7NpdiBkPWEliig8wulbib4MHhEEm', 'mavaji4366@soremap.com', 0, 0, 0, '2023-06-08 00:43:01');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_articles`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `articles_ibfk_2` (`id_user`);

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_content_course`
--
ALTER TABLE `chat_content_course`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments_articles`
--
ALTER TABLE `comments_articles`
  ADD PRIMARY KEY (`id_comments_articles`);

--
-- Индексы таблицы `content_course`
--
ALTER TABLE `content_course`
  ADD PRIMARY KEY (`id_content_course`),
  ADD KEY `content_course_ibfk_1` (`id_courses`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_courses`),
  ADD KEY `id_articles` (`id_articles`);

--
-- Индексы таблицы `like_dislike_comments`
--
ALTER TABLE `like_dislike_comments`
  ADD PRIMARY KEY (`id_like_dislike_comments`);

--
-- Индексы таблицы `name_category`
--
ALTER TABLE `name_category`
  ADD PRIMARY KEY (`id_name_category`),
  ADD UNIQUE KEY `name_category` (`name_category`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_courses` (`id_courses`);

--
-- Индексы таблицы `progress_course`
--
ALTER TABLE `progress_course`
  ADD PRIMARY KEY (`id_progress_course`);

--
-- Индексы таблицы `rassylka`
--
ALTER TABLE `rassylka`
  ADD PRIMARY KEY (`id_rassylka`);

--
-- Индексы таблицы `rassylka_sub`
--
ALTER TABLE `rassylka_sub`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_reviews`),
  ADD KEY `id_users` (`id_users`);

--
-- Индексы таблицы `send_email`
--
ALTER TABLE `send_email`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `send_email_rassylka`
--
ALTER TABLE `send_email_rassylka`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id_articles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT для таблицы `chat_content_course`
--
ALTER TABLE `chat_content_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `comments_articles`
--
ALTER TABLE `comments_articles`
  MODIFY `id_comments_articles` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT для таблицы `content_course`
--
ALTER TABLE `content_course`
  MODIFY `id_content_course` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID пункта курса', AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id_courses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `like_dislike_comments`
--
ALTER TABLE `like_dislike_comments`
  MODIFY `id_like_dislike_comments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT для таблицы `name_category`
--
ALTER TABLE `name_category`
  MODIFY `id_name_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT для таблицы `progress_course`
--
ALTER TABLE `progress_course`
  MODIFY `id_progress_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=587;

--
-- AUTO_INCREMENT для таблицы `rassylka`
--
ALTER TABLE `rassylka`
  MODIFY `id_rassylka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rassylka_sub`
--
ALTER TABLE `rassylka_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_reviews` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `send_email`
--
ALTER TABLE `send_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `send_email_rassylka`
--
ALTER TABLE `send_email_rassylka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID пользователя', AUTO_INCREMENT=95;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_users`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`id_category`) REFERENCES `name_category` (`id_name_category`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `content_course`
--
ALTER TABLE `content_course`
  ADD CONSTRAINT `content_course_ibfk_1` FOREIGN KEY (`id_courses`) REFERENCES `courses` (`id_courses`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`id_articles`) REFERENCES `articles` (`id_articles`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
