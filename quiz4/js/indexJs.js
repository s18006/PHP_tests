const showGameBtn = () => {
  document.getElementById('shortGameBtn_container').style.display = 'block';
  document.getElementById('longGameBtn_container').style.display = 'block';
}

const newGameValidate = () => {
  if (!(document.getElementById('db_type').value)) {
    alert('問題種類を選択して下さい');
    return false;
  } return true;
}
