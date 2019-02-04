
function secondPassed() {
    let seconds = document.getElementById('countdownValue').value;
    let minutes = Math.round((seconds- 30)/60);
    let remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
      remainingSeconds = "0" + remainingSeconds;
    }
  const countdown = document.getElementById('countdown');
  countdown.innerHTML = minutes + ":" + remainingSeconds;
  const answerBtn = document.getElementById('answerBtn');
  const supportText = document.getElementById('supportText');
  if (seconds == 30) {
      answerBtn.className = 'orange_answerBtn';
  }
  if (seconds == 15) {
    answerBtn.className = 'red_answerBtn';
    supportText.className = 'vis_supportText';
  }
  if (seconds == 5) {
    countdown.className = 'red';
    }
  if (seconds == 0) {
    return window.location.href="result.php";
  } else {
    document.getElementById('countdownValue').value--;
    }
}


let countdownTimer = setInterval('secondPassed()', 1000);
