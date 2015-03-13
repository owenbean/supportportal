var converter = new Markdown.Converter();

$(document).ready(function() {
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
	
	//org details page slide down for committees and smart forms
	$(".section_details_head").on("click", function(e) {
		e.preventDefault();
		$(this).closest(".section_details").find(".hidden_row").slideToggle();
		$(this).find(".arrow").toggleClass("arrow_clicked");
	});
	
	//populates the "Submitted By" dropdown with a list of org admins
	$("#member_name").on("change", function() {
		var memberId = document.getElementById("member_name").value;
			$.ajax({
				url: 'list_admin',
				type: 'GET',
				data: { member_id : memberId },
				error: function(){ alert('Did not work'); },
				success: function(data){
					$("#submitter_name").html(data);
				}
			});
	});
	
	
	//organization search box
	$(function() {
		$("#orgSearchBox").dialog({
			autoOpen: false,
			height: 300,
			width: 400,
			modal: true,
			buttons: {
				Search: function() {
					$(this).find("form").submit();
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
			height: 300,
			width: 400,
			modal: true,
			buttons: {
				Search: function() {
					$(this).find("form").submit();
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


//trigger for add administrator popup
var otherEntry;
otherEntry = function(submitter_name) {
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
//	var firstName = $("#admin_first_name");
//	var lastName = $("#admin_last_name");
//	var email = $("#admin_email");
//	var allFields = $([]).add(firstName).add(lastName).add(email);
	$("#adminAddPopUp").dialog({
		autoOpen: false,
		heigh: 600,
		width: 700,
		modal: true,
		closeOnEscape: false,
		buttons: {
			/*
			Submit: function() {
				var bValid = true;
				allFields.removeClass("fieldError");
				var orgName = document.getElementById("org_name").value;
				if($('#contract_lead').is(':checked')){
					var contractLead = 1;
				} else {
					var contractLead = 0;
				};
				if($('#billing_coord').is(':checked')){
					var billingCoord = 1;
				} else {
					var billingCoord = 0;
				};
				if($('#feature_announcement_list').is(':checked')){
					var featureAnnounce = 1;
				} else {
					var featureAnnounce = 0;
				};
				if($('#support_outreach_list').is(':checked')){
					var supportOutreach = 1;
				} else {
					var supportOutreach = 0;
				};
				bValid = bValid && checkLength(firstName, 1);
				bValid = bValid && checkLength(lastName, 1);
				bValid = bValid && checkLength(email, 1);
				if (bValid) {
					$.ajax({
						type: "post",
						url: "../admins/add",
						data: {admin_org_name: orgName,
								admin_first_name: firstName.val(),
								admin_last_name: lastName.val(),
								admin_email: email.val(),
								contract_lead: contractLead,
								billing_coord: billingCoord,
								feature_announcement_list: featureAnnounce,
								support_outreach_list: supportOutreach,
							},
						error: function() {
							alert('Failed');
						},
						success:function(data) {
							location.reload();
						}
					});
				};
			},
			*/
			Cancel: function() {
				$(this).dialog("close");
				var submitter = document.getElementById("LetterSubmitter");
				submitter.value = "";
			}
		}
	});

}

//data validation for modal popups
function checkLength(field, min) {
	if (field.val().length < min || field.val() == 'empty') {
		$(".errorTip").show();
		field.addClass("fieldError");
		setTimeout(function() {
			$(".errorTip").fadeOut(1500)
		}, 1000);
		return false;
	} else {
		return true;
	}
}

function checkDropDown(field) {
	if (field.val() == 'empty') {
		$(".errorTip").show();
		field.addClass("fieldError");
		setTimeout(function() {
			$(".errorTip").fadeOut(1500)
		}, 1000);
		return false;
	} else {
		return true;
	}
}	

//not ready yet popup
function notYet() {
	alert("Coming soon!");
	return false;
}



//DATA VALIDATION FUNCTIONS


//checks that username is unique before leaving page
function userProfileValidate() {
	var userUsername = document.forms["userProfileEdit"]["system_admin_username"].value;
	var userPassword = document.forms["userProfileEdit"]["system_admin_password"].value;
	var userEmail = document.forms["userProfileEdit"]["system_admin_email"].value;
	var dupUsername = $("#system_admin_username").hasClass("invalid_entry");
	if (userUsername == '') {
		alert('Please enter a username.');
		return false;
	} else if (userPassword == '') {
		alert('Please enter a password.');
		return false;
	} else if (userEmail == '') {
		alert('Please enter an email address.');
		return false;
	} else if (dupUsername) {
		alert('Please choose an available username.');
		return false;
	} else {
		return true;
	}
}