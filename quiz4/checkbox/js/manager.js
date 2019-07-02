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
  let content;
  let userAnswer;
  //when game started
  if (type === 'withoutAnswer') {
    content = { 'type' : type, 'answer' : '0' };
  }
  //when user answered for a question
  if (type === 'withAnswer') {
    let questionType = document.getElementById('question_type').value;
    //in case of checkbox, post content is different
    if (questionType == 'checkbox') {
      let checkedSum = document.querySelectorAll('input[type="checkbox"]:checked');
      let answerList = [];
      checkedSum.forEach(x => {answerList.push(x.value)});
      content = { 'type' : type, 'id' : document.getElementById('question_id').value, 'answer' : answerList };
    }
    //in case of select, text input..
    else {
        userAnswer = (questionType == 'select' || questionType == 'select-img') ? document.querySelector('input[name="user_answer"]:checked').value : document.getElementById('user_answer').value;
        content = { 'type' : type, 'id' : document.getElementById('question_id').value, 'answer' : userAnswer };
    }
  }
  let userinput = JSON.stringify(content);
  let receivedData;
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange= function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(xhttp.responseText);
      receivedData = JSON.parse(xhttp.responseText);
      if (receivedData['status'] == 'end') {
        window.location.href = 'index.html';
      } else if (receivedData['status'] == 'refreshed') {
        window.location.href = 'index.html';
      } else {
        document.getElementById('question-container').innerHTML = receivedData['html_content'];
      }
    }
  };
  xhttp.open("POST", "http://localhost/else/checkbox/classes/quizClass.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send('quizContent=' + userinput);
}
