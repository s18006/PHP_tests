
const validate = () => {
  var xhttp = new XMLHttpRequest();
  var key = document.getElementById("keyWord").value;
  var userinput = "keyword=" + key;
  xhttp.onreadystatechange= function() {
  console.log(xhttp);
    if (this.readyState == 4 && this.status == 200) {
       document.getElementById("result_text").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "http://localhost/else/quiz4/downloadKeyList.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(userinput);
  document.getElementById("result_text").style.display = "block";
}

const hiddenElement = () => {
    var elem = document.getElementById("result_text");
    var btn =  document.getElementById('hiddenElementBtn');
    if (elem.style.display == 'block') {
        elem.style.display = 'none';
        btn.innerHTML = '表示する';
    } else {
        elem.style.display = 'block';
        btn.innerHTML = '隠す';
    }
}

const tableChange = (obj) => {
  const options = document.getElementsByClassName('option1stPart');
  const options2 = document.getElementsByClassName('option2ndPart');
  const rightAnswers = document.getElementsByClassName('rightAnswer2');
  const answerLengthRow = document.getElementsByClassName('answerLengthRow');
  const answerLength = document.getElementById('answerLength');
  if (obj.value === 'select' || obj.value === 'checkbox') {
    displayChange(options);
    if (obj.value === 'checkbox') {
      displayChange(answerLengthRow);
      displayHidden(options2)
    }
    if (obj.value === 'select') {
      displayChange(options2);
      displayHidden(answerLengthRow);
      answerLength.value = '';
      checkboxAnswers(answerLength);
    }
  } else {
      displayHidden(options);
      displayHidden(options2);
      displayHidden(answerLengthRow);
      answerLength.value = '';
      checkboxAnswers(answerLength);
  }
  console.log(obj.value);
}


const checkboxAnswers = (obj) => {
  const questionType = document.getElementById('question_type');
  const rightAnswer2 = document.getElementsByClassName('rightAnswer2');
  const rightAnswer3 = document.getElementsByClassName('rightAnswer3');
  if (questionType.value === 'checkbox' && obj.value === '2') {
    console.log('ok');
    displayChange(rightAnswer2);
  }
  if (questionType.value === 'checkbox' && obj.value === '3') {
    displayChange(rightAnswer2);
    displayChange(rightAnswer3);
  }

  if (!(obj.value)) {
    displayHidden(rightAnswer2);
    displayHidden(rightAnswer3);
  }
}

const displayChange = (obj) => {
  Object.keys(obj).forEach (function (item) {
    obj[item].style.display = 'table-cell';
  })
}

const displayHidden = (obj) => {
  Object.keys(obj).forEach (function (item) {
    obj[item].style.display = 'none';
  })
}

const uploadCheck = () => {
  const question = document.getElementById('question');
  const question_type = document.getElementById('question_type');
  const answerLength = document.getElementById('answerLength');
  const rigth_answer = document.getElementById('right_answer');
  const rigth_answer2 = document.getElementById('right_answer2');
  const rigth_answer3 = document.getElementById('right_answer3');
  const option1 = document.getElementById('option1');
  const option2 = document.getElementById('option2');
  const option3 = document.getElementById('option3');

  var alertMsg = [];
  if (!(question.value)) {
    alertMsg.push('問題を記入して下さい');
  }
  if (!(question_type.value)) {
    alertMsg.push('問題種類を選択して下さい');
  }

  if (question_type.value === 'checkbox' && !(answerLength.value)) {
    alertMsg.push('正解な回答の数を決定して下さい');
  }

  if (!(right_answer.value)) {
    alertMsg.push('正解な回答を記入して下さい');
  }

  if (question_type.value === 'checkbox') {

    if (answerLength.value === '2' && !(right_answer2.value)) {
      alertMsg.push('正解な回答2を記入して下さい');
    }

    if (answerLength.value === '3') {
      if (!(right_answer2.value)) {
        alertMsg.push('正解な回答2を記入して下さい');
      }
      if (!(right_answer3.value)) {
        alertMsg.push('正解な回答3を記入して下さい');
      }
    }
  }

  if (question_type.value === 'checkbox' || question_type.value === 'select') {
    if (!(option1.value) || !(option2.value) || !(option3.value)) {
      alertMsg.push('不正解なオプション1-3を記入して下さい');
    }
  }

  if (!(alertMsg.value)) {
    alert(alertMsg.join("\n"));
    return false;
  }

}


