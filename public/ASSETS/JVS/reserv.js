console.log('réservations, bonjour')

const bookDate = document.querySelector("#book-date")
const bookHour = document.querySelector("#reservHour")
const btonsQr = document.querySelectorAll(".btonQuarter")

let remainSeats
let weekHours
let day = {}



//----- GET DATA COMING FROM REPO -> CONTROLLER -> TWIG
document.addEventListener('DOMContentLoaded', function() {
  const myData = document.getElementById('shareData')
  weekHours = JSON.parse(myData.dataset.week)
  remainSeats = JSON.parse(myData.dataset.remainseats)
  
  dateStart = bookDate.value
  // console.log(weekHours[0].weekDay)
  // console.log(remainSeats)
  updateHours(dateStart)

  btonsQr.forEach(btonQr => {
    btonQr.addEventListener('click', (e) => {
        console.log('clic ' + e.target.value)
        bookHour.value = e.target.value
      })
  });

})

// selectQr.addEventListener('click', (e) => {
//   console.log('clic')
//   bookHour.textContent ="coucopui"
// })




// DATE IS CHANGED? MAKE UPDATE
bookDate.addEventListener('change', (e) => {
  dateNew = e.target.value
  updateHours(dateNew)
  bookHour.value ='??:??'
})


// UPDATE HOURS
updateHours = (dateChoice) => {
  console.log("dateChoice = " + dateChoice);
  
  //look for the date
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
      // day.DinnerSeats = remainSeats[nb + 1].seats
      // day.DinnerAvailable = remainSeats[nb + 1].available
      
      if (remainSeats[nb].mealTime === 'MIDI') {
        startHour = new Date(weekHours[day.dayNum - 1].lunchStart)//.getTime()
        endHour = new Date(weekHours[day.dayNum - 1].lunchEnd)//.getTime()
        
      } else {
        startHour = new Date(weekHours[day.dayNum - 1].dinnerStart)//.getTime()
        endHour = new Date(weekHours[day.dayNum - 1].dinnerEnd)//.getTime()
      }

    console.log (day)

    // Q = nbQuarters(remainSeats[nb].mealTime, remainSeats[nb].dayNum)
    
    hideQuarters(remainSeats[nb].mealTime)

    showQuarters(
      remainSeats[nb].mealTime,
      startHour,
      endHour,
      remainSeats[nb].seats != 0,
      remainSeats[nb].available > 0
      )
      
    }    
  }
}

  showQuarters = (meal, startHour, endHour, opened, availableSeats) => {
    if (!opened) {
      console.log(meal + ' fermé !')
      document.getElementById(meal+"closed").style.display = "block"
      document.getElementById(meal+"full").style.display = "none"
      document.getElementById(meal+"quarters").style.display = "none"

    } else {

      if (availableSeats){
        console.log(meal + ' ouvert !')
        document.getElementById(meal+"closed").style.display = "none"
        document.getElementById(meal+"full").style.display = "none"
        document.getElementById(meal+"quarters").style.display = "block"
      } else {
        console.log(meal + ' full !')
        document.getElementById(meal+"closed").style.display = "none"
        document.getElementById(meal+"full").style.display = "block"
        document.getElementById(meal+"quarters").style.display = "none"

      }

      cpt = 1
      // showHour = startHour
      endHour.setHours (endHour.getHours() - 1)
      // console.log("showHour = " + showHour);
      console.log("endHour = " + endHour);
      
      //update the quarters choice
      do {
        // console.log("meal+cpt = " + meal+cpt);
        // showHour = startHour.getHours() + ":" + startHour.getMinutes()
        bton = document.getElementById(meal+cpt)
        // bton.textContent = showHour(startHour)
        bton.value = showHour(startHour)
        bton.style.display = "block"

        startHour.setMinutes( startHour.getMinutes() + 15) 
        // console.log("new showHour = " + startHour);
        cpt++

      } while (startHour <= endHour);

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

  // calculate how many quarters of an hour we have to propose:
  nbQuarters = (meal, dayNum) =>{
    console.log("dayNum = " + dayNum);
    Q = {}



    // Q.nbQlunch = Math.round((Q.endHour - Q.startHour) /15/60/1000)
    // // substract 1 hour for the service:
    // Q.nbQlunch -= 4
    
    // console.log("nbQlunch = " + Q.nbQlunch);    
    return Q
  }
  
hideQuarters = (meal) => {

  for (let i = 1; i <= 18; i++) {

    quarter = document.getElementById(meal + i)
    console.log("quarter = " + quarter.style.display);
    if (quarter.style.display != "none"){
      quarter.style.display = "none"
    } else {
      break
    }    
  }
}
