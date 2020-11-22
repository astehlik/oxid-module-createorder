[{$smarty.block.parent}]

<script type="text/javascript">
    <!--
    function SetBillDate( sID)
    {
        document.myedit['editval[oxorder__oxbilldate]'].value=sID;
    }
    //-->
</script>

<tr>
    <td class="edittext">
        Rechnungsdatum
    </td>
    <td class="edittext">
        [{assign var=date value=$edit->oxorder__oxbilldate->value|replace:"0000-00-00":""}]
        <input type="text" class="editinput" size="25" name="editval[oxorder__oxbilldate]" value="[{$edit->oxorder__oxbilldate|oxformdate}]" [{include file="help.tpl" helpid=article_vonbis}] [{$readonly}]>&nbsp;<a href="Javascript:SetBillDate('[{$sNowValue|oxformdate:'date':true}]');" class="edittext" [{if $readonly}]onclick="JavaScript:return false;"[{/if}]><u>[{oxmultilang ident="ORDER_MAIN_CURRENT_DATE"}]</u></a>
    </td>
</tr>
