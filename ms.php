<!DOCTYPE html>
<html>

<head>
    <title>M I N E S W E E P E R</title>
    <style>
        tr {
            height: 12pt;
        }

        td {
            background-color: black;
            width: 12pt;
            text-align: center;
        }
    </style>
</head>

<body>

    <table border="1">
        <?php


        $size = 30;
        // $size = game_size;

        for ($i = 1; $i <= $size; $i = $i + 1) {
            echo ("<tr>");
            for ($j = 1; $j <= $size; $j++) {
                $id = "r" . $i . "c" . $j;
                $kk = 'id';
                // onClick="changerowcolor('id1')"
                // echo ("<td  style=background-color:blue id='r" . $i . "c" . $j . "'><a>....</a></td>");
                echo ("<td id=" . $id . "   
                      onClick='play(" . $kk .  ")'>O</td>");
            }
        }
        echo ("</tr>");

        ?>



    </table>




    <script>
        const bumbCount = 150; // minu skaits
        const tableSize = 30; // laukuma izmērs
        let firstCell = '';
        // saliek laukumā bumbas
        function bombing(nrOfBombs) {
            let counter = 1;
            while (counter <= nrOfBombs) {
                const rowIndex = getRndInteger(1, tableSize);
                const colIndex = getRndInteger(1, tableSize);
                const mIndex = 'r' + rowIndex + 'c' + colIndex;
                let cellVal = document.getElementById(mIndex).innerHTML;
                if (cellVal.trim != "M" && mIndex != firstCell) {
                    document.getElementById(mIndex).innerHTML = "M";
                    counter = counter + 1;
                }
            }
        }

        // ------------------------------------
        // sasaita , cik bumbas ir ap šūnām
        function countCellBombs() {
            for (let i = 1; i <= tableSize; i++) {
                for (let j = 1; j <= tableSize; j++) {
                    cellIndex2count = 'r' + i + 'c' + j;
                    const cell2check = document.getElementById(cellIndex2count).innerHTML;
                    if (cell2check != "M") {
                        let bumbCountCell = 0;
                        // alert (" M nav! " + cellIndex2count )
                        for (let ii = i - 1; ii <= i + 1; ii++) {
                            for (let jj = j - 1; jj <= j + 1; jj++) {
                                if (ii >= 1 && ii <= tableSize && jj >= 1 && jj <= tableSize) {
                                    let index2Count = 'r' + ii + 'c' + jj;
                                    // alert ("ii=" + ii + " jj= " +jj+ "  " + index2Count);
                                    const cellVal = document.getElementById(index2Count).innerHTML;
                                    //  alert (" M nav! " + 'r' + ii + 'c'+jj );
                                    if (cellVal == "M") {
                                        // alert ("cell cout +"); 
                                        bumbCountCell = bumbCountCell + 1;
                                    }
                                    if (bumbCountCell == 0) {
                                        bumbCountCell = 0
                                    }
                                    document.getElementById(cellIndex2count).innerHTML = bumbCountCell;
                                }
                            }
                        }
                        bumbCountCell = bumbCountCell + 1;
                    }
                }
            }


        }

        // -------------------------------

        function getRndInteger(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        // spēle - izsauc, kad nospiež lauciņu
        function play(cellID) {
            if (firstCell == '') {
                firstCell = cellID;
                bombing(bumbCount); // sākumā saliek mīnas
                countCellBombs(); // saskaita mīnas
            }
            const cell = document.getElementById(cellID);
            cell.style.backgroundColor = '#DDDDDD';

            const cellValue = document.getElementById(cellID).innerHTML.trim();
            let clearArea = [];
            // ja M - atklāj mīnas
            if (cellValue == "M") {
                alert("Spēle galā");

                for (let kr = 1; kr <= tableSize; kr++) {
                    for (let kc = 1; kc <= tableSize; kc++) {
                        const cInd = "r" + kr + "c" + kc;
                        //  alert("cind  " + cInd);
                        const celVal = document.getElementById(cInd).innerHTML;
                        if (celVal == "M") {
                            const cellM = document.getElementById(cInd);
                            cellM.style.backgroundColor = 'yellow';
                        }

                    }

                }
                //-------------
            }

            // ja 0 - atklāj visus laikus, kur blakus ir 0 
            if (cellValue == "0") {
                clearArea[0] = cellID;
                let loopArea = 0;
                // cikls - masīvā ieraksta šūnu adrses, kur ir 0.
                // Pārbauda , kas ir blakus šūnās ar 0. Ja 0 - pārbauda, vai masīvā tāds ieraksts jau ir. Ja nav - pievieno.
                // Turpina līdz netiek atklātas blakus esošas šūnas ar 0.
                // lauki ar 0 un  tam blakus esošie tiek nokrāsoti balti. 
                do {
                    loopArea = 0;
                    clearArea.forEach(cellAreaID => {
                        const cPos = cellAreaID.indexOf("c");
                        const rInd = parseInt(cellAreaID.substring(1, cPos));
                        const cInd = parseInt(cellAreaID.substring(cPos + 1, cPos + 3));
                        for (let i = rInd - 1; i <= rInd + 1; i++) {

                            for (let j = cInd - 1; j <= cInd + 1; j++) {

                                if (i >= 1 && j >= 1 && i <= tableSize && j <= tableSize) {
                                    const idV = ('r' + i + 'c' + j);
                                    const cellArea = document.getElementById(idV).innerHTML;
                                    const cellO = document.getElementById(idV);
                                    cellO.style.backgroundColor = 'white';
                                    if (cellArea == "0") {
                                        cellO.style.color = 'white';
                                        if (clearArea.indexOf(idV) == -1) {
                                            clearArea.push(idV);
                                            loopArea = 1;
                                        }

                                    }
                                }
                            }
                        }

                    });

                }
                while (loopArea == 1);
            }
            // ------------------------------------------
        }
    </script>
</body>

</html>