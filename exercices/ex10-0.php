
<?php
// Exercise 10-0
//1.display the current working directory
$currentDirectory = getcwd();

//2.verify that file ex10-0_text.txt exists in current directory, if not display message "file does not exist"
$file_name = "ex10-0_text.txt";
echo (file_exists($file_name)) ? " $file_name exist" : "$file_name does not exist";

echo '<br/>';

//3.display the file size of file ex10-0_text.txt in bytes

echo (file_exists($file_name)) ?  filesize($file_name) . " octets" : "$file_name does not exist";


//4.read whole content of file ex10-0_text.txt and save in a variable. Display content on web page.
$content = file_get_contents($file_name);
echo $content;

//5.copy file to ex10-0_text.txt to HELLO.txt
$old_name = "HELLO.txt";
if (file_exists($file_name))
    copy($file_name, $old_name);

//6.replace whole file content of HELLO.txt by the text "Hello World"
$text = "Hello World";
file_put_contents($old_name, $text);

//7.rename file HELLO.TXT to HELLO2.txt

$new_name = "HELLO2.txt";
if (file_exists($old_name))
    rename($old_name, $new_name);

//8.delete file HELLO2.txt
if (file_exists($old_name))
    unlink($old_name);
