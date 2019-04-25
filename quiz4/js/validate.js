
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
  var options = document.getElementsByClassName('option1stPart');
  var options2 = document.getElementsByClassName('option2ndPart');
  var rightAnswers = document.getElementsByClassName('rightAnswer2');
  if (obj.value === 'select' || obj.value === 'checkbox') {
    displayChange(options);
    if (obj.value === 'checkbox') {
      displayChange(rightAnswers);
      displayHidden(options2)
    }
    if (obj.value === 'select') {
      displayChange(options2);
      displayHidden(rightAnswers);
    }
  } else {
      displayHidden(options);
      displayHidden(options2);
      displayHidden(rightAnswers);
  }
  console.log(obj.value);
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
