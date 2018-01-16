<!DOCTYPE html>
<html>
    <head>
        <title>Orders</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Bootstrap CSS-->
        <link href="bootstrap-3/css/bootstrap.min.css" rel="stylesheet"/>
        <!--Google fonts-->
        <link href='https://fonts.googleapis.com/css?family=Akronim' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
        <!--Bootstrap JS-->
        <script src="bootstrap-3/jquery-3.2.1.min.js" type="text/javascript"></script>
        <!--jQuery-->
        <script src="bootstrap-3/js/bootstrap.min.js" type="text/javascript"></script>
        <!--Custom styles-->
        <link href="CSS/styles.css" rel="stylesheet"/>
        <!--Custom Script-->
        <script>
            function readTextFile(file, callback) {
                var rawFile = new XMLHttpRequest();
                rawFile.overrideMimeType("application/json");
                rawFile.open("GET", file, true);
                rawFile.onreadystatechange = function () {
                    if (rawFile.readyState === 4 && rawFile.status === 200) {
                        callback(rawFile.responseText);
                    }
                };
                rawFile.send(null);
            }

//usage:
            readTextFile("orders.json", function (text) {
                var data = JSON.parse(text);
                data = data["orders"];
                console.log(data);
                $.each(data, function (i, item) {
                    // alert(item);
                    var orderdetails = JSON.stringify(item);
                    console.log(orderdetails);
                    var order = "<tr>";
                    order += "<td>" + (i + 1) + "</td>";
                    order += "<td>" + item["customerName"] + "</td>";
                    order += "<td>" + item['phone'] + "</td>";
                    order += "<td>" + item['address'] + "</td>";
                    order += "<td>" + item['orderedPizzas'] + "</td>";
                    order += "<td>" + item['time'] + "</td>";
                    order += "</tr>";
                    $("tbody").append(order);
                });

            });

        </script>
        <style>
            td{
                font-size:17px;
                padding:10px;
            }
            th{
                color:#265a88;
                font-weight:bold;
                padding:15px;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#wsdmpizza-menu">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand" href="PizzasUI.html">WSDM PiZZA HUB</a>
                </div>
                <div class="collapse navbar-collapse" id="wsdmpizza-menu">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="PizzasUI.html">HOME</a></li>
                        <li><a href="menu.html">OUR MENU</a></li>
                        <li><a href="offers.html">OFFERS</a></li>
                        <li><a href="contact.html">CONTACT</a></li>
                    </ul>
                    <button type="button" class="btn btn-info navbar-btn" data-toggle="collapse" data-target="#cart">Cart</button>
                    <button class="btn btn-danger navbar-btn navbar-right">ORDER NOW</button> 
                </div>
            </div>
        </nav>
        <div class="container-fluid" style="margin-top:60px;">
            <div class="row" id="menu">
                <div class="col-sm-8 col-sm-offset-2">
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Customer Nmae</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Ordered Pizzas List</th>
                                <th>Ordered Time</th>
                            </tr>
                        <tbody>

                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <footer class="nav navbar navbar-fixed-bottom">
            <p>WisdmLabs © 2018.All rights reserved
                <span class="pull-right"><span class="glyphicon glyphicon-envelope"></span> mail: <a href="mailto:info@wisdmlabs.com">
                        info@wisdmlabs.com</a>.</span></p>
        </footer>
    </body>
</html>
