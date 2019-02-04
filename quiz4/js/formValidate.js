function formValidate() {

  const inputList = document.getElementsByTagName("input");
  let val = 0;

  for (let i = 0; i < inputList.length; i++) {
    if (inputList[i].type == 'checkbox' && inputList[i].checked) {
      val++;
    }
  }

  if (val !== 2) {
    alert('オプションから２つ選んで下さい。');
    return false;
  }
  return true;
 }
