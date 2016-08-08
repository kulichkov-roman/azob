<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
	<title><? $APPLICATION->ShowTitle() ?></title>
	<meta charset="<?= LANG_CHARSET ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=1002">
	<? if (ENVIRONMENT === 'production') { ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/<?= JQVERSION ?>/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="<?= SITE_TEMPLATE_PATH ?>/javascripts/vendor/jquery-<?= JQVERSION ?>.min.js"><\/script>')</script>
	<?
	}

	if (ENVIRONMENT === 'development') {
		?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/<?= JQVERSION ?>/jquery.js"></script>
		<script>window.jQuery || document.write('<script src="<?= SITE_TEMPLATE_PATH ?>/javascripts/vendor/jquery-<?= JQVERSION ?>.js"><\/script>')</script>
	<?
	}	
	$APPLICATION->ShowHead();

	# Подключаем favicons
	if (file_exists(dirname(__FILE__) . '/favicons.php')) {
		include 'favicons.php';
	}
	?>
	<script src="<?=SITE_TEMPLATE_PATH?>/javascripts/main.js"></script>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . '/stylesheets/css/developers.css');?>
</head>
<body>
<!--[if lt IE 9]>
<h3>Ваш браузер устарел!</h3>
<p>
	Вы пользуетесь устаревшей версией браузера Internet Explorer. Данная версия браузера не поддерживает многие
	современные технологии, из-за чего многие страницы отображаются некорректно, а главное — на сайтах могут
	работать не все функции. В связи с этим на Ваш суд представляются более современные браузеры. Все они бесплатны,
	легко устанавливаются и просты в использовании.
</p>
<p class="browsehappy">
	<a href="http://browsehappy.com/">Browsehappy.com</a> Вам поможет определиться с современным браузером.
</p>
<![endif]-->

<? if ($USER->isAdmin()) { ?>
	<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<? } ?>

<div id="case">
	<div class="container">
		<header>
			<div class="col-lg-12">
				<div id="logo">
					<a href="<?= SITE_DIR; ?>">
						<img src="/bitrix/templates/bitrix-ripe/images/header-logo.png" alt="" width="122" height="99">

						<div id="slogan">
							<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/header-slogan.php", Array(), Array("MODE" => "html")); ?>
						</div>
					</a>
				</div>

				<div id="header-phone">
					<div class="text">
						бесплатно <br> круглосуточно
					</div>

					<div class="number">
						<? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/header-phone.php", Array(), Array("MODE" => "html")); ?>
					</div>
				</div>

				<a id="header-order-call" data-toggle="modal" href="<?= SITE_TEMPLATE_PATH ?>/templates/modals/order-call.php" data-target="#order-call-modal">Заказать звонок</a>

				<div id="order-call-modal" class="modal fade header-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
						</div>
					</div>
				</div>

				<div id="login">
					<? $APPLICATION->IncludeComponent("bss:auth.form", "header",
						array(
							"REGISTER_URL" => SITE_DIR . "login/",
							"PROFILE_URL" => SITE_DIR . "personal/",
							"SHOW_ERRORS" => "N"
						),
						false,
						array()
					);?>
				</div>

				<div id="search">
					<?$APPLICATION->IncludeComponent("bitrix:search.title", "",
						array(
							"NUM_CATEGORIES" => "1",
							"TOP_COUNT" => "5",
							"CHECK_DATES" => "N",
							"SHOW_OTHERS" => "N",
							"PAGE" => SITE_DIR . "catalog/",
							"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
							"CATEGORY_0" => array(
								0 => "iblock_catalog",
							),
							"CATEGORY_0_iblock_catalog" => array(
								0 => "all",
							),
							"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
							"SHOW_INPUT" => "Y",
							"INPUT_ID" => "title-search-input",
							"CONTAINER_ID" => "search",
							"PRICE_CODE" => array(
								0 => "BASE",
							),
							"SHOW_PREVIEW" => "Y",
							"PREVIEW_WIDTH" => "75",
							"PREVIEW_HEIGHT" => "75",
							"CONVERT_CURRENCY" => "Y"
						),
						false
					);?>
				</div>

				<div id="basket">
					<? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "",
						array(
							"PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
							"PATH_TO_PERSONAL" => SITE_DIR . "personal/",
							"SHOW_PERSONAL_LINK" => "N"
						),
						false,
						array()
					);?>
				</div>

				<div id="shoe-image"></div>
				<?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu_new",
					array(
						"ROOT_MENU_TYPE" => "top",
						"MENU_CACHE_TYPE" => "Y",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(),
						"MAX_LEVEL" => "2",
						"CHILD_MENU_TYPE" => "",
						"USE_EXT" => "Y",
						"ALLOW_MULTI_SELECT" => "N"
					)
				);?>
				<?/*?>
				<nav id="top-menu">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu",
						array(
							"ROOT_MENU_TYPE" => "top",
							"MENU_CACHE_TYPE" => "Y",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
							"MAX_LEVEL" => "1",
							"USE_EXT" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						)
					);?>
				</nav>
				<?*/?>
			</div>
		</header>

		<div id="breadcrumb" class="row">
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "eshop_adapt", array(
					"START_FROM" => "1",
					"PATH" => "",
					"SITE_ID" => "-"
				),
				false,
				Array('HIDE_ICONS' => 'Y')
			);?>
		</div>

		<section class="row">

			<? if (SIDEBAR === 'left') {?>
				<div id="sidebar-left" class="col-lg-2">
	<div class="content-block">		
		<div class="content-block-inner">			
			<? $APPLICATION->IncludeComponent("bitrix:menu", "catalog", array(
				"ROOT_MENU_TYPE" => "left",
				"MENU_CACHE_TYPE" => "A",
				"MENU_CACHE_TIME" => "36000000",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"MENU_CACHE_GET_VARS" => array(
				),
				"MAX_LEVEL" => "3",
				"CHILD_MENU_TYPE" => "left",
				"USE_EXT" => "Y",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N"
				),
				false
			);?>			
			<?
			if ($APPLICATION->GetCurPage(false) !== '/'):
				$APPLICATION->IncludeComponent("bitrix:news.list", "news", array(
				"IBLOCK_TYPE" => "news",
				"IBLOCK_ID" => "5",
				"NEWS_COUNT" => "3",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"FILTER_NAME" => "",
				"FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"INCLUDE_SUBSECTIONS" => "Y",
				"PAGER_TEMPLATE" => ".default",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "Новости",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "Y",
				"DISPLAY_DATE" => "Y",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"AJAX_OPTION_ADDITIONAL" => ""
				),
				false
			);
			endif;
			?>
		</div>
	</div>
</div>
			<?} ?>

			<main class="col-lg-10">
