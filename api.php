<?php
header("Content-Type:application/json");

if(!empty($_GET['name']))
{
    $name=$_GET['name'];
    $price = get_price($name);

    if(empty($price))
    {
        response(200,"Product Not Found",NULL);
    }
    else
    {
        response(200,"Product Found",$price);
    }

}
else
{
    response(400,"Invalid Request",NULL);
}

function get_price($name)
{
    $products = [
      "book"=>20,
      "pen"=>10,
      "pencil"=>5
    ];

    foreach($products as $product=>$price)
    {
        if($product==$name)
        {
            return $price;
            break;
        }
    }
}

function response($status,$status_message,$data)
{
    header("HTTP/1.1 ".$status);

    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data;

    $json_response = json_encode($response);
    echo $json_response;
}