
{if $rows}
<div id="renewal">
	{strip}
		{* handle enable/disable actions*}
		{include file="CRM/common/enableDisableApi.tpl"}

    <p class="description">
      {ts}Click contribution amount to view details.{/ts}
    </p>


		<table id="options" class="row-highlight">
			<thead>
				<tr>
					<th>{ts}Period{/ts}</th>
					<th>{ts}Start Date{/ts}</th>
					<th>{ts}End Date{/ts}</th>
					<th>{ts}Type{/ts}</th>
{*					<th>{ts}Contribution{/ts}</th>   *}
					<th>{ts}Amount{/ts}</th>
					<th></th>
				</tr>
			</thead>

			{foreach from=$rows item=row}
				<tr id="renewal-{$row.id}"
						class="crm-entity
							{cycle values='odd-row,even-row'}
							{$row.class} crm-renewal {if NOT $row.is_active
							}
						disabled{/if}">
					<td class="crmf-name " >{$row.id}</td>
					<td class="crmf-fixed_period_start_day">{$row.startdate}</td>
					<td class="crmf-fixed_period_start_day">{$row.enddate}</td>
					<td class="crmf-name " >{$row.membership_type}</td>
{*					<td class="crmf-name " >{$row.contribution_id}</td>    *}

					<td class="crm-contribution-amount">
						{if $row.net_amount}
							<a class="nowrap bold crm-expand-row" 
							title="{ts}view payments{/ts}" href="{crmURL p='civicrm/payment' 
							q="view=transaction&component=contribution&action=browse&cid=`$row.contact_id`&id=`$row.contribution_id`&selector=1"}">
							  &nbsp; {$row.net_amount|crmMoney:$row.currency}
							</a>
						{/if}
					</td>

				</tr>
			{/foreach}
		</table>
	{/strip}

	</div>
{else}
	{if $action ne 1}
		<div class="messages status no-popup">
			<img src="{$config->resourceBase}i/Inform.gif" alt="{ts}status{/ts}"/>
			{/capture}{ts 1=$crmURL}There are no renewals entered..{/ts}
		</div>
	{/if}
{/if}


