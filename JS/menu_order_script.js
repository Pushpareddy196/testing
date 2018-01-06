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

            readTextFile("https://pushpareddy196.github.io/testing/pizzasList.json", function (text) {
                var data = JSON.parse(text);
                data = data["list"];
                console.log(data);
                $.each(data, function (i, item) {
                    // alert(item);
                    var pizzadetails = JSON.stringify(item);
                    var pizza = "<div class='col-sm-3'>";
                    pizza += "<div class='thumbnail pizza-details' style='margin-top:100px;'>";
                    pizza += "<h4 class='text-center'>" + item['name'] + "</h4>";
                    pizza += "<img src='" + item['image'] + "' class='img-responsive' alt='" + item['name'] + "' />";
                    pizza += "<div class='caption text-center toppings'>";
                    pizza += "<p>" + item['toppingsDescription'] + "</p>";
                    pizza += "<p><b>Price : RS." + item['price'] + "</b></p>";
                    pizza += "<button class='btn btn-primary add' type='button' data-pizza='" + pizzadetails + "'>Add To Cart</button>";
                    pizza += "</div>";
                    pizza += "</div>";
                    pizza += "</div>";
                    $("#menu").append(pizza);
                });

            });
            $(function () {
                $(".page-content").css({"margin-top": $("nav").height() + 20 + "px"});
                $(window).resize(function () {
                    $(".page-content").css({"margin-top": $("nav").height() + 20 + "px"});
                });

                        var i = 0;
                $(".add").click(function (e) {
                    //$("#cart").show();
                    i = i + 1;
                    var adable = $(this).data('pizza');
                    newRow = "<tr>";
                    newRow += "<td>" + i + "</td>";
                    newRow += "<td>" + adable["name"] + "</td>";
                    newRow += "<td class='price'>" + adable["price"] + "</td>";
                    newRow += "<td><input type='checkbox' name='record'></td>";
//                    newRow += "<td class='btn btn-sm sensor-delete'>delete</td>";
                    newRow += "</tr>";
                    $("#cart tbody").append(newRow);
                    console.log(adable["name"]);
                    totalprice();
                });
                $(".delete-row").click(function () {
                    $("table tbody").find('input[name="record"]').each(function () {
                        if ($(this).is(":checked")) {
                            $(this).parents("tr").remove();
                        }
                    });
                    totalprice();
                });

                function totalprice() {
                    var sum = 0;
                    $(".price").each(function () {
                        var value = $(this).text();
                        // add only if the value is number
                        if (!isNaN(value) && value.length !== 0) {
                            sum += parseFloat(value);
                        }
                    });
                    $("#total").html("<b>Total Price:</b> RS." + sum);
                    console.log("Total Price:" + sum);
                }

                $("#submitbtn").click(function () {
                    var convertTableToJson = function ()
                    {
                        var order = [];
                        var pizzas = [];
                        $('tbody tr').each(function (i, n) {
                            var $row = $(n);
                            pizzas.push($row.find('td:eq(1)').text());
                        });
                        order.push({
                            customerName: $("input[name=cname]").val(),
                            phone: $("input[name=ph]").val(),
                            address: $("input[name=addr]").val(),
                            orderedPizzas: pizzas
                        });
                        return order;
                    };
                    $.ajax({
                        type: 'POST',
                        url: "Save_Order_json.php",
                        data: {'neworder': convertTableToJson()},
                        async: false,
                        success: function () {
                            $("#successmodal").modal("show");
                        }
                    });
                });
            });

