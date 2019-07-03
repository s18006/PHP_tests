const clearcheckBox = () => {
  let checkboxes = document.querySelectorAll('input[type="checkbox"]');
  for (let i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked == true) {
      checkboxes[i].checked = false;
    }
  }
};

const display = (obj) => {
  let sum = obj.checked === true ? parseInt(document.getElementById('num').value) + 1 : parseInt(document.getElementById('num').value) - 1;
  document.getElementById('num').value = sum;
  document.getElementById('summary').innerHTML = 'Total: '+ sum.toString();
}

const validation = () => {
  let checkedSum = document.querySelectorAll('input[type="checkbox"]:checked').length;
  if (checkedSum === 0) {
    alert('テスト種類を選択して下さい');
    return false;
  }
  return true;
}
