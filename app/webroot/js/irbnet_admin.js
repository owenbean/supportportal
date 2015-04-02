var converter = new Markdown.Converter();

$(document).ready(function() {
	//this function allows entire table rows in list tables to be clickable
	$('tr.list-item').click( function() {
	    window.location = $(this).find('a').attr('href');
	}).hover( function() {
	    $(this).toggleClass('hover');
	});

	//Allows user to input "TBD" for go-live dates
	$("#tbd_button").on("click", function(e) {
		e.preventDefault();
		$(".date_picker").val("TBD");
	});
	
	//populates the "Submitted By" dropdown with a list of org admins
	$("#member_name").on("change", function() {
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
function otherEntry(submitter_name) {
	switch (submitter_name.value) {
		case 'Other':
			$("#adminAddPopUp").dialog("open");
			break;
		default:
			break;
	}
};

//add administrator popup
function otherAdmin() {
	$("#adminAddPopUp").dialog({
		autoOpen: false,
		heigh: 600,
		width: 700,
		modal: true,
		closeOnEscape: false,
		buttons: {
			Cancel: function() {
				$(this).dialog("close");
				var submitter = document.getElementById("LetterSubmitter");
				submitter.value = "";
			}
		}
	});
}

//not ready yet popup
function notYet() {
	alert("Coming soon!");
	return false;
}