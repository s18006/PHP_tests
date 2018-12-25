<?php
header('Content-Type:text/html;charset="utf8"');
include('quizClass.php');


$test = new quizClass();
$test -> setPDO_datas('mysql:dbname=newtables;host=localhost;charset=utf8', 'testuser', '0808');
$test -> connection();
$row = $test -> generateQuiz();
$question = $row['question'];
$options = array(1=>$row['option1'], 2=>$row['option2'], 3=>$row['option3'], 4=>$row['option4']);

?>

    <h3> <?php echo $question; ?> </h3>
    <?php
        foreach ($options as $key=>$value) { ?>
           <p> <button value="<?php echo $key;?>" > <?php echo $value; ?> </button> </p>
            <?php }
?>

