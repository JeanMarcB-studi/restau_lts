console.log('réservations, bonjour')

const myData = document.getElementById('shareData')
const bookDate = document.querySelector("#book-date")
const bookHour = document.querySelector("#reservHour")
const bookSeat = document.querySelector("#seats")
const btonsQrs = document.querySelectorAll(".btonQuarter")
const reserved = document.querySelector('#reserved')
const quarters = document.querySelector('#quarters')


let dateMin = new Date()
let dateMax = new Date()
let bookCalendar
let weekHours
let day = {}
let dateNew =''
let nbSeatsReserved 
let hourReserved

dateMin.setHours(0,0,0)
dateMax.setDate(dateMax.getDate() + 21)
dateMax.setHours(23,59,59)

console.log("les dates :")
console.log(dateMin.toISOString())
console.log(dateMax.toISOString())


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

  btonsQrs.forEach(btonQr => {
    btonQr.addEventListener('click', (e) => {
        clickHour(e.target.value)
      })
    });
  })
  
  // 
  clickHour = (timeBooking) => {
  console.log('clic ' +  timeBooking)
  hourReserved = timeBooking
  bookHour.value = timeBooking
  console.log(bookDate)
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
  console.log("dateChoice = " + dateChoice);
  bookHour.value =''
  
  //search for the date in the file coming from Controller
  let nb = 0
  quarters.style.display = "block"
  for(elt in bookCalendar){
    if (bookCalendar[elt].date === dateChoice){
      day.date = dateChoice

      day.dateExtended = new Date(dateChoice).toLocaleDateString('fr-FR', { weekday:"long", year:"numeric", month:"short", day:"numeric"}) 
      console.log('coucou')
      console.log("dd= "+day.dateExtended)

      nb = parseInt(elt)
      console.log(bookCalendar[nb])
      console.log("num jour sur 3 semaines = " + nb);
      console.log("bookCalendar[nb].mealTime = " + bookCalendar[nb].mealTime);

      day.lunchSeats = bookCalendar[nb].seats
      day.lunchAvailable = bookCalendar[nb].available
      day.dayNum = bookCalendar[nb].dayNum
      day.weekDay = weekHours[day.dayNum -1].weekDay
      console.log(day.weekDay)

      console.log("day.dayNum = " + day.dayNum);
      console.log(weekHours)
      
      if (bookCalendar[nb].mealTime === 'MIDI') {
        startHour = new Date(weekHours[day.dayNum - 1].lunchStart)
        endHour = new Date(weekHours[day.dayNum - 1].lunchEnd)
        
      } else {
        startHour = new Date(weekHours[day.dayNum - 1].dinnerStart)
        endHour = new Date(weekHours[day.dayNum - 1].dinnerEnd)
      }

    console.log (day)

    hideQuarters(bookCalendar[nb].mealTime)

    showQuarters(
      bookCalendar[nb].mealTime,
      startHour,
      endHour,
      bookCalendar[nb].seats != 0,
      bookCalendar[nb].available - nbSeatsReserved > 0
      )      
    }    
  }
  if (nb === 0){
    console.log("pbbbbbbbbbbbbbbbb")
    quarters.style.display = "none"
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
    endHour.setHours (endHour.getHours() - 1)
    console.log("endHour = " + endHour);
    
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
