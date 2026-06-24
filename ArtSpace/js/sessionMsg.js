let sessionMsg = document.querySelector(".sessionMsg");
let timerMsg;
if (sessionMsg)
  {
   timerMsg = setInterval(() =>
  {
    sessionMsg.remove();
  }, 3000); 
  }