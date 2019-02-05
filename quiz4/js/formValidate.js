function formValidate() {

  const inputList = document.getElementsByTagName("input");
  let val = 0;
  const limit = parseInt(document.getElementById("checkbox_options").value);
  console.log(limit);
  for (let i = 0; i < inputList.length; i++) {
    if (inputList[i].type == 'checkbox' && inputList[i].checked) {
      val++;
    }
  }

  if (val != limit) {
    alert('オプションから' + limit +'つ選んで下さい。');
    return false;
  }
  return true;
 }
