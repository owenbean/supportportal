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
	
	otherAdmin();
//	$("#submitted_by").on('click', function() {
//		$("#adminAddPopUp").dialog("open");
//	});
	
	/*
	$('#submitted_by').on('change', function() {
		switch ($("#submitted_by").value) {
			case 'Other':
				$("#adminAddPopUp").dialog("open");
				break;
			default:
				break;
		}
	});
	*/
	
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
		/*
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
			Cancel: function() {
				$(this).dialog("close");
			}
		},
		*/
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