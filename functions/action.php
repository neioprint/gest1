 <div class="btn-group-vertical">
                            
                            
                                <a class="btn btn-primary btn-sm btn-success" 
                                href="detailscommande.php?id=<?= $resultcommande[$i]['id'] ?>&page=<?=$page?>">Consulter</a>
                              
                                <a class="btn btn-primary btn-sm" 
                                href="editcommande.php?id=<?= $resultcommande[$i]['id'] ?>&page=<?=$page?>">Modifier</a>
                                <?php
                                if ($_SESSION['user']['role']=='ADMIN') { 
                               // print_r($_SESSION['user']['role']);
                                ?> 
                                <a class="btn btn-primary btn-sm btn-warning" 
                                href="deletecommande.php?id=<?= $resultcommande[$i]['id'] ?>&page=<?=$page?>">Supprimer</a> 

                                <?php } ?>

                                <?php $etatsuivi=$resultcommande[$i]['etat']; 

                                $etatsuivi=explode("/",$etatsuivi);     
                                $etatsuivi=$etatsuivi[0];
                                //print_r( $etatsuivi);
                               
                                if ($etatsuivi==1){ ?> 
                                    <a class="btn btn-primary btn-sm btn-danger" 
                                    href="terminercommande.php?id=<?= $resultcommande[$i]['id'] ?>&suite=99&page=<?=$page?>">Terminer</a>  
                                <?php } ?>

                                <?php if ($etatsuivi==0){ ?>
                                    <a class="btn btn-primary btn-sm btn-danger" 
                                    href="terminercommande.php?id=<?= $resultcommande[$i]['id'] ?>&suite=9&page=<?=$page?>">Debuter</a>  
                                <?php } ?>
                                <?php if ($etatsuivi==2){ ?>
                                    <a class="btn btn-primary btn-sm btn-danger" 
                                    href="terminercommande.php?id=<?= $resultcommande[$i]['id'] ?>&suite=999&page=<?=$page?>">Livrer</a>  
                                <?php } ?>

                                <?php if ($etatsuivi==3){ ?>
                                    <a class="btn btn-primary btn-sm btn-danger" 
                                    href="terminercommande.php?id=<?= $resultcommande[$i]['id'] ?>&suite=9999&page=<?=$page?>">Archiver</a>  
                                <?php } ?>
                                
                                
                              
                               <?php 
                               //print_r($_SESSION['user']['role']);
                               if ($_SESSION['user']['role']=='ADMIN') { 
                               // print_r($_SESSION['user']['role']);
                                ?>
                                
                               
                               
                                <a class="btn btn-primary btn-sm" 
                                href="blivraisoncommande.php?id=<?= $resultcommande[$i]['id'] ?>&page=<?=$page?>">Imprimer</a>
                                <a class="btn btn-primary btn-sm" 
                                href="proforma.php?id=<?= $resultcommande[$i]['id'] ?>&page=<?=$page?>">Proforma</a>

                                <?php 
                               
                                } ?>
                               
                                <!-- fin de btn group div -->
                                </div>