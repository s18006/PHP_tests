let seconds = 10;
function secondPassed() {
    let minutes = Math.round((seconds - 30)/60);
    let remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;
    }
    document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Game Over";
    } else {
        seconds--;
    }
}

let countdownTimer = setInterval('secondPassed()', 1000);

