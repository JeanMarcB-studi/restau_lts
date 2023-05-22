const CR = "%0D%0A"; // CR LF



   // FORM DECLARE
    
    (function() {
    // const bookForm = document.querySelector("#bookForm")
    const btonPost = document.querySelector("#go")
    // let bookForm = document.getElementById('contactForm');
    // let btonPost = document.querySelector("#postMsg")

    //When the button [Envoyer] is clicked
    btonPost.addEventListener('click', function(event) {
        
        console.clear()
        console.log("start CONTROLS...");
        let allOK = true;

        // store + scan each data from the Form 
        let tt=Array.from(bookForm.elements).forEach((input) => {

            if ((input.type !== "button")&&(input.type !== "submit")) { //check every item except the button 

                console.log("=================");
                console.log("CHECK " + input.type + " : " + input.name + " = " + input.value );

                //if invalid entry (return was false)
                if (!validateFields(input)) {
                    console.log('test ERR !');
                    allOK = false;
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
                    // prepare data for email content ----------------
                    console.log ('test OK ');
                    message += input.name +" : " 
                    message += removeTags(input.value)  + CR + CR;

                    //hide error msg 
                    input.nextElementSibling.style.display = 'none';
                    input.classList.remove("is-invalid");
                    input.classList.add("is-valid");
                }

            }
        });
        // if OK, send msg
        if (allOK) {
            console.log ("All data are ok for booking!");
            bookForm.requestSubmit(btSubmit)
        }

    }, false)
})()

//=== END - FORM DECLARE ===============//


//=== START - FIELDS VALIDATION ===//

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
        // return(true)
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

//=== END - FIELDS VALIDATION  ===//

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

// for blocking html injections
function removeTags(str) {
    if ((str===null) || (str===''))
        return false;
    else {
        str = str.toString();
        // Regular expression to identify HTML tags in 
        // the input string. Replacing the identified 
        // HTML tag with a null string.
        return str.replace( /(<([^>]+)>)/ig, '');
    }
}


