-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 03. Jan 2020 um 11:31
-- Server-Version: 5.7.28-0ubuntu0.18.04.4
-- PHP-Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cookiemanager`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bruteforce`
--

CREATE TABLE `bruteforce` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `counter` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `zeitpunkt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookiebars`
--

CREATE TABLE `cookiebars` (
  `websiteid` int(10) UNSIGNED NOT NULL,
  `varid` int(10) UNSIGNED NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookiebar_vars`
--

CREATE TABLE `cookiebar_vars` (
  `id` int(10) UNSIGNED NOT NULL,
  `varname` varchar(255) NOT NULL,
  `input` varchar(255) NOT NULL DEFAULT 'input',
  `defaultval` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

--
-- Daten für Tabelle `cookiebar_vars`
--

INSERT INTO `cookiebar_vars` (`id`, `varname`, `input`, `defaultval`) VALUES
(1, 'bgcolor', 'input', '#000000'),
(2, 'bgopacity', 'input', '0.9'),
(3, 'zindex', 'input', '99996'),
(4, 'paddingbottomtop', 'input', '50px'),
(6, 'barmaintext', 'textarea', 'Externe Cookies sind auf unserer Webseite standardmäßig deaktiviert. Wir möchten diese jedoch mit Ihrer Zustimmung verwenden. Um sich damit einverstanden zu erklären, können Sie auf &quot;AKZEPTIEREN&quot; klicken. Um eine individuelle Einstellung vorzunehmen klicken Sie bitte auf &quot;mehr&quot;. '),
(7, 'barmaintextmaxwith', 'input', '1024px'),
(8, 'barmaintextcolor', 'input', '#ffffff'),
(9, 'barmaintextfontsize', 'input', '14px'),
(10, 'barmaintextfont', 'input', 'sans-serif'),
(11, 'acceptbgcolor', 'input', '#0a550a'),
(12, 'acceptfontsize', 'input', '1em'),
(13, 'acceptfontcolor', 'input', '#ffffff'),
(14, 'acceptfontweight', 'input', 'bold'),
(15, 'accepttitle', 'input', 'Alle akzeptieren'),
(16, 'acceptcontent', 'input', 'AKZEPTIEREN'),
(17, 'morebgcolor', 'input', '#616161'),
(18, 'morefontsize', 'input', '1em'),
(19, 'morefontcolor', 'input', '#f2f2f2'),
(20, 'morefontweight', 'input', 'normal'),
(21, 'moretitle', 'input', 'Datenschutz-Einstellungen öffnen'),
(22, 'morecontent', 'input', 'mehr'),
(23, 'fontfamily', 'input', 'sans-serif'),
(24, 'fingerprintzindex', 'input', '99997'),
(25, 'fingerprinttitle', 'input', 'Datenschutz-Einstellungen öffnen'),
(26, 'morecss', 'textarea', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookieboxes`
--

CREATE TABLE `cookieboxes` (
  `websiteid` int(10) UNSIGNED NOT NULL,
  `varid` int(10) UNSIGNED NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookiebox_vars`
--

CREATE TABLE `cookiebox_vars` (
  `id` int(10) UNSIGNED NOT NULL,
  `varname` varchar(255) NOT NULL,
  `input` varchar(255) NOT NULL DEFAULT 'input',
  `defaultval` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

--
-- Daten für Tabelle `cookiebox_vars`
--

INSERT INTO `cookiebox_vars` (`id`, `varname`, `input`, `defaultval`) VALUES
(1, 'overlaybg', 'input', '#000000'),
(2, 'overlayopacity', 'input', '0.5'),
(3, 'overlayzindex', 'input', '99998'),
(4, 'boxzindex', 'input', '99999'),
(5, 'boxbgcolor', 'input', '#ffffff'),
(6, 'boxmaxwidth', 'input', '700px'),
(7, 'boxmaxheight', 'input', '500px'),
(8, 'boxbordercolor', 'input', '#d0d0d0'),
(9, 'boxfontfamily', 'input', 'sans-serif'),
(10, 'boxfontsize', 'input', '16px'),
(11, 'boxlinecolor', 'input', '#f2f2f2'),
(12, 'boxlabelfontsize', 'input', '14px'),
(13, 'boxcookiedescfontsize', 'input', '13px'),
(14, 'boxcookiedeschlfontsize', 'input', '15px'),
(15, 'boxcookietdoddbgcolor', 'input', '#f2f2f2'),
(16, 'boxhandacolor', 'input', '#0a550a'),
(17, 'boxhcontent', 'input', 'Datenschutz Einstellungen'),
(18, 'boxacceptbgcolor', 'input', '#0a550a'),
(19, 'boxacceptfontsize', 'input', '1em'),
(20, 'boxacceptfontcolor', 'input', '#ffffff'),
(21, 'boxacceptfontweight', 'input', 'bold'),
(22, 'boxaccepttitle', 'input', 'Einstellungen speichern und schließen'),
(23, 'boxacceptcontent', 'input', 'SPEICHERN'),
(24, 'boxclosebgcolor', 'input', '#616161'),
(25, 'boxclosefontsize', 'input', '1em'),
(26, 'boxclosefontcolor', 'input', '#f2f2f2'),
(27, 'boxclosefontweight', 'input', 'normal'),
(28, 'boxclosetitle', 'input', 'Ansicht schließen'),
(29, 'boxclosecontent', 'input', 'Schließen'),
(30, 'boxcookiebordercolor', 'input', '#f2f2f2'),
(31, 'label_cookiepersonenbezogenedaten', 'input', 'Daten'),
(32, 'label_cookielandderdatenerfassung', 'input', 'Land'),
(33, 'label_cookiewirdgeloeschtnach', 'input', 'Ablauf'),
(34, 'label_cookiecompany', 'input', 'Unternehmen'),
(35, 'label_cookiecompanylinks', 'input', 'Links'),
(36, 'label_cookiecompanyoptin', 'input', 'Opt-In'),
(37, 'boxfontcolor', 'input', '#444'),
(38, 'boxmorecss', 'input', ''),
(39, 'h2fontsize', 'input', '22px'),
(40, 'h2fontweight', 'input', 'bold'),
(41, 'boxeinleitung', 'textarea', 'Nachfolgend finden Sie die Datenschutzeinstellungen sowie relevante Informationen zu Cookies und dynamischen Seitenelementen, die von uns und von Dritten auf unseren Webdiensten   Verwendung finden können. Weitere Informationen darüber, wie wir den Umgang mit persönlichen Daten organisieren, finden Sie in unserer Datenschutzerklärung. ');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookies`
--

CREATE TABLE `cookies` (
  `id` int(10) UNSIGNED NOT NULL,
  `company` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `internalremarks` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `personenbezogenedaten` text NOT NULL,
  `landderdatenerfassung` varchar(255) NOT NULL,
  `wirdgeloeschtnach` varchar(255) NOT NULL,
  `sourcetype` smallint(3) UNSIGNED NOT NULL COMMENT 'Verweist auf cookie_sourcetypes',
  `sourcecode` text NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

--
-- Daten für Tabelle `cookies`
--

INSERT INTO `cookies` (`id`, `company`, `name`, `internalremarks`, `beschreibung`, `personenbezogenedaten`, `landderdatenerfassung`, `wirdgeloeschtnach`, `sourcetype`, `sourcecode`, `active`, `deleted`) VALUES
(1, 1, 'CookieManager', 'Alle Seiten, Standard', 'Der CookieManagers speichert Ihre Präferenzen für Cookies und Elemente, die Sie beim Besuch unserer Webseite angegeben haben ab, um diese dauerhaft für den jeweils verwendeten Internet-Browser verfügbar und für Sie abrufbar zu halten.', 'Datum und Uhrzeit der Präferenzfestlegung', 'Deutschland', 'nie', 1, '', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookies2categories`
--

CREATE TABLE `cookies2categories` (
  `cookie` int(10) UNSIGNED NOT NULL,
  `category` bigint(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

--
-- Daten für Tabelle `cookies2categories`
--

INSERT INTO `cookies2categories` (`cookie`, `category`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookies2websites`
--

CREATE TABLE `cookies2websites` (
  `cookie` int(10) UNSIGNED NOT NULL,
  `website` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookie_allowlevel`
--

CREATE TABLE `cookie_allowlevel` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `bitmask` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

--
-- Daten für Tabelle `cookie_allowlevel`
--

INSERT INTO `cookie_allowlevel` (`id`, `bezeichnung`, `bitmask`) VALUES
(1, 'Allow', 1),
(2, 'Deny', 2),
(3, 'System', 4),
(4, 'CreateAccount', 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookie_categories`
--

CREATE TABLE `cookie_categories` (
  `id` bigint(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

--
-- Daten für Tabelle `cookie_categories`
--

INSERT INTO `cookie_categories` (`id`, `name`, `description`, `active`, `deleted`) VALUES
(1, 'Essentiell', 'Essentielle Cookies und Code-Elemente werden für die fehlerfreie technische Funktionalität unserer Webseite benötigt. Elemente der Kategorie Essentiell werden standardmäßig für alle Besucher beim Abruf unserer Internetseite eingesetzt und können in diesen E-Privacy-Einstellungen nicht deaktiviert werden. Wir setzen auf unserer Webseite folgende essentielle Elemente ein:', 1, 0),
(2, 'Marketing', 'Cookies und Code-Elemente der Kategorie Marketing werden auf unseren Webseiten eingesetzt um Marketingmaßnahmen wie beispielsweise Werbeschaltungen datengestützt auswertbar, nachvollziehbar und optimierbar für uns als Webseitenbetreiber zu gestalten. Nach Ihrer jeweils explizit zu erteilenden Einwilligung werden auf unserer Webseite die von Ihnen ausgewählten und in dieser Übersicht mit aktiv gekennzeichneten Elemente mit marketingspezifischen Funktionalitäten eingesetzt:', 1, 0),
(3, 'Tracking', 'Cookies und Code-Elemente der Kategorie Tracking ermöglichen das Verfolgen und Analysieren von Benutzerwegen und -strömen innerhalb eines spezifischen Internetangebots. Wir setzen diese Elemente auf unserer Webseite ein, um unser Internetangebot für unsere Besucher zu optimieren und das Nutzererlebnis kontinuierlich zu verbessern. Nach Ihrer jeweils explizit zu erteilenden Einwilligung werden auf unserer Webseite die von Ihnen ausgewählten und in dieser Übersicht mit aktiv gekennzeichneten Elemente zur Nachverfolgung und Analyse von Nutzerverhalten eingesetzt:', 1, 0),
(4, 'Social Media', 'Bei Elementen der Kategorie Social-Media handelt es sich um technische Verknüpfungen zu Drittanbietern deren Dienste Sie unter Umständen über einen beim jeweiligen Drittanbieter verwendeten persönlichen Account bereits aktiv nutzen. In einem solchen Fall ist der jeweilige Drittanbieter unter Umständen in der Lage, Ihren Besuch auf unserer Webseite nachzuverfolgen und in seinem Datenbestand abzuspeichern sowie auszuwerten. Klassische Beispiele für Social-Media sind Community-Dienste oder auch Bewertungsportale. \r\nNach Ihrer jeweils explizit zu erteilenden Einwilligung werden auf unserer Webseite die von Ihnen ausgewählten und in dieser Übersicht mit aktiv gekennzeichneten Social-Media Elemente eingesetzt:', 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookie_companies`
--

CREATE TABLE `cookie_companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `namezusatz` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `strassezusatz` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `impressum` varchar(255) NOT NULL,
  `datenschutz` varchar(255) NOT NULL,
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

--
-- Daten für Tabelle `cookie_companies`
--

INSERT INTO `cookie_companies` (`id`, `name`, `namezusatz`, `strasse`, `strassezusatz`, `ort`, `land`, `url`, `impressum`, `datenschutz`, `deleted`) VALUES
(1, 'Your first company', '', 'street 1', '', 'citytown', 'Germany', 'https://www.yoururl.com', 'https://www.yoururl.com/imprint', 'https://www.yoururl.com/privacy', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookie_sourcetypes`
--

CREATE TABLE `cookie_sourcetypes` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

--
-- Daten für Tabelle `cookie_sourcetypes`
--

INSERT INTO `cookie_sourcetypes` (`id`, `name`, `deleted`) VALUES
(1, 'No-Code (Internal/Essential)', 0),
(2, 'HTML-Tag (Append tags to document body)', 0),
(3, 'Plain Javascript-Code', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cookie_websites`
--

CREATE TABLE `cookie_websites` (
  `id` int(10) UNSIGNED NOT NULL,
  `host` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `deleted` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `csrftoken`
--

CREATE TABLE `csrftoken` (
  `sessionid` varchar(255) NOT NULL,
  `csrftoken` varchar(255) NOT NULL,
  `sended` varchar(255) NOT NULL,
  `zeitpunkt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login`
--

CREATE TABLE `login` (
  `sessionid` varchar(255) NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `loginlog`
--

CREATE TABLE `loginlog` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `datum` varchar(8) NOT NULL,
  `uhrzeit` varchar(6) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `sessionid` varchar(255) NOT NULL,
  `userid` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_0`
--

CREATE TABLE `opt_chain_0` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_1`
--

CREATE TABLE `opt_chain_1` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_2`
--

CREATE TABLE `opt_chain_2` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_3`
--

CREATE TABLE `opt_chain_3` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_4`
--

CREATE TABLE `opt_chain_4` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_5`
--

CREATE TABLE `opt_chain_5` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_6`
--

CREATE TABLE `opt_chain_6` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_7`
--

CREATE TABLE `opt_chain_7` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_8`
--

CREATE TABLE `opt_chain_8` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_9`
--

CREATE TABLE `opt_chain_9` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_A`
--

CREATE TABLE `opt_chain_A` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_B`
--

CREATE TABLE `opt_chain_B` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_C`
--

CREATE TABLE `opt_chain_C` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_D`
--

CREATE TABLE `opt_chain_D` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_E`
--

CREATE TABLE `opt_chain_E` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `opt_chain_F`
--

CREATE TABLE `opt_chain_F` (
  `usertoken` varchar(32) NOT NULL,
  `websiteid` int(10) UNSIGNED NOT NULL,
  `cookieid` int(10) UNSIGNED NOT NULL,
  `zeitpunkt` varchar(12) NOT NULL,
  `tcpip` varchar(255) NOT NULL,
  `allowlevel` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'allowlevel > 2 will not be used as parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pwhash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='CookieManager is released under the GNU Public License, version 3 or later. Author Oldpwd - JUSTilize GmbH - Frankfurt am Main';

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `pwhash`, `email`, `active`) VALUES
(1, 'admin', 'Administrator', '$2y$10$p0og/eWKFn1und4nPZ1eoeGhm1o2mZo8PHZLqgnzKWdMbuSpDg.Y.', '', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bruteforce`
--
ALTER TABLE `bruteforce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `zeitpunkt` (`zeitpunkt`),
  ADD KEY `counter` (`counter`);

--
-- Indizes für die Tabelle `cookiebars`
--
ALTER TABLE `cookiebars`
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `varid` (`varid`);

--
-- Indizes für die Tabelle `cookiebar_vars`
--
ALTER TABLE `cookiebar_vars`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cookieboxes`
--
ALTER TABLE `cookieboxes`
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `varid` (`varid`);

--
-- Indizes für die Tabelle `cookiebox_vars`
--
ALTER TABLE `cookiebox_vars`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company` (`company`),
  ADD KEY `sourcetype` (`sourcetype`),
  ADD KEY `deleted` (`deleted`);

--
-- Indizes für die Tabelle `cookies2categories`
--
ALTER TABLE `cookies2categories`
  ADD KEY `cookie` (`cookie`),
  ADD KEY `category` (`category`);

--
-- Indizes für die Tabelle `cookies2websites`
--
ALTER TABLE `cookies2websites`
  ADD KEY `cookie` (`cookie`),
  ADD KEY `website` (`website`);

--
-- Indizes für die Tabelle `cookie_allowlevel`
--
ALTER TABLE `cookie_allowlevel`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cookie_categories`
--
ALTER TABLE `cookie_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`);

--
-- Indizes für die Tabelle `cookie_companies`
--
ALTER TABLE `cookie_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`);

--
-- Indizes für die Tabelle `cookie_sourcetypes`
--
ALTER TABLE `cookie_sourcetypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deleted` (`deleted`);

--
-- Indizes für die Tabelle `cookie_websites`
--
ALTER TABLE `cookie_websites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `deleted` (`deleted`);

--
-- Indizes für die Tabelle `csrftoken`
--
ALTER TABLE `csrftoken`
  ADD UNIQUE KEY `csrftoken` (`csrftoken`),
  ADD KEY `sessionid` (`sessionid`),
  ADD KEY `sended` (`sended`),
  ADD KEY `zeitpunkt` (`zeitpunkt`);

--
-- Indizes für die Tabelle `login`
--
ALTER TABLE `login`
  ADD KEY `sessionid` (`sessionid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `zeitpunkt` (`zeitpunkt`);

--
-- Indizes für die Tabelle `loginlog`
--
ALTER TABLE `loginlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessionid` (`sessionid`);

--
-- Indizes für die Tabelle `opt_chain_0`
--
ALTER TABLE `opt_chain_0`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_1`
--
ALTER TABLE `opt_chain_1`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_2`
--
ALTER TABLE `opt_chain_2`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_3`
--
ALTER TABLE `opt_chain_3`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_4`
--
ALTER TABLE `opt_chain_4`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_5`
--
ALTER TABLE `opt_chain_5`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_6`
--
ALTER TABLE `opt_chain_6`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_7`
--
ALTER TABLE `opt_chain_7`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_8`
--
ALTER TABLE `opt_chain_8`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_9`
--
ALTER TABLE `opt_chain_9`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_A`
--
ALTER TABLE `opt_chain_A`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_B`
--
ALTER TABLE `opt_chain_B`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_C`
--
ALTER TABLE `opt_chain_C`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_D`
--
ALTER TABLE `opt_chain_D`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_E`
--
ALTER TABLE `opt_chain_E`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `opt_chain_F`
--
ALTER TABLE `opt_chain_F`
  ADD KEY `usertoken` (`usertoken`),
  ADD KEY `websiteid` (`websiteid`),
  ADD KEY `cookieid` (`cookieid`),
  ADD KEY `allowlevel` (`allowlevel`),
  ADD KEY `tcpip` (`tcpip`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bruteforce`
--
ALTER TABLE `bruteforce`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `cookiebar_vars`
--
ALTER TABLE `cookiebar_vars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT für Tabelle `cookiebox_vars`
--
ALTER TABLE `cookiebox_vars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT für Tabelle `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `cookie_allowlevel`
--
ALTER TABLE `cookie_allowlevel`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `cookie_categories`
--
ALTER TABLE `cookie_categories`
  MODIFY `id` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `cookie_companies`
--
ALTER TABLE `cookie_companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `cookie_sourcetypes`
--
ALTER TABLE `cookie_sourcetypes`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `cookie_websites`
--
ALTER TABLE `cookie_websites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `loginlog`
--
ALTER TABLE `loginlog`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2; 
-- 
-- UPDATE 20200131 
--
ALTER TABLE `cookies` 
  ADD `opttype` TINYINT UNSIGNED NOT NULL DEFAULT '1' COMMENT '1=Optin, 2=Optout' AFTER `sourcecode`;
--
-- UPDATE 20200625
--
INSERT INTO `cookiebar_vars` (`id`, `varname`, `input`, `defaultval`) VALUES (NULL, 'websiteimprint', 'input', 'impressum.html'), (NULL, 'websiteprivacy', 'input', 'datenschutz.html');
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
