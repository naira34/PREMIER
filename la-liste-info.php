<div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                        <div class="product-status-wrap drp-lst">
                            <br>
                            <h1> Liste des demandes d'informations </h1>
                        </div>
                        <div class="sparkline13-list">
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
											<option value="">Display Basic</option>
											<option value="all">Display All</option>
											<option value="selected">Display Selected</option>
										</select>
                                    </div>
                                    <?php
                                    // Include config file
                                    require_once "config.php";
                                    
                                    // Attempt select query execution
                                    
                                    $sql = "SELECT * 
                                      FROM demmandeinfo AS di
                                      JOIN utilisateurs AS u ON di.departement = u.departement
                                       WHERE u.id = $id_personne";
                                    if($result = mysqli_query($link, $sql)){ 				
                                        if(mysqli_num_rows($result) > 0){
                                            echo '<table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                            data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">';
                                                echo "<thead>";
                                                    echo "<tr>";
                                                        echo "<th data-field='state' data-checkbox='true'></th>";
                                                        echo "<th>demandeur</th>";
                                                        echo "<th>direction</th>";
                                                        echo "<th>deparetement</th>";
                                                        echo "<th>atelier</th>";
                                                        echo "<th>date</th>";
                                                        echo "<th>titre</th>";
                                                        echo "<th>documment_ecrit</th>";
                                                        echo "<th>documment_cartographie</th>";
                                                        echo "<th>raster</th>";
                                                        echo "<th>echelle</th>";
                                                        echo "<th>validation</th>";
                                                        echo "";
                                                    echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                while($row = mysqli_fetch_array($result)){
                                                    echo "<tr>";
                                                        echo "<td></td>"; 				
                                                        echo "<td>" . $row['demandeur'] . "</td>";
                                                        echo "<td>" . $row['direction'] . "</td>";
                                                        echo "<td>" . $row['deparetement'] . "</td>";
                                                        echo "<td>" . $row['atelier'] . "</td>";
                                                        echo "<td>" . $row['date'] . "</td>";
                                                        echo "<td>" . $row['titre'] . "</td>";
                                                        echo "<td>" . $row['documment_ecrit'] . "</td>";
                                                        echo "<td>" . $row['documment_cartographie'] . "</td>";
                                                        echo "<td>" . $row['raster'] . "</td>";
                                                        echo "<td>" . $row['echelle'] . "</td>";
                                                        echo "<td>" . $row['validation'] . "</td>";

                                                        
                                                    echo "</tr>";
                                                }
                                                echo "</tbody>";                            
                                            echo "</table>";
                                            // Free result set
                                            mysqli_free_result($result);
                                        } else{
                                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                        }
                                    } else{
                                        echo "Oops! Something went wrong. Please try again later.";
                                    }
                 
                                    // Close connection
                                    mysqli_close($link);
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        

       
       
  
