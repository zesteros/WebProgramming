

var isAlreadyInTable = false;

function searchProduct(){
  location.href = "search_product.php?search="+document.getElementById('search-product').value;
}	

function searchProductForSale(){
  location.href = "sell_product.php?search="+document.getElementById('search-product').value;
} 

function sellProduct(){
  /* echo "<div style=\"overflow-x:auto;\">
    <br><table>
    <tr>
      <th>ID Producto</th>
      <th>Descripción</th>
      <th>Precio</th>
      <th>Inventario</th>
      <th>Tienda</th>
      </tr>";*/
    } 
function logout(){
  location.href = "logout.php";
}	


  // Extend the default Number object with a formatMoney() method:
  // usage: someVar.formatMoney(decimalPlaces, symbol, thousandsSeparator, decimalSeparator)
  // defaults: (2, "$", ",", ".")
  function formatMoney(number, places, symbol, thousand, decimal, currency) {
    places = !isNaN(places = Math.abs(places)) ? places : 2;
    symbol = symbol !== undefined ? symbol : "$";
    thousand = thousand || ",";
    decimal = decimal || ".";
    currency = currency != undefined ? currency : "MXN";
    var  negative = number < 0 ? "-" : "",
    i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
    j = (j = i.length) > 3 ? j % 3 : 0;
    return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "")+" "+currency;
  };


  function showResultTable(){
    var table = document.getElementById("result-table");
    var salesLabel = document.getElementById("sales-label");
    var registerButton = document.getElementById("register-sale");
    salesLabel.style.display ="table";
    salesLabel.style.margin ="auto";
    table.style.display = "table";
    registerButton.style.display ="table";
    registerButton.style.margin="auto";
  }


  function addToSales(id, desc, price, stock, predefinedQuantity){
        var priceFormatted = formatMoney(price); 
        checkPickTable(id);
        if(!isAlreadyInTable){
          /*Get the data of row to draw*/
          var data = [id, desc,priceFormatted];
      //alert(data);
      /*Get table from html*/
      var table = document.getElementById("result-table");

      showResultTable();

      /*Create row*/
      var row = document.createElement("TR");
      row.setAttribute("id","row-"+table.rows.length);
      /*String get for session php */
      str ="";
      data.forEach(function (elemento, indice, array) {
        /*Add every column to row*/
        var column = document.createElement("TD");
        var data = document.createTextNode(elemento);
        if(elemento == priceFormatted){
          column.setAttribute("id","price-row-"+table.rows.length);
        }
        column.appendChild(data);
        row.appendChild(column);
        /*Append get request to php*/
        str += indice + "=" + elemento+"&";
      });
      var columnQuantity =  document.createElement("TD");
      var quantity = document.createElement("INPUT");
      quantity.setAttribute("type", "number"); 
      quantity.setAttribute("min","1");

      predefinedQuantity = predefinedQuantity !== undefined ? predefinedQuantity : "1";

      quantity.setAttribute("value", predefinedQuantity);
      quantity.setAttribute("onkeyup","calculateTotalByRow("+id+","+table.rows.length+","+stock+")");
      quantity.setAttribute("onclick","calculateTotalByRow("+id+","+table.rows.length+","+stock+")");
      quantity.setAttribute("id","quantity-row-"+table.rows.length);
      quantity.setAttribute("max",stock);
      //quantity.setAttribute("placeholder","Ingresa cantidad a vender");
      columnQuantity.appendChild(quantity);
      row.appendChild(columnQuantity);

      row.appendChild(document.createElement("TD"));
      if(quantity.value < stock)
      var totalByQuantity = price*quantity.value;

      var totalByRowColumn = document.createElement("TD");
      totalByRowColumn.setAttribute("id","total-by-row-"+table.rows.length);
      var totalByQuantityText = document.createTextNode(formatMoney(totalByQuantity));
      totalByRowColumn.appendChild(totalByQuantityText);

      row.appendChild(totalByRowColumn);

      var columnRemoveElement =  document.createElement("TD");
      var removeButton = document.createElement("BUTTON");
      /*id=\"search-button\" onclick=\"". $onclick_method. "\"*/
      removeButton.setAttribute("onclick", "removeRow("+id+")"); 
      removeButton.setAttribute("id","add-button");
      //quantity.setAttribute("placeholder","Ingresa cantidad a vender");
      var removeText = document.createTextNode("X");
      removeButton.appendChild(removeText);
      columnRemoveElement.appendChild(removeButton);
      row.appendChild(columnRemoveElement);
      /*Add row to table*/
      table.appendChild(row);
      updateResultTableInSession(id,desc,price,stock,quantity.value);
  //calculateTotalOfRow(table, row);
     } else alert("Este producto ya esta en la lista de ventas.");
}

function updateResultTableInSession(id,desc,price,stock, quantity){
  var str = "id="+id+"&desc="+desc+"&price="+price+"&stock="+stock+"&quantity="+quantity;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    /*Response of php*/
        //alert(this.responseText);
    }
  };
  xmlhttp.open("GET", "../sales_cart.php?" + str, true);
  xmlhttp.send();
}



function calculateTotalByRow(id, rowNumber, stock){
  var priceColumn = document.getElementById("price-row-"+rowNumber);
  var subtotalColumn = document.getElementById("total-by-row-"+rowNumber);
  var quantityColumn = document.getElementById("quantity-row-"+rowNumber);
  var price = unformatNumber(priceColumn.innerHTML);
  var quantity = quantityColumn.value;

  quantityColumn.value = (quantity > stock) ? stock : quantity;
  quantity = quantityColumn.value;

  subtotalColumn.innerHTML = formatMoney(price*quantity);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "../update_sales_cart_quantity.php?id="+id+"&quantity=" + quantity, true);
  xmlhttp.send();

}


function calculateTotalOfRow(table, row){
  var tablePosition = table.rows.length;

  var quantity = document.getElementById("quantity-row-"+tablePosition);
  var price = document.getElementById("price-row-"+tablePosition);

  var priceFormatted = price.innerHTML;
  var priceUnformatted = parseFloat(priceFormatted.replace(/[^0-9-.]/g, ''));

  var totalByQuantity = priceUnformatted*quantity.value;

  var totalByRowColumn = document.createElement("TD");
  var totalByQuantityText = document.createTextNode(formatMoney(totalByQuantity));
  totalByRowColumn.appendChild(totalByQuantityText);

  row.appendChild(totalByRowColumn);

  //alert("Cantidad="+quantity.value+"\nPrecio="+priceFormatted+"\nTotal="+(priceUnformatted*quantity.value)); // 12345.99);

  /*for (var j = 0; j < 4; j++) {
   alert("RENGLON "+i+" COLUMNA "+j+" "+table.rows[i].cells[j].innerHTML);
 }*/

}

function checkPickTable(id){
  var pickTable = document.getElementById("result-table");
  // var x = document.getElementById("myTable").rows.length; 
  // alert(document.getElementById("myTable").rows[0].cells[0].innerHTML); 
  // var x = document.getElementById("myTable").rows[0].cells.length; 

  if(pickTable != null){
    for (var i = 0; i < pickTable.rows.length; i++) {
      if(id == pickTable.rows[i].cells[0].innerHTML) isAlreadyInTable = true;
      else isAlreadyInTable = false;
    } 
  }

  /*CICLE FOR TRAVEL TABLE
  for (var i = 0; i < pickTable.rows.length; i++) {
  for (var j = 0; j < 5; j++) {
   alert("RENGLON "+i+" COLUMNA "+j+" "+pickTable.rows[i].cells[j].innerHTML);
  }
}*/

}

function removeRow(id){
  resultTable = document.getElementById("result-table");
  for (var i = 0; i < resultTable.rows.length; i++) {
    if(id == resultTable.rows[i].cells[0].innerHTML){

      resultTable.deleteRow(i);

      if(resultTable.rows.length == 1) toggleTable();
      return;}
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "../delete_sales_cart_item.php?id="+id+"&quantity=" + quantity, true);
    xmlhttp.send();
  /* alert(row);
  document.getElementById("result-table").deleteRow(row);
  rowNumber--;
  if(rowNumber == 0) toggleTable();*/
}

function toggleTable() {
  var salesLabel = document.getElementById("sales-label");
  var table = document.getElementById("result-table");
  table.style.display =  "none";
  salesLabel.style.display ="none";
  var registerButton = document.getElementById("register-sale");
  registerButton.style.display = "none";

  /*if(document.getElementById("result-table").rows.length == 1){

  }*/

}


function registerSale(){
  /*CICLE FOR TRAVEL TABLE*/
  var table = document.getElementById("result-table");
  for (var i = 1; i < table.rows.length; i++) {
    var quantity = document.getElementById("quantity-row-"+i);
    var price = document.getElementById("price-row-"+i);
    var priceFormatted = price.innerHTML;
    var priceUnformatted = parseFloat(priceFormatted.replace(/[^0-9-.]/g, ''));
  //alert("Cantidad="+quantity.value+"\nPrecio="+priceFormatted+"\nTotal="+(priceUnformatted*quantity.value)); // 12345.99);

  /*for (var j = 0; j < 4; j++) {
   alert("RENGLON "+i+" COLUMNA "+j+" "+table.rows[i].cells[j].innerHTML);
 }*/
}
}

function unformatNumber(number){
  return parseFloat(number.replace(/[^0-9-.]/g, ''));
}

function getRate(from, to) {
  var script = document.createElement('script');
  script.setAttribute('src', "http://query.yahooapis.com/v1/public/yql?q=select%20rate%2Cname%20from%20csv%20where%20url%3D'http%3A%2F%2Fdownload.finance.yahoo.com%2Fd%2Fquotes%3Fs%3D"+from+to+"%253DX%26f%3Dl1n'%20and%20columns%3D'rate%2Cname'&format=json&callback=parseExchangeRate");
  document.body.appendChild(script);
}
function parseExchangeRate(data) {
  var name = data.query.results.row.name;
  var rate = parseFloat(data.query.results.row.rate, 10);
  //var text = document.createTextNode("Exchange rate " + name + " is " + rate);
  var text = document.createTextNode("Precio del dolar: $"+rate+" MXN");
  document.getElementById("dollar-price").appendChild(text);
}

function openNav() {
  //  document.getElementById("navigation-button").style.visibility = 'hidden';
  document.getElementById("mySidenav").style.width = "500px";
  document.getElementById("main").style.marginLeft = "500px";
  document.getElementById("main-bar-logo").style.marginLeft="190px";
  document.getElementById("iframe").style.marginLeft="500px";

  /*    document.getElementById("main").style.color = "rgba(0,0,0,0.4)";*/

}

function closeNav() {
  //document.getElementById("navigation-button").style.visibility = 'visible';
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main-bar-logo").style.marginLeft="350px";
  document.getElementById("main").style.marginLeft= "0";
  //document.body.style.backgroundColor = "white";
}