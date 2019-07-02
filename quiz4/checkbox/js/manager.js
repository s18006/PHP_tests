const secondPassed = () => {
    let seconds = document.getElementById('countdownValue').value;
    let minutes = Math.round((seconds- 30)/60);
    let remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
      remainingSeconds = "0" + remainingSeconds;
    }
  const countdown = document.getElementById('countdown');
  countdown.innerHTML = minutes + ":" + remainingSeconds;
  const answerBtn = document.getElementById('answerBtn');
  if (seconds == 30) {
      answerBtn.className = 'orange_answerBtn';
  }
  if (seconds == 15) {
    answerBtn.className = 'red_answerBtn';
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


const loadQuestion = (type) => {
  let content = { 'type' : 'withoutAnswer', 'answer' : '0' };
  let userinput = JSON.stringify(content);
  let receivedData;
  console.log(userinput);
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange= function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(xhttp.responseText);
      receivedData = JSON.parse(xhttp.responseText);
      document.getElementById('question-container').innerHTML = receivedData['html_content'];
    }
  };
  xhttp.open("POST", "http://localhost/else/checkbox/classes/quizClass.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send('quizContent=' + userinput);
}


