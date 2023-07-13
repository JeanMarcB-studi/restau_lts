console.log('réservations, bonjour')

//Initiate DOM variables
const myData = document.querySelector('#shareData')
const bookDate = document.querySelector('#book-date')
const bookHour = document.querySelector('#reservHour')
const bookSeat = document.querySelector('#seats')
const btonsQrs = document.querySelectorAll('.btonQuarter')
const reserved = document.querySelector('#reserved')
const quarters = document.querySelector('#quarters')
const btSubmit = document.querySelector('#go')
const limitDat = document.querySelector('#outOfdates')

//Some needed variables
let bookCalendar
let weekHours
let day = {}
let dateNew =''
let nbSeatsReserved 
let hourReserved
let lastBtonQr

//Determine reservation max date range
let dateMin = new Date()
dateMin.setHours(0,0,0)
let dateMax = new Date()
dateMax.setDate(dateMax.getDate() + 21)
dateMax.setHours(23,59,59)

// console.log('les dates :')
// console.log(dateMin.toISOString())
// console.log(dateMax.toISOString())


//----- GET DATA COMING FROM <- TWIG <- CONTROLLER <- REPO
document.addEventListener('DOMContentLoaded', function() {

  // opening hours of the week
  weekHours = JSON.parse(myData.dataset.week)

  // remaining nb of seats on next 3 weeks
  bookCalendar = JSON.parse(myData.dataset.bookcalendar)
  
  // initialize date Part for quarters pickers
  dateStart = bookDate.value
  nbSeatsReserved = bookSeat.value
  updateHours(dateStart)

  // put event on quarters buttons
  btonsQrs.forEach(btonQr => {
    btonQr.addEventListener('click', (e) => {
      if (hourReserved) {
        // if a quarter button was already cliked, unmark it
        lastBtonQr.classList.remove('btonQuarterSelected')
      }
      // mark the new quarter button click
      e.target.classList.add('btonQuarterSelected')
      lastBtonQr = e.target
      clickHour(e.target.value)
      })
    });
  })
  
  // show the reservation detail aside the button RESERVER
  clickHour = (timeBooking) => {
  console.log('clic ' +  timeBooking)
  hourReserved = timeBooking
  bookHour.value = timeBooking
  // console.log(bookDate)
  reserved.innerHTML = day.dateExtended + "<br> à " + hourReserved
}

// NB SEATS CHANGED BY CUSTOMER? FOR NO SURBOOKING: UPDATE NB SEATS AVAILABLE
bookSeat.addEventListener('change', (e) => {
  console.log('seat'+e.target.value)
  nbSeatsReserved = bookSeat.value
  dateReserved = bookDate.value
  updateHours(dateReserved)
})

// DATE IS CHANGED? MAKE ALL QUARTER UPDATES
bookDate.addEventListener('change', (e) => {
  dateNew = e.target.value
  reserved.innerHTML =''
  updateHours(dateNew)
})

// UPDATE SHOW OF QUARTER HOURS
updateHours = (dateChoice) => {
  // console.log("dateChoice = " + dateChoice);
  bookHour.value =''
  if (hourReserved) { 
    lastBtonQr.classList.remove('btonQuarterSelected')
  }
  hourReserved =''
  lastBtonQr
  
  //search for the corresponding date in the 3 weeks file coming from Controller
  let dateFound = false
  quarters.style.display = "block"
  limitDat.style.display = "none"

  // console.log('--- bookCalendar : ---')
  // console.log(bookCalendar)
  for(elt in bookCalendar){
    // console.log("parseint(elt) = " + parseInt(elt))
    // console.log("elt = " + elt);
    if (bookCalendar[elt].date === dateChoice){
      // day.date = dateChoice
      dateFound = true
      day.dateExtended = new Date(dateChoice).toLocaleDateString('fr-FR', { weekday:"long", year:"numeric", month:"short", day:"numeric"}) 
      // console.log("dd= "+day.dateExtended)

      // nb = parseInt(elt)
      // console.log(bookCalendar[elt])
      // console.log("num jour sur 3 semaines = " + elt);
      // console.log("bookCalendar[nb].mealTime = " + bookCalendar[elt].mealTime);

      // day.lunchSeats = bookCalendar[nb].seats
      // day.lunchAvailable = bookCalendar[nb].available
      day.dayNum = bookCalendar[elt].dayNum - 1
      // day.weekDay = weekHours[day.dayNum -1].weekDay
      // console.log(day.weekDay)

      // console.log("day.dayNum = " + day.dayNum);
      // console.log(weekHours)
      
      if (bookCalendar[elt].mealTime === 'MIDI') {
        startHour = new Date(weekHours[day.dayNum].lunchStart)
        endHour = new Date(weekHours[day.dayNum].lunchEnd)
        
      } else {
        startHour = new Date(weekHours[day.dayNum].dinnerStart)
        endHour = new Date(weekHours[day.dayNum].dinnerEnd)
      }

    // console.log (day)

    hideQuarters(bookCalendar[elt].mealTime)

    showQuarters(
      bookCalendar[elt].mealTime,
      startHour,
      endHour,
      bookCalendar[elt].seats != 0,
      bookCalendar[elt].available - nbSeatsReserved > 0
      )      
    }    
  }
  if (!dateFound){
    //outside the 3 weeks reservation: close the quarters part
    quarters.style.display = "none"
    limitDat.style.display = "block"
  }
}

showQuarters = (meal, startHour, endHour, opened, availableSeats) => {
  if (!opened) {
    // RESTAURANT IS CLOSED
    document.getElementById(meal+"closed").style.display = "block"
    document.getElementById(meal+"full").style.display = "none"
    document.getElementById(meal+"quarters").style.display = "none"
  } 

  else if (!availableSeats) {
    // RESTAURANT HAS NO ROOM AVAILABLE VS THE RESERVATION DEMAND
    document.getElementById(meal+"closed").style.display = "none"
    document.getElementById(meal+"full").style.display = "block"
    document.getElementById(meal+"quarters").style.display = "none"
  } 
    
  else {
    // RESTAURANT IS OPENED
    document.getElementById(meal+"closed").style.display = "none"
    document.getElementById(meal+"full").style.display = "none"
    document.getElementById(meal+"quarters").style.display = "block"
  
    // SHOW THE QUARTERS CORRESPONDING TO THE WEEK'S DAY

    // bookings stop 1 hour before Restaurant closing
    // endHour.setHours (endHour.getHours() - 1)
    // console.log("endHour = " + endHour);
    
    //show and update the quarters text (19:00, 19:15...)
    cpt = 1
    do {
      bton = document.getElementById(meal+cpt)
      bton.value = showHour(startHour)
      bton.style.display = "block"

      startHour.setMinutes( startHour.getMinutes() + 15) 
      cpt++

    } while (startHour <= endHour)
  }
}

// format Hour for display on buttons
showHour = (myHour) =>{
  hh = myHour.getHours()
  mm = myHour.getMinutes()
  H = hh < 10 ? '0' + hh : '' + hh
  M = mm < 10 ? '0' + mm : '' + mm
  return (H +':' + M)
}

// HIDE BUTTONS OUT OF RESERVATION TIME
hideQuarters = (meal) => {
  for (let i = 1; i <= 18; i++) {

    quarter = document.getElementById(meal + i)
    if (quarter.style.display != "none"){
      quarter.style.display = "none"
    } else {
      break
    }    
  }
}
