console.log('réservations, bonjour')

const myData = document.getElementById('shareData')
const bookDate = document.querySelector("#book-date")
const bookHour = document.querySelector("#reservHour")
const bookSeat = document.querySelector("#seats")
const btonsQrs = document.querySelectorAll(".btonQuarter")

const btonPost = document.querySelector("#submit")

let remainSeats
let weekHours
let day = {}
let nbSeatsReserved 

btonPost.addEventListener('click', (e) => {
  console.clear()
  console.log("start CONTROLS...")

}, true)



//----- GET DATA COMING FROM <- TWIG <- CONTROLLER <- REPO
document.addEventListener('DOMContentLoaded', function() {
 
  // opening hours of the week
  weekHours = JSON.parse(myData.dataset.week)

  // remaining nb of seats on next 3 weeks
  remainSeats = JSON.parse(myData.dataset.remainseats)
  
  // initialize date Part for quarters pickers
  dateStart = bookDate.value
  nbSeatsReserved = bookSeat.value
  updateHours(dateStart)

  btonsQrs.forEach(btonQr => {
    btonQr.addEventListener('click', (e) => {
        console.log('clic ' + e.target.value)
        bookHour.value = e.target.value
      })
  });
})

// NB SEATS CHANGED? FOR NO SURBOOKING: UPDATE NB SEATS AVAILABLE
bookSeat.addEventListener('change', (e) => {
  console.log('seat'+e.target.value)
  nbSeatsReserved = bookSeat.value
  dateReserved = bookDate.value
  updateHours(dateReserved)
})

// DATE IS CHANGED? MAKE ALL QUARTER UPDATES
bookDate.addEventListener('change', (e) => {
  dateNew = e.target.value
  updateHours(dateNew)
})

// UPDATE QUARTER HOURS
updateHours = (dateChoice) => {
  console.log("dateChoice = " + dateChoice);
  bookHour.value ='??:??'
  
  //look for the date in the file coming from Controller
  let nb = 0
  for(elt in remainSeats){
    if (remainSeats[elt].date === dateChoice){
      day.date = dateChoice

      nb = parseInt(elt)
      console.log(remainSeats[nb])
      console.log("num jour sur 3 semaines = " + nb);
      console.log("remainSeats[nb].mealTime = " + remainSeats[nb].mealTime);

      day.lunchSeats = remainSeats[nb].seats
      day.lunchAvailable = remainSeats[nb].available
      day.dayNum = remainSeats[nb].dayNum

      console.log("day.dayNum = " + day.dayNum);
      console.log(weekHours)
      
      if (remainSeats[nb].mealTime === 'MIDI') {
        startHour = new Date(weekHours[day.dayNum - 1].lunchStart)
        endHour = new Date(weekHours[day.dayNum - 1].lunchEnd)
        
      } else {
        startHour = new Date(weekHours[day.dayNum - 1].dinnerStart)
        endHour = new Date(weekHours[day.dayNum - 1].dinnerEnd)
      }

    console.log (day)

    hideQuarters(remainSeats[nb].mealTime)

    showQuarters(
      remainSeats[nb].mealTime,
      startHour,
      endHour,
      remainSeats[nb].seats != 0,
      remainSeats[nb].available - nbSeatsReserved > 0
      )      
    }    
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
