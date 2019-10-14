<?php
if(!isset($_SESSION['account_permission']))
{
    header("Location:../index.php");
}
else
{
?>
<?php
$bdd=connexion_bdd();
$comptex=new Compte();
$cc=$comptex->get_compte($_SESSION['id']);
$r=$cc->fetch();

?>

<!-- Logo -->
<a href="index.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>G</b>RH</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>HR</b>Meister</span>
</a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar
                    <img src="" class="user-image" alt="User Image">-->
                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                   <i class="fa  fa-user"></i>
                    <span class="hidden-xs"><?php echo $r['nom'].' '.$r['prenom']; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                        <p>
                            <?php echo $r['nom'].' '.$r['prenom']; ?></br>
                            <?php echo $r['email']; ?>
                        </p>
                        <?php if ((substr($r['nom'],0,1) == 'a')||(substr($r['nom'],0,1) == 'A')) { ?> <img src="./public/dist/img/alphabet/a.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'b')||(substr($r['nom'],0,1) == 'B')) { ?> <img src="./public/dist/img/alphabet/b.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'c')||(substr($r['nom'],0,1) == 'C')) { ?> <img src="./public/dist/img/alphabet/c.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'd')||(substr($r['nom'],0,1) == 'D')) { ?> <img src="./public/dist/img/alphabet/d.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'e')||(substr($r['nom'],0,1) == 'E')) { ?> <img src="./public/dist/img/alphabet/e.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'f')||(substr($r['nom'],0,1) == 'F')) { ?> <img src="./public/dist/img/alphabet/f.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'g')||(substr($r['nom'],0,1) == 'G')) { ?> <img src="./public/dist/img/alphabet/g.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'h')||(substr($r['nom'],0,1) == 'H')) { ?> <img src="./public/dist/img/alphabet/h.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'i')||(substr($r['nom'],0,1) == 'I')) { ?> <img src="./public/dist/img/alphabet/i.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'j')||(substr($r['nom'],0,1) == 'J')) { ?> <img src="./public/dist/img/alphabet/j.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'k')||(substr($r['nom'],0,1) == 'K')) { ?> <img src="./public/dist/img/alphabet/k.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'l')||(substr($r['nom'],0,1) == 'L')) { ?> <img src="./public/dist/img/alphabet/l.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'm')||(substr($r['nom'],0,1) == 'M')) { ?> <img src="./public/dist/img/alphabet/m.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'n')||(substr($r['nom'],0,1) == 'N')) { ?> <img src="./public/dist/img/alphabet/n.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'o')||(substr($r['nom'],0,1) == 'O')) { ?> <img src="./public/dist/img/alphabet/o.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'p')||(substr($r['nom'],0,1) == 'P')) { ?> <img src="./public/dist/img/alphabet/p.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'q')||(substr($r['nom'],0,1) == 'Q')) { ?> <img src="./public/dist/img/alphabet/q.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'r')||(substr($r['nom'],0,1) == 'R')) { ?> <img src="./public/dist/img/alphabet/r.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 's')||(substr($r['nom'],0,1) == 'S')) { ?> <img src="./public/dist/img/alphabet/s.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 't')||(substr($r['nom'],0,1) == 'T')) { ?> <img src="./public/dist/img/alphabet/t.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'u')||(substr($r['nom'],0,1) == 'U')) { ?> <img src="./public/dist/img/alphabet/u.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'v')||(substr($r['nom'],0,1) == 'V')) { ?> <img src="./public/dist/img/alphabet/v.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'w')||(substr($r['nom'],0,1) == 'W')) { ?> <img src="./public/dist/img/alphabet/w.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'x')||(substr($r['nom'],0,1) == 'X')) { ?> <img src="./public/dist/img/alphabet/x.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'y')||(substr($r['nom'],0,1) == 'Y')) { ?> <img src="./public/dist/img/alphabet/y.png" class="img-circle" alt="User Image"> <?php } ?>
                        <?php if ((substr($r['nom'],0,1) == 'z')||(substr($r['nom'],0,1) == 'Z')) { ?> <img src="./public/dist/img/alphabet/z.png" class="img-circle" alt="User Image"> <?php } ?>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="row">
                            <div class="col text-center">
                                <p>Poste : responsable GRH</br>
                                    Privilèges :
                                    <?php
                                        if($r['account_permission']=='a') echo 'Administrateur';
                                        if($r['account_permission']=='g') echo 'gestionnaire';

                                    ?>
                                    </br>
                                    Statut : Actif</p>
                            </div>
                            <!--<div class="col-xs-4 text-center">
                              <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                              <a href="#">Friends</a>
                            </div>
                          </div>-->
                            <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="index.php?action=deconnect" class="btn btn-default btn-flat">Déconnexion</a>
                        </div>
                    </li>

                </ul>
            </li>
            <li>

                <a class="btn btn-flat-success glyphicon glyphicon-question-sign"  type="button" href="Aide/fichier_aide.pdf" download"> Aide </a>
            </li> <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
        </ul>
    </div>
</nav>
    <?php
}
?>