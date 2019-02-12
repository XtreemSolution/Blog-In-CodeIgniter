<script type="text/javascript">
//Delete Record
	function deleteRecord($this) {
		$('#DeleteModal').modal('show');
		$('#RecordID').val($($this).data('id'));
		$('#DeleteForm').attr('action', $($this).data('url'));
	}

	function callBackCommonDelete(data)
	{
		$('#DeleteModal').modal('hide');
		$('#alert_confirm_div').modal('hide');
		// submitSearchData();
		location.reload();
	}

//Change Record Status
	function changeStatusCommon($this)  {
		var action_url = $($this).attr('data-url');
		var record_id = $($this).attr('data-id');
		var next_status = $($this).attr('data-status');
	
		if(action_url && record_id && next_status)
		{
			$.getJSON(action_url,{id:record_id,status:next_status},function(data){
				if(data.success)
				{
					checkTosterResponse(data);
					// submitSearchData();
					location.reload();
				}
			})
		}
	}
</script>

<script type="text/javascript">
	//Code for Check Checkbox is not Blank
function checkForNullChecked(task,$this)
{
	var selected = new Array();
	$("#sample_3 input.recordcheckbox:checked").each(function() {
			selected.push($(this).val());
	});
	if(selected.length==0)
	{
		$("#alert_message_div").modal('show');
		$("#alert_message_div").find("#alert_message_div_header").text('Ohh!');
		$("#alert_message_div").find("#alert_message_div_message").text('Please select at least one record');
	}
	else
	{
		var taskurl = $($this).attr('data-taskurl');		
		showConfirmDialogTableMultiple(task,taskurl);
	}
}

//Show Confirm Dialog Popup 
function showConfirmDialogTableMultiple(task,taskurl)
{
	$('#alert_confirm_div').modal('show');
	$('#alert_confirm_div').find('#confirm_alert_message_header').text('Please confirm');
	$('#alert_confirm_div').find('#confirm_alert_message_body').text('Are you sure want to '+task+' this record');
	$('#alert_confirm_div').find('.confirm_btn').removeClass('green');
	$('#alert_confirm_div').find('.confirm_btn').removeClass('purple');
	$('#alert_confirm_div').find('.confirm_btn').removeClass('red');
	if(task=='Active')
	$('#alert_confirm_div').find('.confirm_btn').addClass('green');

	else if(task=='Inactive')
	$('#alert_confirm_div').find('.confirm_btn').addClass('purple');

	else if(task=='Deleted')
	$('#alert_confirm_div').find('.confirm_btn').addClass('red');

	else if(task=='Completed')
	$('#alert_confirm_div').find('.confirm_btn').addClass('green');

	else if(task=='Declined')
	$('#alert_confirm_div').find('.confirm_btn').addClass('red');

	else if(task=='Registered')
	$('#alert_confirm_div').find('.confirm_btn').addClass('blue');

    else if(task=='Decline')
	$('#alert_confirm_div').find('.confirm_btn').addClass('red');

    else if(task=='Approved')
	$('#alert_confirm_div').find('.confirm_btn').addClass('green');

    else if(task=='Pending')
	$('#alert_confirm_div').find('.confirm_btn').addClass('decline_info');

	else if(task=='Delete')
	$('#alert_confirm_div').find('.confirm_btn').addClass('red');
	$('#alert_confirm_div').find('#DeleteMultipleForm').attr('action',taskurl);
	var selected = new Array();
   		$("#sample_3 input.recordcheckbox:checked").each(function() {
     		selected.push($(this).val());
 	});
 	$('#alert_confirm_div').find('#multiple_Ids').val(selected);
 	$('#alert_confirm_div').find('#task').val(task);
}	
</script>
<script type="text/javascript">
jQuery(document).on('change','#sample_3 .group-checkable',function () {
    var set = jQuery(this).attr("data-set");
    var checked = jQuery(this).is(":checked");
    jQuery(set).each(function () {
        if (checked) {
            $(this).attr("checked", true);
        } else {
            $(this).attr("checked", false);
        }                    
    });
    jQuery.uniform.update(set);
});	
jQuery(document).on('change','#sample_3 .recordcheckbox',function () {
	 var checked = jQuery(this).is(":checked");
	 if (checked) {
            $(this).attr("checked", true);
        } else {
            $(this).attr("checked", false);
        }   
});
</script>
<script type="text/javascript">
// $(function(){
//             var sampleTags = ['c++', 'java', 'php', 'coldfusion', 'javascript', 'asp', 'ruby', 'python', 'c', 'scala', 'groovy', 'haskell', 'perl', 'erlang', 'apl', 'cobol', 'go', 'lua'];

//             //-------------------------------
//             // Minimal
//             //-------------------------------
//             $('#myTags').tagit();

//             //-------------------------------
//             // Single field
//             //-------------------------------
//             $('#singleFieldTags').tagit({
//                 availableTags: sampleTags,
//                 // This will make Tag-it submit a single form value, as a comma-delimited field.
//                 singleField: true,
//                 singleFieldNode: $('#mySingleField')
//             });

//             // singleFieldTags2 is an INPUT element, rather than a UL as in the other 
//             // examples, so it automatically defaults to singleField.
//             $('#singleFieldTags2').tagit({
//                 availableTags: sampleTags
//             });

//             //-------------------------------
//             // Preloading data in markup
//             //-------------------------------
//             $('#myULTags').tagit({
//                 availableTags: sampleTags, // this param is of course optional. it's for autocomplete.
//                 // configure the name of the input field (will be submitted with form), default: item[tags]
//                 itemName: 'item',
//                 fieldName: 'tags'
//             });

//             //-------------------------------
//             // Tag events
//             //-------------------------------
//             var eventTags = $('#eventTags');

//             var addEvent = function(text) {
//                 $('#events_container').append(text + '<br>');
//             };

//             eventTags.tagit({
//                 availableTags: sampleTags,
//                 beforeTagAdded: function(evt, ui) {
//                     if (!ui.duringInitialization) {
//                         addEvent('beforeTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
//                     }
//                 },
//                 afterTagAdded: function(evt, ui) {
//                     if (!ui.duringInitialization) {
//                         addEvent('afterTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
//                     }
//                 },
//                 beforeTagRemoved: function(evt, ui) {
//                     addEvent('beforeTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
//                 },
//                 afterTagRemoved: function(evt, ui) {
//                     addEvent('afterTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
//                 },
//                 onTagClicked: function(evt, ui) {
//                     addEvent('onTagClicked: ' + eventTags.tagit('tagLabel', ui.tag));
//                 },
//                 onTagExists: function(evt, ui) {
//                     addEvent('onTagExists: ' + eventTags.tagit('tagLabel', ui.existingTag));
//                 }
//             });

//             //-------------------------------
//             // Read-only
//             //-------------------------------
//             $('#readOnlyTags').tagit({
//                 readOnly: true
//             });

//             //-------------------------------
//             // Tag-it methods
//             //-------------------------------
//             $('#methodTags').tagit({
//                 availableTags: sampleTags
//             });

//             //-------------------------------
//             // Allow spaces without quotes.
//             //-------------------------------
//             $('#allowSpacesTags').tagit({
//                 availableTags: sampleTags,
//                 allowSpaces: true
//             });

//             //-------------------------------
//             // Remove confirmation
//             //-------------------------------
//             $('#removeConfirmationTags').tagit({
//                 availableTags: sampleTags,
//                 removeConfirmation: true
//             });
            
//         });

</script><!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

<div class="modal fade bs-modal-sm" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form role="form" method="post" action="" class="ajax_form" id="DeleteForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Delete</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control" name="record_id" value="" id="RecordID">					
					Are You Sure! You want to delete?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn red">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>                              