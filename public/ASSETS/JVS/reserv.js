console.log('réservations, bonjour')

const bookDate = document.querySelector("#book-date")


let remainSeats
let week
let day = {}

//GET DATA COMING FROM REPO -> CONTROLLER -> TWIG
document.addEventListener('DOMContentLoaded', function() {
  const myData = document.getElementById('shareData')
  week = JSON.parse(myData.dataset.week)
  remainSeats = JSON.parse(myData.dataset.remainseats)
  
  dateStart = bookDate.value
  
  
  // console.log(week[0].weekDay)
  // console.log(remainSeats)
  updateHours(dateStart)
})


// DATE IS CHANGED? MAKE UPDATE
bookDate.addEventListener('change', (e) =>{
  dateNew = e.target.value
  updateHours(dateNew)
})

// UPDATE HOURS
updateHours = (dateChoice) => {
  console.log("dateChoice = " + dateChoice);
  
  //look for the date
  let nb = 0
  for(elt in remainSeats){
    if (remainSeats[elt].date === dateChoice){
      nb = parseInt(elt)
      break
    }
  }
  
  if (nb>0)
  {
    console.log(remainSeats[nb])
    
    day.date = dateChoice
    day.lunchSeats = remainSeats[nb].seats
    day.lunchAvailable = remainSeats[nb].available
    day.dayNum = remainSeats[nb].dayNum
    day.DinnerSeats = remainSeats[nb + 1].seats
    day.DinnerAvailable = remainSeats[nb + 1].available
    
    
    // console.log(week[0].weekDay)
    
    console.log (day)

    Q = nbQuarters(remainSeats[nb].mealTime, remainSeats[nb].dayNum)
    
    showQuarters(
      remainSeats[nb].mealTime,
      Q.startHour,
      Q.endHour,
      (remainSeats[nb].seats != 0),
      true
      )
      
      // if closed
      
    }    
  }
  
  showQuarters = (meal, startHour, endHour, opened, availableSeats) => {
    if (!opened) {
      console.log(meal + ' fermé !')
      document.getElementById(meal+"closed").style.display = "block"
      document.getElementById(meal+"quarters").style.display = "none"

    } else {
      console.log(meal + ' ouvert !')
      document.getElementById(meal+"closed").style.display = "none"
      document.getElementById(meal+"quarters").style.display = "block"

      cpt = 1
      // showHour = startHour
      endHour.setHours (endHour.getHours() - 1)
      // console.log("showHour = " + showHour);
      console.log("endHour = " + endHour);
      
      //update the quarters choice
      do {
        console.log("meal+cpt = " + meal+cpt);
        // showHour = startHour.getHours() + ":" + startHour.getMinutes()
        bton = document.getElementById(meal+cpt)
        bton.textContent = showHour(startHour)
        bton.display = "block"

        startHour.setMinutes( startHour.getMinutes() + 15) 
        console.log("new showHour = " + startHour);
        cpt++

      } while (startHour <= endHour);

    }
  }

// manage showing Hour
  showHour = (myHour) =>{
    hh = myHour.getHours()
    mm = myHour.getMinutes()
    H = hh < 10 ? '0' + hh : '' + hh
    M = mm < 10 ? '0' + mm : '' + mm
    return (H +':' + M)
  }


  // calculate how many quarters of an hour we have to propose:
  nbQuarters = (meal, dayNum) =>{
    Q = {}

    if (meal ='MIDI') {
      Q.startHour = new Date(week[dayNum].lunchStart)//.getTime()
      Q.endHour = new Date(week[dayNum].lunchEnd)//.getTime()
      
    } else {
      Q.startHour = new Date(week[dayNum].dinnerStart)//.getTime()
      Q.endHour = new Date(week[dayNum].dinnerEnd)//.getTime()
    }

    Q.nbQlunch = Math.round((Q.endHour - Q.startHour) /15/60/1000)
    // substract 1 hour for the service:
    Q.nbQlunch -= 4
    
    console.log("nbQlunch = " + Q.nbQlunch);    
    return Q
  }
  