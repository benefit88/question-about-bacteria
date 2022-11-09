<?php
$name=$mobNumber=$email=$tactCount="";
$nameErr=$mobNumberErr=$emailErr=$tactCountErr= "";
extract($_POST);

function back($tactCount)
{
    $green = 1;
    $red = 1;
    for ($i = 1; $i <= $tactCount; $i++) {
        $tempGreen = $green*3 + $red*7;
        $tempRed = $green*4 + $red*5;
        $red = $tempRed;
        $green = $tempGreen;
    }

    echo "Количество зеленых бактерий : $green <br>";
    echo "Количество красных бактерий : $red <br>";
}

if(isset($_POST['submit']))
{
    $valid_name="/[^a-zA-Zа-яА-Я]/ui";
    $valid_mobNumber = "/[^0-9\-+]/";
    $valid_tactCount = "/[^0-9]/";
    //Проверка имени
    if (empty($name))
    {
        $nameErr = '<font color="red">заполните имя</font>';
    }
    elseif (preg_match($valid_name,$name))
    {
        $nameErr = '<font color="red">Имя может содержать только буквы</font>';
    }
    else
    {
        $nameErr = true;
    }

    //Проверка теоефона
    if(empty($mobNumber))
    {
        $mobNumberErr = '<font color="red">заполните телефон</font>';
    }
    elseif (preg_match($valid_mobNumber,$mobNumber))
    {
        $mobNumberErr = '<font color="red">В номере телефона должны быть только «+», «-» и цифры</font>';
    }
    else
    {
        $mobNumberErr = true;
    }

    //Проверка почты
    if (empty($email))
    {
        $emailErr = '<font color="red">заполните почту</font>';
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $emailErr = '<font color="red">Неверный формат почты</font>';
    }
    else
    {
        $emailErr = true;
    }

    //Проверка тактов
    if (empty($tactCount))
    {
        $tactCountErr = '<font color="red">Укажите количество тактов</font>';
    }
    elseif (preg_match($valid_tactCount,$tactCount))
    {
        $tactCountErr = '<font color="red">Только цифры</font>';
    }
    else
    {
        $tactCountErr = true;
    }


    if ($nameErr == 1 && $mobNumberErr == 1 && $emailErr == 1 && $tactCountErr == 1)
    {
        back($tactCount);
    }
}

?>
<html>
<head>
    <title>Бактерии</title>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Имя</label><br>
    <input type="text" name="name" value="<?php echo $name; ?>"<br>
    <p class="err-msg">
        <?php if($nameErr!=1){ echo $nameErr; }?>

    </p>
    <label>Номер телефона</label><br>
    <input type="text" name="mobNumber" value="<?php echo $mobNumber ?>"<br>
    <p class="err-msg">
        <?php if($mobNumberErr!=1){ echo $mobNumberErr; }?>
    </p>
    <label>Почта</label><br>
    <input type="text" name="email" value="<?php echo $email ?>"<br>
    <p class="err-msg">
        <?php if($emailErr!=1){ echo $emailErr; }?>
    </p>
    <label>Количество тактов</label><br>
    <input type="text" name="tactCount" value="<?php echo $tactCount ?>"<br>
    <p class="err-msg">
        <?php if($tactCountErr!=1){ echo $tactCountErr; }?>
    </p>
    <input type="submit" name="submit" value="Submit Form"><br>
</form>
<p>
</p>
</body>
</html>