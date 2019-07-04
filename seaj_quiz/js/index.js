const clearcheckBox = () => {
  let checkboxes = document.querySelectorAll('input[type="checkbox"]');
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked == true) {
      checkboxes[i].checked = false;
    }
  }
};

const display = (obj) => {
  //章の数を数える
  let sum = obj.checked === true ? parseInt(document.getElementById('num').value) + 1 : parseInt(document.getElementById('num').value) - 1;
  document.getElementById('num').value = sum;
  //問題の数を数える
  let gamelen = obj.checked === true ? document.getElementById(obj.id+'-len').value : document.getElementById(obj.id + '-len').value * - 1;
  document.getElementById('gamelen').value = parseInt(document.getElementById('gamelen').value) +  parseInt(gamelen);
  document.getElementById('summary').innerHTML = '選択した章: '+ sum.toString() + '  問題の数: ' + document.getElementById('gamelen').value;
}

const validation = () => {
  let checkedSum = document.querySelectorAll('input[type="checkbox"]:checked').length;
  if (checkedSum === 0) {
    alert('テスト種類を選択して下さい');
    return false;
  }
  return true;
}

const logout = () => {
  if (confirm('本当にログアウトしたいですか')) {
    window.location.href = 'login.php?logout="1"';
  }

}
