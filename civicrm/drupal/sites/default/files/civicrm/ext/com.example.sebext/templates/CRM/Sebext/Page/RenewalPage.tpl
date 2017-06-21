
{if $rows}
<div id="renewal">
	{strip}
		{* handle enable/disable actions*}
		{include file="CRM/common/enableDisableApi.tpl"}
		<table id="options" class="row-highlight">
			<thead>
				<tr>
					<th>{ts}Period{/ts}</th>
					<th>{ts}Start Date{/ts}</th>
					<th>{ts}End Date{/ts}</th>
					<th>{ts}Type{/ts}</th>
					<th>{ts}Contribution{/ts}</th>
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
					<td class="crmf-name " >{$row.contribution_id}</td>
				</tr>
			{/foreach}
		</table>
	{/strip}

	</div>
{else}
	{if $action ne 1}
		<div class="messages status no-popup">
			<img src="{$config->resourceBase}i/Inform.gif" alt="{ts}status{/ts}"/>
			{capture assign=crmURL}{crmURL p='civicrm/admin/member/membership/add' q="action=add&reset=1"}
			{/capture}{ts 1=$crmURL}There are no memberships entered. You can <a href='%1'>add one</a>.{/ts}
		</div>
	{/if}
{/if}
