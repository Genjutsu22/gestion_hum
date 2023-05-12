<html lang="en"><head>
  <meta charset="UTF-8">
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('images/Logo-top.png')}}" style="height: 20px;" type="image/png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/876d7409f1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('style/apropos.css')}}">
  <title>À propos</title>
  
</head>
        @php 
        $vals = ["C'est quoi TeamUp ?"=>"TeamUp est une application web conçue pour simplifier la gestion des employés, les demandes de congé et les candidatures. Elle offre des fonctionnalités intuitives pour gérer efficacement les ressources humaines, centraliser les demandes de congé et faciliter le processus de candidature. TeamUp permet aux entreprises de gagner du temps, d'optimiser les workflows et d'améliorer la communication interne pour une gestion des employés plus efficace.",
                "Qui utilise l'application ?"=>"L'application TeamUp est utilisée par les administrateurs pour gérer les ressources humaines. Les employés l'utilisent pour soumettre des demandes de congé et interagir avec leurs collègues. Les candidats s'en servent pour postuler à des postes vacants et suivre l'état de leur candidature. C'est une solution complète pour la gestion des employés, des congés et des candidatures.",
                "Comment utiliser l'application ?"=>"Pour utiliser l'application TeamUp, suivez ces étapes simples :

        Connectez-vous à l'application avec vos identifiants d'utilisateur.
        En tant qu'administrateur, accédez au tableau de bord pour gérer les employés, les congés et les candidatures.
        En tant qu'employé, utilisez l'application pour soumettre vos demandes de congé et interagir avec vos collègues.
        En tant que candidat, postulez à des postes vacants via l'application et suivez l'évolution de votre candidature.
        Explorez les fonctionnalités intuitives de l'application pour une gestion efficace des ressources humaines.",
            "Comment avoir un compte ? "=>"Pour créer un compte sur l'application TeamUp, veuillez suivre les étapes suivantes :
        Contactez l'administrateur de l'application TeamUp.
        L'administrateur créera un compte pour vous.
        Une fois votre compte créé, vous pourrez vous connecter à l'application en utilisant vos identifiants d'utilisateur.
        Veuillez noter que seuls les administrateurs ont le pouvoir de créer des comptes sur l'application TeamUp. Si vous êtes un administrateur, vous pouvez créer des comptes pour les employés et les candidats en suivant les procédures de création de compte appropriées.",
        "L'application est-elle sécurisée ?"=>"
        L'application TeamUp garantit la sécurité des données et la protection de la vie privée de ses utilisateurs de la manière suivante :

        Fiabilité des données : L'application TeamUp utilise des mécanismes de stockage de données fiables pour assurer l'intégrité et la disponibilité des informations. Des sauvegardes régulières sont effectuées pour prévenir la perte de données.

        Stockage sécurisé des informations : Toutes les données personnelles, telles que les informations des utilisateurs, sont stockées de manière sécurisée dans des bases de données protégées. Des mesures de sécurité robustes sont mises en place pour prévenir l'accès non autorisé aux données.

        Hachage des mots de passe : Les mots de passe des utilisateurs sont stockés sous forme de hachage, ce qui signifie qu'ils sont transformés en une séquence de caractères illisible. Cela garantit que même en cas d'accès non autorisé à la base de données, les mots de passe réels restent confidentiels et ne peuvent pas être facilement récupérés.

        En mettant en œuvre ces mesures de sécurité, l'application TeamUp assure la confidentialité et l'intégrité des données, offrant ainsi une expérience d'utilisation fiable et sécurisée pour ses utilisateurs.






        "];

$i= 1;
@endphp
<body translate="no" data-new-gr-c-s-check-loaded="14.1108.0" data-gr-ext-installed="">
  <section class="faq-section">
<div class="container">
  <div class="row">
                    <!-- ***** FAQ Start ***** -->
                    <div class="col-md-6 offset-md-3">

                        <div class="faq-title text-center pb-3">
                        <h2>À propos de l'appliction</h2>
                            
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-3">
                        <div class="faq" id="accordion">
                            @foreach($vals as $k=>$v)
                            <div class="card">
                                <div class="card-header" id="faqHeading-1">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-{{$i}}" data-aria-expanded="true" data-aria-controls="faqCollapse-{{$i}}">
                                            <span class="badge">{{$i}}</span>{{$k}}
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-{{$i}}" class="collapse" aria-labelledby="faqHeading-{{$i}}" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>{{$v}}</p>
                                    </div>
                                </div>
                            </div>
                            @php 
                            $i++;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                  </div>
                </div>
                </section>
                <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2023 All Rights Reserved by Teima@info
            </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
            </ul>
          </div>
        </div>
      </div>
</footer>
  <script src="https://code.jquery.com/jquery-2.1.0.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  
  



</body><grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration></html>