// const showError = (inputField, errMsgId, fieldName) => {
//     let user = document.getElementById(inputField).value;
//     if (user === "" || user === null) {
//         document.getElementById(errMsgId).innerHTML = "" + fieldName + " Is Required";
//     } else {
//         document.getElementById(errMsgId).innerHTML = "";
//     }
// }

// function genderValidation() {

//     let gender = document.getElementsByName('gender');
//     let selectedGender = "";
//     for (let i = 0; i < gender.length; i++) {
//         if (gender[i].checked) {
//             selectedGender = gender[i].value;
//         }
//     }
//     return selectedGender;
// }
// function hobbyValidation() {
//     let hobbies = document.querySelectorAll('.hobby:checked');

//     let hobby = "";
//     for (const hob of hobbies) {
//         hobby += hob.value + ",";
//     }
//     let userHobby = "";
//     if (hobby !== "") {
//         userHobby = hobby.slice(0, -1);
//     }
//     return userHobby;
// }


$(document).ready(function(){
    $("#changeBtn").click(function() {
        $(this).hide();
        $("#profile").show();
    });

    $("#serchBtn").on("click", function() {
        var value = $("#serchbox").val().toLowerCase();
        $("#userData tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    $('#country').on('change', function() {
        var country = this.value;
        $.ajax({
            url: "get-states.php",
            type: "POST",
            data: {
                country: country
            },
            cache: false,
            success: function(result){
                $("#state").html(result);
            }
        });
        
    });

    $("#save").on("click",function() {
        // let name = $("#name").val();
        // let email = $("#email").val();
        // let username = $("#username").val();
        // let male = $("#male").is(':checked');
        // let female = $("#female").is(':checked');

        let hasError = false
        if($("#name").val() == "") {
            $("#nameErr").text("Name must be required");
            hasError = true;
        } else {
            removeError('nameErr');
        }
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        let email = $("#email").val();

        if(email == "") {
            $("#emailErr").text("Email must be required");
            hasError = true;
        } else if(!email.match(emailPattern)) {
            hasError = true;
            $("#emailErr").text("Enter valid email address");
        } else{
            removeError('emailErr');
        }
        if($("#username").val() == "") {
            $("#usernameErr").text("Username must be required");
            hasError = true;
        } else {
            removeError('usernameErr');
        }
        if(!$("#male").is(':checked') && !$("#female").is(':checked')) {
            $("#genderErr").text("Please select gender");
            hasError = true;
        } else {
            removeError("genderErr");
        }
        if(!$("#cricket").is(':checked') && !$("#music").is(':checked') && !$("#dancing").is(':checked')) {
            $("#hobbyErr").text("Please select at leaset one hobby");
            hasError = true;
        } else {
            removeError("hobbyErr");
        }
        if($("#address").val() == "") {
            $("#addressErr").text("Please enter address");
            hasError = true;
        } else {
            removeError("addressErr");
        }
        if($("#country").val() == "") {
            $("#countryErr").text("Please select country");
            hasError = true;
        } else {
            removeError("countryErr");
        }
        if($("#state").val() == "") {
            $("#stateErr").text("Please select state");
            hasError = true;
        } else {
            removeError("stateErr");
        }
        if($("#profile").val() == "") {
            $("#profileErr").text("Please select image");
            hasError = true;
        } else {
            removeError("profileErr");
        }

        if(!hasError) {
            $('#form').submit();
        }
    })

    function removeError(fieldId){
        $("#"+fieldId).text("");
    }
});  
