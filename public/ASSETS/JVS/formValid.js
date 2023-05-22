

//    FORM CONTROLS    
(function() {
    const bookForm = document.querySelector("#bookForm")
    const btonPost = document.querySelector("#go")
    const errMessg = document.querySelector("#errMessage")

    //When the button [Envoyer] is clicked
    btonPost.addEventListener('click', function(event) {
        
        console.clear()
        console.log("start CONTROLS...");
        let allOK = true;
        errMessg.style.display = 'none'

        // store + scan each data from the Form 
        let tt=Array.from(bookForm.elements).forEach((input) => {

            //check every item except the buttons 
            if ((input.type !== "button")&&(input.type !== "submit")) { 

                console.log("=================");
                console.log("CHECK " + input.type + " : " + input.name + " = " + input.value );

                //if invalid entry (return was false)
                if (!validateFields(input)) {
                    console.log('test ERR !');
                    allOK = false;

                    //BLOCK THE FORM FOR SENDING
                    event.preventDefault();
                    event.stopPropagation();
                    
                    input.classList.remove("is-valid");

                    //put invalid class
                    input.classList.add("is-invalid");
                    //show error msg
                    input.nextElementSibling.style.display = 'block';
                } 
                //if data is valid (return was true) 
                else {
                    console.log ('test OK ');

                    //ok so hide error msg 
                    input.nextElementSibling.style.display = 'none';
                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");
                }

            }
        });
        // if not OK, show there are errors 
        if (allOK) {
            console.log ("All data are ok for booking!")
            // bookForm.requestSubmit(btSubmit)
        } else {
            
            errMessg.style.display = 'block'
            console.log ("Errors found!")
        }

    }, false)
})()


// Fields Validation Controls
function validateFields(input) {

    let fieldName = input.name;

    switch (input.name){
        case "firstName" : {
            return (
                //champ obligatoire renseigné ?
                validateRequired(input)
                //format saisie ok ?
                && checkFormat(input, "^([A-Za-z ,.'-]){2,35}$")
                )
            }
            
        case "lastName" :{
            return (
                validateRequired(input)
                && checkFormat(input, "^([A-Za-z ,.'-]){2,35}$")
                )
        }
            
        case "email" :{
            return (
                validateRequired(input)
                && checkFormat(input, "(@)(.+)$")
                && validateEmail(input)
                )
            }
    
        case "phoneNumber" :{
            return (
                validateRequired(input)
                && validatePhoneNumber(input)
            )
        }
        
        case "seats" :{
            return(input.value > 0)
        }
        
        case "book-date" :{
            return(checkDate(input))
        }
        
        case "message" :{
            return (
                validateLength(input, 0, 250)
                )
        }

        case "hour" : {
            return (input.value > '')
        }
    }
}

// Different fields validation functions

// Check Date
function checkDate(input) {
    let date = new Date(input.value)    
    console.log("date = " + date);
    console.log("dateMin = " + dateMin);
    return(date >= dateMin && date <= dateMax)
}

// Check Regex values
function checkFormat(input, regex){
    return input.value.match(regex);
}

// Validate if field is REQUIRED
function validateRequired(input) {
console.log("validate required non vide = " + !(input.value == null || input.value == ""))
return !(input.value == null || input.value == "");
}

// Validation number of chars : MIN & MAX
function validateLength(input, minLength, maxLength) {
    return !(input.value.length < minLength || input.value.length > maxLength);
}

// Validate an e-mail
function validateEmail(input) {
    let EMAIL = input.value;
    let POSAT = EMAIL.indexOf("@");
    let POSDOT = EMAIL.lastIndexOf(".");
    
    return !(POSAT < 1 || (POSDOT - POSAT < 2));
}

// Validate one Phone number
function validatePhoneNumber(input) {
    return input.value.match(/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/);
}


