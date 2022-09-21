<?php

// initialize variables
$pswd = "";
$code = "";
$error = "";
$valid = true;

// if form was submit
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// declare encrypt and decrypt funtions
	require_once('vigenere.php');
	
	// set the variables
	$pswd = $_POST['pswd'];
	$code = $_POST['code'];
	
	// check if password is provided
	if (empty($_POST['pswd']))
	{
		$error = "Please enter a password!";
		$valid = false;
	}
	
	// check if text is provided
	else if (empty($_POST['code']))
	{
		$error = "Please enter some text or code to encrypt or decrypt!";
		$valid = false;
	}
	
	// check if password is alphanumeric
	else if (isset($_POST['pswd']))
	{
		if (!ctype_alpha($_POST['pswd']))
		{
			$error = "Password should contain only alphabetical characters!";
			$valid = false;
		}
	}
	
	// inputs valid
	if ($valid)
	{
		// if encrypt button was clicked
		if (isset($_POST['encrypt']))
		{
			$code = encrypt($pswd, $code);
			$error = "Text encrypted successfully!";
		}
			
		// if decrypt button was clicked
		if (isset($_POST['decrypt']))
		{
			$code = decrypt($pswd, $code);
			$error = "Code decrypted successfully!";
		}
	}
}

?>
<?php
    error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Enkripsi & Dekripsi</title>
        <link rel="stylesheet" href="style2.css">
        <script type="text/javascript" src="Script.js"></script>

    </head>
    <body>      
        <div class="enkrip">
            <div class="atas">
                <form action="index2.php" method="POST">
                    <center><h4>KEY</h4></center>
                    <input type="text" name="pswd" id="pass" class="key" placeholder="Masukkan key ..." value="<?php echo htmlspecialchars($pswd); ?>">
                    <center><h4>PLAINTEXT</h4></center>
                    <textarea name="code" cols="50" rows="8" style="font-family: Arial; padding: 10px;" placeholder="Masukkan disini ..."></textarea><br>
                    <input type="submit" name="encrypt" value="ENKRIPSI !" onclick="validate(1)" class="button btn1" />
                    <input type="submit" name="decrypt" value="DEKRIPSI !" onclick="validate(2)" class="button btn2" />

                </form>
            </div>
            <div class="bawah enkripsi">
                <center><h4>HASIL</h4></center>
                <textarea name="hasil" cols="50" rows="10" style="font-family: Arial; padding: 10px;" readonly><?php echo htmlspecialchars($code); ?></textarea>
                <center><?php echo htmlspecialchars($error) ?></center>
            </div>
        </div>
    </body>
</html>
