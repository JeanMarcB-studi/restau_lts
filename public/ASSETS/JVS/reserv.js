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
    
    day.lunchStart = new Date(week[day.dayNum].lunchStart)//.getTime()
    day.lunchEnd = new Date(week[day.dayNum].lunchEnd)//.getTime()
    
    day.dinnerStart = new Date(week[day.dayNum].dinnerStart)//.getTime()
    day.dinnerEnd = new Date(week[day.dayNum].dinnerEnd)//.getTime()

    // console.log(week[0].weekDay)
    
    // calculate how many quarters of an hour we have:
    nbQlunch = (day.lunchEnd - day.lunchStart) /15/60/1000
    // substract 1 hour for the service:
    nbQlunch -= 4
    // if closed
    nbQlunch = day.lunchSeats > 0 ? nbQlunch : 0
    
    

    console.log("nbQlunch = " + nbQlunch);
    
    console.log (day)
    
    // lunchStart = 
  }
    
}

