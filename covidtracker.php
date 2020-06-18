<?php

$path = "https://api.telegram.org/bot<token>";

$update = json_decode(file_get_contents("php://input"), TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

$message = ucwords($message);

if($message == "Hey" || $message == "/start" || $message == "Hi" || $message == "Hello" || $message == "hey" || $message == "hi" || $message == "hello") {
    
    $info = "Hey, I am Slade a Covid tracker bot \n I can provide Detailed statics of Covid virus in India \n You can command or request me. \n Send me State Name or Total to get details. Also i can provide helpline numbers. Safety Measures. \n Note : Please use space if there is a space in name of the state like Andhra Pradesh.\nMore features will be updated soon";
    $info = urlencode($info);

    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$info);


}
elseif($message == "Total" || $message == "/Total" || $message == "Total India" || $message == "Total Case" || $message == "India Case" || $message == "Total Cases")
{
$response = file_get_contents("https://covid-19india-api.herokuapp.com/v2.0/country_data");
$data = json_decode($response, TRUE);

$info ="Total Active Cases : ".$data[1]['active_cases']."\n Total Confirmed Cases : ".$data[1]['confirmed_cases']."\n Death Cases : ".$data[1]['death_cases']."\n Recovered cases : ".$data[1]['recovered_cases']."\n Last updated : ".$data[1]['last_updated'];
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

$message=rawurlencode($message);
$response = file_get_contents("http://covid19-india-adhikansh.herokuapp.com/state/".$message);


if($response[12] == "i")
{
$data = json_decode($response, TRUE);
$info = "State name : ".$data['data']['0']['name']."\nActive Case : ".$data['data']['0']['active']."\nRecovered : ".$data['data']['0']['cured']."\nDeath : ".$data['data']['0']['death']."\nTotal Case : ".$data['data']['0']['total'];

$info = urlencode($info);
 file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$info);

}
else
{
file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Invalid Message , Try Again. Note : Please use space if there is a space in name of the state like Andhra Pradesh");
}


}

?>