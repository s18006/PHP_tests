<?php
header ('Content-type: text/html; charset=utf8');



//echo hash('sha256', json_encode(strtolower('DDOS')));
echo "\n";

$a = '15001';

echo hash('sha256', json_encode(443))."\n";
//echo hash('sha256', json_encode(strtolower('143')))."\n";
//echo hash('sha256', json_encode('143'));

require_once 'classes/controllerClass.php';
$controller = new controllerClass();
$test = new pageCreateClass();
echo $test -> createNewHead('link_css=test.css');

echo $test -> pageStart (
    $headpart = array('link_css=test.css', 'link_js=js/formValidate.js'),
    $form = array('open', 'method=post', 'onsubmit=return formValidate();', 'action=test2.php')
);

echo $test -> createNewTag(array('type=input-text', 'pattern=\d*', 'value=', 'maxlength=2'));


//echo $test -> createNewTag(array('type=input-number', 'oninput=javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);', 'value=', 'maxlength=3'));
//echo $number = $test -> createNewTag(array('type=input-text', 'pattern=\\d+', 'value=', 'name=testnum', 'maxlength=3'));
//echo htmlspecialchars($number);
$p_inDiv_content = $test -> createNewTag(
    $set = array('type=p', 'id=test', 'value=newtest', 'inside=div', 'class=td1')
);
echo $p_inDiv_content;

echo $test -> createNewTag(
    $test_tag_list = array(
        $h1_tag = array('value=test_h1', 'type=h1', 'inside=div', 'class=h1'),
        $h2_tag = array('value=test_h2', 'type=h2', 'inside=div', 'class=h2'),
        $h3_tag = array('value=test_h3', 'type=h3', 'inside=div', 'class=h3'),
        $h4_tag = array('value=test_h4', 'type=h4', 'inside=div', 'class=h4')
    )
);

$th_tags = $test -> createNewTable(
    $th_part = array(
        $th_1 = array('value=test1', 'type=th', 'req=disabled', 'class=th_row'),
        $th_2 = array('value=test2', 'type=th', 'req=disabled', 'class=th_row'),
        $th_3 = array('value=test3', 'type=th', 'req=disabled', 'class=th_row')
    )
);

$td_tags = $test -> createNewTable(array(
    $td_1 = array('type=td', 'value=test4', 'class=td1'),
    $td_2 = array('type=td', 'value=test5', 'class=td2'),
    $td_3 = array('type=td', 'value=test6', 'class=td3')
));

echo $test ->createNewTable($table = array('type=table', 'class=table1'));

echo $select_content = $test -> createNewSelect(
    $main = array(
        $select_part = array('type=select', 'inside=p', 'name=test_select', 'db=find', 'class=test_select'),
        $option_part = array('Search' => array('value=search', 'id=search'), 'Find' => array('value=find', 'class=find'))
    )
);

//    echo htmlspecialchars($input_text_content = $test -> createNewTag(array('name=test_input', 'type=input-text', 'req=required', 'inside=p', 'value=', 'placeholder=氏名を記入して下さい', 'id=testel', 'style=background-color:white; color:black; width: 150px;')));


echo $checkbox = $test -> createNewCheckbox(array('display=apple', 'name=fruits[]', 'value=apple', 'inside=div', 'id=apple'));
echo $checkbox = $test -> createNewCheckbox(array('display=banana', 'value=banana', 'name=fruits[]', 'inside=div', 'id=banana'));
echo $checkbox = $test -> createNewCheckbox(array('display=pineapple', 'value=pineapple', 'name=fruits[]', 'inside=div', 'id=pineapple'));


echo $test -> createNewTag(array('value=Send', 'type=input-submit'));

echo $test -> formEnd();
echo $test -> pageEnd();

?>
