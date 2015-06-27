var converter = new Markdown.Converter();

$(document).ready(function()
{
	//this function allows entire table rows in list tables to be clickable
	$('tr.list-item').click( function() {
	    window.location = $(this).find('a').attr('href');
	}).hover( function() {
	    $(this).toggleClass('hover');
	});

	//Allows user to input "TBD" for go-live dates
	$("#tbd_button").on("click", function(e) {
		e.preventDefault();
		$(this).closest("div").find("input").val("TBD");
	});
		
	//retired admin list for Member View page
	$(function() {
		//below function clears autofocus
		$.ui.dialog.prototype._focusTabbable = function(){};
		$('#retiredAdminsList').dialog({
			autoOpen: false,
			height: 'auto',
			width: 'auto',
			modal: true,
			buttons: {
				Close: function() {
					$(this).dialog('close');
				}
			}
		});

		$('#retiredAdminsLink').on('click', function() {
			$('#retiredAdminsList').dialog('open');
		});
	});

	//delete or retire popup on Member or Admin View page
	$(function() {
		$('#deleteRetirePopup').dialog({
			autoOpen: false,
			height: 'auto',
			width: 400,
			modal: true,
			buttons: {
				Cancel: function() {
					$(this).dialog('close');
				}
			}
		});

		$('#deleteRetireLink').on('click', function() {
			$('#deleteRetirePopup').dialog('open');
		});
	});

	//organization search box
	$(function() {
		$("#orgSearchBox").dialog({
			autoOpen: false,
			width: 400,
			modal: true,
			open: function() {
				$('#searchOrgName').focus();
			},
			buttons: {
				Search: function() {
					var searchTerm = $('#searchOrgName').value;
					if(searchTerm == '' || searchTerm == null) {
						alert('Please enter a name.');
						return false;
					} else {
						$(this).find("form").submit();						
					}
				},
				Cancel: function() {
					$(this).dialog("close");
				}
			}
		});
		
		$("#orgSearchLink").on("click", function() {
			$("#orgSearchBox").dialog("open");
		});
	});

	//admin search box
	$(function() {
		$("#adminSearchBox").dialog({
			autoOpen: false,
			height: 'auto',
			width: 400,
			modal: true,
			open: function() {
				$('#searchAdminName').focus();
			},
			buttons: {
				Search: function() {
					var searchTerm = $('#searchAdminName').value;
					if(searchTerm == '' || searchTerm == null) {
						alert('Please enter a name.');
						return false;
					} else {
						$(this).find("form").submit();						
					}
				},
				Cancel: function() {
					$(this).dialog("close");
				}
			}
		});
		
		$("#adminSearchLink").on("click", function() {
			$("#adminSearchBox").dialog("open");
		});
	});

	$('.date_picker').datepicker({
		dateFormat: 'yy-mm-dd'
	});

	$('#retired_admin_link').on('click', function(e) {
		e.preventDefault();
		$('#retired_admin_section').slideToggle('fast');
	})
	
	otherAdmin();

	//this function drives the formatting helper popup box
	$("#markdown_formatting_help_link").hover(function(e) {
		$($(this).data("tooltip")).css({ left: e.pageX - 10, top: e.pageY + 20 }).stop().show();
	}, function() {
		$($(this).data("tooltip")).hide();
	});

	//*****FAQ SECTION*******//

	//this checks to see if a question / answer is already present
	if (document.getElementById("FaqQuestionAnswer")) {
		var answer_preview = document.getElementById("FaqQuestionAnswer").value;
		document.getElementById("faq_answer_preview").innerHTML = converter.makeHtml(answer_preview);
		var question_preview = document.getElementById("FaqQuestionQuestion").value;
		document.getElementById("faq_question_preview").innerHTML = question_preview;		
	}

	//this updates the preview as the user types
	$("#FaqQuestionQuestion").on('keyup', function() {
		var question_preview = document.getElementById("FaqQuestionQuestion").value;
 		document.getElementById("faq_question_preview").innerHTML = question_preview;
	});	
	$("#FaqQuestionAnswer").on('keyup', function() {
		var answer_preview = document.getElementById("FaqQuestionAnswer").value;
 		document.getElementById("faq_answer_preview").innerHTML = converter.makeHtml(answer_preview);
	});
	
	//these two functions initiate the helper popups on the faq add/edit page.
	$("#faq_reference_help_link").hover(function(e) {
		$($(this).data("tooltip")).css({ left: e.pageX - 160, top: e.pageY + 1 }).stop().show();
	}, function() {
		$($(this).data("tooltip")).hide();
	});

	$("#faq_formatting_help_link").hover(function(e) {
		$($(this).data("tooltip")).css({ left: e.pageX - 150, top: e.pageY + 1 }).stop().show();
	}, function() {
		$($(this).data("tooltip")).hide();
	});

});


//trigger for add administrator popup on letter add page
function otherEntry(submitter_name)
{
	switch (submitter_name.value) {
		case 'Other':
			$("#adminAddPopUp").dialog("open");
			break;
		default:
			break;
	}
};

//add administrator popup
function otherAdmin()
{
	$("#adminAddPopUp").dialog({
		autoOpen: false,
		heigh: 600,
		width: 700,
		modal: true,
		closeOnEscape: false,
		buttons: {
			Cancel: function() {
				$(this).dialog("close");
				if (document.getElementById("LetterSubmitter")) {
    				var submitter = document.getElementById("LetterSubmitter");
				} else {
    				var submitter = document.getElementById("SmartFormProjectAdminId");    				
				}
				submitter.value = "";
			}
		}
	});
}

//not ready yet popup
function notYet()
{
	alert("Coming soon!");
	return false;
}

function activateMemberDropdown()
{
    var smartFormType = $('#SmartFormProjectType').val();
    var memberPlaceHolder = $('#member-placeholder');
    var memberName = $('#member_name');
    var dropdownHtml = "<div class='form-group' id='smart_form_holder'> \
                        <label class='col-sm-4 control-label'>Smart Form:</label> \
                        <div class='col-sm-5' id='smart_form_name'> \
                            <div class='input select'> \
                                <select name='data[SmartFormProject][smart_form_id]' disabled='disabled' class='form-control' id='SmartFormProjectSmartFormId'></select> \
                            </div> \
                        </div> \
                    </div> \
                    <div class='form-group' id='submitter_name_holder'> \
                        <label class='col-sm-4 control-label'>Request Submitted By:</label> \
                        <div class='col-sm-5' id='submitter_name'> \
                            <div class='input select'> \
                                <select name='data[SmartFormProject][admin_id]' disabled='disabled' class='form-control' id='SmartFormProjectAdminId'></select> \
                            </div> \
                        </div> \
                    </div>";
    
    $('#ajax-dropdown-container').html(dropdownHtml);

    if (smartFormType != '') {
        memberPlaceHolder.addClass('collapse');
        memberName.removeClass('collapse');
    } else {
        memberName.addClass('collapse');
        memberPlaceHolder.removeClass('collapse');
    }
    memberName.val(0);
}

//populates the "Submitted By" dropdown with a list of org admins
function activateSubmittedByDropdown()
{
	var memberId = document.getElementById("member_name").value;
	
	$.ajax({
		url: 'list_admin',
		type: 'GET',
		data: {
			member_id : memberId
		},
		error: function(){
			alert('Did not work');
		},
		success: function(data){
			$("#submitter_name").html(data);
		}
	});
}

//populates the "Submitted By" dropdown with a list of org admins
function submittedByAndSmartFormsDropdowns()
{
	var memberId = document.getElementById("member_name").value;
	var requestType = document.getElementById("SmartFormProjectType").value;
	
	$.ajax({
		url: 'list_admin_and_forms',
		type: 'GET',
		data: {
			member_id : memberId,
			request_type : requestType
		},
		error: function(){
			alert('Did not work');
		},
		success: function(data){
			$("#ajax-dropdown-container").html(data);
		}
	});
}