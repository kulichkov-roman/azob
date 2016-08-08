<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
if (!empty($arResult['ITEMS'])) {?>
	<div id="section-product" class="row">
		<? foreach ($arResult['ITEMS'] as $arItem) {
			if (is_array($arItem)) {
				$bPicture = is_array($arItem["PREVIEW_PICTURE"]);
				?>
				<a class="product-preview col-lg-2" itemscope itemtype="http://schema.org/Product" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
					<div class="image">
						<?if($arItem['PROPERTIES']['ATTR_STOCK']['VALUE'] == 'да') {?>
							<div class="sale-label sale-label-new">акция</div>
						<?}?>
						<div class="fixer">
							<? if ($bPicture): ?>
								<img itemprop="image" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arElement["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arElement["NAME"] ?>">
								<div class="zoom"></div>
							<? else: ?>
								<div class="no-photo-div-big"></div>
							<?endif ?>
						</div>
					</div>

					<div class="info">
						<div class="title" itemprop="name"><?= $arItem["NAME"] ?></div>
						<div class="category">Оптовая цена</div>
						<div class="cost">
							<span class="pair"><?= needleMoneyFormat($arItem["PROPERTIES"]["PAIR_PRICE"]["VALUE"]) ?></span>
							<?= ($oldPrice = $arItem["PROPERTIES"]["OLD_PRICE"]["VALUE"]) ? "<span class=\"old-price\">" . needleMoneyFormat($oldPrice) . "</span>" : "" ?>
						</div>
					</div>
				</a>
			<?}?>
		<?}?>
	</div>
<?}

if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
	echo $arResult["NAV_STRING"]; echo $arResult["DESCRIPTION"];
}
