$(document).ready(function() {
	$("#tbd_button").on("click", function(e) {
		e.preventDefault();
		$(".date_picker").val("TBD");
	});
	
	//controll for new nav
	$(".nav_text").hover(function(e) {
		e.preventDefault();
		$(this).find(".sub_nav_menu").slideToggle(200);
	});
	
	//same as above but for right side
	$("#nav_right_side").hover(function(e) {
		e.preventDefault();
		$("#right_sub_nav_menu").slideToggle(200);
	});
	
	//set width of dropdown menus
	$(".nav_text").on("mouseenter", function() {
		var parentWidth = $(this).width();
		var childWidth = $(this).find(".sub_nav_menu").width();
		if (parentWidth > childWidth) {
			$(this).find(".sub_nav_menu").css("width", parentWidth);
		}
	});
	
	//same as above but for right side
	$("#nav_right_side").on("mouseenter", function() {
		var parentWidth = $(this).find(".nav_text").width();
		var childWidth = $(this).find(".sub_nav_menu").width();
		if (parentWidth > childWidth) {
			$(this).find(".sub_nav_menu").css("width", parentWidth);
		}
	});
	
	//home page menus
	$(".home_menu_head p").on("click", function(event) {
		event.preventDefault();
		$(this).closest(".home_menu").find(".home_sub_menu").slideToggle();
		$(this).find(".pointer_arrow_click").toggleClass("arrow_clicked");
	});
	
	//org details page slide down for committees and smart forms
	$(".section_details_head").on("click", function(e) {
		e.preventDefault();
		$(this).closest(".section_details").find(".hidden_row").slideToggle();
		$(this).find(".arrow").toggleClass("arrow_clicked");
	});
	
	//populates the "Submitted By" dropdown with a list of org admins
	$("#org_name").on("change", function() {
		var orgName = document.getElementById("org_name").value;
		if (orgName == 'empty') {
			$("#submitter_name").attr("disabled", true);
			$("#submitter_name").addClass("submitter_inactive");
		} else {
			$.post('global_pages/admin_list.php', { org: orgName }, function(result) {
				$('#submitter_name').html(result);
				$('#submitter_name').attr("disabled", false);
				$('#submitter_name').removeClass("submitter_inactive");
				}
			);
		}
	});

	//checks for duplicate org short name when user clicks away from input
	$("#org_short_name").on("blur", function() {
		var orgShortName = document.getElementById("org_short_name").value;
		var orgIndex = document.getElementById("org_index").value;
		if (orgShortName != "") {
			$.post('global_pages/form_entry_validation.php?shortName', { orgName: orgShortName, orgIndex: orgIndex }, function(result) {
				if (result == "<span style='color:#41ad49'>Short Name is available!<span>") {
					$("#org_short_name").addClass("valid_entry");
					$("#org_short_name").next(".entry_validation").addClass("entry_validation_good");
					$("#org_short_name").parent("td").find(".entry_validation_message").html(result);;
				} else if (result == "<span style='color:blue'>Short Name already belongs to group</span>") {
					$("#org_short_name").addClass("valid_entry");
					$("#org_short_name").next(".entry_validation").addClass("entry_validation_good");
				} else {
					$("#org_short_name").addClass("invalid_entry");
					$("#org_short_name").next(".entry_validation").addClass("entry_validation_no_good");
					$("#org_short_name").parent("td").find(".entry_validation_message").html(result);;
				}
			});
		}
	});

	//checks for duplicate org id when user clicks away from input
	$("#org_id").on("blur", function() {
		var orgId = document.getElementById("org_id").value;
		var orgIndex = document.getElementById("org_index").value;
		if (orgId != "") {
			$.post('global_pages/form_entry_validation.php?id', { orgID: orgId, orgIndex: orgIndex }, function(result) {
				if (result == "<span style='color:#41ad49'>ID is available!<span>") {
					$("#org_id").addClass("valid_entry");
					$("#org_id").next(".entry_validation").addClass("entry_validation_good");
					$("#org_id").parent("td").find(".entry_validation_message").html(result);;
				} else if (result == "<span style='color:blue'>ID already belongs to group</span>") {
					$("#org_id").addClass("valid_entry");
					$("#org_id").next(".entry_validation").addClass("entry_validation_good");				
				} else {
					$("#org_id").addClass("invalid_entry");
					$("#org_id").next(".entry_validation").addClass("entry_validation_no_good");
					$("#org_id").parent("td").find(".entry_validation_message").html(result);;
				}
			});
		}
	});
	
	//checks for duplicate system admin username when user clicks away from input
	$("#system_admin_username").on("blur", function() {
		var userName = document.getElementById("system_admin_username").value;
		var userIndex = document.getElementById("system_admin_index").value;
		if (userName != "") {
			$.post('global_pages/form_entry_validation.php?username', { username: userName, userIndex: userIndex }, function(result) {
				if (result == "<span style='color:#41ad49'>Username is available!<span>") {
					$("#system_admin_username").addClass("valid_entry");
					$("#system_admin_username").next(".entry_validation").addClass("entry_validation_good");
					$("#system_admin_username").parent("td").find(".entry_validation_message").html(result);;
				} else if (result == "<span style='color:blue'>Username already belongs to this user</span>") {
					$("#system_admin_username").addClass("valid_entry");
					$("#system_admin_username").next(".entry_validation").addClass("entry_validation_good");				
				} else {
					$("#system_admin_username").addClass("invalid_entry");
					$("#system_admin_username").next(".entry_validation").addClass("entry_validation_no_good");
					$("#system_admin_username").parent("td").find(".entry_validation_message").html(result);;
				}
			});
		}
	});
	
	//removes feedback when user clicks into input for org_short_name, org_id, and username fields
	$("#org_short_name, #org_id, #system_admin_username").on("focus", function() {
		$(this).removeClass("invalid_entry").removeClass("valid_entry");
		$(this).next(".entry_validation").removeClass("entry_validation_good").removeClass("entry_validation_no_good");
		$(this).parent("td").find("span").remove();;
	});
	
	/*
	//edit committee popup
	$(".committee_details_edit_link").on("click", function(e) {
		e.preventDefault();
		var committeeIndex = $(this).attr("href");
		$.post('database_update.php?edit_committee', {committee: committeeIndex}, function(result) {
			$("#add_committee").dialog("open").html(result);
			$('.date_picker').datepicker();
			}
		);
	});

	//edit smart form popup
	$(".smart_form_details_edit_link").on("click", function(e) {
		e.preventDefault();
		var smartFormIndex = $(this).attr("href");
		$.post('database_update.php?edit_smart_form', {smart_form: smartFormIndex}, function(result) {
			$("#add_smart_form").dialog("open").html(result);
			$('.date_picker').datepicker();
			}
		);
	});
	*/
	
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
});


//add committee popup
function addCommittee() {
	$("#add_committee").dialog({
		autoOpen: false,
		heigh: 600,
		width: 400,
		modal: true,
		buttons: {
			Submit: function() {
				var bValid = true;
				var committeeType = $("#committee_type");
				var committeeSetUp = $("#committee_setup");
				var committeeStatus = $("#committee_status");
				var fundingModel = $("#funding_model");
				var allFields = $([]).add(committeeType).add(committeeSetUp).add(committeeStatus).add(fundingModel);
				allFields.removeClass("fieldError");
				bValid = bValid && checkDropDown(committeeType);
				bValid = bValid && checkDropDown(committeeSetUp);
				bValid = bValid && checkDropDown(committeeStatus);
				bValid = bValid && checkDropDown(fundingModel);
				if (bValid) {
					$(this).find("form").submit();
				};
			},
			Cancel: function() {
				var allFields = $([]).add("#committee_type").add("#committee_setup").add("#committee_status").add("#funding_model").add("#committee_name").add("#go_live_date");
				allFields.val("").removeClass("fieldError");
				$(this).dialog("close");
			}
		},
		close: function() {
			var allFields = $([]).add("#committee_type").add("#committee_setup").add("#committee_status").add("#funding_model").add("#committee_name").add("#go_live_date");
			allFields.val("").removeClass("fieldError");
		}
	});
	
	$(".add_committee_link").on("click", function() {
		$("#add_committee").dialog("open");
	});
}


//add smart form popup
function addSmartForm() {
	$("#add_smart_form").dialog({
		autoOpen: false,
		heigh: 600,
		width: 400,
		modal: true,
		buttons: {
			Submit: function() {
				var bValid = true;
				var smartFormDomain = $("#smart_form_domain");
				var smartFormStatus = $("#smart_form_status");
				var smartFormDeveloper = $("#smart_form_developer");
				var allFields = $([]).add(smartFormDomain).add(smartFormStatus).add(smartFormDeveloper);
				allFields.removeClass("fieldError");
				bValid = bValid && checkDropDown(smartFormDomain);
				bValid = bValid && checkDropDown(smartFormStatus);
				bValid = bValid && checkDropDown(smartFormDeveloper);
				if (bValid) {
					$(this).find("form").submit();
				};
			},
			Cancel: function() {
				var allFields = $([]).add("#smart_form_domain").add("#smart_form_status").add("#smart_form_developer").add("#smart_form_name").add("#launch_date");
				allFields.val("").removeClass("fieldError");
				$(this).dialog("close");
			}
		},
		close: function() {
			var allFields = $([]).add("#smart_form_domain").add("#smart_form_status").add("#smart_form_developer").add("#smart_form_name").add("#launch_date");
			allFields.val("").removeClass("fieldError");
		}
	});
	
	$(".add_smart_form_link").on("click", function() {
		$("#add_smart_form").dialog("open");
	});
}

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
	var firstName = $("#admin_first_name");
	var lastName = $("#admin_last_name");
	var email = $("#admin_email");
	var allFields = $([]).add(firstName).add(lastName).add(email);

	$("#adminAddPopUp").dialog({
		autoOpen: false,
		heigh: 600,
		width: 500,
		modal: true,
		buttons: {
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
						url: "database_update.php?new_admin_popup",
						data: {admin_org_name: orgName,
								admin_first_name: firstName.val(),
								admin_last_name: lastName.val(),
								admin_email: email.val(),
								contract_lead: contractLead,
								billing_coord: billingCoord,
								feature_announcement_list: featureAnnounce,
								support_outreach_list: supportOutreach,
							},
						success:function(data) {
							location.reload();
						}
					});
				};
			},
			Cancel: function() {
				allFields.val("").removeClass("fieldError");
				$(this).dialog("close");
			}
		},
		close: function() {
			allFields.val("").removeClass("fieldError");
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

//date picker popup
function calendarPopup() {
	$('.date_picker').datepicker();
}

//CONFIRMATION POP-UPS


//not ready yet popup
function notYet() {
	alert("Coming soon!");
	return false;
}

//delete confirm pop-up on Organization List page
function deleteConfirmation() {
	var r = confirm('Are you sure you want to delete this organization?');
	if (r) {
		return true;
	} else {
		return false;
	}	
}


//confirm pop-up for other actions
function confirmation() {
	var areYouSure = document.getElementsByClassName('areyousure');
	for (i in areYouSure) {
		var item = areYouSure[i];
		item.onclick = function() {
			var q = 'Are you sure you want to ' + this.rel + ' this ' + this.rev + '?';
			if (!confirm(q)) {
				return false;
			}
		}
	}
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

//checking that both Username and Password fields were filled in on index page
function loginCheck(form) {
	if (form.user_id.value == '' || form.pswrd.value == '') {
		alert('Please enter a username and password to continue.');
		return false;
	} else {
		return true;
	}
}


//data validation for admin edit/add form
function adminEditValidation() {
	var adminFirstName = document.forms["adminEdit"]["admin_first_name"].value;
	var adminLastName = document.forms["adminEdit"]["admin_last_name"].value;
	var adminEmail = document.forms["adminEdit"]["admin_email"].value;
		if (adminFirstName == '') {
			alert('Please enter admin name.');
			return false;
		} else if (adminLastName == '') {
			alert('Please enter admin last name.');
			return false;
		} else if (adminEmail == '') {
			alert('Please enter admin email.');
			return false;
		} else {
			var r = confirm('All Set?');
			if (r) {
				return true;
			} else {
				return false;
			}
		}
}


//data validation for letter request search
function requestHistorySearch() {
	var org_name = document.forms["searchDetailsForm"]["org_name"].value;
	var request_owner = document.forms["searchDetailsForm"]["request_owner"].value;
	var received_from_date = document.forms["searchDetailsForm"]["received_from_date"].value;
	var received_to_date = document.forms["searchDetailsForm"]["received_to_date"].value;
		if (org_name == 'all' && request_owner == '' && (received_from_date == '' || received_to_date == '')) {
			alert('If searching for all requests, please enter date parameters.');
			return false;
		} else {
			return true;
		}
}


//data validation for letter request form, new only
function requestFormValidation() {	
	var org_name = document.forms["requestDetailsForm"]["org_name"].value;
	var submitter = document.forms["requestDetailsForm"]["submitter_name"].value;
	var new_templates = document.forms["requestDetailsForm"]["new_templates"].value;
	var revised_templates = document.forms["requestDetailsForm"]["revised_templates"].value;
	var date_received = document.forms["requestDetailsForm"]["date_received"].value;
	var target_date = document.forms["requestDetailsForm"]["target_date"].value;
		if (org_name == "empty") {
			alert('Please indicate the organization.');
			return false;
		} else if (submitter == "empty") {
			alert('Please indicate who made the request.');
			return false;
		} else if (new_templates == null || new_templates == "") {
			alert("Number of templates must be entered.");
			return false;
		} else if (isNaN(new_templates)) {
			alert("Number of templates must be written as a number.");
			return false;
		} else if (revised_templates == null || revised_templates == "") {
			alert("Number of templates must be entered.");
			return false;
		} else if (isNaN(revised_templates)) {
			alert("Number of templates must be written as a number.");
			return false;
		} else if (new_templates == 0 && revised_templates == 0) {
			alert("Number of templates must be entered.");
			return false;
		} else if (date_received == null || date_received == "") {
			alert("Date Received must be entered.");
			return false;
		} else if (target_date == null || target_date == "") {
			alert("Target Date must be entered.");
			return false;
		} else {
			var r = confirm('All Set?');
			if (r) {
				return true;
			} else {
				return false;
			}
		}
}


//data validation for letter request edit
function requestEditFormValidation() {	
		var r = confirm("All Set?");
		if (r) {
			return true;
		} else {
			return false;
		}
}


//data validation for org add/edit form
function orgEditValidation() {	
	var org_full_name = document.forms["orgEdit"]["org_full_name"].value;
	var org_short_name = document.forms["orgEdit"]["org_short_name"].value;
	var org_id = document.forms["orgEdit"]["org_id"].value;
	var num_org_id = parseInt(org_id);
	var org_class = document.forms["orgEdit"]["org_class"].value;
	var org_city = document.forms["orgEdit"]["org_city"].value;
	var org_state = document.forms["orgEdit"]["org_state"].value;
	var dupShortName = $("#org_short_name").hasClass("invalid_entry");
	var dupId = $("#org_id").hasClass("invalid_entry");
		if (org_full_name == "") {
			alert('Please indicate the full name of the organization.');
			return false;
		} else if (org_short_name == "") {
			alert('Please indicate the organization\'s "short name".');
			return false;
		} else if (org_id == "") {
			alert('Please indicate the organization\'s ID.');
			return false;
		} else if (org_class == "empty") {
			alert('Please indicate the organization\'s class.');
			return false;
		} else if (num_org_id > 176 || num_org_id < 1) {
			alert('Org ID must be between 1 and 176.');
			return false;
		} else if (org_city == null || org_city == "") {
			alert('Please indicate the city.');
			return false;
		} else if (org_state == null || org_state == "") {
			alert('Please indicate the state.');
			return false;
		} else if (dupShortName) {
			alert('Please choose a unique short name.');
			return false;
		} else if (dupId) {
			alert('Please choose a unique ID.');
			return false;
		} else {
			var r = confirm('All Set?');
			if (r) {
				return true;
			} else {
				return false;
			}
		}
}