<?php

$path = "https://api.telegram.org/<bot api>";

$update = json_decode(file_get_contents("php://input"), TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

$message = ucwords($message);

if($message == "Hey" || $message == "/start" || $message == "Hi" || $message == "Hello" || $message == "hey" || $message == "hi" || $message == "hello") {
    
   $info = "Hey, I am Slade a Covid tracker bot \nI can provide Detailed statics of Covid virus in India \nYou can command or request me. \nSend me State Name or Total to get details. Also i can provide helpline numbers. Safety Measures. \nNote : Please use space if there is a space in name of the state like Andhra Pradesh.\nMore features will be updated soon\nApi Credits : https://github.com/amodm/api-covid19-in";
    $info = urlencode($info);

    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$info);

  
}

elseif($message == "Developer" || $message == "/Developer" || $message == "Creator" || $message == "Develop")
{
  $info = "Hey, Myself Akshay Shetty.I am Freelancer web developer . I like to be involved at different stages of a digital project, from the seed of the idea, to sketches, design and even WordPress. \nGithub : https://github.com/akshy0407 \nLinkedin : https://www.linkedin.com/in/akshy0407/";
    $info = urlencode($info);

    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$info);


}
elseif($message == "Helpline" || $message == "/Helpline" || $message == "helpline Number" || $message == "Help" || $message == "Contacts" || $message == "Helpine No")
{
    
    
$response = file_get_contents("https://api.rootnet.in/covid19-in/contacts");
$data = json_decode($response, TRUE);

  $info = "Contact & helpline \nContact Number : ".$data['data']['contacts']['primary']['number']."\nToll Free No : ".$data['data']['contacts']['primary']['number-tollfree']."\nEmail : ".$data['data']['contacts']['primary']['email']."\nTwitter : ".$data['data']['contacts']['primary']['twitter'];
    $info = urlencode($info);

    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$info);


}
elseif($message == "Total" || $message == "/Total" || $message == "Total India" || $message == "Total Case" || $message == "India Case" || $message == "Total Cases")
{
$response = file_get_contents("https://api.rootnet.in/covid19-in/stats/latest");
$data = json_decode($response, TRUE);

$info ="Total Cases : ".$data['data']['summary']['total']."\nTotal Confirmed Cases : ".$data['data']['summary']['confirmedCasesIndian']."\nDeath : ".$data['data']['summary']['deaths']."\nRecovered cases : ".$data['data']['summary']['discharged'];
$info = urlencode($info);
 file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$info);

}
elseif($message == "Safety" || $message == "/Safety Measures" || $message == "/Safety" || $message == "Safety Measures" || $message == "SafetyMeasurese" || $message == "Safetymeasures")
{
    $info = "Protective measures again Coronavirus \n Follow these five easy steps to help prevent the spread of COVID-19 \n1.Sneeze or cough?  Cover your nose and mouth with a tissue or use your elbow. \n2.Wash your hands often with soap and water for at least 20 seconds. \n 3.Clean and disinfect surfaces around your home and work frequently. \n4.Keep at least 6 feet between yourself and others if you must be in public.\n5.Wear a cloth face covering over your mouth and nose when around others. ";

$info = urlencode($info);
 file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$info);
}
elseif($message == "State" || $message == "/State")
{
    $info = "Enter State Name to get details of particular State. \nNote : Please use space if there is a space in name of the state like Andhra Pradesh ";

$info = urlencode($info);
 file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$info);
}

else
{

$response = file_get_contents("https://api.rootnet.in/covid19-in/stats/latest");
$data = json_decode($response, TRUE);

$found = 0;
for($i=0;$i < 35;$i++){
    
    $c = $data['data']['regional'][$i]['loc'];
    if($c == $message)
    {
        $found = 1;
        break;
    }
    
}

if($found == "1")
{
$info = "State name : ".$data['data']['regional'][$i]['loc']."\nConfirmed Cases Indian : ".$data['data']['regional'][$i]['confirmedCasesIndian']."\nConfirmed Cases Foreign : ".$data['data']['regional'][$i]['confirmedCasesForeign']."\nRecovered : ".$data['data']['regional'][$i]['discharged']."\nDeath : ".$data['data']['regional'][$i]['deaths'];

$info = urlencode($info);
 file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$info);

}
else
{
file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Invalid Message , Try Again. Note : Please use space if there is a space in name of the state like Andhra Pradesh");
}


}

?>
