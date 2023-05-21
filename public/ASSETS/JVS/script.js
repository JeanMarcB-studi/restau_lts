//STICKY CURTAIN EFFECT -----------------------------

//init necessary data
const myHead = document.querySelector("header")
let myHeadIsVisible = true;
let startPos = document.documentElement.scrollTop
let lastPos = startPos
let y

//survey for scrolling action
window.onscroll = () =>
{
  // calculate Y position
  y = document.documentElement.scrollTop
  //console.log("Y: "+y)
  
  // if I go down and header is still visible :
  if (((y - startPos) > 100) && (y > lastPos) && (myHeadIsVisible)){
    // console.log("on descend, remonter le bandeau")
    myHead.classList.add('myHeadMove')
    myHeadIsVisible = false;
  } 
  else
  // if I go up and header is still not visible :
  if ((y < lastPos) && (!myHeadIsVisible)){
    // console.log("on remonte, afficher le bandeau")
    myHead.classList.remove('myHeadMove')
    myHeadIsVisible = true;
  }
  // reset startPos if User changed format
  if (y < startPos) {startPos = y}

  // store new position for future comparison
  lastPos = y;
}