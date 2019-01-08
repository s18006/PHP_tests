let seconds = 30;
function secondPassed() {
    let minutes = Math.round((seconds - 30)/60);
    let remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;
    }
  const countdown = document.getElementById('countdown');
  countdown.innerHTML = minutes + ":" + remainingSeconds;
    if (seconds == 5) {
      countdown.className = 'red';
    }
  if (seconds == 0) {
    return window.location.href="result.php";
  } else {
    seconds--;
    }
}

let countdownTimer = setInterval('secondPassed()', 1000);
