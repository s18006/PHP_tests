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
  document.getElementById('countdownValue').value--;
  if (seconds == 30) {
      answerBtn.className = 'orange_answerBtn';
  }
  if (seconds == 15) {
    answerBtn.className = 'red_answerBtn';
  }
  if (seconds == 0) {
    endGamePost('result.php', 'post');
  }
};

//refresh in every one sec
let countdownTimer = setInterval('secondPassed()', 1000);


const validation = () => {
  let alertMsg = '';
  const type = document.getElementById('question_type').value;
  if (type == 'select' || type == 'select-img') {
    if (document.querySelectorAll("input[type='radio']:checked").length == 0) {
    alertMsg = 'オプションを１つ選択して下さい';
    }
  }
  if (type == 'bet-number') {
    if (document.getElementById('user_answer').value == '') {
      alertMsg = 'インプットフィルドを記入して下さい';
    }
    if (!Number.isInteger(parseInt(document.getElementById('user_answer').value))) {
      alertMsg = '答えとして数字を入力して下さい';
      document.getElementById('user_answer').value = '';
    }
  }
  if (type == 'bet-text') {
     if (document.getElementById('user_answer').value == '') {
      alertMsg = 'インプットフィルドを記入して下さい';
    }
  }
  if (type == 'checkbox') {
    if (document.querySelectorAll("input[type='checkbox']:checked").length != parseInt(document.getElementById('checkbox_options').value)) {
      alertMsg = document.getElementById('checkbox_options').value + 'つのオプションを選択して下さい';
    }
  }
  if (alertMsg != '') {
    alert(alertMsg);
  }
  else {
    loadQuestion('withAnswer');
  }
};

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
      content = { 'type' : type, 'id' : document.getElementById('question_id').value, 'answer' : answerList, 'rightAnswer' : document.getElementById('rightAnswer').value };
    }
    //in case of select, text input..
    else {
        userAnswer = (questionType == 'select' || questionType == 'select-img') ? document.querySelector('input[name="user_answer"]:checked').value : document.getElementById('user_answer').value;
        content = { 'type' : type, 'id' : document.getElementById('question_id').value, 'answer' : userAnswer, 'rightAnswer' : document.getElementById('rightAnswer').value };
    }
  }
  let userinput = JSON.stringify(content);
  console.log(userinput);
  let receivedData;
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange= function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(xhttp.responseText);
      receivedData = JSON.parse(xhttp.responseText);
      if (receivedData['status'] == 'end') {
        endGamePost('result.php', 'post');
      } else if (receivedData['status'] == 'refreshed') {
        window.location.href = 'index.php';
      } else {
        document.getElementById('question-container').innerHTML = receivedData['html_content'];
        if (receivedData['total'] > 0) {
          //fill the statistic data and fill the rightanswer value of the hidden input tag
          document.getElementById('statistics').innerHTML = '正解: ' + receivedData['rightAnswers'] + ', 合計: ' + receivedData['total'] + ', 正解確率: ' + ((parseInt(receivedData['rightAnswers']) / parseInt(receivedData['total'])* 100).toFixed(2)).toString() + '%';
          document.getElementById('rightAnswer').value = receivedData['rightAnswers'];
        }
      }
    }
  };
  xhttp.open("POST", "http://localhost/else/checkbox/classes/quizClass.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send('quizContent=' + userinput);
};

const endGamePost = (path, method='post') => {
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  const gameTime = document.getElementById('totalTime').value - document.getElementById('countdownValue').value - 1;
  const hiddenField = document.createElement('input');
  hiddenField.type = 'hidden';
  hiddenField.name = 'gameTime';
  hiddenField.value = gameTime;
  form.appendChild(hiddenField);
  document.body.appendChild(form);
  form.submit();
}

