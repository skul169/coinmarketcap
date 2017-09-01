function UpdateImmediately(dataResult) {
    if (dataResult == null)
        return;

 console.log(dataResult);

    var updateSegmentDataList;
  
    changedRow = document.getElementById("id-"+dataResult.symbol);
 
     if (changedRow != null) {

                cellIndex = 7;
                 

                $("#id-"+dataResult.symbol).css({ 'background': "#f5f5f5" }) ;// = "#f5f5f5";

                changedRow.cells[2].innerHTML = "$"+formatNumber(dataResult.price); 
                changedRow.cells[3].innerHTML = "$"+formatNumber(dataResult.mktcap); 
                changedRow.cells[4].innerHTML = dataResult.symbol+" "+formatNumber(dataResult.supply); 
                changedRow.cells[5].innerHTML = "$"+formatNumber(dataResult.volume); 

                if (dataResult.capPercent > "0") {
                      changedRow.cells[6].className = "no-wrap percent-24h  positive_change  text-right upPrice"
                      changedRow.cells[6].innerHTML = dataResult.capPercent.toFixed(2)+ "% <span class=\"glyphicon glyphicon-chevron-up\"></span>";
                            
                } else if (dataResult.capPercent < "0") {
                      changedRow.cells[6].className = "no-wrap percent-24h  positive_change  text-right downPrice"
                      changedRow.cells[6].innerHTML = dataResult.capPercent.toFixed(2) + "% <span class=\"glyphicon glyphicon-chevron-down\"></span>";

                }else{
                    var vChange = "0.00";
                    changedRow.cells[6].innerHTML = vChange + "% ";
                }

            // UpCellD(cell)
             setTimeout(function () {
                   $("#id-"+dataResult.symbol).css({ 'background': "#f5f5f5" }) ;// = "#f5f5f5";
                }, 1000);

             setTimeout(function () {

            $("#id-"+dataResult.symbol).css({ 'background': "none" }) ;// = "#f5f5f5";
           
            }, 1000);
            
        }

  
}
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}


