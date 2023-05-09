console.log('réservations, bonjour')


//GET DATA COMING FROM REPO -> CONTROLLER -> TWIG
document.addEventListener('DOMContentLoaded', function() {
  const myData = document.getElementById('shareData')
  const week = JSON.parse(myData.dataset.week)
  const remainSeats = JSON.parse(myData.dataset.remainseats)
  
  console.log(week[0].weekDay)
  console.log(remainSeats)
})

//UPDATE book DATA WITH week TO GET WHAT REMAINS FREE
updWeek = () => {

}

// DATE IS CHANGED
const bookDate = document.querySelector("#book-date")
bookDate.addEventListener('change', (e) =>{
  console.log(e.target.value);
})
