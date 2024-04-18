    <script>
        // PHP brings in Google Sheet Data directly is faster
        window.payload = `<?php echo $json; ?>`;
        window.payload = JSON.parse(window.payload);
        for(i=0;i<window.payload.length;i++) {
            for(j=0; j<window.payload[i].length; j++) {
                    // At the level of row i -> cell j 
                    window.payload[i][j] = window.payload[i][j].replaceAll("__DOUBLE__QUOTE__", '"');
                    // console.log(window.payload[i][j]);
            } // for
        } // for
    </script>

    <div id="data-table-wrapper" class="card" style="padding:10px; overflow:scroll;">
        <table id="data-table" class="">
        </table>

    </div>
