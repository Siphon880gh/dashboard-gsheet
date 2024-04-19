<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>

    <!-- Styling  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?php echo $_SESSION["root_url"] . "public/" ?>assets/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/assets/multipane.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">


    <!-- Scripts -->
    <script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.js"></script>
    <script src="//cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.css">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
    <script src="./public/assets/multipane.js?v=<?php echo time(); ?>"></script>

</head>

<body>
    
    <div class="container-fluid">
        <header class="site-header clearfix">
            <h1 class="site-title display-3-off"><?php echo $pageTitle; ?></h1>
            <nav class="site-nav">
                <i class="nav-mobile-icon fas fa-bars" onclick="event.target.classList.toggle('active')"></i>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $_SESSION["root_url"]; ?>">
                            <i class="fas fa-arrow-left"></i> More Connections
                        </a>
                    </li>
                    <li class="nav-item">
                        |
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="questions.shuffle(); alert('Reshuffled questions');">
                            <i class="fas fa-random"></i> Strategies
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $_SESSION["spreadsheet-link"]; ?>" target="_blank">
                            <i class="fas fa-table"></i> Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal-contact" style="cursor:pointer;">
                        <i class="fas fa-help"></i> Help
                        </a>
                    </li>
                    </li>
                </ul>
            </nav>
        </header>
        <main class="site-body">
            <article class="intro container bg-light rounded-3 px-3 py-3 px-md-5 py-md-4 my-2 my-2 my-md-4 my-md-4" data-page=0>
                <h2 class="intro-title display-5-off">Connections</h2>
                <p class="intro-description lead"><?php echo $pageDesc; ?></p>
                <section id="data-tables" class="btn-wrapper text-center my-4">


                <?php
                    // gotten
                    // $spreadsheetId
                    // $tabs

                    $panelCount = 0;
                    foreach ($tabs as $tabName) {
                        if (strcasecmp($tabName, "INFO") == 0 || strcasecmp($tabName, "COVER") == 0) {
                            continue;  // Skip the current iteration if it's "Info"
                        }

                        include "./controllers/connect-tab.php";

                        // gotten
                        // $values
                        // $json

                        echo "
                        <script>
                            // PHP brings in Google Sheet Data directly is faster
                            var payload = '$json';
                            payload = JSON.parse(payload);
                            
                            for(i=0;i<payload.length;i++) {
                                for(j=0; j<payload[i].length; j++) {
                                        // At the level of row i -> cell j 
                                        payload[i][j] = payload[i][j].replaceAll(\"__DOUBLE__QUOTE__\", '\"');
                                        // console.log(payload[i][j]);
                                } // for
                            } // for
                        </script>
                        
                        <div class='data-table-wrapper card' style='padding:10px; overflow:scroll;' data-internal-id='module-$tabName'>
                            <h3 style='padding:0; margin:0;'>$tabName</h3>
                            <hr style='padding:0; margin:0; margin-bottom:10px;'></hr>
                            <table id='data-table-$panelCount'>
                            </table>
                        </div>

                        <script>
                            var idSelector = '#data-table-$panelCount';
                            renderIn(idSelector, payload);
                        </script>
                        ";


                        $chart_info = [];

                        if(strpos(strtoupper($tabName), "[XYYYY-LINE")!==false) {
                            $chart_info["TABNAME"] = $tabName;
                            $chart_info["CHART_TYPE"] = "XYYYY-LINE";
                            $chart_info["HUMAN_LABEL"] = "XYYYY-LINE";
                            $PARAM = ""; // TODO Probably will get all string after first [. Then parse from tabName if has (.
                            $interm = str_replace(" ", "", $PARAM); 
                            $interm = str_replace("(", "", $PARAM); 
                            $interm = str_replace(")", "", $PARAM); 
                            $chart_info["PARAMS"] = $interm; // Eg: A,B
                        } else if(strpos(strtoupper($tabName), "[XYYY-LINE")!==false) {
                            $chart_info["TABNAME"] = $tabName;
                            $chart_info["CHART_TYPE"] = "XYYY-LINE";
                            $chart_info["HUMAN_LABEL"] = "XYYY-LINE";
                        } else if(strpos(strtoupper($tabName), "[XYY-LINE")!==false) {
                            $chart_info["TABNAME"] = $tabName;
                            $chart_info["CHART_TYPE"] = "XYY-LINE";
                            $chart_info["HUMAN_LABEL"] = "XYY-LINE";
                        } else if(strpos(strtoupper($tabName), "[XY-LINE")!==false) {
                            $chart_info["TABNAME"] = $tabName;
                            $chart_info["CHART_TYPE"] = "XY-LINE";
                            $chart_info["HUMAN_LABEL"] = "XY-LINE";
                        } else if(strpos(strtoupper($tabName), "[BAR")!==false) {
                            $chart_info["TABNAME"] = $tabName;
                            $chart_info["CHART_TYPE"] = "BAR";
                            $chart_info["HUMAN_LABEL"] = "BAR";
                        } else if(strpos(strtoupper($tabName), "[PIE")!==false) {
                            $chart_info["TABNAME"] = $tabName;
                            $chart_info["CHART_TYPE"] = "PIE";
                            $chart_info["HUMAN_LABEL"] = "PIE";
                        } else if(strpos(strtoupper($tabName), "[SCATTER")!==false) {
                            $chart_info["TABNAME"] = $tabName;
                            $chart_info["CHART_TYPE"] = "SCATTER";
                            $chart_info["HUMAN_LABEL"] = "SCATTER";
                        } else if(strpos(strtoupper($tabName), "[HISTO")!==false) {
                            $chart_info["TABNAME"] = $tabName;
                            $chart_info["CHART_TYPE"] = "HISTO";
                            $chart_info["HUMAN_LABEL"] = "HISTO";
                        } else if(strpos(strtoupper($tabName), "[AREA")!==false) {
                            $chart_info["TABNAME"] = $tabName;
                            $chart_info["CHART_TYPE"] = "AREA";
                            $chart_info["HUMAN_LABEL"] = "AREA";
                        };
                        // TODO: Parameters like "Test [XY-LINE(A,B)]" should be parsed for column labels. But how to efficiently store and retrieve for code logic
                        // TODO: How to associate which tabula rdata to which chart we want

                        if(count($chart_info)>0) {
                            echo "
                                <div class='data-table-wrapper card' style='padding:10px; overflow:scroll;' data-internal-id='module-$tabName-chart'>
                                    <h3 style='padding:0; margin:0;'>" . $chart_info["HUMAN_LABEL"] . "</h3>
                                    <hr style='padding:0; margin:0; margin-bottom:10px;'></hr>
                                    <div>
                                    Coming soon! A chart will be displayed here.
                                    </div>
                                </div>
                            ";
                        }

                        $panelCount++;
                    } // for
                ?>

                </section>
            </article>

        </main>
    </div> <!-- Ends container-fluid -->


    <div class="container promote-features">
        <hr/>
        By <a href="javascript:void(0)" onclick="$('.creds-socials').toggleClass('d-none');">Weng</a>.<br/>
        <div class='creds-socials d-none'>
        <a target="_blank" href="https://github.com/Siphon880gh" rel="nofollow"><img src="https://img.shields.io/badge/GitHub--blue?style=social&logo=GitHub" alt="Github" data-canonical-src="https://img.shields.io/badge/GitHub--blue?style=social&logo=GitHub" style="max-width:8.5ch;"></a>
        <a target="_blank" href="https://www.linkedin.com/in/weng-fung/" rel="nofollow"><img src="https://img.shields.io/badge/LinkedIn-blue?style=flat&logo=linkedin&labelColor=blue" alt="Linked-In" data-canonical-src="https://img.shields.io/badge/LinkedIn-blue?style=flat&amp;logo=linkedin&amp;labelColor=blue" style="max-width:10ch;"></a>
        <a target="_blank" href="https://www.youtube.com/user/Siphon880yt/" rel="nofollow"><img src="https://img.shields.io/badge/Youtube-red?style=flat&logo=youtube&labelColor=red" alt="Youtube" data-canonical-src="https://img.shields.io/badge/Youtube-red?style=flat&amp;logo=youtube&amp;labelColor=red" style="max-width:10ch;"></a>
        </div>
        This is for educational purposes only. We are not responsible for any harm or damage from using these tools.
    </div>

    <!-- Modal: Contact me -->
    <div class="modal fade" id="modal-contact" tabindex="-1" aria-labelledby="Contact me modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalContactLabel">Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  <!-- modal-header -->
                <div class="modal-body">
                    <div class="text-center">
                        <a href="https://wengindustry.com/me/contact/" target="_blank">Contact Weng</a><br/>
                    </div>
                </div> <!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Done</button>
                </div> <!-- modal-footer -->
            </div>  <!-- modal-content -->
        </div>  <!-- modal-dialog -->
    </div>  <!-- modal -->


</body>
</html>