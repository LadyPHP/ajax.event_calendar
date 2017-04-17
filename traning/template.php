<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="row">
	<? /* выбор города и месяца для вывода на календарь - begin */ ?>
			<?if($arResult["PREV_MONTH_URL"] && $arResult["NEXT_MONTH_URL"] && !$arParams["SHOW_MONTH_LIST"]):?>
				&nbsp;&nbsp;|&nbsp;&nbsp;
			<?endif?>
			<?	
			if($arParams["SORT_SITY"]):
			?>
					<label>
						Укажите город:
					&nbsp;&nbsp;
					<? /* список городов для выбора */ ?>
					<select onChange="b1_result()" name="SITY_SELECT" id="sity_sel">
						<?foreach($arResult["SORT_SITY"] as $sity => $arOption):?>
							<option value="<?=$arOption["VALUE"]?>" <?if($arResult["currentSity"] == $arOption["NAME"]) echo "selected";?>><?=$arOption["NAME"]?></option>
						<?endforeach?>
					</select>
					&nbsp;&nbsp;
					</label>
					<script language="JavaScript" type="text/javascript">
					<!--
					function b1_result()
					{
						var idx = document.getElementById("sity_sel").selectedIndex;
						<?if($arParams["AJAX_ID"]):?>
							BX.ajax.insertToNode(document.getElementById("sity_sel").options[idx].value, 'comp_<?echo CUtil::JSEscape($arParams['AJAX_ID'])?>', <?echo $arParams["AJAX_OPTION_SHADOW"]=="Y"? "true": "false"?>);
						<?else:?>
							window.document.location.href=document.getElementById("sity_sel").options[idx].value;
						<?endif?>
					}
					-->
					</script>
				<?Endif;?>
				<?if($arResult["SHOW_MONTH_LIST"]):?>
					<label>
						Укажите месяц:
					&nbsp;&nbsp;
					<? /* список городов для выбора */ ?>
					<select onChange="b_result()" name="MONTH_SELECT" id="month_sel">
						<?foreach($arResult["SHOW_MONTH_LIST"] as $month => $arOption):?>
							<option value="<?=$arOption["VALUE"]?>" <?if($arResult["currentMonth"] == $month) echo "selected";?>><?=$arOption["DISPLAY"]?><?echo" ".$arResult["currentYear"];?></option>
						<?endforeach?>
					</select>
					&nbsp;&nbsp;
					</label>
					<script language="JavaScript" type="text/javascript">
					<!--
					function b_result()
					{
						var idx = document.getElementById("month_sel").selectedIndex;
						<?if($arParams["AJAX_ID"]):?>
							BX.ajax.insertToNode(document.getElementById("month_sel").options[idx].value, 'comp_<?echo CUtil::JSEscape($arParams['AJAX_ID'])?>', <?echo $arParams["AJAX_OPTION_SHADOW"]=="Y"? "true": "false"?>);
						<?else:?>
							window.document.location.href=document.getElementById("month_sel").options[idx].value;
						<?endif?>
					}
					-->
					</script>
			<?endif?>
	<? /* выбор города и месяца для вывода на календарь - begin */ ?>
	<br />
	<br />
	<? /* тело календаря - begin */ ?>
	<table class="calendar" cellspacing="0"><tbody>
	<tr>
	<?foreach($arResult["WEEK_DAYS"] as $WDay):?>
		<th><?=$WDay["SHORT"]?></th>
	<?endforeach?>
	</tr>
	<?foreach($arResult["MONTH"] as $arWeek): ?>
	<tr>
		<?foreach($arWeek as $key =>$arDay): ?>
		<td <?if($key == 5 || $key == 6){echo'class="holyday"';}?>>
			<span class="daynum">
				<?=$arDay["day"]?>
			</span>
			<?foreach($arDay["events"] as $arEvent): ?>
				<div class="eventday">
                    <strong><?=$arEvent["time"]?></strong>
					<p style="line-height:1;margin-bottom:6px;">
						<?=$arEvent["title"]?>
					</p>
					<p style="line-height:1;">
						<font color="darkblue"><?=$arEvent["trainers"]?></font>
					<br>
						<font color="#f9a211"><?=$arEvent["address"]?></font>
					</p>
					<?
					/* кнопку регистрации показывем только для будующих событий - проверяем $arEvent["url_registration"] */
					if(!empty($arEvent["url_registration"])){
					?>
						<a class="traning-registration-btn" href="<?=$arEvent["url_registration"]?>"><?=$arParams["NAME_BUTTON_REGISTRATION"]?>
						</a>
						<?						
					}
					?>
					</a>
				</div>
			<?endforeach?>
		</td>
		<?endforeach?>
	</tr >
	<?endforeach?>
	</tbody>
	</table>
	<? /* выбор города и месяца для вывода на календарь - end */ ?>
</div>
