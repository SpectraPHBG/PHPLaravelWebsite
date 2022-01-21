var extended, dropdown_holder, dropdown_button, dropdown_holder_children, elm, style, elmMargin, calculation,
    extended_style;
var username_email_div, password_form
var username_form, username_div, email_form, email_div, username_input, email_input

$(document).ready(function () {
    username_email_div = document.getElementsByClassName("details-flex")[0];
    password_form = document.getElementsByClassName("password-flex")[0];
    username_form = document.getElementById("username-form")
    username_div = document.getElementById("username-div")
    username_input = document.getElementById("username")
    email_form = document.getElementById("email-form")
    email_div = document.getElementById("email-div")
    email_input = document.getElementById("email")

    dropdown_holder = document.getElementsByClassName("account-rigs-dropdown-holder")[0];
    dropdown_button = document.getElementsByClassName("account-rigs-dropdown-button-image")[0];
    dropdown_holder_children = document.getElementsByClassName("account-rig");
    if (dropdown_holder_children.length == 0) {
        return;
    }
    elm = dropdown_holder_children[0];
    style = elm.currentStyle || window.getComputedStyle(elm);
    elmMargin = parseInt(style.marginTop) + parseInt(style.marginBottom);
});

function switchToPasswordForm() {
    username_email_div.style.display = "none";
    password_form.style.display = "flex";
}

function switchToUsernameEmailForm() {
    password_form.style.display = "none";
    username_email_div.style.display = "flex";
}

function switchToSaveUsername() {
    username_form.style.display = "flex";
    username_div.style.display = "none";
    username_input.focus();
}

function switchToSaveEmail() {
    email_form.style.display = "flex";
    email_div.style.display = "none";
    email_input.focus();
}


function extendRigs() {
    if (extended) {
        dropdown_button.classList.remove("account-rigs-dropdown-button-image-extended");
        dropdown_holder.style.height = "0px";
        extended = false;
        console.log("de-extended");
    } else {
        dropdown_button.classList.add("account-rigs-dropdown-button-image-extended");
        if (dropdown_holder_children.length != 0) {
            calculation = dropdown_holder_children.length * (elm.offsetHeight + elmMargin);
            dropdown_holder.style.height = calculation + "px";
        }
        extended = true;
        console.log("extended");
    }
}
